<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\Category;

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
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'=>['required','string','in:donator,association'],
            ];

            if ($request->role === 'association') {
            $rules['ville'] = ['required', 'string', 'max:255'];
            $rules['licenseNumber'] = ['required', 'string', 'max:255'];
            $rules['description'] = ['required', 'string', 'min:50'];
           $rules['category_id'] = ['required', 'integer', 'exists:categories,id'];
        $rules['documentKYC'] = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'];
            $rules['profilePhoto'] = ['required', 'image', 'max:5120'];
        }
        $request->validate($rules);

        $kycPath = null;
        $logoPath = null;
        $status = null;


        if ($request->role === 'association') {
             $kycPath = $request->file('documentKYC')->store('kyc_documents', 'public');
            $logoPath = $request->file('profilePhoto')->store('logos', 'public');
            $status = 'pending';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=>$request->role,
            'ville' => $request->ville,
            'licenseNumber' => $request->licenseNumber,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'documentKYC' => $kycPath,
            'profilePhoto' => $logoPath,
            'status' => $status,
        ]);

        event(new Registered($user));

        Auth::login($user);


       $url = match ($user->role) {
            'admin' => route('admin.dashboard', absolute: false),
            'association' => route('association.dashboard', absolute: false),
            'donator' => route('donator.dashboard', absolute: false),
            default => route('dashboard', absolute: false),
        };

        return redirect($url);
        }
}
