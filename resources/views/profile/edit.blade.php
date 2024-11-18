<x-layout>
    <div class="bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-3xl w-full">
            <h2 class="text-2xl font-bold text-blue-800 mb-6">Edit Profile</h2>

            <form action="" method="POST" class="space-y-4">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ $user->id }}">

                <!-- Name Field -->
                <div>
                    <label for="nameinp" class="block text-blue-700 font-semibold mb-2">Name</label>
                    <input type="text" name="name" id="nameinp" value="{{ $user->name }}"
                        class="w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                </div>

                <!-- Email Field -->
                <div>
                    <label for="emailinp" class="block text-blue-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="emailinp" value="{{ $user->email }}"
                        class="w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                </div>

                <!-- Phone Field -->
                <div>
                    <label for="phoneinp" class="block text-blue-700 font-semibold mb-2">Phone</label>
                    <input type="number" name="phone" id="phoneinp" value="{{ $user->phone }}"
                        class="w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                </div>

                <!-- Address Field -->
                <div>
                    <label for="addressinp" class="block text-blue-700 font-semibold mb-2">Address</label>
                    <textarea name="address" id="addressinp" rows="4"
                        class="w-full px-4 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">{{ $user->address }}</textarea>
                </div>

                <!-- Save Button -->
                <div class="grid grid-cols-2">
                    <div>
                        <a href="/profile">
                            <button type="button"
                                class="py-2 px-4 bg-gray-700 text-white font-semibold rounded-md shadow-md hover:bg-gray-800 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Cancel
                            </button>
                        </a>
                    </div>
                    <div>
                        <button type="submit"
                            class=" float-end py-2 px-4 bg-blue-700 text-white font-semibold rounded-md shadow-md hover:bg-blue-800 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Save Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
