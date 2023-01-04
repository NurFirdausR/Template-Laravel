<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelurahanRequest;
use App\Repositories\WilayahRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
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
     * Menampilkan halaman kelurahan/index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kelurahan.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $data = $this->wilayah->kelurahan($request->all(), $request->kecamatan_id);

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('nama_negara', function ($data) {
                return $data->kecamatan?->kabupaten?->provinsi?->negara?->nama_negara;
            })
            ->addColumn('nama_provinsi', function ($data) {
                return $data->kecamatan?->kabupaten?->provinsi?->nama_provinsi;
            })
            ->addColumn('nama_kabupaten', function ($data) {
                return $data->kecamatan?->kabupaten?->nama_kabupaten;
            })
            ->addColumn('nama_kecamatan', function ($data) {
                return $data->kecamatan?->nama_kecamatan;
            })
            ->addColumn('action', function ($data) {
                $button = "";
                if (Auth::user()->can('edit data kelurahan')) {
                    $button .= "
                            <button class='btn btn-warning text-white'
                                onclick='editForm(`" . route('kelurahan.show', $data->id) . "`, `Edit Kelurahan`)'>
                                <i class='fa-solid fa-pen'></i>
                                Edit
                            </button>
                        ";
                }

                if (Auth::user()->can('delete data kelurahan')) {
                    $button .= "
                            &nbsp
                            <button class='btn btn-danger'
                                onclick='deleteData(`" . route('kelurahan.destroy', $data->id) . "`)'>
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
     * Get List kelurahan berdasarkan kecamatan
     *
     * @param integer $kecamatanId
     *
     * @return mixed|array
     */
    public function getListKelurahanByKecamatan($kecamatanId)
    {
        $this->wilayah = new WilayahRepository("\App\Models\m_kelurahan");

        return $this->wilayah->kelurahan([], $kecamatanId)->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KelurahanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelurahanRequest $request)
    {
        DB::beginTransaction();
        try {
            $kelurahan = $this->wilayah->create($request->except('provinsi_id', 'kabupaten_id'));

            DB::commit();
            return $this->ok($kelurahan, 'Kelurahan berhasil ditambahkan');
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
        $kelurahan = $this->wilayah->find($id);

        if (!$kelurahan) {
            return $this->oops($this->path . ' tidak ditemukan');
        }

        $kelurahan = [
            'provinsi_id' => $kelurahan->kecamatan->kabupaten->provinsi->id,
            'kabupaten_id' => $kelurahan->kecamatan->kabupaten->id,
            'kecamatan_id' => $kelurahan->kecamatan->id,
            'nama_kelurahan' => $kelurahan->nama_kelurahan
        ];

        return $this->ok($kelurahan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KelurahanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(KelurahanRequest $request, $id)
    {
        $kelurahan = $this->wilayah->find($id);
        if (!$kelurahan) {
            return $this->oops('Kelurahan tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $kelurahan = $this->wilayah->update($request->except('provinsi_id', 'kabupaten_id'), $id);

            DB::commit();
            return $this->ok($kelurahan, 'Kelurahan berhasil diupdate');
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
            $kelurahan = $this->wilayah->find($id);
            if (!$kelurahan) {
                return $this->oops('Kelurahan tidak ditemukan.');
            }

            $this->wilayah->delete($kelurahan->id);

            DB::commit();
            return $this->ok(null, 'Kelurahan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
