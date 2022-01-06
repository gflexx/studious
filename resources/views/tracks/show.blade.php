@extends('layouts.app')

@section('content')

<div class="page">

    <div class="row">
        <div class="col-md-4">
            <img class="img-studio" src="{{ asset($track->image) }}" alt="">
        </div>
        <div class="col">
            <h4 class="text-white">{{ $track->title }}</h4>
            <div class="py-3">
                <audio controls src="{{ asset($track->file) }}"></audio>
            </div>
            <p class="text-info">Description: <span class="text-white">{{ $track->description }}</span></p>
            <p class="text-info">Added: <span class="text-white">{{ $track->created_at }}</span></p>
            <p class="text-info">By: <span class="text-white">{{ $track->owner->username }}</span></p>
            @if ($track->owner->studio)
                <p class="text-info">Studio:
                    <span class="text-white h5">
                        @if ($track->owner->studio)
                            {{ $track->owner->studio->title }}
                        @endif
                    </span>
                </p>
            @endif
            @if (!$track->owner->studio && $signed_studio)
            <p class="text-info">Signed to:
                <span class="text-white h5">
                    {{ $signed_studio[0]->title }} Studio
                </span>
            </p>
            @endif
            <p class="text-info">Price: <span class="text-white">{{ $track->price }} KSHS.</span></p>
            <div>
                @if (auth()->check())
                    @if (auth()->user()->id != $track->owner->id)
                        <a href="{{ route('chat', $track->owner->id) }}" class="btn btn-success me-4">Send Message</a>
                    @endif

                    <button class="btn btn-primary">Add to Cart</button>
                @else
                    <p class="text-white">Please sign in to send message and add item to cart.</p>
                @endif
            </div>
        </div>

    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-11 col-md-9">
            <h5 class="text-white">Comments <span class="text-muted">( {{ $comments->count() }} )</span></h5>
            <form action="{{ route('add_comment') }}" method="post">
                @csrf
                <input type="hidden" name="track_id" value="{{ $track->id }}">
                <textarea required name="text" class="form-control" rows="2"></textarea>
                @if (auth()->check())
                    <input type="hidden" name="owner_id" value="{{ auth()->user()->id }}">
                    <div class="mt-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                @endif
            </form>
            @if (!auth()->check())
                <p class="text-white mt-3">Please Log In to Comment</p>
            @endif
            <hr class="text-white">

            <div class="mb-5">
            @forelse ($comments as $comment)
                <div class="row mb-2 comment">
                    <div class="col-3 col-md-1">
                        <img src="{{ asset('user_images/'.$comment->owner->image) }}" class="comment-img rounded-circle">
                    </div>
                    <div class="col">
                        <p class="text-info mb-0">{{ $comment->owner->username }}</p>
                        <p class="text-white">{{ $comment->text }}</p>
                    </div>
                </div>
            @empty
                <div class="alert alert-secondary mb-5">
                    <p class="">No comments to show yet</p>
                </div>
            @endforelse
            </div>

        </div>
    </div>

</div>

@endsection
