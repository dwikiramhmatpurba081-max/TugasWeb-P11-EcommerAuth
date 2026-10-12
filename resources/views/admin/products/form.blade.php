<x-app-layout>
    <section class="panel form-panel">
        <a href="{{ route('admin.products.index') }}">&larr; Kembali ke produk</a>
        <h1>{{ $product->exists ? 'Edit produk' : 'Tambah produk' }}</h1>

        @if ($errors->any())
            <div class="error-list">
                <p>Periksa kembali data berikut:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
            @csrf
            @if ($product->exists)
                @method('PUT')
            @endif

            <label for="name">Nama produk</label>
            <input id="name" name="name" value="{{ old('name', $product->name) }}" required maxlength="160">

            <label for="slug">Slug</label>
            <input id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required maxlength="180">

            <label for="sku">SKU</label>
            <input id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required maxlength="80">

            <label for="category_id">Kategori</label>
            <select id="category_id" name="category_id" required>
                <option value="">Pilih kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id) === (string) $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="description">Deskripsi</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>

            <div class="form-row">
                <div>
                    <label for="price">Harga (Rp)</label>
                    <input id="price" name="price" type="number" min="0" step="0.01"
                           value="{{ old('price', $product->price) }}" required>
                </div>
                <div>
                    <label for="stock">Stok</label>
                    <input id="stock" name="stock" type="number" min="0"
                           value="{{ old('stock', $product->stock ?? 0) }}" required>
                </div>
            </div>

            <label for="image_url">URL gambar (opsional)</label>
            <input id="image_url" name="image_url" type="url" value="{{ old('image_url', $product->image_url) }}">

            <label class="check-row">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
                Produk aktif di katalog
            </label>
            <label class="check-row">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured ?? false))>
                Produk unggulan
            </label>

            <button class="button" type="submit">{{ $product->exists ? 'Simpan perubahan' : 'Buat produk' }}</button>
        </form>
    </section>
</x-app-layout>
