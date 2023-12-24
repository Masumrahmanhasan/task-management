<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Article Create') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('articles.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="title" :value="__('title')"/>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                              :value="old('title')" autofocus autocomplete="title"/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                            </div>

                            <div>
                                <x-input-label for="category_id" :value="__('Category')"/>
                                <select name="category_id[]" id="" multiple
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')"/>
                            </div>

                            <div>
                                <x-input-label for="content" :value="__('Content')"/>
                                <textarea name="content" id="content" cols="30" rows="10"
                                          class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content') }}</textarea>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
