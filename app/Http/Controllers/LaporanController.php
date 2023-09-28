<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pembayaranudb;
use App\Pembayaran;
use App\User;
use App\Siswa;
use App\Kelas;
use App;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{

  public function __construct()
  {
    // $this->middleware([
    //   'auth',
    //   'privilege:admin',
    //   'privilege:petugas'
    // ]);
  }

  public function index()
  {

    $data = [
      'user' => User::find(auth()->user()->id),
      'kelas' => Kelas::orderBy('nama_kelas', 'ASC')->get(),
    ];

    return view('dashboard.generate-laporan.index', $data);
  }

  public function create()
  {
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

    $data = [
      'pembayaran' => Pembayaran::orderBy('created_at', 'DESC')->get(),
      'pembayaranudb' => Pembayaranudb::orderBy('created_at', 'DESC')->get()
    ];

    $pdf = PDF::loadView('pdf.laporan', $data);
    return $pdf->download('Laporan-Pembayaran-UDB-UDT.pdf');
  }
}