<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Category;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('auth.register',compact('categories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
public function store(RegisterUserRequest $request): RedirectResponse
    {
         $kycPath = null;
        $logoPath = null;

        try {
            if ($request->role === 'association') {
                $kycPath = $request->file('documentKYC')->store('kyc_documents', 'local');
                $logoPath = $request->file('profilePhoto')->store('logos', 'public');
            }

            $user = DB::transaction(function () use ($request, $kycPath, $logoPath) {
                return User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'ville' => $request->ville,
                    'licenseNumber' => $request->licenseNumber,
                    'description' => $request->description,
                    'category_id' => $request->category_id,
                    'documentKYC' => $kycPath,
                    'profilePhoto' => $logoPath,
                    'status' => $request->role === 'association' ? 'PENDING' : null,
                ]);
            });

            event(new Registered($user));

            if ($user->role === 'association') {
                return redirect()->route('home')->with('success', 'Inscription réussie. Votre compte est en attente de validation par l\'administration.');
            }

            Auth::login($user);
            return redirect()->intended($user->getRedirectRoute());

        } catch (\Exception $e) {
             if ($kycPath) Storage::disk('local')->delete($kycPath);
            if ($logoPath) Storage::disk('public')->delete($logoPath);

            Log::error('Erreur lors de l\'inscription: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de votre inscription. Veuillez réessayer.')->withInput();
        }
    }
}
