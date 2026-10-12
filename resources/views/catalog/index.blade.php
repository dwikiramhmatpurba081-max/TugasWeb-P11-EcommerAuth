<x-app-layout>
    <section class="hero">
        <p class="eyebrow">TOKO KITA</p>
        <h1>Belanja mudah, pilihan lengkap.</h1>
        <p>Temukan produk pilihan dari berbagai kategori.</p>
    </section>

    <section class="panel">
        <form class="filters" method="GET" action="{{ route('home') }}">
            <label>
                Cari produk
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Nama produk">
            </label>
            <label>
                Kategori
                <select name="category">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>
            <button class="button" type="submit">Cari</button>
        </form>

        <div class="product-grid">
            @forelse ($products as $product)
                <article class="product-card">
                    <p class="eyebrow">{{ $product->category->name }}</p>
                    <h2><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h2>
                    <p>{{ \Illuminate\Support\Str::limit($product->description, 95) }}</p>
                    <p class="price">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
                    <p class="muted">{{ $product->stock }} tersedia</p>
                </article>
            @empty
                <p>Belum ada produk yang cocok dengan pencarian.</p>
            @endforelse
        </div>
        <div class="pagination">{{ $products->links() }}</div>
    </section>
</x-app-layout>
