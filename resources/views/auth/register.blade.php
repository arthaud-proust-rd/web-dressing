<x-app-layout>
    <form
        class="flex flex-col gap-4 mt-auto mb-6"
        method="POST"
        action="{{ route('register') }}"
    >
        @csrf

        <h1 class="h1">Créer un compte</h1>

        <livewire:input type="text" property="name" title="Nom"/>
        <livewire:input type="text" property="email" title="Email"/>
        <livewire:input type="password" property="password" title="Mot de passe"/>
        <livewire:input type="password" property="password_confirmation" title="Confirmer le mot de passe"/>

        <button class="btn-primary">
            Créer un compte
        </button>

        <div class="mt-6 flex flex-col gap-1">
            <a class="btn-secondary" href="{{ route('login') }}">
                J'ai déjà un compte
            </a>
        </div>
    </form>
</x-app-layout>
