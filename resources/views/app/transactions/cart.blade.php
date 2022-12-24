<section id="cart" class="mb-4 w-full">
    <p class="mb-3 ml-1 text-sm text-base-content">Keranjang</p>
    @if (\Cart::getContent()->count() > 0)
    <div class="grid w-full gap-3">
      @foreach (\Cart::getContent() as $item)
      <div class="card bg-base-100 shadow">
        <div class="card-body flex flex-col gap-4 p-5">
          <div class="basis-3/4">
            <p class="m-0 text-sm font-semibold">
              {{ $item->name }}
            </p>
            <small>{{ $item->attributes['brand'] }}</small>
            <p class="m-0 font-semibold text-primary">@currency($item->price * $item->quantity)</p>
          </div>
          <div class="flex basis-1/4 flex-row">
            <div class="input-group">
              <button class="btn-outline btn-sm btn" onClick="removeqty({{$item->id}})">-</button>
              <input
                data-price="60000"
                type="number"
                min="1"
                value="{{ $item->quantity }}"
                class="input-bordered input input-sm w-10 px-1 text-center focus:outline-none"
                readonly
              />
              <button class="btn-outline btn-sm btn" onClick="addqty({{$item->id}})">+</button>
            </div>
            <button class="btn-error btn-sm btn" onClick="destroy({{$item->id}})">
              <i class="fal fa-fw fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="grid w-full gap-3"></div>
      <div class="card bg-base-100 shadow">
        <div class="card-body flex flex-col gap-4 p-5">
          <div class="basis-3/4">
            <p class="m-0 text-sm font-semibold">
              Keranjang kosong
            </p>
          </div>
        </div>
      </div>
      @endif
    </section>
    
    <section id="cashier" class="w-full">
      <p class="mb-3 ml-1 text-sm text-base-content">Kasir</p>
      
      {{-- <form action="" id="bayar"> --}}
    <div class="card bg-base-100 shadow">
      <div class="card-body flex flex-col gap-3 p-5">
        <div class="flex flex-row items-center justify-between">
          <p class="m-0 text-sm">Total</p>
          <p
            id="total"
            data-total="{{ \Cart::getTotal() }}"
            class="m-0 text-right font-semibold text-primary"
          >
           @currency(\Cart::getTotal())
          </p>
        </div>
        <div class="flex flex-row items-center justify-between">
          <p class="m-0 text-sm">Bayar</p>
          <div class="flex flex-row items-center gap-2">
            <p class="m-0 text-sm">Rp</p>
            <input
              type="number"
              id="input-bayar"
              class="input-bordered input input-sm w-32 text-right focus:outline-none"
              placeholder="0"
            />
          </div>
        </div>
        <div class="flex flex-row items-center justify-between">
          <p class="m-0 text-sm">Kembali</p>
          <p
            id="kembali"
            data-kembali="0"
            class="m-0 text-right text-sm"
          >
            Rp0
          </p>
        </div>
        {{-- <button class="btn-primary btn mt-2">Bayar</button> --}}
        <button type="submit" class="btn-primary btn mt-2" onClick="purchase()">Bayar</button>
      </div>
    </div>
  {{-- </form> --}}
  </section>

  <script>
    $('#input-bayar').keyup(function(){
        // console.log(parseInt($("#total").data("total")))
        var $kembali = $("#kembali");
        var total = parseInt($("#total").data("total"))
        var bayar = $('#input-bayar').val();
        var kembali = bayar - total;
        var format = `Rp${formatNumber(kembali.toString())}`;
        $kembali.removeClass("text-error");
        $kembali.addClass("text-success");
        if (kembali < 0) {
          format = `-${format}`;
          $kembali.addClass("text-error");
          $kembali.removeClass("text-success");
        }
        $kembali.text(format);
        $kembali.data("kembali", kembali);
    });

        function formatNumber(angka) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split = number_string.split(","),
          sisa = split[0].length % 3,
          format = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
          separator = sisa ? "." : "";
          format += separator + ribuan.join(".");
        }

        return format || 0;
      }

        function destroy(id) {
            $.ajax({
            url: `/transaksi/destroy/${id}`,
            type: "GET",
            success: function (response) {
                getcart()
            },
            });
        }

        function addqty(id) {
            $.ajax({
            url: `/transaksi/addqty/${id}`,
            type: "GET",
            success: function (response) {
                getcart()
            },
            });
        }

        function removeqty(id) {
            $.ajax({
            url: `/transaksi/removeqty/${id}`,
            type: "GET",
            success: function (response) {
                getcart()
            },
            });
        }
        function purchase() {
            var kembali = $("#kembali").data("kembali");
            var total = parseInt($("#total").data("total"))
            if (kembali < 0) {
                alert("Uang tidak cukup");
                return;
            }
            if (total == 0) {
                alert("Keranjang kosong");
                return;
            }
            $.ajax({
            url: `/transaksi/savetransaksi`,
            type: "GET",
            success: function (response) {
                getcart()
            },
            });
        }
  </script>