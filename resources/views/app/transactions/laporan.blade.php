@extends('mainlayout')

@section('title', 'Laporan Transaksi')

@section('content')
<section class="prose p-4">
    <div class="mb-2 flex flex-row items-center gap-4">
      <a href="transaction.html"><i class="fas fa-arrow-left"></i></a>
      <h2 class="m-0 p-0">Laporan Transaksi</h2>
    </div>
    <div class="mb-4">
        <form action="" method="get">
      <div class="grid-row mb-3 grid grid-cols-2 gap-3">
        <div class="form-control">
          <label class="label"
            ><span class="label-text">Dari</span></label
          >
          <input
            type="date"
            name="tanggalawal"
            placeholder="Type here"
            class="input-bordered input focus:outline-none"
          />
        </div>
        <div class="form-control">
          <label class="label"
            ><span class="label-text">Sampai</span></label
          >
          <input
            type="date"
            name="tanggalakhir"
            placeholder="Type here"
            class="input-bordered input focus:outline-none"
          />
        </div>
      </div>
      <button type="" class="btn btn-primary w-full gap-2">
        Tampilkan Laporan
      </button>
    </form>
    <button onclick="exportlaporan()" class="mt-3 btn btn-success w-full gap-2">
      <i class="fal fa-file-excel"></i> Buat Laporan
    </button>
    </div>
    <div class="grid w-full gap-3">
        @foreach ($transactions as $transaction)
      <div class="card bg-base-100 shadow">
        <div class="card-body flex flex-row items-center gap-4 p-5">
          <i
            class="far fa-fw fa-shopping-basket text-2xl text-primary"
          ></i>
          <div class="basis-3/4">
            <a href="/transaksi/detailtransaksi/{{ $transaction->id }}" class="text-sm font-semibold">Transaksi#{{ $transaction->id }}</a>
            <p class="m-0 text-sm">Pesanan untuk <b>Bro</b></p>
          </div>
          <div class="basis-3/4 text-right">
            <p class="m-0 font-semibold text-primary">@currency($transaction->total_price)</p>
            <p class="m-0 text-sm">{{ $transaction->created_at->format('H:i') }} WIB</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
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

  <script>
    function exportlaporan() {
      var tanggalawal = document.getElementsByName("tanggalawal")[0].value;
      var tanggalakhir = document.getElementsByName("tanggalakhir")[0].value;
      window.location.href = "/transaksi/exportlaporan/" + tanggalawal + "/" + tanggalakhir + "";
    }
  </script>
@endsection