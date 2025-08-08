<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{

    protected $fillable = [
        'sender_id',
        'rfq_id',
        'conversation_id',
        'message',
        'has_attachment',
    ];

    public function rfq(): BelongsTo
    {
        return $this->belongsTo(Rfq::class, 'rfq_id');
    }

    public function messageAttachments()
    {
        return $this->hasMany(MessageAttachment::class, 'message_id');
    }
    
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }
}

