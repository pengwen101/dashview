<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function login()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function googleAuth()
    {
        return  Socialite::driver('google')->redirect();
    }

    public function processLogin()
    {
        // Log::info('3: ',session()->all());
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $email = strtolower($user->getEmail());
            $name = $user->getName();

            if (!User::exists()) {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'is_email_approved' => 1,
                    'email_approved_at' =>  Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                Auth::login($user);

                session([
                    'email' => $email,
                    'name' => $name,
                ]);
                $redirectUrl = session('url.intended', '/');
                return redirect($redirectUrl);
            } else{
                $user = User::where('email', $email)->first();
                if (!$user) {
                    $user = User::create([
                        'name' => $name,
                        'email' => $email,
                        'is_email_approved' => 0,
                        'email_approved_at' => null,
                    ]);
                }

                if (!$user->is_email_approved) {
                    return redirect('/login')->with('error', 'Your email is pending approval.');
                }

                Auth::login($user);

                session([
                    'email' => $email,
                    'name' => $name,
                ]);
            
                $redirectUrl = session('url.intended', '/');
                return redirect($redirectUrl);
            }
        } catch (\Exception $e) {
            Log::error('Error during Google login: ' . $e->getMessage(), ['stack' => $e->getTraceAsString()]);
            return redirect()->route('login')->with('error', 'Error during Google login, please try again.');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
