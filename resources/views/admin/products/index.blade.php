<x-app-layout>
    <section class="panel">
        <div class="section-heading">
            <div>
                <p class="eyebrow">ADMINISTRASI</p>
                <h1>Kelola produk</h1>
            </div>
            <a class="button" href="{{ route('admin.products.create') }}">Tambah produk</a>
        </div>

        @if (session('status'))
            <p class="notice">{{ session('status') }}</p>
        @endif

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
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}<br><span class="muted">{{ $product->sku }}</span></td>
                            <td>{{ $product->category->name }}</td>
                            <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->creator?->name ?? '—' }}</td>
                            <td class="actions">
                                @can('update', $product)
                                    <a href="{{ route('admin.products.edit', $product) }}">Edit</a>
                                @endcan
                                @can('delete', $product)
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                          onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="link-button danger" type="submit">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination">{{ $products->links() }}</div>
    </section>
</x-app-layout>
