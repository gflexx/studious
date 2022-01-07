@extends('layouts.app')

@section('content')

<div class="home">

    <div class="mt-3">
        <h4 class="text-white">Signed Studios</h4>
        <div class="row g-2">
            @foreach ($studios as $studio)
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="card bg-secondary mb-2 text-center">
                        <a href="{{ route('show_studio', $studio->id) }}">
                            <img class="studio-img-h img-fluid" src="{{ asset($studio->image) }}" alt="">
                        </a>
                        <div class="card-body">
                            <a style="text-decoration: none;" class="h6 text-info" href="{{ route('show_studio', $studio->id) }}">{{ $studio->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-3 mb-5">
        <h4 class="text-white">Tracks</h4>
        <div class="row g-2">
            @foreach ($tracks as $track)
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="card track-card mb-2 text-center">
                        <a href="{{ route('show_track', $track->id) }}">
                            <img class="studio-img-h img-fluid" src="{{ asset($track->image) }}" alt="">
                        </a>
                        <div class="card-body">
                            <a style="text-decoration: none;" class="h6 text-white" href="{{ route('show_track', $track->id) }}">{{ $track->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
