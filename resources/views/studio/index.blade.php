@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white mb-3">Signed Studios</h4>
    <div class="row g-2">
        @foreach ($studios as $studio)
            <div class="col-md-6">
                <div class="card bg-dark mb-2">
                    <div class="row">
                        <div class="col-3 col-md-4">
                            <a href="{{ route('show_studio', $studio->id) }}">
                                <img class="studio-img img-fluid" src="{{ asset($studio->image) }}" alt="">
                            </a>
                        </div>
                        <div class="col">
                            <a style="text-decoration: none;" class="h4 text-info" href="{{ route('show_studio', $studio->id) }}">{{ $studio->title }}</a>
                            <p class="text-muted mt-2">About: <span class="text-white">{{ $studio->description }}</span></p>
                            <p class="text-muted">Created <span class="text-white">{{ $studio->created_at }}</span></p>
                            <p class="text-muted">Signings <span class="text-white">{{ $studio->signings()->count() }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



</div>

@endsection
