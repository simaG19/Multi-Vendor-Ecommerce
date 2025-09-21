<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'My Store')</title>
  <style>
    /* tiny clean styles for quick testing */
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,"Helvetica Neue",Arial;padding:16px;color:#111;}
    .container{max-width:980px;margin:0 auto;}
    header{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;}
    nav a{margin-left:12px;color:#0366d6;text-decoration:none}
    .card{border:1px solid #e5e7eb;padding:12px;border-radius:6px;background:#fff;}
    .form-group{margin-bottom:12px;}
    label{display:block;font-weight:600;margin-bottom:6px;}
    input[type="text"], input[type="email"], input[type="number"], input[type="password"], textarea, select{
      width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;
    }
    button{background:#0366d6;color:white;border:0;padding:8px 12px;border-radius:6px;cursor:pointer}
    img.thumb{width:60px;height:60px;object-fit:cover;border:1px solid #ddd;border-radius:4px}
    .muted{color:#6b7280;font-size:0.9rem}
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div><a href="/" style="font-weight:700;color:#111;text-decoration:none">My E-Commerce</a></div>
      <nav>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('vendor.register') }}">Vendor Register</a>
        <a href="{{ route('login') }}">Login</a>
      </nav>
    </header>

    <main>
      @yield('content')
    </main>

    <footer class="muted" style="margin-top:28px">© {{ date('Y') }} My E-Commerce — simple test UI</footer>
  </div>
</body>
</html>
