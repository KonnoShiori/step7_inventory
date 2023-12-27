<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => 'required | integer',
            'product_name' => 'required | max:50',
            'price' => 'required | integer',
            'stock' => 'required | integer',
            'comment' => 'max:200',
            'img_path' => 'file | image',
        ];
    }
    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'company_id' => 'メーカー名',
            'product_name' => '商品名',
            'price' => '価格',
            'stock' => '在庫数',
            'comment' => 'コメント',
            'img_path' => '商品画像',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'company_id.required' => ':attributeを選択してください',
            'company_id.integer' => ':attributeを選択してください',
            'product_name.required' => ':attributeを入力してください',
            'product_name.max' => ':attributeは:max字以内で入力してください',
            'price.required' => ':attributeを入力してください',
            'price.integer' => ':attributeは整数で入力してください',
            'stock.required' => ':attributeを入力してください',
            'stock.integer' => ':attributeは整数で入力してください',
            'comment.max' => ':attributeは:max字以内で入力してください',
            'img_path.image' => ':attributeは画像ファイルを選択してください',
        ];
    }
}
