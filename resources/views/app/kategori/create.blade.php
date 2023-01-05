@extends('mainlayout')

@section('title', 'Tambah Kategori')

@section('content')
<section class="prose p-4">
    <div class="mb-4 flex flex-row items-center gap-4">
      <a href="/kategori"><i class="fas fa-arrow-left"></i></a>
      <h2 class="m-0 p-0">Tambah Kategori</h2>
    </div>
    <section id="add-category" class="w-full">
      <div class="card bg-base-100 shadow">
        <div class="card-body p-5">
          <form action="/kategori/store" method="POST">
            @csrf
            <div class="form-control mb-2">
              <label class="label"
                ><span class="label-text">Nama Kategori</span></label
              >
              <input
                placeholder="Nama Kategori"
                name="name"
                class="input-bordered input focus:outline-none"
              />
            </div>
            <div class="form-control mt-5">
              <button class="btn-primary btn">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </section>
@endsection