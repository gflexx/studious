@extends('layouts.app')

@section('content')

<div class="">

    <h4 class="text-white">Checkout</h4>
    <hr class="text-white">
    <div class="row">
        <div class="col-11 col-md-6 p-5">
            <div class="alert bg-dark text-white border rounded">
                <h4 class="mb-3">Tracks:</h4>

                @forelse ($cartItems as $item)
                    <p class="mb-1">{{ $item->track->title }}</p>
                    <p class="mb-2">{{ $item->track->price }}  Kshs.</p>
                @empty
                    <p class="text-white">Please add tracks to your cart first.</p>
                    <a href="{{ route('tracks_all') }}">Tracks</a>
                @endforelse
                <div class="mt-4">
                    @if ($cartItems->count() > 0)
                        <h5>Cart Total:  {{ $cart->total }}  Kshs.</h5>
                    @endif
                </div>
           </div>
        </div>
        <div class="col-11 col-md-6 text-white p-5">
            @if ($cartItems->count() > 0)
                <form class="px-3" action="{{ route('checkout_payment') }}" method="post">
                    @csrf
                    <h5 class="mb-3 text-center">Pay with Mpesa</h5>
                    <p class="text-center">Total:  {{ $cart->total  }}  Kshs.</p>
                    <input type="hidden" name="total">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phonenumber</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="0701234567">
                    </div>
                    <button class="btn btn-success" type="submit">Make Payment</button>
                </form>
            @endif
        </div>
    </div>

</div>

@endsection
