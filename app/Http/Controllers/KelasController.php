<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{

   public function __construct()
   {
      $this->middleware([
         'auth',
         'privilege:admin'
      ]);
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $data = [
         'kelas' => Kelas::orderBy('id', 'DESC')->paginate(20),
         'user' => User::find(auth()->user()->id),
      ];

      return view('dashboard.data-kelas.index', $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
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
      ];

      $validasi = $request->validate([
         'kelas' => 'Required',
         'keahlian' => 'Required',
         'walikelas' => 'Required',
      ], $messages);

      if ($validasi) :
         $create = Kelas::create([
            'nama_kelas' => $request->kelas,
            'kompetensi_keahlian' => $request->keahlian,
            'walikelas' => $request->walikelas
         ]);

         if ($create) :
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
         'edit' =>  Kelas::find($id),
         'user' => User::find(auth()->user()->id),
      ];

      return view('dashboard.data-kelas.edit', $data);
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

      $messages = [
         'required' => ':attribute tidak boleh kosong!',
      ];

      $validasi = $req->validate([
         'kelas' => 'Required',
         'keahlian' => 'Required',
         'walikelas' => 'Required',
      ], $messages);

      if ($update = Kelas::find($id)) :
         $stat = $update->update([
            'nama_kelas' => $req->kelas,
            'kompetensi_keahlian' => $req->keahlian,
            'walikelas' => $req->walikelas
         ]);
         if ($stat) :
            Alert::success('Berhasil!', 'Data Berhasil di Edit!');
         else :
            Alert::success('Terjadi Kesalahan!', 'Data Gagal di Edit!');
            return back();
         endif;
      endif;

      return redirect('dashboard/data-kelas');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      if (Kelas::find($id)->delete()) :
         Alert::success('Berhasil!', 'Data Berhasil Dihapus');
      else :
         Alert::error('Terjadi Kesalahan!', 'Data Gagal Dihapus');
      endif;

      return back();
   }

   public function cari(Request $req)
   {
      $cari = $req->cari;

      $kelas = DB::table('kelas')->where('nama_kelas','like', "%".$cari."%")->paginate();
      
     return redirect('dashboard/data-kelas');
   }
}