<flux:container>


    <h2 flux:text>Crea Corso</h2>
    <div class="mb-6"></div>


    @if (session()->has('message'))
    <div flux:alert flux:alert-success>
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="store">
        <flux:field>
            <flux:label for="nome" flux:text>Nome</flux:label>
            <flux:input type="text" id="nome" wire:model="nome" />
            @error('nome')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>
        <div class="mb-6"></div>
        <flux:field>
            <flux:label for="citta" flux:text>Città</flux:label>
            <flux:input type="text" id="citta" wire:model="citta" />
            @error('citta')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>
        <div class="mb-6"></div>



        <flux:field>
            <flux:label for="inizio_corso" flux:text>Data di inizio</flux:label>
            <flux:input type="datetime-local" id="inizio_corso" wire:model="inizio_corso" />
            @error('inizio_corso')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>
        <div class="mb-6"></div>
        <flux:field>
            <flux:label for="fine_corso" flux:text>Data di fine</flux:label>
            <flux:input type="datetime-local" id="fine_corso" wire:model="fine_corso" />
            @error('fine_corso')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>




        <div class="mb-6"></div>
        <flux:field>
            <flux:label for="its_id" flux:text>ITS</flux:label>
            <flux:select id="its_id" wire:model="its_id" flux:input>
                <flux:select.option value="">Seleziona ITS</flux:select.option>
                @foreach($itsOptions as $its)
                <flux:select.option value="{{ $its->id }}">{{ $its->nome }}</flux:select.option>
                @endforeach
            </flux:select>
            @error('its_id')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>
        <div class="mb-6"></div>
        <flux:button type="submit" flux:btn flux:btn-primary>
            Crea Corso
        </flux:button>
    </form>


</flux:container>