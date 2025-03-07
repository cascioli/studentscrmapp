<flux:container>


    <flux:text>Modifica ITS</flux:text>
    <div class="mb-6"></div>


    @if (session()->has('message'))
    <div flux:alert flux:alert-success>
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="update">
        <flux:field>
            <flux:label for="nome" flux:text>Nome</flux:label>
            <flux:input type="text" id="nome" wire:model="nome" />
            @error('nome')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>

        <div class="mb-6"></div>
        <flux:button type="submit" flux:btn flux:btn-primary>
            Aggiorna ITS
        </flux:button>
    </form>


</flux:container>