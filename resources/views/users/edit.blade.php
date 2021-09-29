@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Edit Profile</h4>
    <div class="row">
        <div class="col-7 col-md-5">
            <form class="p-5" action="{{ route('save_edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="text-white" for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username') ?? $user->username }}" required>
                    @error('username')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="text-white" for="mail">Email</label>
                    <input type="email" name="email" id="mail" class="form-control" value="{{ old('email') ?? $user->email }}" required>
                    @error('email')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-white" class="mb-3">
                    <label for="formFile" class="form-label">User Image</label>
                    <input class="form-control" accept="image/*" value="{{ old('image') ?? asset('avatars/'.$user->image) }}" name="image" type="file" id="formFile">
                    @error('image')
                        <p class="text-muted">{{ $message }}</p>
                     @enderror
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </div>
            </form>>
        </div>
    </div>

</div>

@endsection
