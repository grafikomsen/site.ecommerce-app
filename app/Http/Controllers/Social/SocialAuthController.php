<?php
// app/Http/Controllers/Social/SocialAuthController.php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Rediriger vers le provider
     */
    public function redirectToProvider($provider)
    {
        $this->validateProvider($provider);

        // Stocker l'intention
        session(['url.intended' => url()->previous()]);

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback du provider
     */
    public function handleProviderCallback($provider)
    {
        $this->validateProvider($provider);

        try {
            /** @var \Laravel\Socialite\AbstractUser $socialUser */
            $socialUser = Socialite::driver($provider)->user();

            // Vérifier si l'utilisateur existe déjà
            $user = User::where($provider . '_id', $socialUser->getId())->first();

            if (!$user) {
                // Vérifier si l'email existe déjà
                $existingUser = User::where('email', $socialUser->getEmail())->first();

                if ($existingUser) {
                    // Lier le compte social au compte existant
                    $existingUser->update([
                        $provider . '_id' => $socialUser->getId(),
                        'social_data' => array_merge($existingUser->social_data ?? [], [
                            $provider => $socialUser->getRaw()
                        ])
                    ]);
                    $user = $existingUser;
                } else {
                    // Créer un nouveau compte
                    $user = $this->createSocialUser($socialUser, $provider);
                }
            }

            // Vérifier si l'utilisateur est actif
            if ($user->status !== 'active') {
                Auth::logout();
                return redirect()->route('login')
                    ->with('error', 'Votre compte a été désactivé. Veuillez contacter l\'administrateur.');
            }

            // Connecter l'utilisateur
            Auth::login($user, true);

            // Rediriger selon le rôle
            $intendedUrl = session('url.intended', route('dashboard'));
            session()->forget('url.intended');

            return $this->redirectBasedOnRole($user, $intendedUrl);

        } catch (Exception $e) {
            Log::error('Social login error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Une erreur est survenue lors de l\'authentification.');
        }
    }

    /**
     * Créer un utilisateur social
     */
    private function createSocialUser($socialUser, $provider)
    {
        $name = $socialUser->getName() ?? explode('@', $socialUser->getEmail())[0];

        // Télécharger l'avatar
        $avatar = null;
        if ($socialUser->getAvatar()) {
            $avatar = $this->downloadAvatar($socialUser->getAvatar(), $provider);
        }

        $userData = [
            'name' => $name,
            'email' => $socialUser->getEmail(),
            'password' => Hash::make(Str::random(24)),
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
            'avatar' => $avatar,
            $provider . '_id' => $socialUser->getId(),
            'social_registered_at' => now(),
            'social_data' => [$provider => $socialUser->getRaw()]
        ];

        return User::create($userData);
    }

    /**
     * Télécharger l'avatar
     */
    private function downloadAvatar($url, $provider)
    {
        try {
            $contents = file_get_contents($url);
            $name = 'avatars/' . $provider . '_' . time() . '_' . Str::random(10) . '.jpg';
            Storage::disk('public')->put($name, $contents);
            return $name;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Rediriger selon le rôle
     */
    private function redirectBasedOnRole($user, $defaultUrl)
    {
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }
        if ($user->role === 'vendor') {
            return redirect()->intended(route('vendor.dashboard'));
        }
        return redirect()->intended($defaultUrl);
    }

    /**
     * Valider le provider
     */
    private function validateProvider($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }
    }
}
