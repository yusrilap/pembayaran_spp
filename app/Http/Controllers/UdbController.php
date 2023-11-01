<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Udb;
use App\User;
use App\Kelas;
use RealRashid\SweetAlert\Facades\Alert;

class UdbController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth',
            'privilege:admin'
        ]);
    }

    public function index()
    {
        $data = [
            'udb' => Udb::orderBy('id', 'DESC')->paginate(20),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.data-udb.index', $data);
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute tidak boleh kosong!',
            'numeric' => ':attribute harus berupa angka!',
            'min' => ':attribute minimal harus :min angka!',
            'max' => ':attribute maksimal harus :max angka!',
            'integer' => ':attribute harus berupa nilai uang tanpa titik!'
        ];

        $validasi = $request->validate([
            'bulan' => 'required',
            'nominal' => 'required|integer',
        ], $messages);

        if ($validasi) :
            $store = Udb::create([
                'bulan' => $request->bulan,
                'nominal' => $request->nominal,
            ]);

            if ($store) :
                Alert::success('Berhasil!', 'Data Berhasil Ditambahkan');
            else :
                Alert::error('Gagal!', 'Data Gagal Ditambahkan');
            endif;
        endif;

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'edit' => Udb::find($id),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.data-udb.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if ($update = Udb::find($id)) :
            $stat = $update->update([
                'bulan' => $req->bulan,
                'nominal' => $req->nominal
            ]);
            if ($stat) :
                Alert::success('Berhasil!', 'Data Berhasil di Edit');
            else :
                Alert::error('Terjadi Kesalahan!', 'Data Gagal di Edit');
                return back();
            endif;
        endif;

        return redirect('dashboard/data-udb');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Udb::find($id)->delete()) :
            Alert::success('Berhasil!', 'Data Berhasil Dihapus');
        else :
            Alert::error('Berhasil!', 'Data Gagal Dihapus');
        endif;

        return back();
    }
}