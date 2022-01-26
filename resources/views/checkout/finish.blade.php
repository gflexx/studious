@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Finish Checkout</h4>
    <hr class="text-white">
    <form action="{{ route('download') }}" method="post">
        @csrf
        <input type="hidden" name="cart_id" value="{{ $cart_id }}">
        <button type="submit" class="btn btn-success">Download Assets</button>
    </form>

</div>

@endsection
