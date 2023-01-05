@extends('mainlayout')

@section('title', 'Edit Kategori')

@section('content')
<section class="prose p-4">
    <div class="mb-4 flex flex-row items-center gap-4">
      <a href="/kategori"><i class="fas fa-arrow-left"></i></a>
      <h2 class="m-0 p-0">Ubah Kategori</h2>
    </div>
    <section id="edit-category" class="w-full">
      <div class="card bg-base-100 shadow">
        <div class="card-body p-5">
          <form action="/kategori/update/{{ $categorie->id }}" method="POST">
            @csrf
            <div class="form-control mb-2">
              <label class="label"
                ><span class="label-text">Nama Kategori</span></label
              >
              <input
                name="name"
                value="{{ $categorie->name }}"
                placeholder="Nama Kategori"
                class="input-bordered input focus:outline-none"
              />
            </div>
            <div class="form-control mt-5">
              <button class="btn btn-success">Ubah</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </section>
@endsection