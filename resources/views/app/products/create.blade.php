@extends('mainlayout')

@section('title', 'Tambah Produk')

@section('content')
<section class="prose p-4">
    <div class="mb-4 flex flex-row items-center gap-4">
      <a href="product.html"><i class="fas fa-arrow-left"></i></a>
      <h2 class="m-0 p-0">Tambah Produk</h2>
    </div>

    <section id="add-product" class="w-full">
      <div class="card bg-base-100 shadow">
        <div class="card-body p-5">
          <form action="/products/store" method="POST">
            @csrf
            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Nama Produk</span>
              </label>
              <input
                type="text"
                name="name"
                placeholder="Nama Produk"
                class="input-bordered input focus:outline-none"
              />
              <!-- <label class="label">
                <span class="label-text text-error">Alt label</span>
            </label> -->
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Harga</span>
              </label>
              <input
                type="number"
                name="price"
                placeholder="Harga"
                class="input-bordered input focus:outline-none"
              />
              <!-- <label class="label">
                <span class="label-text text-error">Alt label</span>
            </label> -->
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Stok</span>
              </label>
              <input
                type="number"
                name="stock"
                placeholder="Stok"
                class="input-bordered input focus:outline-none"
              />
              <!-- <label class="label">
                <span class="label-text text-error">Alt label</span>
            </label> -->
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Kategori</span>
              </label>
              <select class="select-bordered select" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
              <!-- <label class="label">
                <span class="label-text text-error">Alt label</span>
            </label> -->
            </div>

            <div class="form-control mb-2">
              <label class="label">
                <span class="label-text">Merek</span>
              </label>
              <select class="select-bordered select" name="brand_id">
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>
              <!-- <label class="label">
                <span class="label-text text-error">Alt label</span>
            </label> -->
            </div>

            <div class="form-control mt-5">
              <button type="submit" class="btn-primary btn">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </section>
  @endsection