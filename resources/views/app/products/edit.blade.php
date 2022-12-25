@extends('mainlayout')

@section('title', 'Edit Produk')

@section('content')
<section class="prose p-4">
    <div class="mb-4 flex flex-row items-center gap-4">
      <a href="/products"><i class="fas fa-arrow-left"></i></a>
      <h2 class="m-0 p-0">Ubah Produk</h2>
    </div>

    <section id="edit-product" class="w-full">
      <div class="card bg-base-100 shadow">
        <div class="card-body p-5">
          <form action="/products/update/{{ $product->id }}" method="POST">
            @csrf
            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Nama Produk</span>
              </label>
              <input
                type="text"
                name="name"
                value="{{ $product->name }}"
                placeholder="Nama Produk"
                class="input-bordered input focus:outline-none"
              />
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Harga</span>
              </label>
              <input
                type="number"
                name="price"
                value="{{ $product->price }}"
                placeholder="Harga"
                class="input-bordered input focus:outline-none"
              />
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Stok</span>
              </label>
              <input
                type="number"
                name="stock"
                value="{{ $product->stock }}"
                placeholder="Stok"
                class="input-bordered input focus:outline-none"
              />
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Kategori</span>
              </label>
              <select class="select-bordered select" name="category_id">
                @foreach ($categories as $category)
                @if ($category->id == $product->category_id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
              </select>
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Merek</span>
              </label>
              <select class="select-bordered select" name="brand_id">
                @foreach ($brands as $brand)
                @if ($brand->id == $product->brand_id)
                <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                @else
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endif
                @endforeach
              </select>
            </div>

            <div class="form-control mt-5">
              <button type="submit" class="btn-success btn">Ubah</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </section>
@endsection