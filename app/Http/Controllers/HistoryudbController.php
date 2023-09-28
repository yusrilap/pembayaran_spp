<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Pembayaranudb;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;

class HistoryudbController extends Controller
{
    public function index()
    {
        $data = [
            'pembayaranudb' => Pembayaranudb::orderBy('id', 'DESC')->paginate(15),
            'user' => User::find(auth()->user()->id)
        ];

        return view('dashboard.historyudb-pembayaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        $data = [
        'pembayaranudb' => Pembayaranudb::orderBy('created_at', 'DESC')->get()
        ];

        $pdf = PDF::loadView('pdf.laporan', $data);
        return $pdf->download('Laporan-Pembayaran-UDB-UDT.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}