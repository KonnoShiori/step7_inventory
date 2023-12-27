@extends('layouts.app')

@section('title', '商品情報詳細')

@section('content')
    <div class="contents">
        <h2 class="contents__title">商品情報詳細</h2>

        <div>
            @if (session('edit_success'))
                <div class="alert-success">
                    {{ session('edit_success') }}
                </div>
            @endif
        </div>

        <table class="show-table">
            <tr>
                <th class="show-table__title--id">ID</th>
                <td class="show-table__contents--id">{{ $product->id }}</td>
            </tr>
            <tr>
                <th>商品画像</th>
                <td>
                    <img class="show-table__img" src="{{ asset('storage/product_images/' . $product->img_path) }}" alt="商品画像">
                </td>
            </tr>
            <tr>
                <th>商品名</th>
                <td>{{ $product->product_name }}</td>
            </tr>
            <tr>
                <th>メーカー名</th>
                <td>{{ $product->company->company_name }}</td>
            </tr>
            <tr>
                <th>価格</th>
                <td>&yen;{{ $product->price }}</td>
            </tr>
            <tr>
                <th>在庫数</th>
                <td>{{ $product->stock }}</td>
            </tr>
            <tr>
                <th>コメント</th>
                <td>{{ $product->comment }}</td>
            </tr>

        </table>
        <button class="default__btn show__back-btn" type="button" onclick="history.back()">戻る</button>

        <button class="default__btn edit__btn" type="button"onclick=location.href="{{ route('productEdit',$product->id) }}">編集</button>

    </div>
@endsection
