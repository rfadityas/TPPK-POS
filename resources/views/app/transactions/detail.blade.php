@extends('mainlayout')

@section('title', 'Detail Transaksi')

@section('content')

  <section class="prose p-4">
    <div class="mb-2 flex flex-row items-center gap-4">
      <a href="/transaksi"><i class="fas fa-arrow-left"></i></a>
      <h2 class="m-0 p-0">Detail Transaksi#{{ $transaction1->id }}</h2>
    </div>
    <section id="cart" class="mb-4 w-full">
      <p class="mb-3 ml-1 text-sm text-base-content">Detail Produk</p>
      <div class="grid w-full gap-3">
        @foreach ($transactiondetails as $transaction)
        <div class="card bg-base-100 shadow">
          <div class="card-body flex w-full flex-col gap-2 p-5">
            <div class="basis-3/4">
              <p class="m-0 text-sm font-semibold">
                Aqua AQR-D190 Kulkas 1 Pintu - Dark Silver
              </p>
              <small>{{$transaction->quantity}} x @currency($transaction->product->price) | {{ $transaction->product->brand->name }} | {{ $transaction->product->category->name }}</small>
            </div>
            <div class="flex flex-row items-center">
              <p class="m-0 text-sm">Total harga</p>
              <p class="m-0 text-right font-semibold text-primary">
                @currency($transaction->price)
              </p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section>
    <section id="cashier" class="mb-6 w-full">
      <p class="mb-3 ml-1 text-sm text-base-content">Info Pelanggan</p>
      <div class="card bg-base-100 shadow">
        <div class="card-body flex flex-col gap-3 p-5">
          <input
          type="hidden"
          id="invoice"
          value="{{ asset('storage/pdf/'.$transaction1->invoice) }}"
          class="input-bordered input focus:outline-none"
        />
          <input
          type="text"
          id="nama"
          placeholder="Nama Pelanggan"
          class="input-bordered input focus:outline-none"
        />
          <input
          type="text"
          id="nomorhp"
          placeholder="Format : 62xxxxxx"
          class="input-bordered input focus:outline-none"
        />
        </div>
      </div>
    </section>
    <section id="cashier" class="mb-6 w-full">
      <p class="mb-3 ml-1 text-sm text-base-content">
        Rincian Pembayaran
      </p>
      <div class="card bg-base-100 shadow">
        <div class="card-body flex flex-col gap-3 p-5">
          <div class="flex flex-row items-center justify-between">
            <p class="m-0 text-sm">Total</p>
            <p
              id="total"
              data-total="0"
              class="m-0 text-right font-semibold text-primary"
            >
            @currency($transaction1->total_price)
            </p>
          </div>
          <div class="flex flex-row items-center justify-between">
            <p class="m-0 text-sm">Bayar</p>
            <p
              id="kembali"
              data-kembali="0"
              class="m-0 text-right text-sm"
            >
              @currency($transaction1->pay)
            </p>
          </div>
          <div class="flex flex-row items-center justify-between">
            <p class="m-0 text-sm">Kembali</p>
            <p
              id="kembali"
              data-kembali="0"
              class="m-0 text-right text-sm"
            >
            @php $kembali = $transaction1->pay - $transaction1->total_price; @endphp
            @currency($kembali)
            </p>
          </div>
        </div>
      </div>
    </section>
    <div class="w-full text-center">
      
      <button class="btn mb-3 w-full gap-2" onClick="kirimkewa()">
        <i class="fab fa-whatsapp text-xl"></i> Kirim Nota
      </button>
      <a
        href="#"
        class="text-sm font-normal text-gray-400 no-underline dark:text-gray-500"
        >Hapus Transaksi</a
      >
    </div>
  </section>

  <script>
    function kirimkewa() {
      var nomorhp = document.getElementById("nomorhp").value;
      var nama = document.getElementById("nama").value;
      var invoice = document.getElementById("invoice").value;
      // var url = "https://api.whatsapp.com/send?phone="+nomorhp+"&text=Halo%20"+nama+"%20Terima%20Kasih%20Telah%20Membeli%20Di%20Toko%20Kelontong%20Bu%20Sari%20Berikut%20Invoice%20Pembelian%20Anda%20"+invoice+"";
      var url = "https://api.whatsapp.com/send?phone="+nomorhp+"&text=Halo%20*"+nama+"*%2C%0A%0ATerimakasih%20telah%20berbelanja%20di%20Toko%20Kelontong%20Bu%20Sari!%0A%0ABerikut%20link%20nota%20digital%20dari%20Kami%2C%0A"+invoice+"%0A%0ATerimakasih!";
      window.open(url, '_blank');
    }
  </script>
@endsection