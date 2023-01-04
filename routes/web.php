<?php

use App\Http\Controllers\{
    UserController,
    JenisMadrasahController,
    ProgramMadrasahController,
    FormDinamisController,
    KabupatenController,
    KecamatanController,
    KelurahanController,
    ProvinsiController,
    DashboardController,
    FrontController,
    GenerateFileController,
    PegawaiController,
    StakeholderController,
    TahapPendirianController,
    RegulasiController,
    PortalController,
    SelectListController,
    PesertaRapatController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index']);

// list
Route::get('jenis_madrasah/list', [SelectListController::class, 'getListJenisMadrasah'])->name('jenis_madrasah.list_nama');
Route::get('program_madrasah/list', [SelectListController::class, 'getListProgramMadrasah'])->name('program_madrasah.list_nama');
Route::get('jenjang_pendidikan/list', [SelectListController::class, 'getListJenjangPendidikan'])->name('jenjang_pendidikan.list_nama');
Route::get('peserta_rapat/list', [SelectListController::class, 'getListPesertaRapat'])->name('peserta_rapat.list_nama');
Route::get('bank/list', [SelectListController::class, 'getListBank'])->name('bank.list_nama');
Route::get('jabatan/list', [SelectListController::class, 'getListJabatan'])->name('jabatan.list_nama');
Route::get('pegawai/list/{jabatan?}', [SelectListController::class, 'getListPegawai'])->name('pegawai.list_nama');

//list Wilayah
Route::get('provinsi/list', [ProvinsiController::class, 'getListProvinsi'])->name('provinsi.list_provinsi');
Route::get('provinsi/{provinsiId}/kabupaten/list', [KabupatenController::class, 'getListKabuptenByProvinsi'])->name('kabupaten.list_nama_kabupaten');
Route::get('kabupaten/{kabupatenId}/kecamatan/list', [KecamatanController::class, 'getListKecamatanByKabupaten'])->name('kecamatan.list_nama_kecamatan');
Route::get('kecamatan/{kelurahanId}/kelurahan/list', [KelurahanController::class, 'getListKelurahanByKecamatan'])->name('kelurahan.list_nama_kelurahan');

Route::get('detail/{id}', [PortalController::class, 'detail'])->name('portal.detail_madrasah');
Route::get('regulasi/list', [PortalController::class, 'regulasi'])->name('portal.data_regulasi');
Route::get('regulasi/download/{id}', [PortalController::class, 'download'])->name('portal.download_regulasi');

Route::group([
    'middleware' => 'auth'
], function () {

    // Portal
    Route::get('/portals', [PortalController::class, 'index']);
    Route::post('/portals/save', [PortalController::class, 'save']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('redirect_by_role');

    // Provinsi
    Route::group(['middleware' => 'permission:create data provinsi|view data provinsi|edit data provinsi|delete data provinsi'], function () {
        Route::get('provinsi/data', [ProvinsiController::class, 'data'])->name('provinsi.data');
        Route::resource('provinsi', ProvinsiController::class)->except('create', 'edit');
    });

    // Kabupaten
    Route::group(['middleware' => 'permission:create data kabupaten|view data kabupaten|edit data kabupaten|delete data kabupaten'], function () {
        Route::get('kabupaten/data', [KabupatenController::class, 'data'])->name('kabupaten.data');
        Route::resource('kabupaten', KabupatenController::class)->except('create', 'edit');
    });

    // Kecamatan
    Route::group(['middleware' => 'permission:create data kecamatan|view data kecamatan|edit data kecamatan|delete data kecamatan'], function () {
        Route::get('kecamatan/data', [KecamatanController::class, 'data'])->name('kecamatan.data');
        Route::resource('kecamatan', KecamatanController::class)->except('create', 'edit');
    });

    // Kelurahan
    Route::group(['middleware' => 'permission:create data kelurahan|view data kelurahan|edit data kelurahan|delete data kelurahan'], function () {
        Route::get('kelurahan/data', [KelurahanController::class, 'data'])->name('kelurahan.data');
        Route::resource('kelurahan', KelurahanController::class)->except('create', 'edit');
    });

    // Stakeholder
    Route::group(['middleware' => 'permission:create data stakeholder|view data stakeholder|edit data stakeholder|delete data stakeholder'], function () {
        Route::get('stakeholder/data', [StakeholderController::class, 'data'])->name('stakeholder.data');
        Route::resource('stakeholder', StakeholderController::class)->except('create', 'edit');
    });

    // Tahap Pendirian
    Route::group(['middleware' => 'permission:create data tahap pendirian|view data tahap pendirian|edit data tahap pendirian|delete data tahap pendirian'], function () {
        Route::get('tahap_pendirian/data', [TahapPendirianController::class, 'data'])->name('tahap_pendirian.data');
        Route::resource('tahap_pendirian', TahapPendirianController::class)->except('create', 'edit');
    });

    // Tahap Pendirian
    Route::group(['middleware' => 'permission:create data regulasi|view data regulasi|edit data regulasi|delete data regulasi'], function () {
        Route::get('regulasi/data', [RegulasiController::class, 'data'])->name('regulasi.data');
        Route::resource('regulasi', RegulasiController::class)->except('create', 'edit');
    });

    // Tahap Pendirian
    Route::group(['middleware' => 'permission:create data peserta rapat|view data peserta rapat|edit data peserta rapat|delete data peserta rapat'], function () {
        Route::get('peserta_rapat/data', [PesertaRapatController::class, 'data'])->name('peserta_rapat.data');
        Route::resource('peserta_rapat', PesertaRapatController::class)->except('create', 'edit');
    });

    // Profil
    Route::get('user/profil', [UserController::class, 'showFormProfil'])->name('user.show_form_profil');
    Route::post('user/update_profil', [UserController::class, 'updateProfil'])->name('user.update_profil');
    Route::post('user/update_password', [UserController::class, 'updatePassword'])->name('user.update_password');

    // Jenis Madrasah
    // Route::group(['middleware' => 'permission:create data jenis madrasah|view data jenis madrasah|delete data jenis madrasah'], function () {
    Route::get('jenis_madrasah/data', [JenisMadrasahController::class, 'data'])->name('jenis_madrasah.data');
    Route::resource('jenis_madrasah', JenisMadrasahController::class)->except('create', 'edit');
    Route::post('jenis_madrasah/is_published', [JenisMadrasahController::class, 'UpdatePublish'])->name('jenis_madrasah.is_published');
    // });

    // Program Madrasah
    Route::get('program_madrasah/data', [ProgramMadrasahController::class, 'data'])->name('program_madrasah.data');
    Route::resource('program_madrasah', ProgramMadrasahController::class, [
        'except' => ['create', 'update']
    ]);
    Route::get('program_madrasah/create/{step}', [ProgramMadrasahController::class, 'create'])->name('program_madrasah.create');
    Route::post('program_madrasah/create/save/{step}', [ProgramMadrasahController::class, 'createProgramMadrasahPost'])->name('program_madrasah.create.post');
    Route::get('program_madrasah/update/{id}/{step}', [ProgramMadrasahController::class, 'update'])->name('program_madrasah.update');
    Route::put('program_madrasah/update/save/{id}/{step}', [ProgramMadrasahController::class, 'updateProgramMadrasahPost'])->name('program_madrasah.update.post');
    Route::post('program_madrasah/is_published', [ProgramMadrasahController::class, 'UpdatePublish'])->name('program_madrasah.is_published');
    Route::get('program_madrasah/detail/{id}', [ProgramMadrasahController::class, 'detail'])->name('program_madrasah.detail');
    Route::delete('program_madrasah/{id}', [ProgramMadrasahController::class, 'destroy'])->name('program_madrasah.delete');

    // Form Dinamis
    Route::get('form_dinamis/get-form', [FormDinamisController::class, 'get_form'])->name('form_dinamis.get_form');
    Route::post('form_dinamis/store-form', [FormDinamisController::class, 'store_form'])->name('form_dinamis.store_form');
    Route::post('form_dinamis/update-form/{id}', [FormDinamisController::class, 'update_form'])->name('form_dinamis.update_form');
    Route::delete('form_dinamis/delete-form/{id}', [FormDinamisController::class, 'destroy_form'])->name('form_dinamis.destroy_form');

    // Pegawai
    Route::group(['middleware' => 'permission:create data pegawai|view data pegawai|edit data pegawai|delete data pegawai'], function () {
        Route::get('pegawai/data', [PegawaiController::class, 'data'])->name('pegawai.data');
        Route::resource('pegawai', PegawaiController::class)->except('create', 'edit');
    });

    Route::get('generate_file/download/{tipe}/{pengajuan_id}', [GenerateFileController::class, 'download'])->name('generate_file.download');
});
