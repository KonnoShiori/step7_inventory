<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;
    // テーブル名
    protected $table = 'sales';

    // 可変項目
    protected $fillable =
    [
        'product_id',
        'created_at',
        'updated_at'
    ];

    // リレーション
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 商品IDを登録する
    public function addSale($product_id)
    {
        return $this->create([
            'product_id' => $product_id,
        ]);
    }

    // 商品を削除する
    public function deleteSaleId($product_id)
    {
        $delete_sale = Sale::find('product_id', $product_id);
        $delete_sale->delete();
    }
}
