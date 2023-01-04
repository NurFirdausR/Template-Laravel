<?php

namespace App\Http\Controllers;

use App\Http\Requests\KabupatenRequest;
use App\Repositories\WilayahRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KabupatenController extends Controller
{
    /**
     * @var string
     */
    private $path;

    /**
     * Repository kabupaten
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
     * Menampilkan halaman kabupaten/index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kabupaten.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $data = $this->wilayah->kabupaten($request->all(), $request->provinsi_id);

        return datatables($data)
            ->addIndexColumn()
            ->addColumn('nama_provinsi', function ($data) {
                return $data->provinsi?->nama_provinsi;
            })
            ->addColumn('action', function ($data) {
                $button = "";
                if (Auth::user()->can('edit data kabupaten')) {
                    $button .= "
                        <button class='btn btn-warning text-white'
                            onclick='editForm(`" . route('kabupaten.show', $data->id) . "`, `Edit Kabupaten`)'>
                            <i class='fa-solid fa-pen'></i>
                            Edit
                        </button>
                    ";
                }

                if (Auth::user()->can('delete data kabupaten')) {
                    $button .= "
                        &nbsp
                        <button class='btn btn-danger'
                            onclick='deleteData(`" . route('kabupaten.destroy', $data->id) . "`)'>
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
     * Get List kabupaten berdasarkan provinsi
     *
     * @param integer $provinsiId
     *
     * @return mixed|array
     */
    public  function getListKabuptenByProvinsi($provinsiId)
    {
        $this->wilayah = new WilayahRepository("\App\Models\m_kabupaten");

        return $this->wilayah->kabupaten([], $provinsiId)->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KabupatenRequest $request
     * @return \Illuminate\Http\Response
     */
    public  function store(KabupatenRequest $request)
    {
        DB::beginTransaction();
        try {
            $kabupaten = $this->wilayah->create($request->all());

            DB::commit();
            return $this->ok($kabupaten, 'Kabupaten berhasil ditambahkan');
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
        $kabupaten = $this->wilayah->find($id);

        if (!$kabupaten) {
            return $this->oops($this->path . ' tidak ditemukan');
        }

        return $this->ok($kabupaten);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KabupatenRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(KabupatenRequest $request, $id)
    {
        $kabupaten = $this->wilayah->find($id);
        if (!$kabupaten) {
            return $this->oops('Kabupaten tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            $kabupaten = $this->wilayah->update($request->all(), $id);

            DB::commit();
            return $this->ok($kabupaten, 'Kabupaten berhasil diupdate');
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
            $kabupaten = $this->wilayah->find($id);
            if (!$kabupaten) {
                return $this->oops('Kabupaten tidak ditemukan.');
            }

            $this->wilayah->delete($kabupaten->id);

            DB::commit();
            return $this->ok(null, 'Kabupaten berhasil dihapus.');
        } catch (\Exception             $e) {
            DB::rollBack();
            return $this->oops($e->getMessage());
        }
    }
}
