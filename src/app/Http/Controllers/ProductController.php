<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * 商品一覧（検索・並び替え含む）
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // 並び替え
        if ($request->has('sort')) {
            $query->orderBy('price', $request->sort === 'desc' ? 'desc' : 'asc');
        }

        // キーワード検索（同義語対応）
        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $synonymMap = [
                'いちご' => ['ストロベリー'],
                'みかん' => ['オレンジ'],
                'ぶどう' => ['ブドウ', 'シャインマスカット'],
                'グレープ' => ['ブドウ', 'シャインマスカット'],
                'もも' => ['ピーチ'],
                'apple' => ['リンゴ'],
                'pineapple' => ['パイナップル'],
                'banana' => ['バナナ'],
                'orange' => ['オレンジ'],
                'grape' => ['ブドウ', 'シャインマスカット'],
                'peach' => ['ピーチ'],
                'strawberry' => ['ストロベリー'],
                'kiwi' => ['キウイ'],
                'melon' => ['メロン'],
                'watermelon' => ['スイカ'],
            ];

            $keywords = [$keyword];
            if (array_key_exists($keyword, $synonymMap)) {
                $keywords = array_merge($keywords, $synonymMap[$keyword]);
            }

            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('name', 'like', "%{$word}%");
                }
            });
        }

        $products = $query->paginate(6);
        return view('products.index', compact('products'));
    }

    /**
     * 登録フォーム表示
     */
    public function showRegisterForm()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    /**
     * 登録処理
     */
    public function register(StoreProductRequest $request)
        {
            // ① アップロードされたファイルのオリジナル名を取得
            $originalName = $request->file('image')->getClientOriginalName();

            // ② ファイル名を時間ベースでユニークにし、スペースをハイフンに変換
            $filename = time() . '_' . str_replace(' ', '-', $originalName);

            // ③ storage/app/public/products/ にファイルを保存
            $request->file('image')->storeAs('products', $filename, 'public');

            // ④ DBに保存する画像パスを明確に設定
            $imagePath = 'products/' . $filename;

            // ⑤ 商品情報を保存（画像パスは $imagePath）
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imagePath,
                'description' => $request->description,
            ]);

            // ⑥ 季節のリレーションも保存
            $product->seasons()->attach($request->season);

            return redirect()->route('products.index')->with('success', '商品を登録しました');
        }

    /**
     * 商品詳細 or 編集画面
     */
    public function show($productId)
        {
            $product = Product::with('seasons')->findOrFail($productId);
            return view('products.show', compact('product'));
        }
    public function edit($productId)
        {
            $product = Product::findOrFail($productId);
            $seasons = Season::all();
            return view('products.edit', compact('product', 'seasons'));
        }

    /**
     * 更新処理
     */
    public function update(StoreProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $validated = $request->validated();
    
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
    
        $seasonIds = $request->input('season', []);
        $product->seasons()->sync($seasonIds);
    
        if ($request->file('image')) {
            // 旧画像削除
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
    
            // 新画像保存
            $originalName = $request->file('image')->getClientOriginalName();
            $filename = time() . '_' . str_replace(' ', '-', $originalName);
            $path = $request->file('image')->storeAs('products', $filename, 'public');
            $product->image = 'products/' . $filename;
        }
    
        $product->save(); // ← これでDBに更新される
    
        return redirect()->route('products.index')->with('success', '商品を更新しました');
    
    }
    


    /**
     * 削除処理
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        // 画像削除
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // リレーション削除 → 本体削除
        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}
