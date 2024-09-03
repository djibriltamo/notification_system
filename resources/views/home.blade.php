@extends('layouts.app')

@section('content')

<style>
    #status {
        background-color: rgb(214, 214, 214);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <?php
            $user_id = Auth::user()->id;

            $user_who_connect = Auth::user(); //Information de l'utilisateur connecté


            $users = App\Models\User::where('id','!=', $user_id)->get();
        ?>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 align="center">{{ __('Liste des utilisateurs') }}</h3></div>
                    <ul class="list-group">
                        @foreach ($users as $user)
                                <li 
                                @if($user_who_connect->hasSentFriendRequestTo($user))
                                    id="status" 
                                @endif
                                    class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $user->name}}

                                @if($user_who_connect->hasSentFriendRequestTo($user))
                                    <span class="btn btn-secondary">Vous avez déjà envoyé une demande d'amitié</span>
                                @else
                                    <a href="{{ route('befriend', $user->id) }}" class="btn btn-primary">Ajouter comme ami(e)</a>
                                @endif
                                </li>
                        @endforeach
                      </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3 align="center">{{ __('Liste des suggestions d\'amis ') }}</h3></div>
                    <ul class="list-group">
                        @foreach ($user_who_connect->getFriendRequests() as $request)

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $request->sender->name }}
                                <a href="{{ route('accept_friend', $request->sender->id) }}" class="btn btn-success">Confirmer</a>
                                <a href="{{ route('denied_friend', $request->sender->id) }}" class="btn btn-danger">Refuser</a>
                            </li>
                        @endforeach
                      </ul>
            </div>
        </div>
    </div>
</div>
@endsection
