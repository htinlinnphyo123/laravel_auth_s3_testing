<x-app-layout>

    <x-slot name="header">
        <form action="{{ route('posts.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
            @error('image')
                <h3 class="text-red-600">{{ $message }}</h3>            
            @enderror
            <button>Submit</button>
        </form>
    </x-slot>
</x-app-layout>
