<section>
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Atualizar Senha') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-black-400">
            {{ __('Tenha certeza de que a senha utilizada seja longa e aleatória para estar seguro.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Senha Atual')" style="color:black;"/>
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full input-field" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Nova Senha')" style="color:black;"/>
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full input-field" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" style="color:black;"/>
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full input-field" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color:black;">{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-black-600 dark:text-black-400"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
