<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    </head>
    <body class="guest-page">
        <div class="guest-card">
            <a class="brand guest-brand" href="/"><?php echo e(config('app.name', 'Laravel')); ?></a>
            <div>
                <?php echo e($slot); ?>

            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\LATITUDE\Downloads\TugasWeb-P11-EcommerAuth\resources\views/layouts/guest.blade.php ENDPATH**/ ?>