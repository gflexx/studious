@extends('layouts.app')

@section('content')

<div class="">

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
            <p class="text-info">Studio:
                <span class="text-white">
                    @if ($track->owner->studio)
                        {{ $track->owner->studio->title }}
                    @endif
                </span>
            </p>
            <p class="text-info">Price: <span class="text-white">{{ $track->price }} KSHS.</span></p>
            <button class="btn btn-primary">Add to Cart</button>
        </div>
    </div>

</div>

@endsection
