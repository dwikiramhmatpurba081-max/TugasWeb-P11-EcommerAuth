<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="hero">
        <p class="eyebrow">TOKO KITA</p>
        <h1>Belanja mudah, pilihan lengkap.</h1>
        <p>Temukan produk pilihan dari berbagai kategori.</p>
    </section>

    <section class="panel">
        <form class="filters" method="GET" action="<?php echo e(route('home')); ?>">
            <label>
                Cari produk
                <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Nama produk">
            </label>
            <label>
                Kategori
                <select name="category">
                    <option value="">Semua kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->slug); ?>" <?php if(request('category') === $category->slug): echo 'selected'; endif; ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </label>
            <button class="button" type="submit">Cari</button>
        </form>

        <div class="product-grid">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="product-card">
                    <p class="eyebrow"><?php echo e($product->category->name); ?></p>
                    <h2><a href="<?php echo e(route('products.show', $product)); ?>"><?php echo e($product->name); ?></a></h2>
                    <p><?php echo e(\Illuminate\Support\Str::limit($product->description, 95)); ?></p>
                    <p class="price">Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?></p>
                    <p class="muted"><?php echo e($product->stock); ?> tersedia</p>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Belum ada produk yang cocok dengan pencarian.</p>
            <?php endif; ?>
        </div>
        <div class="pagination"><?php echo e($products->links()); ?></div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\LATITUDE\Downloads\TugasWeb-P11-EcommerAuth\resources\views/catalog/index.blade.php ENDPATH**/ ?>