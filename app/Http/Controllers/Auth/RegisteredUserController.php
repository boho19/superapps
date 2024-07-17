<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('pages.auth.reg');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('register.bio')->with(['id' => $user->id]);
    }

    public function bio()
    {

        if (!session()->has('id')) {
            return redirect()->route('register')->with('error', 'Silahkan isi form pendaftaran terlebih dahulu.');
        }
        return view('pages.auth.bio');
    }

    public function bioStore(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'id_user' => ['required', 'integer'],
            'nik' => ['required', 'string', 'max:16', 'unique:'.Karyawan::class],
            'nama' => ['required', 'string', 'max:50'],
            'jenis_kelamin' => ['required', 'string', 'in:LK,PR'],
            'no_hp' => ['required', 'string', 'max:15'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('id', $request->input('id_user'));
        }

        // Handle image upload
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('/profile', $imageName, 'public_custom');
        } else {
            $imageName = 'profile.png';
        }

        // Create and save the event
        try {
            Karyawan::create([
                'nik' => $request->input('nik'),
                'nama' => $request->input('nama'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'no_hp' => $request->input('no_hp'),
                'foto' => $imageName,
                'id_user' => $request->input('id_user'),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Server error, gagal menambahkan data.')
                            ->withInput()
                            ->with('id', $request->input('id_user'));
        }

        // Redirect to a named route
        return redirect()->route('login')->with('success', 'Berhasil mendaftar. Harap menunggu validasi dari admin. Max 1x24 jam.');
    }

}
