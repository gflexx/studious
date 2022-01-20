@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Cart</h4>
    <hr class="text-white">
    @forelse ($cart_items as $cart_item)
        <div class="row bg-dark border justify-content-center rounded mb-2 text-center">
            <div class="col-3">
                <img style="height: 72px; width: 72px;" class="rounded img-fluid" src="{{ $cart_item->track->image }}" alt="">
            </div>
            <div class="col-3 py-3">
                <a href="{{ route('show_track', $cart_item->track->id) }}">{{ $cart_item->track->title }}</a>
            </div>
            <div class="col-3 py-3">
                <form action="{{ route('cart_remove') }}" method="post">
                    @csrf
                    <input type="hidden" name="track_id" value="{{ $cart_item->track->id }}">
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-white">No tracks in your cart.</p>
    @endforelse

    @if ($cart_items->count() > 0)
        <div class="mt-5">
            <h5 class="text-info">TOTAL: <span class="text-white">{{ $cart->total }} Kshs.</span></h5>
            <div class="text-end">
                <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
            </div>
        </div>
    @endif

</div>

@endsection
