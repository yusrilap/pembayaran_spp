<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Udb extends Model
{
    protected $table = 'udb';
   
    protected $fillable = [
         'bulan', 'nominal'
    ];
   
    /**
   * Belongs To Spp -> User
   *
   * @return void
   */
   public function user()
   {
         return $this->belongsTo(User::class);
   }
}