<?php

namespace App\Http\Controllers;

use App\Notifications\FriendNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function befriend($id_recipient){
        //Recuperation de l'utilisateur à qui on envoie la demande
        $recipient = User::find($id_recipient);
        
        $user = Auth::user();
        $user->befriend($recipient);

        $details_user = [
            'message' => "Votre demande à " . $recipient->name . " a été envoyé avec succès"
        ];

        $details_recipient = [
            'message' => $user->name . " veut être votre ami"
        ];

        // Envoie de la notification
        $user->notify(new FriendNotification($details_user));

        $recipient->notify(new FriendNotification($details_recipient));

        return redirect()->back();
    }

    public function accept_friend($sender_id)
    {
        $user_who_connect = Auth::user();
        $sender = User::find($sender_id)->first();
        $user_who_connect->acceptFriendRequest($sender);

        return redirect()->back();
    }

    public function denied_friend($sender_id)
    {
        $user_who_connect = Auth::user();
        $sender = User::find($sender_id)->first();
        $user_who_connect->denyFriendRequest($sender);

        return redirect()->back();
    }

}
