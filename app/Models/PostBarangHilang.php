<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostBarangHilang extends Model
{
protected $table = 'post_barang_hilang';
protected $fillable = ['user_id', 'item_name', 'description', 'location', 'lost_date', 'image'];
}
