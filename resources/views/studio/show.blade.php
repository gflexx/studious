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
    <div class="row mt-3">
        <h3 class="text-white">Tracks</h3>
    </div>

</div>

@endsection
