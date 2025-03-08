<flux:container>


    <flux:text>Modifica Studente</flux:text>
    <div class="mb-6"></div>


    @if (session()->has('message'))
    <div flux:alert flux:alert-success>
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="update">
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
            <flux:label for="password" flux:text>Password (lascia vuoto per non cambiare)</flux:label>
            <flux:input type="password" id="password" wire:model="password" />
            @error('password')
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
            <span flux:text flux:text-danger>{{ $message }}</span>
            @enderror
        </flux:field>
        <div class="mb-6"></div>
        <div class="form-group">
            <label for="courses">Seleziona i corsi</label>
            <select wire:model="selectedCourses" id="courses" class="form-control" multiple>
                @foreach($courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->nome }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-6"></div>
        <flux:button type="submit" flux:btn flux:btn-primary>
            Aggiorna Studente
        </flux:button>
    </form>

    <hr>

    <h5>Corsi Assegnati:</h5>
    <ul>
        @foreach($student->courses as $course)
        <li>
            {{ $course->nome }}
            <button wire:click="removeCourse({{ $course->id }})" class="bg-red-500 text-white px-2 py-1 rounded" onclick="confirm('Sei sicuro di voler dissociare questo corso dallo studente?') || event.stopImmediatePropagation()">Rimuovi</button>
        </li>
        @endforeach
    </ul>


</flux:container>