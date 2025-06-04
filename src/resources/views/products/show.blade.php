@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="titole-container">
    <h3 class="title-top">確認画面</h3>
</div>
<div class="breadcrumb">
<a href="{{ route('products.index') }}" class="shouhin">商品一覧</a>&gt;
    <span>{{ $product->name }}</span>
</div>
<div class="product-edit-container">
    {{-- 左エリア：画像・ファイル --}}
    <div class="product-edit-left">
        <img id="preview" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        <div class="custom-file-wrapper">
            <label class="custom-file-label">ファイルを選択</label>
            <input type="file" disabled class="custom-file-input">
            <span id="file-name" class="file-name">{{ $product->image }}</span>
        </div>
    </div>

    {{-- 右エリア：入力フォーム --}}
    <div class="product-edit-right">
        <div class="form-group">
            <label for="name">商品名</label>
            <input id="name" type="text" name="name" value="{{ $product->name }}" readonly>
        </div>

        <div class="form-group">
            <label for="price">値段</label>
            <input id="price" type="text" name="price" value="{{ $product->price }}" readonly>
        </div>

        <div class="form-group">
            <label>季節</label>
            <div class="checkbox-group">
                @php
                    $selectedSeasons = is_array($product->seasons) ? $product->seasons : [];
                @endphp
                @foreach(['春', '夏', '秋', '冬'] as $season)
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="{{ $season }}"
                            {{ in_array($season, $selectedSeasons) ? 'checked' : '' }} disabled>
                        <span class="checkmark"></span>
                        {{ $season }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- 商品説明 --}}
<div class="form-group-description">
    <label for="description" class="form-label">商品説明</label>
    <textarea id="description" name="description" class="textarea-field" rows="5" readonly>{{ $product->description }}</textarea>
</div>

{{-- ボタン --}}
<div class="button-container">
    <div class="main-buttons">
       <x-back-button :href="route('products.index')">戻る</x-back-button>
        <a href="{{ route('products.edit', $product->id) }}" class="btn-save">編集する</a>
    </div>
</form>
    {{-- 削除ボタン --}}
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display:inline;">
        @csrf
        <button type="submit" class="btn-trash" title="削除">
            <img src="{{ asset('images/gomi.png') }}" alt="削除" class="trash-icon">
        </button>
    </form>
</div>
@endsection
