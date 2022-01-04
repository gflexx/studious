@extends('layouts.app')

@section('content')

<div class="container">
    <div class="text-center">
        <img class="profile-img rounded-circle img-fluid" src="{{ asset('user_images/'.$receiver->image) }}" alt="">
        <p class="text-white">{{ $receiver->username }}</p>
    </div>
    <hr class="text-white">
    <div class="row">
        <div class="col-9">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="row g-3">
                    <div class="col-10">
                        <textarea class="form-control" name="text" id="text" rows="2" required></textarea>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </div>

            </form>

            <div class="messages">

            </div>
        </div>
    </div>

</div>

@endsection
