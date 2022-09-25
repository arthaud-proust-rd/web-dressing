<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form
        class="flex flex-col gap-4 mt-auto mb-6"
        method="POST"
        action="{{ route('password.email') }}"
    >
        @csrf

        <h1 class="h1">Mot de passe oublié</h1>
        <p>Nous allons vous envoyer un mail pour réinitialiser votre mot de passe</p>

        <livewire:input type="text" name="email" title="Email"/>

        <button class="btn-primary">
            Envoyer un mail
        </button>

        <div class="mt-6 flex flex-col gap-1">
            <a class="btn-secondary" href="{{ route('login') }}">
                J'ai retrouvé mon mot de passe
            </a>
        </div>
    </form>
</x-app-layout>
