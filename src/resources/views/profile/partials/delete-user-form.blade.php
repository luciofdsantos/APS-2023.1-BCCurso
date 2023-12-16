<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Excluir Conta') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-black-400">
            {{ __('Ao excluir sua conta, todos os seus recursos e dados serão permanentemente excluídos. Antes de excluir sua conta, por favor faça o download de qualquer dado ou informação que deseja manter.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Excluir Conta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
                {{ __('Você tem certeza que deseja excluir esta conta?') }}
            </h2>

            <p class="mt-1 text-sm text-black-600 dark:text-black-400">
                {{ __('Ao excuir sua conta, todos os seus recursos e dados serão permanentemente excluídos. Por favor insira a sua senha para confirmar que deseja permanentemente excluir sua conta.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Senha') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button style="background-color:black;" x-on:click="$dispatch('close')"  >
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Excluir Conta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
