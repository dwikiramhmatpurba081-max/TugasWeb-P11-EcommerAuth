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
    <section class="panel form-panel">
        <a href="<?php echo e(route('admin.products.index')); ?>">&larr; Kembali ke produk</a>
        <h1><?php echo e($product->exists ? 'Edit produk' : 'Tambah produk'); ?></h1>

        <?php if($errors->any()): ?>
            <div class="error-list">
                <p>Periksa kembali data berikut:</p>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST"
              action="<?php echo e($product->exists ? route('admin.products.update', $product) : route('admin.products.store')); ?>">
            <?php echo csrf_field(); ?>
            <?php if($product->exists): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <label for="name">Nama produk</label>
            <input id="name" name="name" value="<?php echo e(old('name', $product->name)); ?>" required maxlength="160">

            <label for="slug">Slug</label>
            <input id="slug" name="slug" value="<?php echo e(old('slug', $product->slug)); ?>" required maxlength="180">

            <label for="sku">SKU</label>
            <input id="sku" name="sku" value="<?php echo e(old('sku', $product->sku)); ?>" required maxlength="80">

            <label for="category_id">Kategori</label>
            <select id="category_id" name="category_id" required>
                <option value="">Pilih kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if((string) old('category_id', $product->category_id) === (string) $category->id): echo 'selected'; endif; ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="4"><?php echo e(old('description', $product->description)); ?></textarea>

            <div class="form-row">
                <div>
                    <label for="price">Harga (Rp)</label>
                    <input id="price" name="price" type="number" min="0" step="0.01"
                           value="<?php echo e(old('price', $product->price)); ?>" required>
                </div>
                <div>
                    <label for="stock">Stok</label>
                    <input id="stock" name="stock" type="number" min="0"
                           value="<?php echo e(old('stock', $product->stock ?? 0)); ?>" required>
                </div>
            </div>

            <label for="image_url">URL gambar (opsional)</label>
            <input id="image_url" name="image_url" type="url" value="<?php echo e(old('image_url', $product->image_url)); ?>">

            <label class="check-row">
                <input type="checkbox" name="is_active" value="1" <?php if(old('is_active', $product->is_active ?? true)): echo 'checked'; endif; ?>>
                Produk aktif di katalog
            </label>
            <label class="check-row">
                <input type="checkbox" name="is_featured" value="1" <?php if(old('is_featured', $product->is_featured ?? false)): echo 'checked'; endif; ?>>
                Produk unggulan
            </label>

            <button class="button" type="submit"><?php echo e($product->exists ? 'Simpan perubahan' : 'Buat produk'); ?></button>
        </form>
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
<?php /**PATH C:\Users\LATITUDE\Downloads\TugasWeb-P11-EcommerAuth\resources\views/admin/products/form.blade.php ENDPATH**/ ?>