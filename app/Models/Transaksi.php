<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    public $primaryKey = 'id';

    public $timestamps = true;

    public function item() {
        return $this->belongsToMany('App\Models\Item', 'detail_transaksi', 'transaksi_id', 'item_id')
                    ->as('detail_transaksi')
                    ->withPivot('jumlah_item', 'total_harga')
                    ->withTimestamps();
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'transaksi_id', 'id');
    }
}
