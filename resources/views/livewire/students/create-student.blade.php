<flux:container>


    <h2 flux:text>Crea Studente</h2>
    <div class="mb-6"></div>


    @if (session()->has('message'))
    <div flux:alert flux:alert-success>
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="store">
        <flux:field>
            <flux:label for="name" flux:text>Nome</flux:label>
            <flux:input type="text" id="name" wire:model="name" />
            @error('name')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>
        <div class="mb-6"></div>
        <flux:field>
            <flux:label for="email" flux:text>Email</flux:label>
            <flux:input type="email" id="email" wire:model="email" />
            @error('email')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>

        <div class="mb-6"></div>


        <flux:field>
            <flux:label for="password" flux:text>Password</flux:label>
            <flux:input type="password" id="password" wire:model="password" />
            @error('password')
            <flux:error flux:text flux:text-danger>{{ $message }}</flux:error>
            @enderror
        </flux:field>
        <div class="mb-6"></div>
        <flux:field>
            <flux:label for="password_confirmation" flux:text>Conferma Password</flux:label>
            <flux:input type="password" id="password_confirmation" wire:model="password_confirmation" />
            @error('password_confirmation')
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
            Crea Studente
        </flux:button>
    </form>


</flux:container>