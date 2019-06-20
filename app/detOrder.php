<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class detOrder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'detail_orders';

    protected $fillable = [
        'order_id', 'masakan_id', 'keterangan', 'status_detail_order', 'jumlah', 'keterangan'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function masakan()
    {
        return $this->belongsTo('App\Masakan');
    }
}
