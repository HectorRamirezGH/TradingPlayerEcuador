<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Friend;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class Chatroom extends Component
{
    public $noChat = false;

    public $receiver;
    public $current_user;
    public $message;
    public $thread;
    public $receiver_id;
    public $notification;

    protected $rules = ['message' => 'required'];

    public function startChat($id)
    {
        $this->noChat = true;

        $this->receiver = $id;

        $this->current_user = Auth::user()->id;

        // change to chat read
        $notifications = Message::where('thread', $this->current_user.'-'.$this->receiver)->orWhere('thread', $this->receiver.'-'.$this->current_user)->update(['is_read' => '1']);
    }

    public function sendChat ()
    {
        $this->validate();

        $thread_value = $this->current_user . '-' .$this->receiver;

        if($this->thread = 0){
            Message::create([
                'thread' => $thread_value,
                'message' => $this->message,
                'receiver_id' => $this->receiver,
                'sender_id' => $this->current_user
            ]);
        }else{
            Message::create([
                'thread' => $thread_value,
                'message' => $this->message,
                'receiver_id' => $this->receiver,
                'sender_id' => $this->current_user
            ]);
        }

        $this->clearForm();

    }

    public function clearForm ()
    {
        $this->message = "";
    }

    public function render()
    {
        // All variables
        $user = Auth::user()->id;

        $receiver = $this->receiver;

        $current = User::find($receiver);

        // get all users
        $users = User::where('id', '!=', $user)->get();

        // check if current user is friend
        $friend = Friend::where('friend', $current)->first();

        // get all chats
        $messages = Message::where('thread', $user.'-'.$receiver)->orWhere('thread', $receiver.'-'.$user)->get();        

        return view('livewire.chatroom', compact('messages', 'users', 'current', 'friend'));
    }
}
