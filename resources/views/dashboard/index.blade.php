<x-layout>
    <x-slot:title>
        Dashboard
        </x-slot>
        @component('dashboard.navbar')

        @endcomponent

        @component('dashboard.sidebar')

        @endcomponent

        <div class="p-4 sm:ml-64 ">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                        <p class="text-2xl text-green-600 dark:text-green-600">
                            Total Posts: {{ $posts->count() }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                        <p class="text-2xl text-green-600 dark:text-green-600">
                            Total User: {{ $users->count() }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                        <p class="text-2xl text-green-600 dark:text-green-600">
                            Total Categories: {{ $categories->count() }}
                        </p>
                    </div>
                </div>
                <div class=" mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
                    <h3 class="text-3xl">Posts</h3>
                    <div class=" w-full p-4 sm:rounded-lg">
                        @if ($posts->count() > 0)
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-50 bg-gray-700 uppercase rounded dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Content
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Image
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Category
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ Str::limit($post->title, 30) }}...
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ Str::limit($post->content, 50) }}...
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($post->image)
                                                    <img src="{{ asset('images/' . $post->image) }}" alt="Post Image"
                                                        class="w-16 h-16 object-cover rounded">
                                                @else
                                                    <span class="text-gray-500">No Image</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $post->category ? $post->category->name : 'Uncategorized' }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                                
                            </table>
                            {{ $posts->links() }}
                        @else
                            <div class="text-center text-gray-500 dark:text-gray-400">
                                No posts available.
                            </div>
                        @endif
                        
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class=" rounded-sm bg-gray-50  dark:bg-gray-800">
                        <h3 class="text-3xl">Categories</h3>
                        <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <div class=" w-full p-4 sm:rounded-lg">
                            @if ($categories->count() > 0)
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-50 bg-gray-700 uppercase rounded dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                name
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr
                                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $category->name }}
                                                </th>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <div class="text-center text-gray-500 dark:text-gray-400">
                                    No Category Available.
                                </div>
                            @endif
                        </div>
                        </p>
                    </div>

                    <div class=" col-span-2  rounded-sm bg-gray-50  dark:bg-gray-800">
                        <h3 class="text-3xl">Users</h3>
                        <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <div class=" w-full p-4 sm:rounded-lg">
                            @if ($users->count() > 0)
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-50 bg-gray-700 uppercase rounded dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Avatar
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Email
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr
                                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <img class="w-8 h-8 rounded-full z-10"
                                                        src="{{$user->avatar ? 'avatars/' . $user->avatar : 'https://ui-avatars.com/api/?name=' . auth()->user()->name . '&background=random&color=random'}}"
                                                        alt="user photo">
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $user->name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $user->email }}
                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <div class="text-center text-gray-500 dark:text-gray-400">
                                    No User Available.
                                </div>
                            @endif
                        </div>
                        </p>
                    </div>
                </div>
                <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                        <p class="text-2xl text-gray-400 dark:text-gray-500">
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </p>
                    </div>
                    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                        <p class="text-2xl text-gray-400 dark:text-gray-500">
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </p>
                    </div>
                    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                        <p class="text-2xl text-gray-400 dark:text-gray-500">
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </p>
                    </div>
                    <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                        <p class="text-2xl text-gray-400 dark:text-gray-500">
                            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
        </div>

</x-layout>