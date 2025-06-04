<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/products.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
<div class="page-nav">
    <a href="<?php echo e(route('products.index')); ?>" class="nav-button-itiran">
        
        <?php if(request('keyword')): ?>
            “<?php echo e(request('keyword')); ?>”の商品一覧
        <?php else: ?>
            商品一覧
        <?php endif; ?>
    </a>
    <a href="<?php echo e(route('products.register')); ?>" class="nav-button-touroku">＋商品を追加</a>
</div>



<div class="product-page__form">
    
    <form method="GET" action="<?php echo e(route('products.index')); ?>" class="search-sort-form">
        
        <?php echo csrf_field(); ?>
        <div class="search-sort-container">
            <div class="search-label">
                <div class="search-input-box">
                    <input type="text" name="keyword" class="search-input" placeholder="商品名で検索" value="<?php echo e(request('keyword')); ?>">
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
                        <option value="asc" <?php echo e(request('sort') == 'asc' ? 'selected' : ''); ?>>価格が安い順</option>
                        <option value="desc" <?php echo e(request('sort') == 'desc' ? 'selected' : ''); ?>>価格が高い順</option>
                    </select>
                </div>
                <?php if(request()->has('sort')): ?>
                    <div class="sort-badge">
                        <?php echo e(request('sort') === 'asc' ? '安い順に表示' : '高い順に表示'); ?>

                        
                        
                        <button
                            type="button"
                            onclick="window.location.href='<?php echo e(route('products.index', request()->only('keyword'))); ?>'"
                            class="sort-reset-button">
                            ✖︎
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </form>

    
    <div>
        <div class="product-list">
        
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            
                <div class="product-card">
                <a href="<?php echo e(route('products.show', ['productId' => $product->id])); ?>">
                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
                </a>
                    <div class="product-card__info">
                        <h3><?php echo e($product->name); ?></h3>
                        <p>¥<?php echo e(number_format($product->price)); ?></p>
                    </div>
                </div>
               
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        


        
        <div class="pagination">
            <?php echo e($products->onEachSide(1)->links('vendor.pagination.custom')); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/index.blade.php ENDPATH**/ ?>