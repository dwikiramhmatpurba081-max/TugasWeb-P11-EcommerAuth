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
    <section class="panel">
        <div class="section-heading">
            <div>
                <p class="eyebrow">ADMINISTRASI</p>
                <h1>Kelola produk</h1>
            </div>
            <a class="button" href="<?php echo e(route('admin.products.create')); ?>">Tambah produk</a>
        </div>

        <?php if(session('status')): ?>
            <p class="notice"><?php echo e(session('status')); ?></p>
        <?php endif; ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Dibuat oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($product->name); ?><br><span class="muted"><?php echo e($product->sku); ?></span></td>
                            <td><?php echo e($product->category->name); ?></td>
                            <td>Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?></td>
                            <td><?php echo e($product->stock); ?></td>
                            <td><?php echo e($product->creator?->name ?? '—'); ?></td>
                            <td class="actions">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>
                                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>">Edit</a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>
                                    <form method="POST" action="<?php echo e(route('admin.products.destroy', $product)); ?>"
                                          onsubmit="return confirm('Hapus produk ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="link-button danger" type="submit">Hapus</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6">Belum ada produk.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
<?php /**PATH C:\Users\LATITUDE\Downloads\TugasWeb-P11-EcommerAuth\resources\views/admin/products/index.blade.php ENDPATH**/ ?>