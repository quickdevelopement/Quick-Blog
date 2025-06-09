<x-layout>
    <x-slot:title>
        Register
        </x-slot>

        <main class="bg-gray-100 min-h-screen flex items-center justify-center">
            <div class="w-3/4 md:w-1/2 lg:w-1/3 mx-auto  p-6 bg-white rounded shadow-lg">
                <div class="flex items-center justify-between mb-6 px-10">
                    <h1 class="text-2xl font-bold mb-4">Register Now</h1>

                </div>

                <form method="POST" action="{{ route('register.post') }}" class="  px-8 pt-6 pb-8 mb-4">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" name="name" id="name" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @if ($errors->has('name'))
                            <p class="text-red-500 text-xs italic mt-2">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" id="email" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @if ($errors->has('email'))
                            <p class="text-red-500 text-xs italic mt-2">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="flex items-center justify-between gap-4 flex-col">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Submit
                        </button>
                        <p>Do You have an Account? Please <a href="{{ route('login.get') }}"
                                class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Login
                            </a></p>
                    </div>
            </div>
        </main>

</x-layout>