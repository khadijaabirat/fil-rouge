<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
<div class="mt-4">
            <x-input-label for="role" :value="__('Je m\'inscris en tant que :')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="donator">Donateur </option>
                <option value="association">Association  </option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
        <div id="association-fields" style="display: none;" class="mt-4 p-4 border rounded-md bg-gray-50">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations de l'Association</h3>

            <div class="mt-4">
                <x-input-label for="ville" :value="__('Ville')" />
                <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')" />
                <x-input-error :messages="$errors->get('ville')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="licenseNumber" :value="__('Numéro de Licence (Récépissé)')" />
                <x-text-input id="licenseNumber" class="block mt-1 w-full" type="text" name="licenseNumber" :value="old('licenseNumber')" />
                <x-input-error :messages="$errors->get('licenseNumber')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description (Min 50 caractères)')" />
                <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="category_id" :value="__('Catégorie')" />
                <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="" disabled selected>Choisissez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="documentKYC" :value="__('Justificatif Légal (KYC - PDF/JPG)')" />
                <input id="documentKYC" class="block mt-1 w-full" type="file" name="documentKYC" accept=".pdf,.jpg,.jpeg,.png" />
                <x-input-error :messages="$errors->get('documentKYC')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="profilePhoto" :value="__('Logo de l\'Association')" />
                <input id="profilePhoto" class="block mt-1 w-full" type="file" name="profilePhoto" accept="image/*" />
                <x-input-error :messages="$errors->get('profilePhoto')" class="mt-2" />
            </div>
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const associationFields = document.getElementById('association-fields');

        roleSelect.addEventListener('change', function () {
            if (this.value === 'association') {
                associationFields.style.display = 'block';
            } else {
                associationFields.style.display = 'none';
            }
        });
    });
</script>
</x-guest-layout>
