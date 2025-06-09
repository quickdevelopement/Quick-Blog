<x-layout>
    <x-slot:title>
        Create Posts
        </x-slot>

        @component('dashboard.navbar')

        @endcomponent

        @component('dashboard.sidebar')

        @endcomponent

         <div class="p-4 sm:ml-64 mt-14">
             <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-xl font-bold mb-4">{{ isset($post) ? 'Edit' : 'Create' }} Post</h1>

                <form method="POST"
                    action="{{ isset($post) ? route('posts.edit.post', $post->id) : route('posts.create.post') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @if(isset($post))
                        @method('PATCH')
                    @endif

                    <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}"
                        class="w-full p-2 border rounded mb-4" placeholder="Title">

                    <textarea name="content" rows="5" class="w-full p-2 border rounded mb-4 "
                        placeholder="Content">{{ old('content', $post->content ?? '') }}</textarea>


                    <div class="w-full  bg-white  overflow-hidden items-center">

                        <input id="upload" type="file" name="image" class="invisible" />
                        <div id="image-preview"
                        class=" p-6 mb-4 -mt-6 bg-gray-100 border-dashed border-2 border-gray-400 rounded-lg items-center mx-auto text-center cursor-pointer">
                            <label for="upload" class="cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-8 h-8 text-gray-700 mx-auto mb-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-700">Upload picture</h5>
                                <p class="font-normal text-sm text-gray-400 md:px-6">Choose photo size should be less than
                                    <b class="text-gray-600">2mb</b>
                                </p>
                                <p class="font-normal text-sm text-gray-400 md:px-6">and should be in <b class="text-gray-600">JPG,
                                        PNG, or GIF</b> format.</p>
                                <span id="filename" class="text-gray-500 bg-gray-200 z-50"></span>
                            </label>
                        </div>


                    </div>


                

                    <select name="category_id" class="w-full p-2 border rounded mb-4">
                        <option value="">Select Category</option>
                         @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(old('category_id', $post->category_id ?? '') == $category->id)
                            selected @endif>{{ $category->name }}</option>
                        @endforeach
                       
                    </select>

                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                        {{ isset($post) ? 'Edit' : 'Create' }} Post
                    </button>
                </form>
            </div>
            <script>
            const uploadInput = document.getElementById('upload');
            const filenameLabel = document.getElementById('filename');
            const imagePreview = document.getElementById('image-preview');

            // Check if the event listener has been added before
            let isEventListenerAdded = false;

            uploadInput.addEventListener('change', (event) => {
                const file = event.target.files[0];

                if (file) {
                filenameLabel.textContent = file.name;

                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.innerHTML =
                    `<img src="${e.target.result}" class="max-h-48 rounded-lg mx-auto" alt="Image preview" />`;
                    imagePreview.classList.remove('border-dashed', 'border-2', 'border-gray-400');

                    // Add event listener for image preview only once
                    if (!isEventListenerAdded) {
                    imagePreview.addEventListener('click', () => {
                        uploadInput.click();
                    });

                    isEventListenerAdded = true;
                    }
                };
                reader.readAsDataURL(file);
                } else {
                filenameLabel.textContent = '';
                imagePreview.innerHTML =
                    `<div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center text-gray-500">No image preview</div>`;
                imagePreview.classList.add('border-dashed', 'border-2', 'border-gray-400');

                // Remove the event listener when there's no image
                imagePreview.removeEventListener('click', () => {
                    uploadInput.click();
                });

                isEventListenerAdded = false;
                }
            });

            uploadInput.addEventListener('click', (event) => {
                event.stopPropagation();
            });
            </script>
                

            </div>


</x-layout>