@extends('layouts.app')

@section('content')

<div>
    <p class="h4 text-center text-white mb-5">Search for: {{$search}}</p>
    <div>
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
</div>

@endsection
