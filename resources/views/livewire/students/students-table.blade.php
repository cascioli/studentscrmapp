<div class="flex flex-col items-start">
    @include('partials.students-heading')

    <div>
        <div>
            <div class="mb-4">
                <input id="searchfield" type="text" wire:model.live.debounce.500ms="search" placeholder="Cerca per nome..." class="border p-2 rounded">
            </div>

            <flux:button wire:click="store()" class="bg-blue-500 text-white px-2 py-1 rounded">
                Aggiungi studente
            </flux:button>
        </div>

        @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div>
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nome</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">ITS</th>
                        <th class="px-4 py-2">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td class="border px-4 py-2">{{ $student->id }}</td>
                        <td class="border px-4 py-2">{{ $student->name }}</td>
                        <td class="border px-4 py-2">{{ $student->email }}</td>
                        <td class="border px-4 py-2">{{ $student->its->nome }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $student->id }})" class="bg-blue-500 text-white px-2 py-1 rounded">Modifica</button>
                                <button wire:click="delete({{ $student->id }})" class="bg-red-500 text-white px-2 py-1 rounded" onclick="confirm('Sei sicuro di voler eliminare questo studente?') || event.stopImmediatePropagation()">Elimina</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <div class="mt-4">
            {{ $students->links() }}
        </div>


    </div>
</div>