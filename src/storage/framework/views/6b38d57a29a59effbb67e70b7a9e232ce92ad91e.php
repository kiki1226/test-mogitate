<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/register.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?>

<div class="register-container">
    <h2 class="page-title">商品登録</h2>

    <form action="<?php echo e(route('products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

                <div class="form-group">
            <label for="name">商品名 <span class="required">必須</span></label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="商品名を入力">
            <?php if($errors->get('name')): ?>
                <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="error"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="price">値段 <span class="required">必須</span></label>
            <input type="text" name="price" value="<?php echo e(old('price')); ?>" placeholder="値段を入力">
            <?php if($errors->get('price')): ?>
                <?php $__currentLoopData = $errors->get('price'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="error"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <img id="preview" src="#" alt="プレビュー画像" style="display:none; max-height: 200px; margin-top: 10px;">
            <label for="image">商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" id="imageInput">
            <?php if($errors->get('image')): ?>
                <?php $__currentLoopData = $errors->get('image'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="error"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label>季節 <span class="required">必須</span>          
            <span class="note"> 複数選択可</span></label>

            <div class="checkbox-group">
                <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="custom-checkbox">
                        <input type="checkbox" name="season[]" value="<?php echo e($season->id); ?>"
                            <?php echo e(is_array(old('season')) && in_array($season->id, old('season')) ? 'checked' : ''); ?>>
                        <span class="checkmark"></span>
                        <?php echo e($season->name); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($errors->get('season')): ?>
                <?php $__currentLoopData = $errors->get('season'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="error"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">商品説明 <span class="required">必須</span></label>
            <textarea name="description" placeholder="商品の説明を入力"><?php echo e(old('description')); ?></textarea>
            <?php if($errors->get('description')): ?>
                <?php $__currentLoopData = $errors->get('description'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="error"><?php echo e($error); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="button-container">
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
<?php $component->withAttributes(['type' => 'submit','class' => 'btn-submit']); ?>登録 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/products/register.blade.php ENDPATH**/ ?>