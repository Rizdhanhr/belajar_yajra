<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use DataTables;
use DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = Karyawan::with('jeniskelamin')->get();
        // DD($data);
        return view('karyawan.index');
    }

    public function getkaryawan(Request $request){
        if ($request->ajax()) {
            $data = Karyawan::with('jeniskelamin')->orderBy('nama','ASC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('jk', function($data) {
                    return $data->jeniskelamin->nama;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . route('karyawan.create') . '"  data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)"  data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
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
        return view('karyawan.create');
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
