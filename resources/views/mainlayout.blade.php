<!DOCTYPE html>
<html lang="en" data-theme="light" class="bg-base-300">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | POS Warung Kelontong</title>
    <script src="{{ asset('dist/js/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dist/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/dist/css/main.css') }}" />
    <link
    href="https://cdn.staticaly.com/gh/hung1001/font-awesome-pro/4cac1a6/css/all.css"
    rel="stylesheet"
    type="text/css"
    />
    <script defer src="{{ asset('/dist/js/main.js') }}"></script>
  </head>
  <body>
    <div class="max-w-md mx-auto bg-base-200">
      <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content h-screen">
          <!-- Header -->
          <div class="navbar bg-base-100 shadow">
            <div class="flex-1">
              <a class="btn btn-ghost normal-case text-xl">Warung Kelontong</a>
            </div>
            <div class="flex-none">
              <label class="btn btn-square btn-ghost swap swap-rotate">
                <!-- this hidden checkbox controls the state -->
                <input id="theme-switcher" type="checkbox" />

                <!-- sun icon -->
                <svg
                  class="swap-on fill-current w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"
                  />
                </svg>

                <!-- moon icon -->
                <svg
                  class="swap-off fill-current w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"
                  />
                </svg>
              </label>
            </div>
            <div class="flex-none">
              <label
                for="my-drawer"
                class="btn btn-square btn-ghost drawer-button"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  class="inline-block w-5 h-5 stroke-current"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  ></path>
                </svg>
              </label>
            </div>
          </div>
          <!-- End Header -->

          <!-- Content -->
          @yield('content')
          <!-- End Content -->
        </div>
        <div class="drawer-side">
          <label for="my-drawer" class="drawer-overlay"></label>

          <div class="w-80 bg-base-100 text-base-content">
            <!-- Profile -->
            <div class="flex flex-row items-center pt-4 px-4">
              <img
                src="https://randomuser.me/api/portraits/lego/5.jpg"
                class="rounded-full w-16 h-16"
              />
              <div class="ml-4">
                <h3 class="text-lg font-bold">{{ Auth::user()->name }}</h3>
                <p>{{ Auth::user()->role->name }}</p>
              </div>
            </div>

            <!-- Menu -->
            <ul class="menu p-4">
              <li class="menu-title">
                <span>Menu</span>
              </li>
              <li>
                <a href="/" class="active"
                  ><i class="fas fa-tachometer-alt"></i> Dashboard</a
                >
              </li>
              <div class="divider my-0"></div>
              <li class="menu-title">
                <span>Transaksi</span>
              </li>
              <li>
                <a href="/transaksi/tambah"><i class="fas fa-plus"></i> Tambah Transaksi</a>
              </li>
              <li>
                <a href="/transaksi"
                  ><i class="fas fa-exchange-alt"></i> Daftar Transaksi</a
                >
              </li>
              <div class="divider my-0"></div>
              <li class="menu-title">
                <span>Produk</span>
              </li>
              <li>
                <a href="/products/tambah"><i class="fas fa-plus"></i> Tambah Produk</a>
              </li>
              <li>
                <a href="/products"><i class="fas fa-boxes"></i> Daftar Produk</a>
              </li>
              <div class="divider my-0"></div>
              <li class="menu-title">
                <span>Kategori</span>
              </li>
              <li>
                <a href="#"><i class="fas fa-plus"></i> Tambah Kategori</a>
              </li>
              <li>
                <a href="#"><i class="fas fa-stream"></i> Daftar Kategori</a>
              </li>
              <div class="divider my-0"></div>
              <li class="menu-title">
                <span>User</span>
              </li>
              <li>
                <a href="#"><i class="fas fa-plus"></i> Tambah User</a>
              </li>
              <li>
                <a href="#"><i class="fas fa-users"></i> Daftar User</a>
              </li>
              <div class="divider my-0"></div>
              <li class="menu-title">
                <span>Lainnya</span>
              </li>
              <li>
                <a href="#"><i class="fas fa-cog"></i> Pengaturan</a>
              </li>
              <li>
                <a href="/logout"
                  ><i class="fas fa-sign-out-alt"></i> Logout</a
                >
              </li>
            </ul>
            <!-- End Menu -->
          </div>
        </div>
      </div>
    </div>

    @yield('scriptjs')
    {{-- <script src="{{ asset('/dist/js/main.js') }}"></script> --}}
    
  </body>
</html>
