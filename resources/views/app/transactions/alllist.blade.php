@extends('mainlayout')

@section('title', 'Semua Transaksi')

@section('content')
<section class="p-4 prose">
    <div class="mb-4 flex flex-row items-center gap-4">
        <a href="/transaksi"><i class="fas fa-arrow-left"></i></a>
        <h2 class="m-0 p-0">Semua Transaksi</h2>
      </div>
      <form action="" method="get">
        <div class="form-control mb-4">
          <label class="label">
            <span class="label-text">Cari Transaksi</span>
          </label>
          <input
            type="text"
            name="search"
            placeholder="Cari Transaksi"
            class="input-bordered input focus:outline-none"
          />
        </div>
        </form> 
      <div class="grid w-full gap-3">
        @foreach ($alltransactions as $transaction)
            <div
            class="card flex flex-row items-center gap-4 bg-base-100 shadow p-5"
        >
            <i class="far fa-fw fa-shopping-basket fa-2x text-primary"></i>
            <div class="basis-3/4">
            <a href="/transaksi/detailtransaksi/{{ $transaction->id }}" class="font-semibold">Transaksi#{{ $transaction->id }}</a>
            <p class="m-0">Pesanan untuk <b>Bro</b></p>
            </div>
            <div class="basis-3/4 text-right">
            <p class="m-0 font-semibold text-primary">@currency($transaction->total_price)</p>
            <p class="m-0">{{ $transaction->created_at->format('H:i') }} WIB</p>
            </div>
        </div>
        @endforeach
    </div>
    {{ $alltransactions->links('vendor.pagination.custom') }}
    {{-- <div class="flex justify-center my-6">
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
    </div> --}}
  </section>
@endsection