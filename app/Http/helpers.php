<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('randomKey')) {
    /**
     * Random
     */

    function randomKey()
    {
        $s = strtoupper(md5(uniqid(rand(), true)));
        $guidText =
            substr($s, 0, 4) . '_' .
            substr($s, 5, 4) . '_' .
            substr($s, 12, 4) . '_' .
            substr($s, 20);
        return $guidText;
    }
}

if (!function_exists('upload_file')) {
    /**
     * Fungsi untuk upload file dan menyimpan ke storage public
     *
     * @param string $directory
     * @param mixed $file
     * @param string $filename
     * @return string
     */
    function upload_file($directory, $file, $filename)
    {
        $extensi  = $file->getClientOriginalExtension();
        $filename = "{$filename}_" . date('Ymdhis') . '_' . randomKey() . '_' . ".{$extensi}";

        $disk = Storage::disk('public');
        $disk->putFileAs("uploads/$directory", $file, $filename);

        return "uploads/$directory/$filename";
    }
}

if (!function_exists('load_file')) {
    /**
     * Fungsi untuk load file dari storage public
     *
     * @param string $filepath
     * @return string
     */
    function load_file($filepath)
    {
        return Storage::disk('public')->url("$filepath");
    }
}

if (!function_exists('download_file')) {
    /**
     * Fungsi untuk download file dari storage public
     *
     * @param string $filepath
     * @return string
     */
    function download_file($filepath)
    {
        if (Storage::disk('public')->exists("$filepath")) {
            return Storage::disk('public')->download("$filepath");
        }

        abort(404);
    }
}

if (!function_exists('delete_file')) {
    /**
     * Fungsi untuk hapus file dari storage public
     *
     * @param string $filepath
     * @return bool
     */
    function delete_file($filepath)
    {
        if (Storage::disk('public')->exists("$filepath")) {
            return Storage::disk('public')->delete("$filepath");
        }

        return false;
    }
}

if (!function_exists('format_tanggal')) {
    /**
     * Fungsi untuk memformat tanggal menjadi tanggal indonesia
     *
     * @param string $date
     * @param boolean $day
     * @return string
     */
    function format_tanggal($date, $day = false)
    {
        if ($date == null or $date == "") {
            return '';
        }

        $days   = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');
        $months = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        $year  = substr($date, 0, 4);
        $month = $months[(int) substr($date, 5, 2)];
        $date2 = substr($date, 8, 2);
        $text  = '';

        if ($day) {
            $day   = date('w', mktime(0, 0, 0, substr($date, 5, 2), $date2, $year));
            $day   = $days[$day];
            $text .= "{$day}, {$date2} {$month} {$year}";

            return $text;
        }

        $text .= "{$date2} {$month} {$year}";
        return $text;
    }
}

if (!function_exists('format_ymd')) {
    /**
     * Fungsi untuk memformat tanggal menjadi format Y-m-d
     *
     * @param string $data
     * @return string
     */
    function format_ymd($date)
    {
        return $date ? now()->parse($date)->format('Y-m-d') : '';
    }
}

if (!function_exists('format_bulan')) {
    /**
     * Fungsi untuk memformat nomor bulan menjadi nama bulan
     *
     * @param integer $month
     * @return string
     */
    function format_bulan($month)
    {

        $months = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $month = $months[(int) $month];

        return $month;
    }
}

if (!function_exists('format_bulan_romawi')) {
    /**
     * Fungsi untuk memformat nomor bulan menjadi romawi
     *
     * @param integer $month
     * @return string
     */
    function format_bulan_romawi($month)
    {

        $months = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $month = $months[(int) $month];

        return $month;
    }
}

if (!function_exists('format_hari')) {
    /**
     * Fungsi untuk memformat nomor hari menjadi nama hari
     *
     * @param string|integer $date
     * @return string
     */
    function format_hari($date)
    {
        $days = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');
        if (is_string($date)) {
            $day  = date('w', mktime(0, 0, 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4)));
            $day  = $days[$day];
        } else {
            $day  = $days[$date];
        }

        return $day;
    }
}

if (!function_exists('format_uang')) {
    /**
     * Fungsi untuk memformat number menjadi format indonesia
     *
     * @param integer $number
     * @return string
     */
    function format_uang($number)
    {
        if (!$number) {
            return 0;
        }

        return number_format($number, 0, ',', '.');
    }
}


if (!function_exists('angka_terbilang')) {
    /**
     * Fungsi untuk memformat number menjadi format indonesia
     *
     * @param integer $number
     * @return string
     */
    function angka_terbilang($angka)
    {
        $angka = abs($angka);
        $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
        $terbilang = '';

        if ($angka < 12)      $terbilang        = ' ' . $baca[$angka];
        elseif ($angka < 20)  $terbilang        = angka_terbilang($angka - 10) . ' belas';
        elseif ($angka < 100) $terbilang        = angka_terbilang($angka / 10) . ' puluh' . angka_terbilang($angka % 10);
        elseif ($angka < 200) $terbilang        = ' seratus' . angka_terbilang($angka - 100);
        elseif ($angka < 1000) $terbilang       = angka_terbilang($angka / 100) . ' ratus' . angka_terbilang($angka % 100);
        elseif ($angka < 2000) $terbilang       = ' seribu' . angka_terbilang($angka - 1000);
        elseif ($angka < 1000000) $terbilang    = angka_terbilang($angka / 1000) . ' ribu' . angka_terbilang($angka % 1000);
        elseif ($angka < 1000000000) $terbilang = angka_terbilang($angka / 1000000) . ' juta' . angka_terbilang($angka % 1000000);

        return ucwords($terbilang);
    }
}


if (!function_exists('tanggal_terbilang')) {
    /**
     * Fungsi untuk memformat tanggal menjadi format indonesia
     *
     * @param date $date
     * @return string
     */
    function tanggal_terbilang($date)
    {
        $date = date('Y-m-d', strtotime($date));
        if ($date == '0000-00-00')
            return 'Tanggal Kosong';

        $tgl = substr($date, 8, 2);
        $bln = substr($date, 5, 2);
        $thn = substr($date, 0, 4);

        switch ($bln) {
            case 1: {
                    $bln = 'Januari';
                }
                break;
            case 2: {
                    $bln = 'Februari';
                }
                break;
            case 3: {
                    $bln = 'Maret';
                }
                break;
            case 4: {
                    $bln = 'April';
                }
                break;
            case 5: {
                    $bln = 'Mei';
                }
                break;
            case 6: {
                    $bln = "Juni";
                }
                break;
            case 7: {
                    $bln = 'Juli';
                }
                break;
            case 8: {
                    $bln = 'Agustus';
                }
                break;
            case 9: {
                    $bln = 'September';
                }
                break;
            case 10: {
                    $bln = 'Oktober';
                }
                break;
            case 11: {
                    $bln = 'November';
                }
                break;
            case 12: {
                    $bln = 'Desember';
                }
                break;
            default: {
                    $bln = 'UnKnown';
                }
                break;
        }

        $hari = date('N', strtotime($date));
        switch ($hari) {
            case 0: {
                    $hari = 'Minggu';
                }
                break;
            case 1: {
                    $hari = 'Senin';
                }
                break;
            case 2: {
                    $hari = 'Selasa';
                }
                break;
            case 3: {
                    $hari = 'Rabu';
                }
                break;
            case 4: {
                    $hari = 'Kamis';
                }
                break;
            case 5: {
                    $hari = "Jum'at";
                }
                break;
            case 6: {
                    $hari = 'Sabtu';
                }
                break;
            default: {
                    $hari = 'UnKnown';
                }
                break;
        }

        $tanggalIndonesia = "Hari " . $hari . ", Tanggal " . angka_terbilang($tgl) . " " . $bln . " Tahun" . angka_terbilang($thn);
        return ucwords($tanggalIndonesia);
    }
}

if (!function_exists('format_tanggal_romawi')) {
    function format_tanggal_romawi($tanggal)
    {
        $pecah = explode("-", $tanggal);
        return $pecah[0] . "/" . format_bulan_romawi($pecah[1]) . "/" . $pecah[2];
    }
}
