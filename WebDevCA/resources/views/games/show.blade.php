<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Game Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="flex">

                <a href="{{ route('games.edit', $game) }}" class="btn-link ml-auto">Edit</a>

                <!-- Delete method is wrapped in a form with a button linked -->
                <form action="{{ route('games.destroy', $game) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you want to delete?')">Delete </button>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                        <td rowspan="6">
                            <!-- use the asset function, access the file $book->book_image in the folder storage/images -->
                            <img src="{{asset('storage/images/' . $game->game_image) }}" width="150" />
                        </td>
                        </tr>
                        <tr>
                            <td class="font-bold ">Title </td>
                            <td>{{ $game->title }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold ">Category </td>
                            <td>{{ $game->category }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Publisher </td>
                            <td>{{ $game->publisher }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold ">Description </td>
                            <td>{{ $game->description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>