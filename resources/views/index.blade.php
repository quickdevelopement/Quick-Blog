<x-layout>
    <x-slot:title>
        Home
        </x-slot>
        <header>
            @component('components.navigation')

            @endcomponent
        </header>
        <main>
            <div class="container mx-auto px-10">

                @if($posts->count() > 0)
                    @foreach ($posts as $post)
                        <a href="{{ route('posts.show', $post->id) }}"
                            class="flex mb-5 flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row  hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                src="/images/{{ $post->image }}" alt="{{ $post->title }}">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $post->title }}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    {{ Str::limit($post->content, 100) }}...</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center text-blue-500 dark:text-red-400">
                        No Posts Here
                    </div>
                @endif

            </div>
            <div class="container mx-auto px-10">
                {{ $posts->links() }}
            </div>
        </main>


</x-layout>