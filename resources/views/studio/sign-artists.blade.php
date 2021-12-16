@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row g-5">
        <div class="col-md-4">
            <h5 class="text-white mb-3">Signed Artists:</h5>
            @foreach ($studio->signings as $signing)
                <div class="row signing-card mb-2">
                    <div class="col-4">
                        <div class="text-center">
                            <img src="{{ asset('user_images/'.$signing->user->image) }}" alt="" class="small-img rounded-circle img-fluid">
                        </div>
                    </div>
                    <div class="col">
                        <p class="text-white">{{ $signing->user->username }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col">
            <h4 class="text-white">{{ $studio->title }}</h4>
            <p class="text-info">Owner: <span class="text-white">{{ $studio->owner->username }}</span></p>
            <p class="text-info">Artist Signings: <span class="text-white">{{ $studio->signings->count() }}</span></p>
            <hr class="text-white">
            <h6 class="text-white">Sign an Artists to the Studio:</h6>
            <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#signArtistModal">Get Artists</button>

            <div class="modal fade" id="signArtistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Sign Artists</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Select the artists from the list:</p>
                      <form action="{{ route('save_sign') }}" method="post">
                        @csrf
                        <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                        <select name="user_id" required class="form-select mb-3" multiple aria-label="multiple select example">
                            @foreach ($user_list as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-center">
                            <input class="btn btn-success" type="submit" value="Submit">
                        </div>

                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
