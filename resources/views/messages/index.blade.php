@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="text-center">
                <img class="profile-img rounded-circle img-fluid" src="{{ asset('user_images/'.$receiver->image) }}" alt="">
                <p class="text-white">{{ $receiver->username }}</p>
            </div>
        </div>
        <div class="col-9 mt-4">
            <form action="{{ route('save_message') }}" method="post">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="row g-3">
                    <div class="col-11">
                        <textarea class="form-control" name="text" id="text" rows="2" required></textarea>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </div>

            </form>

            <div class="messages mt-5 text-white">
                @forelse ($messages as $msg)
                    <div
                        @if ($msg->sender->id == $user->id)
                            class="sender text-end"
                        @else
                            class="receiver text-start"
                        @endif
                    >
                        <div class="message lh-1">
                            <p class="mb-1">{{ $msg->message }}</p>
                            <p class="mb-1"><small>{{ $msg->created_at }}</small></p>
                            <p class="text-info msg-bg">Me</p>
                            <p class="text-info sender-bg">{{ $msg->sender->username }}</p>
                            <span style="clear: both;"></span>
                        </div>

                    </div>
                @empty
                    <p class="text-white">No messages yet.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection
