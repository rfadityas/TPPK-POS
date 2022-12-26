@extends('mainlayout')

@section('title', 'Detail Transaksi')

@section('content')
<section class="p-4 prose">
    <div class="mb-4 flex flex-row items-center gap-4">
        <a href="/transaksi"><i class="fas fa-arrow-left"></i></a>
        <h2 class="m-0 p-0">Transaksi #{{ $transaction->id }}</h2>
      </div>
    <div class="grid w-full gap-3">
        @foreach ($transactiondetails as $transaction)
            <div
            class="card flex flex-row items-center gap-4 bg-base-100 shadow p-5"
        >
            <i class="far fa-fw fa-shopping-basket fa-2x text-primary"></i>
            <div class="basis-3/4">
            <a href="" class="font-semibold">{{ $transaction->product->name }}</a>
            <p class="m-0">Qty : {{$transaction->quantity}} | @currency($transaction->product->price)</p>
            </div>
            <div class="basis-3/4 text-right">
            <p class="m-0 font-semibold text-primary">@currency($transaction->price)</p>
            <p class="m-0">Total</p>
            </div>
        </div>
        @endforeach
    </div>
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