<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Task Create') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('tasks.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="title" :value="__('Title')"/>
                                <x-text-input id="name" name="title" type="text" class="mt-1 block w-full"
                                              :value="old('title')" required autofocus autocomplete="title"/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('Description')"/>
                                <textarea id="email" name="description" type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                              :value="old('description')" required autocomplete="description"></textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')"/>

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
