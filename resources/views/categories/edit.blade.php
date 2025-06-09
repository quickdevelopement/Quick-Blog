<x-layout>
    <x-slot:title>
        Edit Categories
        </x-slot>

        @component('dashboard.navbar')

        @endcomponent

        @component('dashboard.sidebar')

        @endcomponent


        <div class="p-4 sm:ml-64 ">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <div class="grid  gap-4 mb-4">
                    <div class="flex items-center justify-center  rounded-sm bg-gray-50 dark:bg-gray-800">
                        <div class="text-2xl text-green-600 dark:text-green-600">
                            <h1 class="text-xl font-bold mb-4">Edit  Category</h1>

                            <form method="POST" action="{{  route('categories.edit.post', $category) }}">
                                @csrf

                                @method('PATCH')


                                <input type="text" name="name" value="{{ $category->name  }}"
                                    placeholder="Category name" class="w-full p-2 border rounded mb-4">

                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>


</x-layout>