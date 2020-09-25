<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    public $primaryKey = 'id';

    public $timestamps = false;

    public function transaksi() {
        return $this->belongsToMany('App\Models\Transaksi', 'detail_transaksi', 'item_id', 'transaksi_id')
                    ->as('detail_transaksi')
                    ->withPivot('jumlah_item', 'total_harga')
                    ->withTimestamps();
    }
}
