<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="">
                        <div class="mt-4">
                            <x-input-label for="title" :value="__('title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="title" name="title" :value="old('title',$post->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="body" :value="__('body')" />
                            <x-text-input id="body" class="block mt-1 w-full" type="body" name="body" :value="old('body',$post->body)" required autofocus />
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>