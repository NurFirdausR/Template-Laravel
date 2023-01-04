<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\IdentitasPenyelenggaraRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $user;

    /**
     * @var IdentitasPenyelenggaraRepository
     */
    private $identitasPenyelenggara;

    public function __construct(
        UserRepository $user,
        IdentitasPenyelenggaraRepository $identitasPenyelenggara
    ) {
        $this->user = $user;
        $this->identitasPenyelenggara = $identitasPenyelenggara;

        app()['cache']->forget('spatie.permission.cache');
    }

    protected $role = 'yayasan';

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_organisasi' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telepon' => ['required', 'string', 'max:15'],

            'provinsi_id' => ['required', 'exists:m_provinsi,id'],
            'kabupaten_id' => ['required', 'exists:m_kabupaten,id'],
            'kecamatan_id' => ['required', 'exists:m_kecamatan,id'],
            'kelurahan_id' => ['required', 'exists:m_kelurahan,id'],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'kotak_centang' => ['required'],
        ]);

        $user = $this->user->create([
            'name' => $request->nama_organisasi,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password),
            'role' => $this->role,
        ]);

        $user->syncRoles($this->role);

        $this->identitasPenyelenggara->create([
            'user_id' => $user->id,
            'nama_organisasi' => $request->nama_organisasi,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
