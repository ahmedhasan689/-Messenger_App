<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'last_message_id',
        'type',
    ];

    /**
     * Participants => Users
     * Relation Between Conversation And Users
     * Many To Many
     * */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')->withPivot([
            'joined_at',
            'role'
        ]);
    }

    // Relation Message
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    // Relation With User ( How Created MSG )
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relation With Last Message
    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id', 'id')->withDefault();
    }

}
