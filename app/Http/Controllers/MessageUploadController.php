<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageMedia;
use App\Models\MessageShare;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageUploadController extends Controller
{
    public function index()
    {
        return view('message.upload');
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'messages' => 'required|file|mimes:json,txt'
        ]);
        $messageFile = $request->file('messages');
        $content = json_decode($messageFile->getContent(), true);

        $nonContents = [];

//        foreach ($content as $messageItem)
//        {
//            if (!isset($messageItem['sender_name']))
//            {
//                $nonContents[] = $messageItem;
//            }
//        }
//        dd($content);
        DB::beginTransaction();
        try {
            foreach ($content['messages'] ?? [] as $messageItem)
            {
                $messageContent = $messageItem['content'] ?? null;
                $message = Message::query()
                    ->create([
                        'from' => $messageItem['sender_name'],
                        'content' => $messageContent,
                        'on' => Carbon::createFromTimestampMs($messageItem['timestamp_ms']),
                        'audio_call' => $this->checkIfContentAudioCall($messageContent),
                        'video_call' => $this->checkIfContentVideoCall($messageContent)
                    ])
                ;
                $this->storeAssets($messageItem, $message->id);
                if (isset($messageItem['share']))
                {
                    $this->manageShare($messageItem['share'], $message->id);
                }
            }
            DB::commit();
            return redirect()->to('/message/upload');
        }catch (\Exception $exception)
        {
            DB::rollBack();
            dd($exception);
        }
    }

    public function manageShare($shareItem, $messageID)
    {
        if (isset($shareItem['link']))
        {
            MessageShare::query()
                ->create([
                    'message_id' => $messageID,
                    'link' => $shareItem['link'],
                    'owner' => $shareItem['original_content_owner'] ?? null
                ])
            ;
        }
    }

    public function storeAssetsByType($messageItem, $parentID, $type = 'photos')
    {
        if (array_key_exists($type, $messageItem))
        {
            foreach ($messageItem[$type] as $single)
            {
                $this->storeMessageMediaQuery($single, $parentID, $type);
            }
        }
    }

    public function storeMessageMediaQuery($single, $parentID, $type = 'photos')
    {
        MessageMedia::query()
            ->create([
                'message_id' => $parentID,
                'type' => $type,
                'url' => $this->changeAssetURL($single['uri'] ?? $single['url']),
//                'on' => Carbon::createFromTimestampMs($single['creation_timestamp'])
            ]);
    }

    public function storeAssets($messageItem, $parentID)
    {
        $this->storeAssetsByType($messageItem, $parentID);
        $this->storeAssetsByType($messageItem, $parentID, 'videos');
    }

    public function changeAssetURL(string $currentURL)
    {
        return str_replace('your_activity_across_facebook/messages/inbox/sapana_1182706193122257', 'assets', $currentURL);
    }

    public function checkIfContentAudioCall(?string $content): bool
    {
        return $content && (str_contains($content, 'started an audio call') || str_contains($content, 'Audio call ended'));
    }

    public function checkIfContentVideoCall(?string $content): bool
    {
        return $content && (str_contains($content, 'started a video chat') || str_contains($content, 'Video chat ended'));
    }
}
