@extends('mainlayout')

@section('title', 'Tambah Transaksi')

@section('content')
@if(Session::has('status'))
<div class="alert alert-{{Session::get('status')}}" role="alert">
    {{Session::get('message')}}
</div>
@endif

<section class="prose p-4">
    <div class="mb-4 flex flex-row items-center gap-4">
      <a href="transaction.html"><i class="fas fa-arrow-left"></i></a>
      <h2 class="m-0 p-0">Tambah Transaksi</h2>
    </div>

    <section id="search-product" class="mb-4 w-full">
        <form action="" method="get">
            <div class="form-control mb-3">
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

      <div class="grid w-full grid-cols-2 gap-3" id="showproduct">
        @foreach ($products as $product)
        <div class="card bg-base-100 p-5 shadow">
          <p class="m-0 text-sm">
            {{ $product->name }}
          </p>
          <small class="font-light">{{ $product->brand->name }}</small>
          <div class="flex flex-row items-center justify-between">
            <p class="m-0 font-semibold text-primary">@currency($product->price)</p>
            <p class="m-0 text-sm">Stok: {{ $product->stock }}</p>
          </div>
          <button class="btn-success btn-sm btn mt-2" onClick="store({{$product->id}})">
            <i class="fal fa-fw fa-cart-plus"></i>
          </button>
        </div>
        @endforeach
      </div>
    </section>
    {{ $products->links()}}


    {{-- @include('app.transactions.cart') --}}
    <div id="cartshow">
    </div>
    

    <script
      src="https://code.jquery.com/jquery-3.6.3.min.js"
      integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
      crossorigin="anonymous"
    ></script>

    <script>
        $(document).ready(function(){
            getcart();
        });

      function store(idbarang)
      {
        $.ajax({
          url: "/transaksi/store",
          type: "GET",
          data: "idbarang="+idbarang,
          success: function (data) {
            getcart()
          }
        });
      }

      function getcart()
      {
        $.get("{{ url('/transaksi/getcart') }}", function (data, status) {
          $("#cartshow").html(data);
        });
      }
    </script>
  </section>
@endsection