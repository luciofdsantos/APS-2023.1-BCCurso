<section >
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">  <!--Onde é black aqui e em todos os lugares da pasta partials, era grey antes-->
            {{ __('Informações da Conta') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-black-400">
            {{ __("Atualize seu nome de perfil e o endereço de email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nome')" style="color:black;"/>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full input-field" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" style="color:black;"/>
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full input-field" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-black-800 dark:text-black-200">
                        {{ __('Seu email não é verificado.') }}

                        <button form="send-verification" class="underline text-sm text-black-600 dark:text-black-400 hover:text-black-900 dark:hover:text-black-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-black-800">
                            {{ __('Clique aqui para reenviar o email de verificação.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Um novo link de verificação foi enviado para o seu endereço de email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color:black;">{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
