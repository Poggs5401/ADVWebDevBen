<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.games.create') }}" class="btn-link btn-lg mb-2">Add a Game</a>
            @forelse ($games as $game)
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <h2 class="font-bold text-2xl">
                    <a href="{{ route('admin.games.show', $game) }}"><strong>{{ $game->title }}</strong></a>
                </h2>
                <br>
                <p class="mt-2">
                <h3 class="font-bold text-1xl"> <strong> Publisher Name </strong>
                    {{$game->publisher->name}}
                </h3>
                <h3 class="font-bold text-1xl"> <strong> Category </strong>
                {{ $game->category }}
                </h3>
                </p>
                <br>
                <p>
                    {{$game->description}}
                </p>
                <br>
                <td rowspan="6">
                    <!-- use the asset function, access the file $book->book_image in the folder storage/images -->
                    <img src="{{asset('storage/images/' . $game->game_image) }}" width="150" />

                </td>


            </div>
            <br>
            @empty
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <p>No Games.</p>

            </div>
            @endforelse
            <!-- This line of code simply adds the links for Pagination-->

        </div>
    </div>
</x-app-layout>