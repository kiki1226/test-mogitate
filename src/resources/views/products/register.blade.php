@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
@section('js')
<script>
    document.getElementById('imageInput').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file && file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

<div class="register-container">
    <h2 class="page-title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

                <div class="form-group">
            <label for="name">商品名 <span class="required">必須</span></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
            @if ($errors->get('name'))
                @foreach ($errors->get('name') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <label for="price">値段 <span class="required">必須</span></label>
            <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
            @if ($errors->get('price'))
                @foreach ($errors->get('price') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <img id="preview" src="#" alt="プレビュー画像" style="display:none; max-height: 200px; margin-top: 10px;">
            <label for="image">商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" id="imageInput">
            @if ($errors->get('image'))
                @foreach ($errors->get('image') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
            @endif
        </div>
        <div class="form-group">
            <label>季節 <span class="required">必須</span>          
            <span class="note"> 複数選択可</span></label>

            <div class="checkbox-group">
                @foreach($seasons as $season)
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="{{ $season->id }}"
                            {{ is_array(old('season')) && in_array($season->id, old('season')) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        {{ $season->name }}
                    </label>
                @endforeach
            </div>

            @if ($errors->get('season'))
                @foreach ($errors->get('season') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <label for="description">商品説明 <span class="required">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @if ($errors->get('description'))
                @foreach ($errors->get('description') as $error)
                    <span class="error">{{ $error }}</span>
                @endforeach
            @endif
        </div>

        <div class="button-container">
            <x-back-button :href="route('products.index')">戻る</x-back-button>
            <x-button type="submit" class="btn-submit">登録</x-button>
        </div>
    </form>
</div>
@endsection