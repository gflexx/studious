@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Create Studio</h4>
    <div class="row">
        <div class="col-7 col-md-5">
            <form class="p-5" action="{{ route('save_studio') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="owner_id" value="{{ auth()->user()->id }}" id="">
                <div class="mb-3">
                    <label class="text-white" for="title ">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="text-white" for="feese">Session Booking Fees</label>
                    <input type="number" min="0.0" step="1.0" name="session_fees" id="fees" value="0.0" class="form-control" value="{{ old('session_fees') }}" required>
                    @error('session_fees')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="text-white" for="text">Description</label>
                    <textarea name="description" id="text" class="form-control" rows="2"></textarea>
                    @error('description')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="text-white" for="formImage" class="form-label">Studio Image</label>
                    <input class="form-control" accept="image/*" value="{{ old('image') }}" name="image" type="file" id="formImage">
                    @error('image')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Add Studio</button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
