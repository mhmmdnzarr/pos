<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style> 
  body {
    background-color: #1e293b;
    min-height: 100vh;
  }

  /* teks judul & label supaya tetap kebaca di atas background gelap */
  .h3.fw-bold,
  h5.text-muted {
    color: #f1f5f9 !important;
  }

  h4.fw-bold.text-secondary {
    color: #e2e8f0 !important;
  }

  .border-bottom {
    border-color: rgba(255, 255, 255, 0.15) !important;
  }
</style>
<body>
    <div class="container">
        
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success')}}
        </div>
    @endif

        <!-- isi konten -->
        @yield('content')
    </div>
</body>
</html>