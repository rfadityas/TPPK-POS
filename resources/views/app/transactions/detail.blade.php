@extends('mainlayout')

@section('meta')
@endsection

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

    <section id="cashier" class="mb-6 w-full">
      <p class="mb-3 ml-1 text-sm text-base-content">Info Pelanggan</p>
      <div class="card bg-base-100 shadow">
        <div class="card-body flex flex-col gap-3 p-5">
          <label for="my-modal" class="btn-success btn-sm btn"
          >Cari Pelanggan Terdaftar</label>
          {{-- <div class="divider">atau</div> --}}
          <input
          type="hidden"
          id="invoice"
          value="{{ asset('storage/pdf/'.$transaction1->invoice) }}"
          class="input-bordered input focus:outline-none"
        />
          <input
          type="hidden"
          id="idcustomer"
          class="input-bordered input focus:outline-none" disabled
        />
          <input
          type="text"
          id="nama"
          placeholder="Nama Pelanggan"
          class="input-bordered input focus:outline-none" disabled
        />
          <input
          type="text"
          id="nomorhp"
          placeholder="Nomor WA Pelanggan"
          class="input-bordered input focus:outline-none" disabled
        />
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

  <section id="modal">
    <input type="checkbox" id="my-modal" class="modal-toggle" />
    <div class="modal">
      <div class="modal-box">
        <h3 class="mt-2 text-lg font-bold">Pelanggan <label id="tambahcust" class="btn-success btn-sm btn"
          ><i class="fal fa-user-plus"></i
        ></label><label id="caricust" class="btn-success btn-sm btn" style="visibility: hidden;"
        >Cari Pelanggan</label></h3>

        <div class="py-1">
          <div class="form-control mb-2">
            <form id="searchform" action="" method="post">
              <div class="form-control mb-3">
                <input
                  type="text"
                  id="search"
                  placeholder="Cari Pelanggan"
                  class="input-bordered input focus:outline-none"
                />
              </div>
          </form>
          <div id="addcust" style="display:none;">
            <div class="form-control mb-2">
              <label class="label"
                ><span class="label-text">Nama</span></label
              >
              <input
                id="namapelangganbaru"
                name="namapelanggan"
                placeholder="Nama Pelanggan"
                class="input-bordered input focus:outline-none"
              />
            </div>
            <div class="form-control mb-2">
              <label class="label"
                ><span class="label-text">No. Whatsapp</span></label
              >
              <input
                id="nomorhpbaru"
                name="nomorhpbaru"
                placeholder="6289123123123"
                class="input-bordered input focus:outline-none"
              />
              <small class="ml-2 italic"
                >Nomor diawali dengan 62!</small
              >
            </div>
            <button class="btn-primary btn mt-2" onClick="simpancust()">Simpan</button>
          </div>
          
          <div class="mb-6 w-full" id="showcustomer">
        
          </div>
          </div>
        </div>
        <div class="modal-action">
          <label for="my-modal" id="tutup" class="btn">Tutup</label>
          {{-- <button class="btn-success btn">Tambah</button> --}}
        </div>
      </div>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <script>
    function kirimkewa() {
      var nomorhp = document.getElementById("nomorhp").value;
      var nama = document.getElementById("nama").value;
      var invoice = document.getElementById("invoice").value;
      // var url = "https://api.whatsapp.com/send?phone="+nomorhp+"&text=Halo%20"+nama+"%20Terima%20Kasih%20Telah%20Membeli%20Di%20Toko%20Kelontong%20Bu%20Sari%20Berikut%20Invoice%20Pembelian%20Anda%20"+invoice+"";
      var url = "https://api.whatsapp.com/send?phone="+nomorhp+"&text=Halo%20*"+nama+"*%2C%0A%0ATerimakasih%20telah%20berbelanja%20di%20Toko%20Kelontong%20Bu%20Sari!%0A%0ABerikut%20link%20nota%20digital%20dari%20Kami%2C%0A"+invoice+"%0A%0ATerimakasih!";
      log_send_invoice();
      window.open(url, '_blank');
    }
    function log_send_invoice() {
      var idcustomer = document.getElementById("idcustomer").value;
      var idtransaksi = '{{ $transaction1->id }}';

      $.ajax({
        url: "{{ route('simpan.sendinvoicelog') }}",
        type: "POST",
        data: {
          "idcustomer": idcustomer,
          "idtransaksi": idtransaksi,
          "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (data) {
          console.log(data);
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
    
    function pilihdata(nama, nomorhp, idcustomer){
      document.getElementById("nama").value = nama;
      document.getElementById("nomorhp").value = nomorhp;
      document.getElementById("idcustomer").value = idcustomer;
      $('#tutup').click();
    }

    $('#tambahcust').click(function(){
      var searchform = document.getElementById("searchform");
      searchform.style.display = "none";
      document.getElementById("tambahcust").style.display = "none";
      document.getElementById("showcustomer").style.display = "none";
      document.getElementById("caricust").style.visibility = "visible";
      document.getElementById("addcust").style.display = "block";
    });
    $('#caricust').click(function(){
      var searchform = document.getElementById("searchform");
      searchform.style.display = "block";
      document.getElementById("tambahcust").style.display = "initial";
      document.getElementById("showcustomer").style.display = "block";
      document.getElementById("caricust").style.visibility = "hidden";
      document.getElementById("addcust").style.display = "none";
    });

    function simpancust(){
      var namapelanggan = document.getElementById("namapelangganbaru").value;
      var nomorhp = document.getElementById("nomorhpbaru").value;

      $.ajax({
        url: "{{ route('simpan.customer') }}",
        type: "POST",
        data: {
          "nomorhpbaru": nomorhp,
          "namapelangganbaru": namapelanggan,
          "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (data) {
          console.log(data);
          if (data.status == 'success') {
            alert('Data Berhasil Disimpan');
            $("#namapelangganbaru").val = "";
            $("#nomorhpbaru").val = "";
            $('#caricust').click();
            $('#search').val(namapelanggan);
            search();
          }else{
            alert('Data Gagal Disimpan');
          }
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
  </script>
  <script>
    $('#search').on('keyup', function(){
      // console.log($('#search').val());
      if ($('#search').val() != '') {
        search();
      }else{
        $('#showcustomer').html('');
      }
    });
    // search();
    function search(){
         var keyword = $('#search').val();
         $.post('{{ route("search.customer") }}',
          {
             _token: $('meta[name="csrf-token"]').attr('content'),
             keyword:keyword
           },
           function(data){
            table_post_row(data);
              console.log(data);
           });
    }
    // table row with ajax
    function table_post_row(res){
      let htmlView = '';
        if(res.customers.length <= 0){
            htmlView+= `
            <div class="card bg-base-100 shadow">
                    <div class="card-body flex flex-col gap-3 p-5">
                      <p class="m-0 text-center text-sm">Tidak ada pelanggan</p>
                    </div>
                  </div>`;
        }
        for(let i = 0; i < res.customers.length; i++){
            htmlView += `
            <div class="card bg-base-100 p-5 shadow">
          <p class="m-0 text-sm">
            `+ res.customers[i].number+`
          </p>
          <div class="flex flex-row items-center justify-between">
            <p class="m-0 font-semibold text-primary">`+ res.customers[i].name+`</p>
          </div>
          <button class="btn-success btn-sm btn mt-2" onclick="pilihdata('`+res.customers[i].name+`', `+ res.customers[i].number+`, `+ res.customers[i].id+`)">
            Pilih
          </button>
        </div>`;
        }
          $('#showcustomer').html(htmlView);
    }
    </script>

@endsection