<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Validator;
use DataTables;
use DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.index');
    }

    public function getpegawai(Request $request){
        if ($request->ajax()) {
            $data = DB::table('pegawai')->orderBy('created_at','DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)"  data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
        $validation = Validator::make($request->all(),[
            'nama' => 'required|max:255|unique:pegawai',
            'umur' => 'required|numeric',
            'jabatan' => 'required|max:255'
        ]);

        if($validation->fails()){
            return response()->json(['error' => $validation->errors()]);
        }else{
            $data = [
                'nama' => $request->nama,
                'umur' => $request->umur,
                'jabatan' => $request->jabatan
            ];
            Pegawai::create($data);
            return response()->json(['success' => "Data Berhasil Disimpan"]);
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
        $pegawai = Pegawai::where('id',$id)->first();
        return response()->json(['result' => $pegawai ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = Validator::make($request->all(),[
            'nama' => 'required|max:255',
            'umur' => 'required|numeric',
            'jabatan' => 'required|max:255'
        ]);

        if($validation->fails()){
            return response()->json(['error' => $validation->errors()]);
        }else{
            $data = [
                'nama' => $request->nama,
                'umur' => $request->umur,
                'jabatan' => $request->jabatan
            ];
            Pegawai::where('id',$id)->update($data);
            return response()->json(['success' => "Data Berhasil Disimpan"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return response()->json(['success' => "Data Berhasil Dihapus"]);
    }
}
