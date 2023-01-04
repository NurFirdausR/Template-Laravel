<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class WilayahRepository extends BaseRepository
{
    /**
     * @param string $model
     */
    public function __construct(string $model)
    {
        /** @var \App\Models\Model $model */
        $model = new $model;

        parent::__construct($model);
    }

    /**
     * Menampilkan data provinsi
     * Apabila ada filter maka data akan ditampilkan sesuai keyword
     *
     * @param array|null $attributes
     * @return Collection
     */
    public function provinsi($attributes = []): Collection
    {
        return $this->model
            ->when(isset($attributes['q']) && $attributes['q'] != "", function ($query) use ($attributes) {
                $query->where('name', 'LIKE', "%" . $$attributes['q'] . "%");
            })
            ->get();
    }

    /**
     * Menampilkan data kabupaten sesuai dengan provinsi_id
     * Apabila ada filter maka data akan ditampilkan sesuai keyword
     *
     * @param array|null $attributes
     * @param integer|null $provinsi_id
     * @return Collection
     */
    public function kabupaten($attributes = [], $provinsi_id = null): Collection
    {
        return $this->model
            ->with('provinsi:id,nama_provinsi')
            ->when($provinsi_id, function ($query) use ($provinsi_id) {
                $query->where('provinsi_id', $provinsi_id);
            })
            ->when(isset($attributes['q']) && $attributes['q'] != "", function ($query) use ($attributes) {
                $query->where('name', 'LIKE', "%" . $$attributes['q'] . "%");
            })
            ->get();
    }

    /**
     * Menampilkan data kecamatan sesuai dengan kabupaten_id
     * Apabila ada filter maka data akan ditampilkan sesuai keyword
     *
     * @param array|null $attributes
     * @param integer|null $kabupaten_id
     * @return Collection
     */
    public function kecamatan($attributes = [], $kabupaten_id = null): Collection
    {
        return $this->model
            ->with(['kabupaten' => fn ($query) => $query->with('provinsi')])
            ->when($kabupaten_id, function ($query) use ($kabupaten_id) {
                $query->where('kabupaten_id', $kabupaten_id);
            })
            ->when(isset($attributes['q']) && $attributes['q'] != "", function ($query) use ($attributes) {
                $query->where('name', 'LIKE', "%" . $$attributes['q'] . "%");
            })
            ->get();
    }

    /**
     * Menampilkan data kelurahan sesuai dengan kecamatan_id
     * Apabila ada filter maka data akan ditampilkan sesuai keyword
     *
     * @param array|null $attributes
     * @param integer|null $kecamatan_id
     * @return Collection
     */
    public function kelurahan($attributes = [], $kecamatan_id = null): Collection
    {
        return $this->model
            ->with(['kecamatan' => fn ($query) => $query->with('kabupaten')])
            ->when($kecamatan_id, function ($query) use ($kecamatan_id) {
                $query->where('kecamatan_id', $kecamatan_id);
            })
            ->when(isset($attributes['q']) && $attributes['q'] != "", function ($query) use ($attributes) {
                $query->where('name', 'LIKE', "%" . $$attributes['q'] . "%");
            })
            ->get();
    }
}
