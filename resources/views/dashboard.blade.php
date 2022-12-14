@extends('mainlayout')

@section('title', 'Dashboard')

@section('content')
<section class="p-4">
  <div class="grid grid-cols-1 gap-4">
    <div class="stats shadow">
      <div class="stat bg-primary text-primary-content">
        <div class="stat-figure">
          <i class="fas fa-fw fa-exchange-alt text-2xl"></i>
        </div>
        <div class="stat-title">Total Transaksi</div>
        <div class="stat-value">{{ $totaltrx }}</div>
        <div class="stat-desc">
          <a href="" class="mt-3 underline">Lihat Transaksi</a>
        </div>
      </div>
    </div>
    <div class="stats shadow">
      <div class="stat bg-success text-success-content">
        <div class="stat-figure">
          <i class="fas fa-fw fa-boxes text-2xl"></i>
        </div>
        <div class="stat-title">Total Produk</div>
        <div class="stat-value">{{ $totalprod }}</div>
        <div class="stat-desc">
          <a href="" class="mt-3 underline">Lihat Produk</a>
        </div>
      </div>
    </div>
    <div class="stats shadow">
      <div class="stat bg-warning text-warning-content">
        <div class="stat-figure">
          <i class="fas fa-fw fa-stream text-2xl"></i>
        </div>
        <div class="stat-title">Total Kategori Produk</div>
        <div class="stat-value">{{$totalcat}}</div>
        <div class="stat-desc">
          <a href="" class="mt-3 underline">Lihat Kategori Produk</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection