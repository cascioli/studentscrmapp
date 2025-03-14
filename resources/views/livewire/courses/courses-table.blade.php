<div class="flex flex-col items-start">
    @include('partials.courses-heading')

    <div>
        <div>
            <div class="mb-4">
                <input id="searchfield" type="text" wire:model.live.debounce.500ms="search" placeholder="Cerca per nome..." class="border p-2 rounded">
            </div>

            <flux:button wire:click="store()" class="bg-blue-500 text-white px-2 py-1 rounded">
                Aggiungi Corso
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
                        <th class="px-4 py-2">Città</th>
                        <th class="px-4 py-2">Inizio Corso</th>
                        <th class="px-4 py-2">Fine Corso</th>
                        <th class="px-4 py-2">ITS</th>
                        <th class="px-4 py-2">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td class="border px-4 py-2">{{ $course->id }}</td>
                        <td class="border px-4 py-2">{{ $course->nome }}</td>
                        <td class="border px-4 py-2">{{ $course->citta }}</td>
                        <td class="border px-4 py-2">{{ $course->inizio_corso }}</td>
                        <td class="border px-4 py-2">{{ $course->fine_corso }}</td>
                        <td class="border px-4 py-2">{{ optional($course->its)->nome }}</td>

                        <td class="border px-4 py-2">
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $course->id }})" class="bg-blue-500 text-white px-2 py-1 rounded">Modifica</button>
                                <button wire:click="delete({{ $course->id }})" class="bg-red-500 text-white px-2 py-1 rounded" onclick="confirm('Sei sicuro di voler eliminare questo Corso?') || event.stopImmediatePropagation()">Elimina</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <div class="mt-4">
            {{ $courses->links() }}
        </div>


    </div>
</div>