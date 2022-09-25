<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form
        class="flex flex-col gap-4 mt-auto mb-6"
        method="POST"
        action="{{ route('password.update') }}"
    >
        @csrf

        <h1 class="h1">Réinitialiser le mot de passe</h1>

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <livewire:input type="text" name="email" title="Email"/>
        <livewire:input type="password" name="password" title="Mot de passe"/>
        <livewire:input type="password" name="password_confirmation" title="Confirmer le mot de passe"/>

        <button class="btn-primary">
            Modifier le mot de passe
        </button>
    </form>
</x-app-layout>
