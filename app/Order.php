<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'no_meja', 'user_id', 'keterangan', 'status_order',
    ];

    public function detail_orders()
    {
        return $this->hasMany('App\detOrder');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Transaksi');
    }
}
