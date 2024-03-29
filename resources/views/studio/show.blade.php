@extends('layouts.app')

@section('content')

<div class="">
    @if (session('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <p class="mb-1">{{ session('status') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
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
                <p class="text-info">Fees: <span class="text-white">{{ $studio->session_fees }} Kshs.</span></p>
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
                                    <h6 class="text-info mb-1">
                                        <a href="{{ route('track_owner', $signing->user->id) }}"
                                            style="text-decoration: none; text-decoration-color: inherit;">
                                        {{ $signing->user->username }}</a>
                                    </h6>
                                    <p class="mb-1">Song Count: {{ $signing->user->tracks->count() }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-white">No signed artist</p>
                    @endforelse
                </div>
                <br>
                @if (auth()->check())
                    @if (auth()->user()->id != $studio->owner->id)
                        <a href="{{ route('chat', $studio->owner->id) }}" class="btn btn-primary">Message Studio Owner</a>
                        @if ($availability->is_available)
                            <a href="{{ route('create_session', $studio->id) }}" class="btn btn-outline-success mt-3">Book Studio Session</a>
                        @else
                            <p class="text-white mt-3">Studio is not available for session booking</p>
                        @endif

                    @endif
                @else
                    <p class="text-white">Please login to Send Mesage and Book Studio Session</p>
                @endif

            </div>
        </div>
        <div class="col p-2">
            <h6 class="text-white">Notices:</h6>
            <hr class="text-white">
            <div class="notices">
                @forelse ($studio->notices as $notice)
                    <div class="row gx-3 py-2">
                        @if ($notice->text)
                            <div class="col-9">
                                <ul class="mb-2">
                                    <li class="text-white h6">{{ $notice->text }}</li>
                                </ul>
                            </div>
                        @elseif ($notice->image)
                            <div class="col-9 mt-2 ">
                                <ul class="mb-2">
                                    <li class="text-center text-white">
                                        <img class="notice-img img-fluid rounded" src="{{ asset('notices/'.$notice->image) }}" alt="">
                                    </li>
                                </ul>
                            </div>
                        @endif
                        <div class="col">
                            @if (auth()->check())
                                @if (auth()->user()->id == $studio->owner->id)
                                    <form action="{{ route('delete_notice') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                                        <input type="hidden" name="notice_id" value="{{ $notice->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-white">No notices yet</p>
                @endforelse
            </div>
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
