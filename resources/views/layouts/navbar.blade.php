<nav class="navbar navbar-expand-lg navbar-dark first">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
      <i class="bi bi-shop"></i> POS
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-2">
        <li class="nav-item">
          <a class="nav-link px-3 {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @if (Auth::user()->role->name === 'admin')
        <li class="nav-item">
          <a class="nav-link px-3 {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Pengguna</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link px-3 {{ Request::is('jenis') ? 'active' : '' }}" href="{{ route('jenis.index') }}">Jenis Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 {{ Request::is('produk*') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>

      <form action="{{ route('logout') }}" method="POST" class="d-flex mt-2 mt-lg-0">
        @csrf
        <button type="submit" class="btn btn-logout d-flex align-items-center gap-1">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
      <form action="{{ route('logout') }}" method="POST">
    @csrf
</form>
    </div>
  </div>
</nav>

<style>
  /* Menyamakan warna latar belakang body dengan navbar */
  body {
    background-color: #243044; /* Warna solid gelap yang menyatu dengan navbar */
    margin: 0;
  }

  .navbar.first {
    /* Mengubah gradient ke warna solid agar tidak ada perbedaan gradasi antara navbar dan body */
    background-color: #243044; 
    padding: 0.9rem 0;
    box-shadow: none !important; /* Menghapus garis bayangan bawah */
    border: none !important;
  }

  .navbar.first .navbar-brand {
    color: #ffffff;
    letter-spacing: 0.5px;
  }

  .navbar.first .nav-link {
    color: rgba(255, 255, 255, 0.75);
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.25s ease;
    position: relative;
  }

  .navbar.first .nav-link:hover {
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.08);
  }

  .navbar.first .nav-link.active {
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.15);
    font-weight: 600;
  }

  .navbar.first .btn-logout {
    background-color: #ef4444;
    border: none;
    color: #fff;
    font-weight: 500;
    padding: 0.45rem 1.1rem;
    border-radius: 8px;
    transition: all 0.2s ease;
  }

  .navbar.first .btn-logout:hover {
    background-color: #dc2626;
    transform: translateY(-1px);
    color: #fff;
  }
</style>