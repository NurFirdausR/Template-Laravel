<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfilRequest;
use App\Http\Requests\updatePasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $user;


    public function __construct(
        UserRepository $user,
    ) {
        $this->user = $user;
    }

    public function showFormProfil()
    {
        return view('admin.users.profil');
    }

    /**
     * Update profil user
     *
     * @param UpdateProfilRequest $request
     * @return mixed
     */
    public function updateProfil(UpdateProfilRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();

            // $pathImage = $user->path_image;
            // if ($request->hasFile('path_image')) {
            //     delete_file($pathImage);
            //     $pathImage = upload_file('user', $request->path_image, 'path_image');
            // }

            $attributes['name'] = auth()->user()->role == 'yayasan' ? $request->nama_organisasi : $request->nama;
            $attributes['email'] = $request->email;
            // $attributes['path_image'] = $pathImage;

            $user->update($attributes);

            if (auth()->user()->role == 'kanwil' || auth()->user()->role == 'kabko') {
                $kantor = $this->kantor->findBy('user_id', $user->id);
                $kantor->update($request->all());
            }

            if (auth()->user()->role == 'yayasan') {
                $yayasan = $this->yayasan->findBy('user_id', $user->id);
                $yayasan->update($request->all());
            }

            DB::commit();
            return $this->ok($user, 'Profil berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }

    /**
     * Update password user
     *
     * @param updatePasswordRequest $request
     * @return mixed
     */
    public function updatePassword(updatePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();

            $currentPassword = $user->password;
            if (!Hash::check($request->current_password, $currentPassword)) {
                return back()->with('error_msg', 'Password lama tidak cocok');
            }

            $attributes['password'] = Hash::make($request->password);

            $user->update($attributes);

            DB::commit();

            return $this->ok($user, 'Password berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
