<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\Title;
new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $phone = '';
    public string $address = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    /**
     * Handle an incoming registration request.
     */
    #[Title('register')]
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input class="block mt-1 w-full" id="name" wire:model="name" type="text" name="name" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input class="block mt-1 w-full" id="email" wire:model="email" type="email" name="email"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input class="block mt-1 w-full" id="phone" wire:model="phone" type="text" name="phone"
                required autocomplete="Phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!--  Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input class="block mt-1 w-full" id="address" wire:model="address" type="text" name="address"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input class="block mt-1 w-full" id="password" wire:model="password" type="password" name="password"
                required autocomplete="new-password" />

            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input class="block mt-1 w-full" id="password_confirmation" wire:model="password_confirmation"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
