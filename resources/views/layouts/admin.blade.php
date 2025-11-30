<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Admin Panel - Bake&Bite</title>
    <style>
        body, h1, h2, h3, p, ul, li { margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }

        body {
            background-color: #f4f7f6;
            color: #333;
        }

        .admin-layout {
            display: flex;
        }

        .admin-sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            min-height: 100vh;
        }
        .admin-sidebar-header {
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 1px solid #34495e;
            color: white;
        }
        .admin-sidebar-nav ul {
            list-style-type: none;
            margin-top: 20px;
        }
        .admin-sidebar-nav li a {
            display: block;
            padding: 15px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background 0.3s;
        }
        .admin-sidebar-nav li a:hover,
        .admin-sidebar-nav li a.active {
            background-color: #34495e;
            color: white;
        }

        .admin-content {
            flex-grow: 1;
            padding: 30px;
        }

        .btn { padding: 10px 18px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; cursor: pointer; border: none; font-size: 14px; }
        .btn-edit { background: #ffc107; }
        .btn-delete { background: #dc3545; }

        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        th, td { padding: 12px 15px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f9f9f9; }
        td img { max-width: 80px; border-radius: 5px; }

        .form-wrapper { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 12px; box-sizing: border-box;
            border: 1px solid #ccc; border-radius: 5px;
        }
        .form-group textarea { min-height: 120px; }

        .alert-success {
            background: #d4edda; color: #155724; padding: 15px;
            border-radius: 5px; margin-bottom: 20px;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="admin-layout">

        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                Bake&Bite
            </div>
            <nav class="admin-sidebar-nav">
                <ul>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="{{ Request::is('admin/products*') ? 'active' : '' }}">
                            Kelola Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                            Kelola Kategori
                        </a>
                    </li>
                    <li style="margin-top: 30px; border-top: 1px solid #34495e;">
                        <a href="{{ route('home') }}">Kembali ke Toko</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="admin-content">
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
