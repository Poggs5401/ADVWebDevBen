<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('games.create') }}" class="btn-link btn-lg mb-2">Add a Game</a>
            @forelse ($games as $game)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <h2 class="font-bold text-2xl">
                    <a href="{{ route('games.show', $game) }}">{{ $game->title }}</a>
                </h2>
                <br>
                <p class="mt-2">
                    {{ $game->category }}
                </p>
                <br>
                <p>
                    {{$game->publisher}}
                </p>
                <br>
                <p>
                    {{$game->description}}
                </p>
                <br>
                <img src="{{asset('storage/images/' . $game->game_image) }}" width="150" />


            </div>
            <br>
            @empty
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <p>No Games.</p>

            </div>
            @endforelse
            <!-- This line of code simply adds the links for Pagination-->
            {{$games->links()}}
        </div>
    </div>
</x-app-layout>