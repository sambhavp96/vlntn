<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageShare extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'message_id', 'link', 'owner'
    ]
    ;

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
