@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<script>
function updateFileName(input) {
    const file = input.files[0];
    const fileName = file?.name || '選択されていません';
    document.getElementById('file-name').textContent = fileName;

    // プレビュー表示
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" enctype="multipart/form-data" action="{{ route('products.update', ['productId' => $product->id]) }}">
    @csrf
    @method('PUT')
    <div class="breadcrumb">
    <a href="{{ route('products.index') }}" class="shouhin">商品一覧</a> &gt;
        <span>{{ $product->name }}</span>
    </div>
    <div class="product-edit-container">
        {{-- 左エリア：画像・ファイル --}}
        <div class="product-edit-left">
            <img id="preview" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <div class="custom-file-wrapper">
                <label for="image" class="custom-file-label">ファイルを選択</label>
                <input type="file" id="image" name="image" class="custom-file-input" onchange="updateFileName(this)">
                <span id="file-name" class="file-name">{{ $product->image }}</span>
            </div>
            @if ($errors->has('image'))
                <span class="error-message">{{ $errors->first('image') }}</span>
            @endif
        </div>

        {{-- 右エリア：入力フォーム --}}
        <div class="product-edit-right">
            <div class="form-group">
                <label for="name">商品名</label>
                <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}" class="{{ $errors->has('name') ? 'error-border' : '' }}">
                @if ($errors->has('name'))
                    <span class="error-message">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="price">値段</label>
                <input id="price" type="text" name="price" value="{{ old('price', $product->price) }}" class="{{ $errors->has('price') ? 'error-border' : '' }}">
                @if ($errors->has('price'))
                    <span class="error-message">{{ $errors->first('price') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>季節</label>
                <div class="checkbox-group">
                    @php
                        $selectedSeasons = old('season', $product->seasons->pluck('id')->toArray());
                    @endphp
                    @foreach($seasons as $season)
                        <label class="custom-checkbox">
                            <input type="checkbox" name="season[]" value="{{ $season->id }}" {{ in_array($season->id, $selectedSeasons) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>
                @if ($errors->has('season'))
                    <span class="error-message">{{ $errors->first('season') }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- 商品説明 --}}
    <div class="form-group-description">
        <label for="description" class="form-label">商品説明</label>
        <textarea id="description" name="description" class="textarea-field" rows="5">{{ old('description', $product->description) }}</textarea>
        @if ($errors->has('description'))
            <span class="error-message">{{ $errors->first('description') }}</span>
        @endif
    </div>

    {{-- ボタン --}}
    <div class="button-container">
        <div class="main-buttons">
            <x-back-button :href="route('products.index')">戻る</x-back-button>
            <x-button type="save" class="btn-save">変更を保存</x-button>
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