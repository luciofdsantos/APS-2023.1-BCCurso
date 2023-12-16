<x-app-layout>
    <x-slot name="header">
        

        <!--Parte replicada que estava sendo sobreposta pelo fundo-->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" >
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg" style="background-color: gray;">
                    <div class="max-w-xl" >
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-professor-info-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                   </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ url()->previous() }}" class="btn custom-button custom-button-castastrar-tcc btn-default">Voltar</a>
        </div>

        
        <!--Fim da parte replicada-->

    </x-slot>


    <!-- Algum commit com mudanças no estilo começou a fazer com que a parte abaixo, fora do elemento x-slot acima não aparecesse mais ( o background azul 
    escuro começou a sobrepor os form). Solução temporária foi colocar as informações abaixo todas dentro do elemento acima (x-slot). 

    Para reproduzir o erro, comente das linhas 8 à 42, e descomente as linhas abaixo
    ------------------------------------------------------------------------------------------------------------------------------------------------------
        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-professor-info-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Departamento de Ciência da Computação - IFNMG - Todos os direitos reservados</p>
        <p>Endereço: Rua Dois, 300 - Village do Lago I - Montes Claros - MG – CEP 39.404-058</p>
        <p>Telefone: (38) 2103-4141</p>
        <p>E-mail: <a href="mailto:comunicacao.montesclaros@ifnmg.edu.br">comunicacao.montesclaros@ifnmg.edu.br</a></p>
        <p>Página eletrônica: <a href="https://www.ifnmg.edu.br/montesclaros">www.ifnmg.edu.br/montesclaros</a></p>
    
    </footer>
-->

</x-app-layout>
