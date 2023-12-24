<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Category Create') }}
                            </h2>
                        </header>

                        <form method="POST" action="{{ route('categories.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="name" :value="__('name')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name')" required autofocus autocomplete="name"/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
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
