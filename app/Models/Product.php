<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'products';

    // 可変項目
    protected $fillable =
    [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
        'created_at',
        'updated_at'

    ];

    // リレーション
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // リレーション
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // 商品一覧画面を表示する
    public function filterIndex($data)
    {
        $search = $data->search;
        $company_filter = $data->company_filter;

        $products = Product::with('company')
            ->where(function ($query) use ($search, $company_filter) {
                // 検索条件
                if (is_null($search) && !is_null($company_filter)) {
                    $query->where('company_id', 'like', "%$company_filter%");
                } elseif (!is_null($search) && is_null($company_filter)) {
                    $query->Where('id', '=', "$search")
                        ->orWhere('product_name', 'like', "%$search%")
                        ->orWhere('price', '=', "%$search%")
                        ->orWhere('stock', '=', "%$search%");
                } elseif (!is_null($search) && !is_null($company_filter)) {
                    $query->where('company_id', 'like', "%$company_filter%")
                        ->where(function ($query) use ($search) {
                            $query->Where('id', 'like', "%$search%")
                                ->orWhere('product_name', 'like', "%$search%")
                                ->orWhere('price', '=', "%$search%")
                                ->orWhere('stock', '=', "%$search%");
                        });
                } else {
                    $query->get();
                }
            })->paginate(5);

        return $products;
    }

    // 商品を新規登録する
    public function addProduct($data)
    {

        if (request('img_path')) {
            $img_name = $data->file('img_path')->hashName();
            $img_save_name = date('Ymd_His') . "_" . $img_name;
            $data->file('img_path')->storeAs('public/product_images', $img_save_name);
        } else {
            $img_save_name = "";
        }

        return $this->create([
            'company_id' => $data->company_id,
            'product_name' => $data->product_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => $img_save_name,
        ]);
    }

    // 商品情報を更新する
    public function updateProductId($data, $id)
    {

        $inputs = $data->all();
        $update = Product::find($id);

        $img_save_name = $update->img_path;
        if (request('img_path')) {
            $img_name = $data->file('img_path')->hashName();
            $img_save_name = date('Ymd_His') . "_" . $img_name;
            $data->file('img_path')->storeAs('public/product_images', $img_save_name);
        }

        return $update->fill([
            'company_id' => $inputs['company_id'],
            'product_name' => $inputs['product_name'],
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'comment' => $inputs['comment'],
            'img_path' => $img_save_name
        ])->save();
    }


    // 商品を削除する
    public function deleteProductId($id)
    {
        $delete_product = Product::find($id);
        $delete_product->delete();
    }
}
