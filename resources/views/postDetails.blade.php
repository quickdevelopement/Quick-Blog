<x-layout>
    @component('components.navigation')

    @endcomponent
    <x-slot:title>
        {{ $post->title }}
        </x-slot>
        <div class="container mx-auto px-5">
            <div class="bg-white shadow p-6 rounded mb-6">
                <div class="flex justify-center flex-col items-center mb-4">
                    <img src="/images/{{ $post->image }}" alt="{{ $post->title }}"
                        class="w-3/4  object-cover rounded mb-4">
                    <p class="text-gray-500 text-sm">Posted on {{ $post->created_at->format('d M Y') }} by
                        {{ $post->user->name }}
                    </p>
                </div>
                <div>
                    <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
                    <p class="text-gray-600 text-sm mb-2">{{ $post->category->name ?? 'Uncategorized' }}</p>
                    <p>{{ $post->content }}</p>
                </div>
            </div>
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Comments</h2>
                @forelse($post->comments as $comment)
                    <div class="bg-gray-100 p-4 rounded mb-3">
                        <p class="text-sm font-semibold">{{ $comment->author_name }}</p>
                        <p>{{ $comment->body }}</p>
                    </div>
                @empty
                    <p>No comments yet.</p>
                @endforelse
            </div>



            <div class="bg-white p-4 shadow rounded">
                <h3 class="text-lg font-semibold mb-2">Add a Comment</h3>
                <?php if (auth()->check()) {?>

                <form method="POST" action="{{ route('comments.store', $post) }}">
                    @csrf
                    <input type="text" name="author_name" placeholder="Your Name" disabled class=" p-2 mb-2 "
                        value="{{ Auth::user()->name ?? '' }}" required>

                    <input name="body" type="text" placeholder="Your comment" class="w-full border p-2 mb-2 rounded"
                        required />

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Comment</button>
                </form>

                <?php } else { ?>
                <p class="text-red-500">You must be logged in to comment.</p>
                <a href="{{ route('login.get') }}" class="text-blue-500">Login</a> or
                <a href="{{ route('register.get') }}" class="text-blue-500">Register</a> to comment.
                <?php  }?>
            </div>

        </div>

</x-layout>