@extends('layouts.app')

@section('content')

<div class="profile">

    <h4 class="text-white">Profile</h4>
    <div class="text-center">
        <img class="profile-img rounded-circle img-fluid" src="{{ asset('user_images/'.auth()->user()->image) }}" alt="">
        <p class="text-light">{{ auth()->user()->email }}</p>
    </div>
    <hr class="text-white">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-dark">
                <h6 class="text-white">
                    Messages:
                </h6>
            </div>

        </div>
        <div class="col">
            <div class="py-2 mb-2">
                <h5 class="text-white">User information</h5>
                <p class="text-info">Username: <span class="text-white">{{ auth()->user()->username }}</span></p>
                <p class="text-info">Email: <span class="text-white">{{ auth()->user()->email }}</span></p>
                <p class="text-info">Created: <span class="text-white">{{ auth()->user()->created_at }}</span></p>
                <div class="mt-3">
                    <a href="{{ route('edit_profile', auth()->user()) }}" class="btn btn-primary">Update Profile</a>
                </div>
            </div>
            <div class="mb-5 py-2">
                <h5 class="text-white">Tracks and Studio</h5>
                <div class="p-2">
                    <a href="{{ route('add_track') }}" class="btn btn-info">Upload Track</a>
                    @if (!$studio->count() == 0)
                        <a href="{{ route('edit_studio', $studio[0]->id) }}" class="btn btn-success">Edit Studio</a>
                        <a href="{{ route('sign_artist', $studio[0]->id) }}" class="btn btn-primary">Sign Artist to Studio</a>
                    @else
                        <a href="{{ route('create_studio') }}" class="btn btn-success">Create Studio</a>
                    @endif
                </div>
                <div class="py-2">
                    <h5 class="text-white mt-3 mb-2">Studio</h5>
                    @if($studio->count() == 0)
                        <p class="text-white">No Studio </p>
                    @else
                        <div class="card studio-card">
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    <a href="{{ route('show_studio', $studio[0]->id) }}">
                                        <img class="studio-img img-fluid" src="{{ asset($studio[0]->image) }}" alt="">
                                    </a>
                                </div>
                                <div class="col">
                                    <a style="text-decoration: none;" class="h4 text-info" href="{{ route('show_studio', $studio[0]->id) }}">{{ $studio[0]->title }}</a>
                                    <p class="text-info mt-2">About: <span class="text-white">{{ $studio[0]->description }}</span></p>
                                    <p class="text-info mt-1">Created: <span class="text-white">{{ $studio[0]->created_at }}</span></p>
                                    <p class="text-info mt-1">Signings: <span class="text-white">{{ $studio[0]->signings()->count() }}</span></p>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>

                <div class="py-2">
                    <h5 class="text-white mt-3 mb-2">Tracks</h5>
                    @if(! $tracks->count() > 0)
                        <p class="text-light">No tracks to show</p>
                    @else
                        <div class="row py-2 g-2">
                            @foreach ($tracks as $track)
                                <div class="col col-md-6">
                                    <div class="card bg-secondary">
                                        <div class="row">
                                            <div class="col-4 col-md-4">
                                                <a href="{{ route('show_track', $track->id) }}">
                                                    <img class="track-image" src="{{ asset($track->image) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a style="text-decoration: none;" class="text-info h4" href="{{ route('show_track', $track->id) }}">{{ $track->title }}</a>
                                                <p class="text-dark mt-2">By: <span class="text-light">{{ $track->owner->username }}</span></p>
                                                <p class="text-dark mt-1">Added: <span class="text-light">{{ $track->created_at }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>


</div>

@endsection
