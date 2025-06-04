<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/show.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="titole-container">
    <h3 class="title-top">確認画面</h3>
</div>
<div class="breadcrumb">
<a href="<?php echo e(route('products.index')); ?>" class="shouhin">商品一覧</a>&gt;
    <span><?php echo e($product->name); ?></span>
</div>
<div class="product-edit-container">
    
    <div class="product-edit-left">
        <img id="preview" src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
        <div class="custom-file-wrapper">
            <label class="custom-file-label">ファイルを選択</label>
            <input type="file" disabled class="custom-file-input">
            <span id="file-name" class="file-name"><?php echo e($product->image); ?></span>
        </div>
    </div>

    
    <div class="product-edit-right">
        <div class="form-group">
            <label for="name">商品名</label>
            <input id="name" type="text" name="name" value="<?php echo e($product->name); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="price">値段</label>
            <input id="price" type="text" name="price" value="<?php echo e($product->price); ?>" readonly>
        </div>

        <div class="form-group">
            <label>季節</label>
            <div class="checkbox-group">
                <?php
                    $selectedSeasons = is_array($product->seasons) ? $product->seasons : [];
                ?>
                <?php $__currentLoopData = ['春', '夏', '秋', '冬']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="<?php echo e($season); ?>"
                            <?php echo e(in_array($season, $selectedSeasons) ? 'checked' : ''); ?> disabled>
                        <span class="checkmark"></span>
                        <?php echo e($season); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>


<div class="form-group-description">
    <label for="description" class="form-label">商品説明</label>
    <textarea id="description" name="description" class="textarea-field" rows="5" readonly><?php echo e($product->description); ?></textarea>
</div>


<div class="button-container">
    <div class="main-buttons">
       <?php if (isset($component)) { $__componentOriginal062de37a2190933ac56a13b0e2577641ad8a3d8f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\BackButton::class, ['href' => route('products.index')]); ?>
<?php $component->withName('back-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>戻る <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal062de37a2190933ac56a13b0e2577641ad8a3d8f)): ?>
<?php $component = $__componentOriginal062de37a2190933ac56a13b0e2577641ad8a3d8f; ?>
<?php unset($__componentOriginal062de37a2190933ac56a13b0e2577641ad8a3d8f); ?>
<?php endif; ?>
        <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn-save">編集する</a>
    </div>
</form>
    
    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display:inline;">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn-trash" title="削除">
            <img src="<?php echo e(asset('images/gomi.png')); ?>" alt="削除" class="trash-icon">
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/show.blade.php ENDPATH**/ ?>