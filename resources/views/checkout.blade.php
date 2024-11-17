@extends('layout.frontend.master')

@section('content')
    <!-- Checkout Section -->
    <section class="py-20">
        <div class="container mx-auto">
            <h1 class="text-3xl font-bold mb-6">Checkout</h1>

            <form action="{{ route('orders.place') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6 mb-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                            Shipping Address
                        </label>
                        <input class="form-input w-full" id="address" type="text" name="address" required>
                    </div>
                    

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="payment_method">
                            Payment Method
                        </label>
                        <select class="form-select w-full" id="payment_method" name="payment_method" required>
                            <option value="credit_card">Credit Card</option>
                            <option value="Esewa">Esewa</option>
                            <!-- Add more payment options if needed -->
                        </select>
                    </div>

                    <button class="bg-blue-500 text-white py-2 px-6 rounded-full text-lg hover:bg-blue-600" type="submit">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
