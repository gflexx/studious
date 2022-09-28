@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Register</h4>
    <div class="row">
        <div class="col-7 col-md-5">
            <form class="p-5" action="{{ route('save_user') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="text-white" for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                    @error('username')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="text-white" for="mail">Email</label>
                    <input type="email" name="email" id="mail" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="text-white" for="pwd1">Password</label>
                    <input type="password" name="password" id="pwd1" class="form-control mb-3" required>
                    @error('password')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="text-white" for="pwd2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="pwd2" class="form-control mb-3" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Register</button>
                    <a class="ms-5" href="{{ route('login') }}">Login</a>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
