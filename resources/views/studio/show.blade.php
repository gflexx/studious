@extends('layouts.app')

@section('content')

<div class="">
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <img class="img-studio" src="{{ asset($studio->image) }}" alt="">
            </div>
        </div>
        <div class="col">
            <div class="py-2">
                <h4 class="text-white">{{ $studio->title }}</h4>
                <p class="text-info mt-2">About: <span class="text-white">{{ $studio->description }}</span></p>
                <p class="text-info">Owner: <span class="text-white">{{ $studio->owner->username }}</span></p>
                <p class="text-info">Created: <span class="text-white">{{ $studio->created_at }}</span></p>
                <p class="text-info">Artist Signings: <span class="text-white">{{ $studio->signings->count() }}</span></p>
                <p class="mb-0">
                    <button
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#artistsCollapse"
                    aria-expanded="false"
                    aria-controls="artistsCollapse"
                    class="btn btn-outline-secondary">
                        Show Signed Artists
                </button>
                </p>
                <div class="collapse mt-2" id="artistsCollapse">
                    @forelse ($signings as $signing)
                        <div class="card card-body py-0 small track-card mb-1">
                            <div class="row text-white">
                                <div class="col-3">
                                    <img src="{{ asset('user_images/'.$signing->user->image) }}" alt="" class="img-fluid rounded-circle sm-img">
                                </div>
                                <div class="col">
                                    <h6 class="text-info mb-1">{{ $signing->user->username }}</h6>
                                    <p class="mb-1">Song Count: {{ $signing->user->tracks->count() }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-white">No signed artist</p>
                    @endforelse
                </div>
                <br>
                @if (auth()->user()->id != $studio->owner->id && auth()->check())
                    <a href="{{ route('chat', $studio->owner->id) }}" class="btn btn-primary">Message Studio Owner</a>

                    <a href="#" class="btn btn-outline-success mt-3">Book Studio Session</a>
                @endif

            </div>
        </div>
        <div class="col p-2">
            <h6 class="text-white">Notices:</h6>
            <hr class="text-white">
            <p class="text-white">No notices yet</p>
        </div>
    </div>
    <div class="row mt-3 justify-content-center mb-5">
        <h3 class="text-white">Tracks</h3>
        @forelse ($tracks as $track)
            <div class="row studio-song mb-2">
                <div class="col-4 col-md-2">
                    <a style="text-decoration: none;" href="{{ route('show_track', $track->id) }}">
                        <img src="{{ asset($track->image) }}" alt="" class="studio-tack-img rounded">
                    </a>
                </div>
                <div class="col">
                    <h5 class="text-white mb-0">
                        <a style="text-decoration: none;" href="{{ route('show_track', $track->id) }}">{{ $track->title }}</a>
                    </h5>
                    <p class="text-info">By: <span class="text-white">{{ $track->owner->username }}</span></p>
                    <div class="py-0">
                        <audio controls src="{{ asset($track->file) }}"></audio>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-white">No tracks available yet</p>
        @endforelse
    </div>

</div>

@endsection
