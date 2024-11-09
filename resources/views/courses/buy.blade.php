<x-layout>
    <div class="container mx-auto p-6">
        <!-- Grid layout for main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <form action="/courses/{{ $course->id }}/buy" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- About Course Section -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold mb-4">About Course</h2>
                    <p class="mb-2"><strong>Name:</strong> {{ $course->name }}</p>
                    <p class="mb-2"><strong>People Enrolled:</strong> {{ $course->enrolled }}</p>
                    <p class="mb-2"><strong>Duration:</strong> {{ $course->duration }}</p>
                    <p class="mb-2 text-green-500"><strong>Price:</strong>
                        @if ($course->price == 0)
                            {{ 'FREE' }}
                        @else
                            ${{ $course->price }}
                        @endif
                    </p>

                    <!-- Payment Method Selection -->
                    <label class="block mt-4 font-semibold">Select Payment Method</label>
                    <select name="payment_method" class="mt-2 border-2 w-full border-black rounded-md cursor-pointer">
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="upload_image">Upload Payment Image</option>
                    </select>

                    <!-- Payment Details for Credit Card -->
                    <div id="credit-card-details" class="mt-4 hidden">
                        <label class="block">Card Number</label>
                        <input type="text" name="card_number" placeholder="XXXX XXXX XXXX XXXX"
                            class="border-2 w-full border-gray-300 rounded-md p-2" />

                        <label class="block mt-2">Expiry Date</label>
                        <input type="text" name="expiry_date" placeholder="MM/YY"
                            class="border-2 w-full border-gray-300 rounded-md p-2" />

                        <label class="block mt-2">CVV</label>
                        <input type="text" name="cvv" placeholder="XXX"
                            class="border-2 w-full border-gray-300 rounded-md p-2" />
                    </div>

                    <!-- Bank Transfer Details -->
                    <div id="bank-transfer-details" class="mt-4 hidden">
                        <label class="block">Bank Account Number</label>
                        <input type="text" name="account_number" placeholder="Enter Bank Account Number"
                            class="border-2 w-full border-gray-300 rounded-md p-2" />
                        <p class="text-sm mt-2 text-gray-500">Transfer the amount after submitting. You'll receive
                            further instructions by email.</p>
                    </div>

                    <!-- Payment Image Upload -->
                    <div id="upload-image-details" class="mt-4 hidden">
                        <label class="block">Upload Payment Proof</label>
                        <input type="file" name="payment_image"
                            class="mt-2 border-2 w-full border-black rounded-md cursor-pointer" />
                        <p class="text-sm mt-2 text-gray-500">Upload an image of your payment receipt or screenshot.</p>
                    </div>

                    <button type="submit"
                        class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-primary text-white hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                        Start Learning
                    </button>
                </div>
            </form>

            <!-- Course Image (spans 2 columns on large screens) -->
            <div class="lg:col-span-2">
                <div class="relative w-full h-[400px]">
                    <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 object-contain max-w-full max-h-full" />
                </div>

                <!-- Description Section -->
                <div class="border-4 border-gray-200 rounded-lg p-6 overflow-hidden lg:col-span-2 mt-4">
                    <h3 class="text-xl font-semibold mb-4">Description</h3>
                    <p class="text-gray-700 break-words">{{ $course->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to Toggle Payment Details -->
    <script>
        document.querySelector('select[name="payment_method"]').addEventListener('change', function(e) {
            // Hide all payment details sections
            document.getElementById('credit-card-details').classList.add('hidden');
            document.getElementById('bank-transfer-details').classList.add('hidden');
            document.getElementById('upload-image-details').classList.add('hidden');

            // Show the relevant payment details section based on selected method
            if (e.target.value === 'credit_card') {
                document.getElementById('credit-card-details').classList.remove('hidden');
            } else if (e.target.value === 'bank_transfer') {
                document.getElementById('bank-transfer-details').classList.remove('hidden');
            } else if (e.target.value === 'upload_image') {
                document.getElementById('upload-image-details').classList.remove('hidden');
            }
        });
    </script>
</x-layout>
