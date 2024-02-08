<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from', 'content', 'on', 'reaction', 'reply_to', 'audio_call', 'video_call'
    ];

    protected $casts = [
      'on' => 'timestamp'
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(MessageMedia::class)->orderBy('on');
    }
}
