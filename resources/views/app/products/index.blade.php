@extends('mainlayout')

@section('title', 'Daftar Produk')

@section('content')
<section class="prose p-4">
    <h2 class="mb-0">Daftar Produk</h2>
    <a href="/products/tambah" class="btn-primary btn my-3 gap-2"
      ><i class="fas fa-fw fa-plus"></i> Tambah Produk</a
    >
    <form action="" method="get">
    <div class="form-control mb-4">
      <label class="label">
        <span class="label-text">Cari Produk</span>
      </label>
      <input
        type="text"
        name="search"
        placeholder="Cari Produk"
        class="input-bordered input focus:outline-none"
      />
    </div>
    </form> 
    <div class="grid w-full gap-3">
        @foreach ($products as $product)
        <div class="card bg-base-100 shadow">
          <div class="card-body flex flex-row gap-4 p-5">
            <div class="basis-3/4">
              <p class="m-0 text-sm font-semibold">
                {{ $product->name }}
              </p>
              <small>{{ $product->category->name }} | {{ $product->brand->name }} | Stok: <b>{{ $product->stock }}</b></small>
              <p class="m-0 font-semibold text-primary">@currency($product->price)</p>
            </div>
            <div
              class="flex basis-1/4 flex-col items-end justify-between"
            >
              <a
                href="/products/edit/{{ $product->id }}"
                class="btn-success btn-sm btn w-10"
                ><i class="fal fa-fw fa-edit"></i
              ></a>
              <button
                type="button"
                class="btn-error btn-sm btn w-10"
                onclick="confirmationHapusData('/products/delete/{{ $product->id }}')"
              >
                <i class="fal fa-fw fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
        @endforeach
    </div>

    {{ $products->links() }}
    <div class="my-6 flex justify-center">
      <div class="btn-group">
        <button
          class="btn btn-active border-base-100 bg-base-100 text-base-content shadow hover:border-base-300 hover:bg-base-300"
        >
          1
        </button>
        <button
          class="btn border-base-100 bg-base-100 text-base-content shadow hover:border-base-300 hover:bg-base-300"
        >
          2
        </button>
        <button
          class="btn border-base-100 bg-base-100 text-base-content shadow hover:border-base-300 hover:bg-base-300"
        >
          3
        </button>
        <button
          class="btn border-base-100 bg-base-100 text-base-content shadow hover:border-base-300 hover:bg-base-300"
        >
          4
        </button>
      </div>
    </div>
  </section>
@endsection

@section('scriptjs')

@if(Session::has('status'))
<script>
  Swal.fire(
  '{{Session::get('message')}}',
  '',
  '{{Session::get('status')}}'
)
</script>
@endif

<script>
  function confirmationHapusData(url) {
      Swal.fire({
          title: 'Apakah anda yakin?',
          text: 'Setelah dihapus data akan hilang selamanya!',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Confirm',
          closeOnConfirm: false
      }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
              window.location.href = url;
          }
      })
  }
</script>
@endsection