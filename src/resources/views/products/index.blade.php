@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="page-nav">
    <a href="{{ route('products.index') }}" class="nav-button-itiran">
        
        @if(request('keyword'))
            “{{ request('keyword') }}”の商品一覧
        @else
            商品一覧
        @endif
    </a>
    <a href="{{ route('products.register') }}" class="nav-button-touroku">＋商品を追加</a>
</div>



<div class="product-page__form">
    {{-- フォームだけ --}}
    <form method="GET" action="{{ route('products.index') }}" class="search-sort-form">
        {{-- CSRFトークン --}}
        @csrf
        <div class="search-sort-container">
            <div class="search-label">
                <div class="search-input-box">
                    <input type="text" name="keyword" class="search-input" placeholder="商品名で検索" value="{{ request('keyword') }}">
                </div>
                <div class="search-button-box">
                    <button type="submit" class="search-button">
                        <div class="search-button__label">検索</div>
                    </button>
                </div>
            </div>
            <div class="sort-label">
                <div class="sort-label-box">
                    <h3 class="sort-label__title">価格順で表示</h3>
                </div>
                <div class="sort-select-box">
                    <select name="sort" onchange="this.form.submit()" class="sort-select">
                        <option value="">価格で並べ替え</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>価格が安い順</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>価格が高い順</option>
                    </select>
                </div>
                @if(request()->has('sort'))
                    <div class="sort-badge">
                        {{ request('sort') === 'asc' ? '安い順に表示' : '高い順に表示' }}
                        
                        {{-- 「×」ボタンでリセット（パラメータ無しに遷移） --}}
                        <button
                            type="button"
                            onclick="window.location.href='{{ route('products.index', request()->only('keyword')) }}'"
                            class="sort-reset-button">
                            ✖︎
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </form>

    {{-- 商品一覧 --}}
    <div>
        <div class="product-list">
        
            @foreach($products as $product)
            
            
                <div class="product-card">
                <a href="{{ route('products.show', ['productId' => $product->id]) }}">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </a>
                    <div class="product-card__info">
                        <h3>{{ $product->name }}</h3>
                        <p>¥{{ number_format($product->price) }}</p>
                    </div>
                </div>
               
            @endforeach
        </div>
        


        {{-- ページネーション --}}
        <div class="pagination">
            {{ $products->appends(request()->query())->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>

@endsection
