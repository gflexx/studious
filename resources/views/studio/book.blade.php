@extends('layouts.app')

@section('content')

<div class="bg-dark text-white">
    <h4>Book Studio Session at: {{ $studio->title }}</h4>
    <div class="row">
        <div class="col-7 col-md-5">
            <form class="p-5" action="{{ route('save_session') }}" method="POST">
                <p class="text-center">Enter your Mpesa enabled phonenumber to pay Session Fees</p>
                <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <h6 class="text-center">Fees: {{ $studio->session_fees }} Kshs.</h6>
                <div class="mb-3">
                    <label class="text-white" for="phonenumber">Phonenumber</label>
                    <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="{{ old('phonenumber') }}" required>
                    @error('phonenumber')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create Session</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
