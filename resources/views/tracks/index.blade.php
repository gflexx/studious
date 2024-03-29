@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Published Tracks</h4>
    <div class="row mt-3 g-2">
        @foreach ($tracks as $track)
            <div class="col col-md-6">
                <div class="card track-card">
                    <div class="row">
                        <div class="col-4 col-md-3">
                            <a href="{{ route('show_track', $track->id) }}">
                                <img class="track-image" src="{{ asset($track->image) }}" alt="">
                            </a>
                        </div>
                        <div class="col">
                            <a style="text-decoration: none;" class="text-info h4" href="{{ route('show_track', $track->id) }}">{{ $track->title }}</a>
                            <p class="text-info mt-2">By: <span class="text-light"><a href="{{ route('track_owner', $track->owner->id) }}">{{ $track->owner->username }}</a></span></p>
                            <p class="text-info mt-1">Price: <span class="text-light">{{ $track->price }} Kshs.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
