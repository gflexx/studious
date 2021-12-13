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
            </div>
        </div>
    </div>
    <div class="row mt-3 justify-content-center mb-5">
        <h3 class="text-white">Tracks</h3>
        @forelse ($tracks as $track)
            <div class="row studio-song">
                <div class="col-4 col-md-2">
                    <img src="{{ asset($track->image) }}" alt="" class="studio-tack-img rounded">
                </div>
                <div class="col">
                    <p class="text-white">{{ $track->title }}</p>
                    <p class="text-info">By: <span class="text-white">{{ $track->owner->username }}</span></p>
                </div>
            </div>
        @empty
            <p class="text-white">no tracks available yet</p>
        @endforelse
    </div>

</div>

@endsection
