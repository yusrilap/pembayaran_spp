<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaranudb extends Model
{
    protected $table = 'pembayaranudb';
   
    protected $fillable = [
         'id_petugas','id_siswa', 'udb_bulan', 'jumlah_bayar'
    ];
   
 /**
   * Belongs To Pembayaran -> User (petugas)
   *
   * @return void
   */
    public function users()
    {
         return $this->belongsTo(User::class,'id_petugas', 'id');
    }
   
 /**
   * Has Many Pembayaran -> Siswa
   *
   * @return void
   */
    public function siswa()
    {
         return $this->belongsTo(Siswa::class,'id_siswa','id','nisn');
    }
}