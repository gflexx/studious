@extends('layouts.app')

@section('content')

<div class="container">
    <div class="text-center">
        <img class="profile-img rounded-circle img-fluid" src="{{ asset('user_images/'.$owner->image) }}">
        <p class="text-info mb-1">Name: <span class="text-white">{{ $owner->username }}</span></p>

        @if ($signing)
            <p class="text-info mb-1">Studio: <span class="text-white"></span></p>
        @endif

        <p class="text-info mb-1">Tracks: <span class="text-white">{{ $tracks->count() }}</span></p>
        <a href="#" class="btn btn-primary btn-sm mb-1">Send Message</a>
    </div>
    <hr class="text-white">
    <div class="row g-2">
        @forelse ($tracks as $track)
            <div class="col col-md-6">
                <div class="card bg-secondary">
                    <div class="row">
                        <div class="col-4 col-md-3">
                            <a href="{{ route('show_track', $track->id) }}">
                                <img class="track-image" src="{{ asset($track->image) }}" alt="">
                            </a>
                        </div>
                        <div class="col">
                            <a style="text-decoration: none;" class="text-info h4" href="{{ route('show_track', $track->id) }}">{{ $track->title }}</a>
                            <p class="text-dark mt-1">Added: <span class="text-light">{{ $track->created_at }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-white">No tracks to dislay yet.</p>
        @endforelse
    </div>

</div>

@endsection
