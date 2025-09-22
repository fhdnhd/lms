<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'nik' => ['required', 'digits:16', 'unique:users,nik'],
                'alamat' => ['required', 'string'],
                'tps' => ['required', 'string'],
                'desa' => ['required', 'string'],
                'kecamatan' => ['required', 'string'],
                'kabupaten' => ['required', 'string'],
                'provinsi' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'no_wa' => ['required', 'string'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            

            $user = User::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'tps' => $request->tps,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'email' => $request->email,
                'no_wa' => $request->no_wa,
                'password' => Hash::make($request->password),
                'role' => 'kpps',
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
         } catch (ValidationException $e) {
            // Redirect ke halaman login jika validasi gagal
            return Redirect::route('register')->withErrors($e->errors())->withInput();
        }
    }
}
