<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    </head>
    <body>
        <nav class="site-nav">
            <a class="brand" href="<?php echo e(route('home')); ?>"><?php echo e(config('app.name', 'Laravel')); ?></a>
            <div class="nav-links">
                <a href="<?php echo e(route('home')); ?>">Katalog</a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    <?php if(auth()->user()->hasRole('admin', 'editor')): ?>
                        <a href="<?php echo e(route('admin.products.index')); ?>">Kelola produk</a>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="link-button" type="submit">Keluar</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>">Masuk</a>
                    <a href="<?php echo e(route('register')); ?>">Daftar</a>
                <?php endif; ?>
            </div>
        </nav>
        <?php if(isset($header)): ?>
            <header class="page-header"><?php echo e($header); ?></header>
        <?php endif; ?>
        <main class="page-content"><?php echo e($slot); ?></main>
    </body>
</html>
<?php /**PATH C:\Users\LATITUDE\Downloads\TugasWeb-P11-EcommerAuth\resources\views/layouts/app.blade.php ENDPATH**/ ?>