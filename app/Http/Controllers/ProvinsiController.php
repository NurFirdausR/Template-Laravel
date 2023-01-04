<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinsiRequest;
use App\Repositories\WilayahRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var WilayahRepository
     */
    private $wilayah;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $model = explode('/', $request->path())[0];

        $this->path   = $model;
        $this->wilayah = new WilayahRepository("\App\Models\\m_$model");
    }

    /**
     * Menampilkan halaman provinsi/index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('provinsi.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $data = $this->wilayah->provinsi($request->all());

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = "";
                if (Auth::user()->can('edit data provinsi')) {
                    $button .= "
                        <button class='btn btn-warning text-white'
                            onclick='editForm(`" . route('provinsi.show', $data->id) . "`, `Edit Provinsi`)'>
                            <i class='fa-solid fa-pen'></i>
                            Edit
                        </button>
                    ";
                }

                if (Auth::user()->can('delete data provinsi')) {
                    $button .= "
                        &nbsp
                        <button class='btn btn-danger'
                            onclick='deleteData(`" . route('provinsi.destroy', $data->id) . "`)'>
                            <i class='fa-solid fa-trash'></i>
                            Hapus
                        </button>
                    ";
                }

                return $button;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Get List Provinsi
     *
     * @return mixed|array
     */
    public  function getListProvinsi()
    {
        $this->wilayah = new WilayahRepository("\App\Models\m_provinsi");

        return $this->wilayah->provinsi([])->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProvinsiRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinsiRequest $request)
    {
        DB::beginTransaction();
        try {
            $provinsi = $this->wilayah->create($request->all());

            DB::commit();
            return $this->ok($provinsi, 'Provinsi berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provinsi = $this->wilayah->find($id);

        if (!$provinsi) {
            return $this->oops($this->path . ' tidak ditemukan');
        }

        return $this->ok($provinsi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProvinsiRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinsiRequest $request, $id)
    {
        $provinsi = $this->wilayah->find($id);
        if (!$provinsi) {
            return $this->oops('Provinsi tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $provinsi = $this->wilayah->update($request->all(), $id);

            DB::commit();
            return $this->ok($provinsi, 'Provinsi berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $provinsi = $this->wilayah->find($id);
            if (!$provinsi) {
                return $this->oops('Provinsi tidak ditemukan.');
            }

            $this->wilayah->delete($provinsi->id);

            DB::commit();
            return $this->ok(null, 'Provinsi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
