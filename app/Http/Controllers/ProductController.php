<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * 商品一覧画面を表示する
     * @param $request
     * @return view
     */
    public function productsIndex(Request $request)
    {
        $model = new Product();
        $products = $model->filterIndex($request);

        $company_filter = $request->company_filter;

        $companies = Company::all();

        return view('product.index',compact('products','companies','company_filter'));

    }

    /**
     * 商品新規登録画面を表示する
     *
     * @return view
     */
    public function productCreate()
    {
        $companies = Company::all();

        return view('product.create',compact('companies'));
    }

    /**
     * 商品を新規登録する
     * @param $request
     * @return view
     */
    public function productStore(ProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $model = new Product();
            $add_product = $model->addProduct($request);

            $product_id = $add_product ->id;
            $model = new Sale();
            $add_sale = $model->addSale($product_id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }

        return redirect(route('productCreate'))
            ->with('create_success', '新規登録しました');

    }

    /**
     * 商品情報詳細画面を表示する
     * @param int $id
     * @return view
     */
    public function productShow($id)
    {
        $product = Product::with('company')->find($id);

        if (is_null($product)) {
            return redirect(route('productsIndex'));
        }

        return view('product.show',compact('product'));

    }

    /**
     * 商品情報編集画面を表示する
     * @param int $id
     * @return view
     */
    public function productEdit($id)
    {
        $product = Product::with('company')->find($id);

        if (is_null($product)) {
            return redirect(route('productEdit'));
        }

        $companies = Company::all();

        return view('product.edit',compact('product','companies'));

    }

    /**
     * 商品情報を更新する
     * @param $request $id
     * @return view
     */
    public function productUpdate(ProductRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $model = new Product();
            $update_product = $model->updateProductId($request, $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }

        return redirect(route('productShow',$id))
            ->with('edit_success', '更新しました');

    }

    /**
     * 商品を削除する
      * @param int $id
     * @return view
     */
    public function productDelete($id)
    {
        try {
            $model = new Product();
            $model->deleteProductId($id);
        } catch (\Exception $e) {
            report($e);
        }
        return back()->with('delete_success', '削除しました');

    }
}
