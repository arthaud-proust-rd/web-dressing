<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="flex flex-col gap-4 mt-auto mb-6">
        <h1 class="h1">Vérifier votre email</h1>
        <p>Merci de nous avoir rejoints. Nous vous demanderons de cliquer dans le lien reçu par email avant de continuer.</p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                Un nouveau lien de confirmation a été envoyé sur l'email de votre compte.
            </div>
        @endif
        <form
            class="flex flex-col gap-4 mt-auto mb-6"
            method="POST"
            action="{{ route('verification.send') }}"
        >
            @csrf
            <button class="btn-primary">
                Renvoyer un lien
            </button>
        </form>
        <form
            class="flex flex-col gap-4 mt-auto mb-6"
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf
            <button class="btn-secondary">
                Se déconnecter
            </button>
        </form>
    </div>

</x-app-layout>
