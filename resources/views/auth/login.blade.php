<x-app-layout>
        <form
            class="flex flex-col gap-4 mt-auto mb-6"
            method="POST"
            action="{{ route('login') }}"
        >
            @csrf

            <h1 class="h1">Connexion</h1>

            <livewire:input type="text" property="email" title="Email"/>
            <livewire:input type="password" property="password" title="Mot de passe"/>
            <livewire:input type="checkbox" property="remember" title="Se souvenir de moi"/>

            <button class="btn-primary">
                Se connecter
            </button>
            @if (Route::has('password.request'))
                <a class=" btn-tertiary" href="{{ route('password.request') }}">
                    Mot de passe oublié
                </a>
            @endif
            <a class="mt-6 btn-secondary" href="{{ route('register') }}">
                Créer un compte
            </a>
        </form>
</x-app-layout>
