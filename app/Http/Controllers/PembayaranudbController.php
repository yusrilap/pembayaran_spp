<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaranudb;
use App\User;
use App\Siswa;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranudbController extends Controller
{
    public function __construct()
   {
      $this->middleware([
         'auth',
         'privilege:admin&petugas'
      ]);
   }

   public function index()
   {
      $data = [
         'pembayaranudb' => Pembayaranudb::orderBy('id', 'DESC')->paginate(10),
         'user' => User::find(auth()->user()->id)
      ];

      return view('dashboard.entri-pembayaranudb.index', $data);
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
   public function store(Request $req)
   {

      $message = [
         'required' => ':attribute harus di isi',
         'numeric' => ':attribute harus berupa angka',
         'min' => ':attribute minimal harus :min angka',
         'max' => ':attribute maksimal harus :max angka',
      ];

      $req->validate([
         'nisn' => 'required',
         'udb_bulan' => 'required',
         'jumlah_bayar' => 'required|numeric'
      ], $message);

      if (Siswa::where('nisn', $req->nisn)->exists() == false) :
         Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
         return back();
         exit;
      endif;


      $siswa = Siswa::where('nisn', $req->nisn)->get();

      foreach ($siswa as $val) {
         $id_siswa = $val->id;
      }

      Pembayaranudb::create([
         'id_petugas' => auth()->user()->id,
         'id_siswa' => $id_siswa,
         'udb_bulan' => $req->udb_bulan,
         'jumlah_bayar' => $req->jumlah_bayar,
      ]);

      Alert::success('Berhasil!', 'Pembayaran Berhasil di Tambahkan!');

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
         'edit' => Pembayaranudb::find($id),
         'user' => User::find(auth()->user()->id)
      ];

      return view('dashboard.entri-pembayaranudb.edit', $data);
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
      $message = [
         'required' => ':attribute harus di isi',
         'numeric' => ':attribute harus berupa angka',
         'min' => ':attribute minimal harus :min angka',
         'max' => ':attribute maksimal harus :max angka',
      ];

      $req->validate([
         'nisn' => 'required',
         'udb_bulan' => 'required',
         'jumlah_bayar' => 'required|numeric'
      ], $message);

      $pembayaranudb = Pembayaranudb::find($id);

      $pembayaranudb->update([
         'udb_bulan' => $req->udb_bulan,
         'jumlah_bayar' => $req->jumlah_bayar
      ]);

      if (Siswa::where('nisn', $req->nisn)->exists() == false) :
         Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
         return back();
         exit;
      endif;

      if ($req->nisn != $pembayaranudb->siswa->nisn) :
         $siswa = Siswa::where('nisn', $req->nisn)->get();

         foreach ($siswa as $val) {
            $id_siswa = $val->id;
         }

         $pembayaranudb->update([
            'id_siswa' => $id_siswa,
         ]);
      endif;

      Alert::success('Berhasil!', 'Pembayaran berhasil di Edit');
      return back();
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      if (Pembayaranudb::find($id)->delete()) :
         Alert::success('Berhasil!', 'Pembayaran Berhasil di Hapus!');
      else :
         Alert::success('Terjadi Kesalahan!', 'Pembayaran Gagal di Tambahkan!');
      endif;

      return back();
   }
}