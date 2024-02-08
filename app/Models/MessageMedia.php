<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageMedia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'message_id', 'type', 'url', 'on'
    ];

    protected $casts = [
      'on' => 'timestamp'
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
