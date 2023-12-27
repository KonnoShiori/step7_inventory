@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
    <div class="contents">
        <h2 class="contents__title">商品一覧</h2>

        <form class="search-form" action=" {{ route('productsIndex') }}">
            @csrf
            <input class="default__search" type="search" name="search" value="{{ request('search') }}" placeholder="検索キーワード">

            <select class="default__drp" name="company_filter" id="">
                <option value="">メーカー名</option>
                @foreach ($companies as $company )
                <option value="{{ $company->id }}" @if($company->id==$company_filter) selected @endif>{{ $company->company_name}}</option>
                @endforeach

            <input class="default__btn" type="submit" value="検索">
            <button class="default__btn" type="button" onclick=location.href="{{ route('productsIndex') }}">クリア</button>
        </form>

        <div>
            @if (session('delete_success'))
                <div class="alert-success">
                    {{ session('delete_success') }}
                </div>
            @endif
        </div>

        <table class="index-table">
            <thead class="index-table__litle">
                <tr>
                    <th class="index-table__title--id">ID</th>
                    <th class="index-table__title--img">商品画像</th>
                    <th class="index-table__title--product-name">商品名</th>
                    <th class="index-table__title--price">価格</th>
                    <th class="index-table__title--stock">在庫数</th>
                    <th class="index-table__title--company-name">メーカー名</th>
                    <th class="index-table__title--btn">
                        <button class="default__btn nav-create__btn" type="button"  onclick=location.href="{{ route('productCreate')}}">新規登録</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="index-table__contents--height">
                        <td class="index-table__contents--right">{{ $product->id }}</td>
                        <td class="index-table__contents--img">
                            <img class="index-table__img" src="{{ asset('storage/product_images/'.$product->img_path) }}" alt="商品画像"></td>
                        <td class="index-table__contents--left">{{ $product->product_name }}</td>
                        <td class="index-table__contents--right">&yen;{{ $product->price }}</td>
                        <td class="index-table__contents--right">{{ $product->stock }}</td>
                        <td class="index-table__contents--left">{{ $product->company->company_name }}</td>
                        <td class="index-table__contents--center index-table__contents--btn">
                            <button class="default__btn" type="button"
                            onclick=location.href="{{ route('productShow',$product->id) }}">詳細</button>

                            <form action="{{ route('productDelete', $product->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="default__btn index-table__delete-btn" type="submit" onclick='return confirm("削除しますか？");'>削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>

@endsection
