<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Masakan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'nama_masakan', 'harga', 'image', 'status_masakan', 'kategori', 'deskripsi'
    ];

    public function detail_orders()
    {
        return $this->hasMany('App\detOrder');
    }
}
