<?php

namespace App\Http\Controllers;

use App\Http\Requests\KecamatanRequest;
use App\Repositories\WilayahRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    /**
     * @var string
     */
    private $path;

    /**
     * Repository kecamatan
     *
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
     * Menampilkan halaman kecamatan/index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kecamatan.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $data = $this->wilayah->kecamatan($request->all(), $request->kabupaten_id);

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('nama_provinsi', function ($data) {
                return $data->kabupaten?->provinsi?->nama_provinsi;
            })
            ->addColumn('nama_kabupaten', function ($data) {
                return $data->kabupaten?->nama_kabupaten;
            })
            ->addColumn('action', function ($data) {
                $button = "";
                if (Auth::user()->can('edit data kecamatan')) {
                    $button .= "
                        <button class='btn btn-warning text-white'
                            onclick='editForm(`" . route('kecamatan.show', $data->id) . "`, `Edit Kecamatan`)'>
                            <i class='fa-solid fa-pen'></i>
                            Edit
                        </button>
                    ";
                }

                if (Auth::user()->can('delete data kecamatan')) {
                    $button .= "
                        &nbsp
                        <button class='btn btn-danger'
                            onclick='deleteData(`" . route('kecamatan.destroy', $data->id) . "`)'>
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
     * Get List kecamatan berdasarkan kabupaten
     *
     * @param integer $kabupatenId
     *
     * @return mixed|array
     */
    public function getListKecamatanByKabupaten($kabupatenId)
    {
        $this->wilayah = new WilayahRepository("\App\Models\m_kecamatan");

        return $this->wilayah->kecamatan([], $kabupatenId)->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KecamatanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KecamatanRequest $request)
    {
        DB::beginTransaction();
        try {
            $kecamatan = $this->wilayah->create($request->except('provinsi_id'));

            DB::commit();
            return $this->ok($kecamatan, 'Kecamatan berhasil ditambahkan');
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
        $kecamatan = $this->wilayah->find($id);

        if (!$kecamatan) {
            return $this->oops($this->path . ' tidak ditemukan');
        }

        $kecamatan = [
            'provinsi_id' => $kecamatan->kabupaten->provinsi->id,
            'kabupaten_id' => $kecamatan->kabupaten->id,
            'nama_kecamatan' => $kecamatan->nama_kecamatan
        ];

        return $this->ok($kecamatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KecamatanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(KecamatanRequest $request, $id)
    {
        $kecamatan = $this->wilayah->find($id);
        if (!$kecamatan) {
            return $this->oops('Kecamatan tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $kecamatan = $this->wilayah->update($request->except('provinsi_id'), $id);

            DB::commit();
            return $this->ok($kecamatan, 'Kecamatan berhasil diupdate');
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
            $kecamatan = $this->wilayah->find($id);
            if (!$kecamatan) {
                return $this->oops('Kecamatan tidak ditemukan.');
            }

            $this->wilayah->delete($kecamatan->id);

            DB::commit();
            return $this->ok(null, 'Kecamatan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
