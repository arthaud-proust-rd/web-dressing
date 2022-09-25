<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form
        class="flex flex-col gap-4 mt-auto mb-6"
        method="POST"
        action="{{ route('password.confirm') }}"
    >
        @csrf

        <h1 class="h1">Confirmer votre mot de passe</h1>

        <livewire:input type="password" name="password" title="Mot de passe"/>

        <button class="btn-primary">
            Confirmer
        </button>
        @if (Route::has('password.request'))
            <a class=" btn-tertiary" href="{{ route('password.request') }}">
                Mot de passe oublié
            </a>
        @endif
    </form>
</x-app-layout>
