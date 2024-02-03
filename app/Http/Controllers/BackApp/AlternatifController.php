<?php

namespace App\Http\Controllers\BackApp;

use Exception;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\AlternatifDataTable;

class AlternatifController extends Controller
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
    public function index(AlternatifDataTable $dataTable)
    {
        return $dataTable->render('backapp.alternatif.index');
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
                'kode' => 'required|string|max:191',
                'nama' => 'required|string|max:191'
            ]);

            Alternatif::create([
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
        $data = Alternatif::find($id);
        $linkUpdate = route("alternatif.update", Crypt::encrypt($data->id));
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
                'kode' => 'required|string|max:191',
                'nama' => 'required|string|max:191'
            ]);

            $db = Alternatif::find($id);

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
        $data = Alternatif::where('id', $id);
        $data->delete();
        return true;
    }
}
