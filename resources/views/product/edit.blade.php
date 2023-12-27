@extends('layouts.app')

@section('title', '商品情報編集')

@section('content')
    <div class="contents">
        <h2 class="contents__title">商品情報編集</h2>

        <form action="{{ route('productUpdate',$product->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <table class="edit-table">

                <div class="form-group">
                    <tr class="edit-table__title--id">
                        <th>ID</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>
                            <label for="lblProductName">商品名<span class="info--required">*</span></label>
                        </th>
                        <td>
                            <input type="text" id=lblProductName name="product_name"
                                placeholder="Product Name" value="{{ $product->product_name }}">
                            <div class="info--error">
                                @if ($errors->has('product_name'))
                                    <p>{{ $errors->first('product_name') }}</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                </div>

                <div class="form-group">
                    <tr>
                        <th>
                            <label for="lblCompanyId">メーカー名<span class="info--required">*</span></label>
                        </th>
                        <td>
                            <select class="default__drp" name="company_id" id="lblCompanyId">
                                <option value="">選択してください</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @selected($product->company_id == $company->id)>
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="info--error">
                                @if ($errors->has('company_id'))
                                    <p>{{ $errors->first('company_id') }}</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                </div>

                <div class="form-group">
                    <tr>
                        <th>
                            <label for="lblPrice">価格<span class="info--required">*</span></label>
                        </th>
                        <td>
                            <input type="text" id="lblPrice" name="price" placeholder="price"
                                value="{{ $product->price }}">
                            <div class="info--error">
                                @if ($errors->has('price'))
                                    <p>{{ $errors->first('price') }}</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                </div>

                <div class="form-group">
                    <tr>
                        <th>
                            <label for="lblStock">在庫数<span class="info--required">*</span></label>
                        </th>
                        <td>
                            <input type="text" id="lblStock" name="stock" placeholder="stock"
                                value="{{ $product->stock }}">
                            <div class="info--error">
                                @if ($errors->has('stock'))
                                    <p>{{ $errors->first('stock') }}</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                </div>

                <div class="form-group">
                    <tr>
                        <th>
                            <label for="lblComment">コメント</label>
                        </th>
                        <td>
                            <textarea id="lblComment" cols="30" rows="3"name=" comment" placeholder="comment">{{ $product->comment }}</textarea>
                            <div class="info--error">
                                @if ($errors->has('comment'))
                                    <p>{{ $errors->first('comment') }}</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                </div>

                <div class="form-group">
                    <tr>
                        <th class="edit-table__last-row">
                            <label for="lblImgPath">商品画像</label>
                        </th>
                        <td>
                            <input type="file" id="lblImgPath" name="img_path" accept=".jpg, .jpeg, .png">
                            <div class="info--error">
                                @if ($errors->has('img_path'))
                                    <p>{{ $errors->first('img_path') }}</p>
                                @endif
                            </div>
                            <div class="edit-table__index--now-img">
                                <p>現在の画像</p>
                                <img class="edit-table__img" src="{{ asset('storage/product_images/'.$product->img_path) }}" alt="">
                            </div>
                        </td>
                    </tr>
                </div>
            </table>

            <button class="default__btn show__back-btn" type="button" onclick="history.back()">戻る</button>

            <button class="default__btn edit__btn" type="submit" onclick='return confirm("更新しますか？");'>更新</button>

        </form>

    </div>

@endsection
