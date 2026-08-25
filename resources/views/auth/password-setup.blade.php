<x-guest-layout>
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-xl font-bold mb-4">Définir votre mot de passe</h1>

        <form method="POST" action="{{ route('password.setup.store', $user->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium">Nouveau mot de passe</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                Valider
            </button>
        </form>
    </div>
</x-guest-layout>