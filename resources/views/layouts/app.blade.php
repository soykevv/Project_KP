<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Inventori CV. Montana Intercontinental')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS sederhana dulu --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f8;
        }
        .navbar {
            background: #2c3e50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .navbar .left a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
        }
        .logout-btn {
            background: #e74c3c;
            border: none;
            color: white;
            padding: 8px 12px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
        .badge {
            background: #3498db;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 12px;
        }
        .container {
            display: flex;
        }

        .sidebar {
            width: 220px;
            background: #34495e;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }

        .sidebar h3 {
            margin-top: 0;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <div class="navbar">
        <div class="left">
            <strong>CV. Montana Intercontinental</strong>

            @auth
                @if(auth()->user()->role == 'gudang')
                    <a href="/dashboard-gudang">Dashboard Gudang</a>
                @elseif(auth()->user()->role == 'sales')
                    <a href="/dashboard-sales">Dashboard Sales</a>
                @endif
            @endauth
        </div>

        <div class="right">
            @auth
                <span>
                    {{ auth()->user()->nama }}
                    <span class="badge">{{ auth()->user()->role }}</span>
                </span>

                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button class="logout-btn" type="submit">Logout</button>
                </form>
            @endauth
        </div>
    </div>

    {{-- KONTEN --}}
    <div class="container">

        {{-- SIDEBAR GUDANG --}}
        @auth
            @if(auth()->user()->role == 'gudang')
                <div class="sidebar">
                    <h3>Menu Gudang</h3>

                    <a href="/dashboard-gudang">Dashboard</a>
                    <a href="/barang">Data Barang</a>
                    <a href="/barang/tambah">Tambah Barang</a>
                    <a href="/supplier">Supplier</a>
                    <a href="/log-aktivitas">Log Aktivitas</a>
                </div>
            @endif
        @endauth

        {{-- SIDEBAR SALES --}}
        @auth
            @if(auth()->user()->role == 'sales')
                <div class="sidebar">
                    <h3>Menu Sales</h3>

                    <a href="/dashboard-sales">Dashboard</a>
                    <a href="/transaksi/tambah">Transaksi Baru</a>
                    <a href="/transaksi">Riwayat Transaksi</a>
                </div>
            @endif
        @endauth

        {{-- KONTEN UTAMA --}}
        <div class="main-content">
            @yield('content')
        </div>

    </div>


</body>
</html>
