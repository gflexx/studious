@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Add Track</h4>
    <div class="row">
        <div class="col-7 col-md-5">
            <form class="p-5" action="{{ route('save_track') }}" method="POST" enctype="multipart/form-data">
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
                    <label class="text-white" for="text">Description</label>
                    <textarea name="description" id="text" class="form-control" rows="2"></textarea>
                    @error('description')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="text-white" for="formImage" class="form-label">Track Image</label>
                    <input class="form-control" accept="image/*" value="{{ old('image') }}" name="image" type="file" id="formImage">
                    @error('image')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="text-white" for="formFile" class="form-label">Track File</label>
                    <input class="form-control" accept="audio/*" value="{{ old('file') }}" name="file" type="file" id="formFile">
                    @error('file')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="text-white" for="price ">Price</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
                    @error('price')
                        <p class="text-muted">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Add Track</button>
                </div>
            </form>

            </form>
        </div>
    </div>

</div>

@endsection
