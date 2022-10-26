<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
            <a href="{{ route('games.create') }}" class="btn-link btn-lg mb-2">Add a Game</a>
            @forelse ($games as $game)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                    <a href="{{ route('games.show', $game) }}">{{ $game->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ $game->category }}
                        {{$game->publisher}}
                        <!-- {{$game->description}} -->

                    </p>

                </div>
            @empty
            <p>No games.</p>
            @endforelse
            <!-- This line of code simply adds the links for Pagination-->
            {{$games->links()}}
        </div>
    </div>
</x-app-layout>