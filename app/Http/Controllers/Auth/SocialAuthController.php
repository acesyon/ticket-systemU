<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    /**
     * @var array<int, string>
     */
    private array $allowedProviders = ['google', 'facebook'];

    public function redirect(string $provider): RedirectResponse
    {
        abort_unless(in_array($provider, $this->allowedProviders, true), 404);

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        abort_unless(in_array($provider, $this->allowedProviders, true), 404);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (Throwable) {
            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Unable to authenticate with ' . ucfirst($provider) . '. Please try again.']);
        }

        $email = $socialUser->getEmail();
        if (! $email) {
            return redirect()
                ->route('login')
                ->withErrors(['email' => ucfirst($provider) . ' did not return an email address.']);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            [$firstName, $lastName] = $this->splitName($socialUser->getName() ?: $socialUser->getNickname());

            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(40)),
                'role' => 'user',
                'oauth_provider' => $provider,
                'oauth_provider_id' => (string) $socialUser->getId(),
            ]);
        } else {
            $user->forceFill([
                'email_verified_at' => $user->email_verified_at ?? now(),
                'oauth_provider' => $provider,
                'oauth_provider_id' => (string) $socialUser->getId(),
            ])->save();
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        return redirect()->route('home')->with('success', 'Logged in with ' . ucfirst($provider) . ' successfully.');
    }

    /**
     * @return array{0:string,1:string}
     */
    private function splitName(?string $fullName): array
    {
        $clean = trim((string) $fullName);
        if ($clean === '') {
            return ['User', 'Account'];
        }

        $parts = preg_split('/\s+/', $clean) ?: [];
        $first = $parts[0] ?? 'User';
        $last = count($parts) > 1 ? implode(' ', array_slice($parts, 1)) : 'Account';

        return [$first, $last];
    }
}
