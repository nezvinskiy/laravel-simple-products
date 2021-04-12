<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="mt-10 sm:mt-0">
                    <div class="mt-5 md:mt-0 md:col-span-2">

                        <!-- Validation Errors -->
                        <x-validation-errors class="px-8 my-5" :errors="$errors" />

                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="col-span-6 sm:col-span-4">
                                            <x-label for="name" :value="__('Name')" />

                                            <x-input
                                                id="name"
                                                class="block mt-1 w-full"
                                                type="text"
                                                name="name"
                                                :value="old('name')"
                                            />

                                            <x-input-errors name="name" :errors="$errors" class="mt-1" />
                                        </div>

                                        <div class="col-span-6">
                                            <x-label for="description" :value="__('Description')" />

                                            <x-textarea
                                                id="description"
                                                class="block mt-1 w-full"
                                                name="description"
                                            >{{ old('description') }}</x-textarea>

                                            <x-input-errors name="description" :errors="$errors" class="mt-1" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-1">
                                            <x-label for="price" :value="__('Price')" />

                                            <x-input
                                                id="price"
                                                class="block mt-1 w-full"
                                                type="number"
                                                step="0.01"
                                                placeholder="0.00"
                                                name="price"
                                                :value="old('price')"
                                            />

                                            <x-input-errors name="price" :errors="$errors" class="mt-1" />
                                        </div>

                                        <div class="col-span-6 sm:col-span-6">
                                            <x-label for="categories" :value="__('Categories')" />

                                            @foreach ($categories as $category)
                                                <div class="flex items-center justify-start mt-1">
                                                    <x-input-checkbox
                                                        id="category-{{ $category->id }}"
                                                        class="mr-2"
                                                        name="categories[][id]"
                                                        :value="$category->id"
                                                    />

                                                    <x-label for="category-{{ $category->id }}" :value="$category->name" />
                                                </div>
                                            @endforeach

                                            <x-input-errors name="categories" :errors="$errors" class="mt-1" />
                                        </div>

                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">

                                    <x-button class="ml-3">
                                        {{ __('Save') }}
                                    </x-button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
