<?php

namespace App\Http\Controllers\BackApp;

use Exception;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\KriteriaDataTable;
use Illuminate\Support\Facades\Crypt;

class KriteriaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(KriteriaDataTable $dataTable)
    {
        return $dataTable->render('backapp.kriteria.index');
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
        try {
            $request->validate([
                'kode' => 'required|string|max:191|unique:kriteria,kode',
                'nama' => 'required|string|max:191'
            ]);

            Kriteria::create([
                'kode' => strtoupper($request->kode),
                'nama' => ucwords($request->nama),
                'created_by' => Auth::id()
            ]);

            return response()->json([
                'status' => true, 'message' => 'Berhasil tersimpan'
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
        $data = Kriteria::find($id);
        $linkUpdate = route("kriteria.update", Crypt::encrypt($data->id));
        return response()->json(['kode' => $data->kode, 'nama'=>$data->nama, 'link' => $linkUpdate]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $request->validate([
                'kode' => 'required|string|max:191|unique:kriteria,kode,'.$id,
                'nama' => 'required|string|max:191'
            ]);

            $db = Kriteria::find($id);

            $db->kode = strtoupper($request->kode);
            $db->nama = ucwords($request->nama);

            $db->update();

            return response()->json([
                'status' => true, 'message' => 'Berhasil update'
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Crypt::decrypt($id);
        $data = Kriteria::where('id', $id);
        $data->delete();
        return true;
    }
}