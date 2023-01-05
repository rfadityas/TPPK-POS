@extends('mainlayout')

@section('title', 'Daftar Kategori')

@section('content')
<section class="prose p-4">
  <h2 class="mb-0">Daftar Kategori</h2>
  <a href="/kategori/tambah" class="btn btn-primary my-3 gap-2"
    ><i class="fas fa-fw fa-plus"></i> Tambah Kategori</a
  >
  <form action="" method="get">
    <div class="form-control mb-4">
      <label class="label"
        ><span class="label-text">Cari Kategori</span></label
      >
      <input
        type="text"
        name="search"
        placeholder="Cari Kategori"
        class="input-bordered input focus:outline-none"
      />
    </div>
  </form>
  <div class="grid w-full gap-3">
    @foreach($categories as $category)
    <div class="card bg-base-100 shadow">
      <div class="card-body flex flex-row items-center gap-4 p-5">
        <div class="basis-3/4">
          <p class="m-0 text-sm font-semibold">{{ $category->name }}</p>
        </div>
        <div
          class="flex basis-1/4 flex-row items-end justify-between gap-2"
        >
          <a
            href="kategori/edit/{{ $category->id }}"
            class="btn btn-success btn-sm w-10"
            ><i class="fal fa-fw fa-edit"></i
          ></a>
          <button
            type="button"
            class="btn btn-error btn-sm w-10"
            onclick="confirmationHapusData('/kategori/delete/{{ $category->id }}')"
          >
            <i class="fal fa-fw fa-trash"></i>
          </button>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  {{ $categories->links('vendor.pagination.custom') }}
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