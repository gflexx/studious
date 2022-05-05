@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Finish Checkout</h4>
    <hr class="text-white">
    <form action="{{ route('download') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-success">Download Assets</button>
    </form>

    <div class="mt-3">
        <a href="{{ route('home') }}" class="btn btn-primary">Go To Home Page</a>
    </div>

</div>

@endsection
