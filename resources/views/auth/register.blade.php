<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInputUsername" name="name" placeholder="myusername" required autofocus>
            <label for="floatingInputUsername">Username</label>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="name@example.com" required>
            <label for="floatingInputEmail">Email</label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <hr>

        <!-- Password -->
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
            <label for="floatingPassword">Heslo</label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPasswordConfirm" name="password_confirmation" placeholder="Confirm Password" required>
            <label for="floatingPasswordConfirm">Potvrdenie hesla</label>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-grid mb-2">
            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase text-black bg-blue-400" type="submit">Register</button>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-black dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Už zaregistrovaný?') }}
            </a>
        </div>
    </form>
</x-guest-layout>

