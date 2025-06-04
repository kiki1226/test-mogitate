<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/edit.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul class="m-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" action="<?php echo e(route('products.update', ['productId' => $product->id])); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="breadcrumb">
    <a href="<?php echo e(route('products.index')); ?>" class="shouhin">商品一覧</a> &gt;
        <span><?php echo e($product->name); ?></span>
    </div>
    <div class="product-edit-container">
        
        <div class="product-edit-left">
            <img id="preview" src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
            <div class="custom-file-wrapper">
                <label for="image" class="custom-file-label">ファイルを選択</label>
                <input type="file" id="image" name="image" class="custom-file-input" onchange="updateFileName(this)">
                <span id="file-name" class="file-name"><?php echo e($product->image); ?></span>
            </div>
            <?php if($errors->has('image')): ?>
                <span class="error-message"><?php echo e($errors->first('image')); ?></span>
            <?php endif; ?>
        </div>

        
        <div class="product-edit-right">
            <div class="form-group">
                <label for="name">商品名</label>
                <input id="name" type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" class="<?php echo e($errors->has('name') ? 'error-border' : ''); ?>">
                <?php if($errors->has('name')): ?>
                    <span class="error-message"><?php echo e($errors->first('name')); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="price">値段</label>
                <input id="price" type="text" name="price" value="<?php echo e(old('price', $product->price)); ?>" class="<?php echo e($errors->has('price') ? 'error-border' : ''); ?>">
                <?php if($errors->has('price')): ?>
                    <span class="error-message"><?php echo e($errors->first('price')); ?></span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>季節</label>
                <div class="checkbox-group">
                    <?php
                        $selectedSeasons = old('season', $product->seasons->pluck('id')->toArray());
                    ?>
                    <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="custom-checkbox">
                            <input type="checkbox" name="season[]" value="<?php echo e($season->id); ?>" <?php echo e(in_array($season->id, $selectedSeasons) ? 'checked' : ''); ?>>
                            <span class="checkmark"></span>
                            <?php echo e($season->name); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php if($errors->has('season')): ?>
                    <span class="error-message"><?php echo e($errors->first('season')); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="form-group-description">
        <label for="description" class="form-label">商品説明</label>
        <textarea id="description" name="description" class="textarea-field" rows="5"><?php echo e(old('description', $product->description)); ?></textarea>
        <?php if($errors->has('description')): ?>
            <span class="error-message"><?php echo e($errors->first('description')); ?></span>
        <?php endif; ?>
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
            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Button::class, []); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['type' => 'save','class' => 'btn-save']); ?>変更を保存 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/edit.blade.php ENDPATH**/ ?>