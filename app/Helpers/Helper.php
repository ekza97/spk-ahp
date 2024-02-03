<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Mapel;
use App\Mail\NotifTTD;
use Ilovepdf\Ilovepdf;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Permission;
use App\Models\TandaTangan;
use App\Mail\NotifDokumenTTD;
use App\Models\PerbandinganAlternatif;
use App\Models\PerbandinganKriteria;
use App\Models\PriorityVektorAlternatif;
use App\Models\PriorityVektorKriteria;
use App\Models\RandomIndex;
use App\Models\StudentHasExam;
use Illuminate\Support\Facades\Mail;
use App\Notifications\TTDNotification;
use PhpOffice\PhpWord\TemplateProcessor;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Helper
{

    public static function appTitle($title)
    {
        return preg_replace('/(?<!\ )[A-Z]/', ' $0', $title);
    }

    public static function permissions($param = null)
    {
        if ($param == null) {
            return Permission::orderBy('name', 'asc')->get();
        } else {
            return Permission::orderBy('name', 'asc')->where('name', 'like', '%' . $param . '%')->get();
        }
    }

    public static function roles()
    {
        return Role::all();
    }

    public static function date($data, $format)
    {
        return Carbon::parse($data)->format($format);
    }

    public static function number($data)
    {
        return number_format($data, 0, '', '.');
    }

    public static function dateIndo($tanggal)
    {
        $tanggal = Carbon::parse($tanggal)->format('Y-m-d');
        $bulan = [
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        //format tanggal 2022-10-20
        $pecahkan = explode('-', $tanggal);

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public static function delMask($separator, $data)
    {
        return implode('', explode($separator, $data));
    }

    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function monthRomawi($month)
    {
        $monthArr = [1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
        return $monthArr[$month];
    }

    public static function getNoUrut($no_surat)
    {
        $nomor = explode('/', $no_surat);
        $urut = explode('.', $nomor[0]);
        return (int)$urut[1];
    }

    public static function getFilename($file)
    {
        $name = explode('/', $file);
        end($name);         // move the internal pointer to the end of the pecah
        $key = key($name);
        return $name[$key];
    }

    public static function getKriteriaID($no_urut)
    {
        $listID = Kriteria::orderBy('id')->pluck('id')->toArray();
        return $listID[$no_urut];
    }

    public static function getAlternatifID($no_urut)
    {
        $listID = Alternatif::orderBy('id')->pluck('id')->toArray();
        return $listID[$no_urut];
    }

    public static function getKriteriaNama($no_urut)
    {
        $nama = Kriteria::orderBy('id')->pluck('nama')->toArray();
        return $nama[$no_urut];
    }

    public static function getAlternatifNama($no_urut)
    {
        $nama = Alternatif::orderBy('id')->pluck('nama')->toArray();
        return $nama[$no_urut];
    }

    public static function getAlternatifPV($id_alternatif, $id_kriteria)
    {
        $pv = PriorityVektorAlternatif::where('alternatif_id', $id_alternatif)
            ->where('kriteria_id', $id_kriteria)
            ->value('nilai');
        return $pv;
    }

    public static function getKriteriaPV($id_kriteria)
    {
        $pv = PriorityVektorKriteria::where('kriteria_id', $id_kriteria)
            ->value('nilai');
        return $pv;
    }

    public static function getNilaiPerbandinganKriteria($kriteria1, $kriteria2)
    {
        $kriteria_one = Helper::getKriteriaID($kriteria1);
        $kriteria_two = Helper::getKriteriaID($kriteria2);

        $nilai = PerbandinganKriteria::where('kriteria_one', $kriteria_one)
            ->where('kriteria_two', $kriteria_two)
            ->value('nilai');

        return $nilai ? $nilai : 1;
    }

    public static function getNilaiPerbandinganAlternatif($alternatif1, $alternatif2, $kriteriaId)
    {
        $alternatif_one = Helper::getAlternatifID($alternatif1);
        $alternatif_two = Helper::getAlternatifID($alternatif2);
        $id_kriteria = Helper::getKriteriaID($kriteriaId);

        $nilai = PerbandinganAlternatif::where('alternatif_one', $alternatif_one)
            ->where('alternatif_two', $alternatif_two)
            ->where('kriteria_id', $id_kriteria)
            ->value('nilai');

        return $nilai ? $nilai : 1;
    }

    public static function getJumlah($jenis)
    {
        $n = $jenis === 'kriteria' ? Kriteria::count() : Alternatif::count();

        return $n;
    }

    public static function getEigenVector($matrik_a, $matrik_b, $n)
    {
        $eigenVector = 0;
        for ($i = 0; $i < $n; $i++) {
            $eigenVector += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
        }

        return $eigenVector;
    }

    public static function getConsIndex($matrik_a, $matrik_b, $n)
    {
        $eigenVector = Helper::getEigenVector($matrik_a, $matrik_b, $n);
        $consIndex = ($eigenVector - $n) / ($n - 1);

        return $consIndex;
    }

    public static function getConsRatio($matrik_a, $matrik_b, $n)
    {
        $consIndex = Helper::getConsIndex($matrik_a, $matrik_b, $n);
        $nilaiIR = RandomIndex::where('jumlah', $n)->value('nilai');
        $consRatio = $consIndex / $nilaiIR;

        return $consRatio;
    }

    public static function showTabelPerbandingan($jenis)
    {
        $n = $jenis === 'kriteria' ? Kriteria::count() : Alternatif::count();
        $pilihan = $jenis === 'kriteria' ? Kriteria::pluck('nama')->toArray() : Alternatif::pluck('nama')->toArray();

        return view('backapp.perbandingan', compact('jenis', 'n', 'pilihan'));
    }
}
