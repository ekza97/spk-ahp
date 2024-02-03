<?php

namespace App\Http\Controllers\BackApp;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\PerbandinganAlternatif;
use App\Models\PriorityVektorAlternatif;

class BobotAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jenis = $request->segment(2);
        return view('backapp.alternatif.bobot',compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jenis = $request->jenis;
        // jumlah kriteria
        $n = Alternatif::count();

        // memetakan nilai ke dalam bentuk matrik
        // x = baris
        // y = kolom
        $matrik = array();
        $urut     = 0;

        for ($x = 0; $x <= ($n - 2); $x++) {
            for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                $urut++;
                $pilih    = "pilih" . $urut;
                $bobot     = "bobot" . $urut;
                if ($_POST[$pilih] == 1) {
                    $matrik[$x][$y] = $_POST[$bobot];
                    $matrik[$y][$x] = 1 / $_POST[$bobot];
                } else {
                    $matrik[$x][$y] = 1 / $_POST[$bobot];
                    $matrik[$y][$x] = $_POST[$bobot];
                }

                $this->inputDataPerbandingan($x, $y, ($jenis-1), $matrik[$x][$y], $_POST[$pilih]);
            }
        }

        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n - 1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = array();
        $jmlmnk = array();
        for ($i = 0; $i <= ($n - 1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $value        = $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }


        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x = 0; $x <= ($n - 1); $x++) {
            for ($y = 0; $y <= ($n - 1); $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value    = $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }

            // nilai priority vektor
            $pv[$x]     = $jmlmnk[$x] / $n;

            // memasukkan nilai priority vektor ke dalam tabel pv_kriteria dan pv_alternatif
            $id_alternatif = Helper::getAlternatifID($x);
            $id_kriteria	= Helper::getKriteriaID($jenis-1);

            $this->inputDataPV($id_alternatif,$id_kriteria,$pv[$x]);
        }

        // cek konsistensi
        $eigenvektor = Helper::getEigenVector($jmlmpb, $jmlmnk, $n);
        $consIndex   = Helper::getConsIndex($jmlmpb, $jmlmnk, $n);
        $consRatio   = Helper::getConsRatio($jmlmpb, $jmlmnk, $n);

        return view('backapp.alternatif.matriks',compact('n','jmlmpb','jmlmnk','matrik','matrikb','pv','eigenvektor','consIndex','consRatio','jenis'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function inputDataPerbandingan($alternatif1, $alternatif2, $kriteriaId, $nilai, $pilih)
    {
        // Get kriteria IDs
        $id_alternatif1 = Helper::getAlternatifID($alternatif1); // Assuming Kriteria is your model
        $id_alternatif2 = Helper::getAlternatifID($alternatif2);
        $id_kriteria = Helper::getKriteriaID($kriteriaId);

        // Check if the comparison already exists
        $perbandingan = PerbandinganAlternatif::where('alternatif_one', $id_alternatif1)
            ->where('alternatif_two', $id_alternatif2)
            ->where('kriteria_id', $id_kriteria)
            ->first();

        if (!$perbandingan) {
            // Create a new comparison
            PerbandinganAlternatif::create([
                'alternatif_one' => $id_alternatif1,
                'alternatif_two' => $id_alternatif2,
                'kriteria_id' => $id_kriteria,
                'nilai' => $nilai,
                'checked' => $pilih,
            ]);
        } else {
            // Update the existing comparison
            $perbandingan->update([
                'nilai' => $nilai,
                'checked' => $pilih,
            ]);
        }
    }

    private function inputDataPV($alternatifId, $kriteriaId, $pv)
    {
        $existingPV = PriorityVektorAlternatif::where('alternatif_id', $alternatifId)->where('kriteria_id',$kriteriaId)->first();

        if (!$existingPV) {
            // Insert new priority vector
            PriorityVektorAlternatif::create([
                'alternatif_id' => $alternatifId,
                'kriteria_id' => $kriteriaId,
                'nilai' => $pv,
            ]);
        } else {
            // Update existing priority vector
            $existingPV->update([
                'nilai' => $pv,
            ]);
        }
    }
}
