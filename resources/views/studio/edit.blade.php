@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Edit Studio</h4>
    <div class="row">
        <div class="col-7 col-md-5">
            <form class="p-5" action="{{ route('save_studio_edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                <div class="mb-3">
                    <label class="text-white" for="title ">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $studio->title ?? old('title') }}" required>
                    @error('title')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="text-white" for="feese">Session Booking Fees</label>
                    <input type="number" min="0.0" step="1.0" name="session_fees" id="fees" value="{{ $studio->session_fees ?? old('session_fees') }}" class="form-control" required>
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
                    <p class="text-white mb-1">Current: <a target="_blank" href="{{ asset($studio->image) }}">image</a></p>
                    <input class="form-control" accept="image/*" name="image" type="file" id="formImage">
                    @error('image')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update Studio</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var text = document.getElementById('text');
        text.value = '{{ $studio->description }}';
    }, false);
</script>

@endsection
