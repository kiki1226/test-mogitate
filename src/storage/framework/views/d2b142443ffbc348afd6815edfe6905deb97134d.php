<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>

</head>
<body>
    <header class="header">
        <h1 class="header-title">mogitate</h1>
    </header>
    <main class="main-content">
    
     <?php echo $__env->yieldContent('content'); ?>
     <?php echo $__env->yieldContent('js'); ?>
     
    </main>
</body>
</html>
<?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>