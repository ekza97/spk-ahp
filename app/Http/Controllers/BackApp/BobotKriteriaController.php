<?php

namespace App\Http\Controllers\BackApp;

use App\Helpers\Helper;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PerbandinganKriteria;
use App\Models\PriorityVektorKriteria;

class BobotKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backapp.kriteria.bobot');
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
        // jumlah kriteria
        $n = Kriteria::count();

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

                $this->inputDataPerbandingan($x, $y, $matrik[$x][$y], $_POST[$pilih]);
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
            $id_kriteria = Helper::getKriteriaID($x);
            $this->inputDataPV($id_kriteria,$pv[$x]);
        }

        // cek konsistensi
        $eigenvektor = Helper::getEigenVector($jmlmpb, $jmlmnk, $n);
        $consIndex   = Helper::getConsIndex($jmlmpb, $jmlmnk, $n);
        $consRatio   = Helper::getConsRatio($jmlmpb, $jmlmnk, $n);

        return view('backapp.kriteria.matriks',compact('n','jmlmpb','jmlmnk','matrik','matrikb','pv','eigenvektor','consIndex','consRatio'));
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

    private function inputDataPerbandingan($kriteria1, $kriteria2, $nilai, $pilih)
    {
        // Get kriteria IDs
        $id_kriteria1 = Helper::getKriteriaID($kriteria1); // Assuming Kriteria is your model
        $id_kriteria2 = Helper::getKriteriaID($kriteria2);

        // Check if the comparison already exists
        $perbandingan = PerbandinganKriteria::where('kriteria_one', $id_kriteria1)
            ->where('kriteria_two', $id_kriteria2)
            ->first();

        if (!$perbandingan) {
            // Create a new comparison
            PerbandinganKriteria::create([
                'kriteria_one' => $id_kriteria1,
                'kriteria_two' => $id_kriteria2,
                'nilai' => $nilai,
            ]);
        } else {
            // Update the existing comparison
            $perbandingan->update([
                'nilai' => $nilai,
            ]);
        }
    }

    private function inputDataPV($kriteriaId, $pv)
    {
        $existingPV = PriorityVektorKriteria::where('kriteria_id', $kriteriaId)->first();

        if (!$existingPV) {
            // Insert new priority vector
            PriorityVektorKriteria::create([
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