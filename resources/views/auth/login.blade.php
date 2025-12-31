<x-guest-layout>
    <div style="min-height:60vh;display:flex;align-items:center;justify-content:center;padding:3rem 1rem;">
        <div style="display:flex;gap:2.5rem;align-items:center;max-width:920px;width:100%;background:rgba(255,255,255,0.02);padding:2rem;border-radius:12px;box-shadow:0 10px 30px rgba(0,0,0,0.5);">

            <!-- Logo (left) -->
            <div style="flex:0 0 260px;display:flex;align-items:center;justify-content:center;padding:0 1rem;">
                <img src="/assets/LOGO.png" alt="Lost In The Ocean" style="width:200px;height:auto;display:block;filter:drop-shadow(0 6px 18px rgba(0,0,0,.6));">
            </div>

            <!-- Form (right) -->
            <div style="flex:1;min-width:320px;">
                <h2 style="font-family:var(--font-title);font-size:1.45rem;margin:0 0 .6rem;color:var(--text);">Iniciar sesion</h2>
                <p style="margin:0 0 1rem;color:var(--text-faint);">Accede al panel de administración</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div style="margin-bottom:.75rem;">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div style="margin-bottom:.75rem;">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:.5rem;gap:1rem;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <input id="remember_me" type="checkbox" name="remember" style="width:18px;height:18px;border-radius:4px;border:1px solid rgba(255,255,255,.06);">
                            <label for="remember_me" style="font-size:.9rem;color:var(--text-faint);">Recuérdame</label>
                        </div>

                        <div style="margin-left:auto;">
                            <x-primary-button>
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
