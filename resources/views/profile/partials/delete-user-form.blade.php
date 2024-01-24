<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Vymazať účet') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Po vymazaní vášho účtu budú všetky jeho zdroje a údaje natrvalo vymazané. Pred vymazaním účtu si stiahnite všetky údaje alebo informácie, ktoré si želáte zachovať.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Vymazať účet') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Ste si istí, že chcete odstrániť svoj účet?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Po vymazaní vášho účtu budú všetky jeho zdroje a údaje natrvalo vymazané. Zadajte svoje heslo a potvrďte, že chcete svoj účet natrvalo vymazať.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Heslo') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Heslo') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Vymazať účet') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
