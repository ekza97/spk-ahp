<?php

namespace App\Http\Controllers\BackApp;

use App\Helpers\Helper;
use App\Models\Ranking;
use App\Models\Kriteria;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jmlKriteria = Kriteria::count();
        $jmlAlternatif = Alternatif::count();
        $nilai = [];

        // Calculate ranking
        for ($x = 0; $x < $jmlAlternatif; $x++) {
            $nilai[$x] = 0;

            for ($y = 0; $y < $jmlKriteria; $y++) {
                $id_alternatif = Helper::getAlternatifID($x);
                $id_kriteria = Helper::getKriteriaID($y);

                $pv_alternatif =Helper::getAlternatifPV($id_alternatif, $id_kriteria);
                $pv_kriteria =Helper::getKriteriaPV($id_kriteria);

                $nilai[$x] += ($pv_alternatif * $pv_kriteria);
            }

            // Update ranking
            Ranking::updateOrInsert(
                ['alternatif_id' => $id_alternatif],
                ['nilai' => $nilai[$x]]
            );
        }

        $alternatif = Alternatif::join('ranking', 'alternatif.id', '=', 'ranking.alternatif_id')
            ->select('alternatif.nama as nama', 'ranking.nilai as nilai')
            ->orderBy('ranking.nilai', 'desc')
            ->get();

        return view('backapp.ranking', compact('alternatif','jmlKriteria','jmlAlternatif','nilai'));
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
        //
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
}
