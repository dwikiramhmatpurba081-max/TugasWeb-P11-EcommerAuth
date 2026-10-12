<x-app-layout>
    <section class="panel product-detail">
        <a href="{{ route('home') }}">&larr; Kembali ke katalog</a>
        <p class="eyebrow">{{ $product->category->name }}</p>
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <p class="price">Rp {{ number_format((float) $product->price, 0, ',', '.') }}</p>
        <p>Stok tersedia: {{ $product->stock }}</p>
        <p class="muted">SKU: {{ $product->sku }}</p>
    </section>
</x-app-layout>
