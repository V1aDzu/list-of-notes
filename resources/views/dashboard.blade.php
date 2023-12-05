<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="m-4 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                            <th>N</th>
                            <th>User</th>
                            <th>Text</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notes as $note)
                            <tr>
                            <td>{{ $note->id }}</td>
                            <td>{{ $note->user->name }}</td>
                            <td>{{ $note->text }}</td>
                            <form id="note{{ $note->id }}" method="POST" action="{{ route('notes.destroy', $note->id)}}">
                                @csrf
                                @method('delete')
                                <td><button type="button" onclick="deleteMyItem('{{ $note->id }}')" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">{{ __('Delete') }}</button></td>
                            </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="m-4 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form id="note" method="POST" action="{{ route('notes.store')}}">
                    @csrf
                    @method('post')
                    <div class="relative flex py-2 w-2/3">
                        <input id="text" name="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white" type="text" value="">
                        <button type="submit" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">{{ __('Post') }}</button>                
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
     function deleteMyItem(item) {
                Swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to <b>delete</b> record №' + item + '<br>You will not be able to recover this item!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonColor: '#db2777',
                    reverseButtons: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('note{{ $note->id }}').submit();
                    }
                });
            }
</script>