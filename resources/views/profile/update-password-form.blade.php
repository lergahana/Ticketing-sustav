<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Ažuriranje lozinke') }}
    </x-slot>

    <x-slot name="description">
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4" style="margin-top: 10px;">
            <x-jet-label for="current_password" value="{{ __('Trenutna lozinka') }}" />
            <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4" style="margin-top: 10px;">
            <x-jet-label for="password" value="{{ __('Nova lozinka') }}" />
            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4" style="margin-top: 10px;">
            <x-jet-label for="password_confirmation" value="{{ __('Potvrdi lozinku') }}" />
            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>

        <div>
            <div class="btn btn-pink-primary" style="width:100px; float:right; margin-top:10px; margin-bottom:10px;">
                {{ __('Spremi') }}
            </div>
        </div>
    </x-slot>

</x-jet-form-section>
