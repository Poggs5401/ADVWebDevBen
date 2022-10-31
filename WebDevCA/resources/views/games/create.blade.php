<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('games.store') }}" method="post">
                    @csrf
                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Title"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title')"></x-text-input>

                    <x-text-input
                        type="text"
                        name="category"
                        field="category"
                        placeholder="Category..."
                        class="w-full mt-6"
                        :value="@old('category')"></x-text-input>

                    <x-text-input
                        type="text"
                        name="publisher"
                        field="publisher"
                        placeholder="Publisher..."
                        class="w-full mt-6"
                        :value="@old('publisher')"></x-text-input>

                        <x-textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="@old('description')"></x-textarea>

                    <x-primary-button class="mt-6">Save Game</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>