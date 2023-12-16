<section>
    <header>
        <h2 class="text-lg font-medium text-black-900 dark:text-black-100">
            {{ __('Informações do Professor') }}
        </h2>

        <p class="mt-1 text-sm text-black-600 dark:text-black-400">
            {{ __("Atualize os seus dados de professor.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="titulacao" :value="__('Titulação')" style="color:black;"/>
            <x-text-input id="titulacao" name="titulacao" type="text" class="mt-1 block w-full input-field" :value="old('titulacao', $user->titulacao)" autofocus autocomplete="titulacao" />
            <x-input-error class="mt-2" :messages="$errors->get('titulacao')" />
        </div>

        <div>
            <x-input-label for="biografia" :value="__('Biografia')" style="color:black;"/>
            <x-text-input id="biografia" name="biografia" type="text" class="mt-1 block w-full input-field" :value="old('biografia', $user->biografia)" autofocus autocomplete="biografia" />
            <x-input-error class="mt-2" :messages="$errors->get('biografia')" />
        </div>

        <div>
            <x-input-label for="area" :value="__('Área')" style="color:black;"/>
            <x-text-input id="area" name="area" type="text" class="mt-1 block w-full input-field" :value="old('area', $user->area)" autofocus autocomplete="area" />
            <x-input-error class="mt-2" :messages="$errors->get('area')" />
        </div>

        <!-- Links -->
        <div class="mt-4">
        <x-input-label for="links" :value="__('Links')" style="color:black;"/>
            <div id="links-container">
                <div class="link-input-group">
                    <x-text-input class="block mt-1 w-full input-field" type="text" name="links[]" autocomplete="links" />
                </div>
            </div>
            <button type="button" class="add-link" style="color:black;">+</button>
            <x-input-error :messages="$errors->get('links')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="foto" :value="__('Foto')" style="color:black;"/>
            @if (count($user->fotos) > 0)
                @foreach ($user->fotos as $ft)
                    <button class="btn text-danger" type="submit" form="deletar-fotos{{ $ft->id }}">X</button>
                    <img src="{{ URL::asset('storage') }}/{{ $ft->foto }}" class="img-responsive"
                        style="max-height:100px; max-width:100px;">
                @endforeach
            @endif
            <input type="file" name="fotos[]" id="fotos" class="form-control" multiple>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color:black;" >{{ __('Salvar') }}</x-primary-button>

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
    
    @if (count($user->fotos) > 0)
        @foreach ($user->fotos as $ft)
            <form id="deletar-fotos{{ $ft->id }}"
                action="{{ route('profile.delete_foto', ['id' => $ft->id]) }}" method="post">
                @csrf
                @method('delete')
            </form>
        @endforeach
    @endif
</section>

<!-- Pequeno script js pra clonar o campo de link ao clicar no botão "+" -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addButton = document.querySelector(".add-link");
        const container = document.querySelector("#links-container");

        addButton.addEventListener("click", function () {
            const linkGroup = document.querySelector(".link-input-group").cloneNode(true);
            linkGroup.querySelector("input").value = "";
            container.appendChild(linkGroup);
        });
    });
</script>