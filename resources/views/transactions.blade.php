@extends('mainlayout')

@section('title', 'Daftar Transaksi')

@section('content')
<section class="p-4 prose">
    <h2 class="mb-4">Daftar Transaksi</h2>
    <div class="card bg-base-100 shadow mb-5 p-5">
      <div class="grid grid-row">
        <div class="flex justify-between items-center mb-2">
          <p class="font-semibold m-0">Total pendapatan</p>
          <p class="text-lg font-semibold m-0 text-primary">
           @currency($alltransactions->sum('total_price'))
          </p>
        </div>
        <div class="flex flex-wrap gap-8 justify-center items-center">
          <div class="bg-base-100 text-center">
            <div
              class="btn btn-outline btn-primary btn-circle p-3 my-2"
            >
              <i class="far fa-sack-dollar text-xl"></i>
            </div>
            <p class="m-0 text-sm">Bulan ini</p>
            <p class="text-lg font-semibold m-0 text-primary">
              @currency($revenuethismonth)
            </p>
          </div>
          <div class="bg-base-100 text-center">
            <div
              class="btn btn-outline btn-primary btn-circle p-3 my-2"
            >
              <i class="fad fa-sack-dollar text-xl"></i>
            </div>
            <p class="m-0 text-sm">3 bulan lalu</p>
            <p class="text-lg font-semibold m-0 text-primary">
              @currency($revenuelastmonth)
            </p>
          </div>
          <div class="bg-base-100 text-center">
            <div
              class="btn btn-outline btn-primary btn-circle p-3 my-2"
            >
              <i class="fas fa-sack-dollar text-xl"></i>
            </div>
            <p class="m-0 text-sm">Tahun ini</p>
            <p class="text-lg font-semibold m-0 text-primary">
                @currency($revenuethisyear)
            </p>
          </div>
        </div>
      </div>
    </div>
    <a href="" class="btn btn-primary gap-2"
      ><i class="fas fa-fw fa-plus"></i> Tambah Transaksi</a
    >
    <div class="flex w-full flex-row justify-between my-4">
      <h4 class="m-0">Transaksi hari ini</h4>
      <a href="" class="no-underline">Lihat semua ></a>
    </div>
    <div class="grid w-full gap-3">
        @foreach ($alltransactionstoday as $transaction)
            <div
            class="card flex flex-row items-center gap-4 bg-base-100 shadow p-5"
        >
            <i class="far fa-fw fa-shopping-basket fa-2x text-primary"></i>
            <div class="basis-3/4">
            <a href="" class="font-semibold">Transaksi#{{ $transaction->id }}</a>
            <p class="m-0">Pesanan untuk <b>Bro</b></p>
            </div>
            <div class="basis-3/4 text-right">
            <p class="m-0 font-semibold text-primary">@currency($transaction->total_price)</p>
            <p class="m-0">{{ $transaction->created_at->toTimeString() }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-center my-6">
      <div class="btn-group">
        <button
          class="btn bg-base-100 hover:bg-base-300 border-base-100 hover:border-base-300 text-base-content shadow btn-active"
        >
          1
        </button>
        <button
          class="btn bg-base-100 hover:bg-base-300 border-base-100 hover:border-base-300 text-base-content shadow"
        >
          2
        </button>
        <button
          class="btn bg-base-100 hover:bg-base-300 border-base-100 hover:border-base-300 text-base-content shadow"
        >
          3
        </button>
        <button
          class="btn bg-base-100 hover:bg-base-300 border-base-100 hover:border-base-300 text-base-content shadow"
        >
          4
        </button>
      </div>
    </div>
  </section>
@endsection