<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bake&Bite</title>
    <style>
        body, h1, h2, h3, p, ul, li { margin: 0; padding: 0; font-family: sans-serif; }

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

        .btn { padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; cursor: pointer; border: none; font-size: 14px; }
        .btn-edit { background: #ffc107; }
        .btn-delete { background: #dc3545; }
        .btn-secondary { background: #6c757d; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #f9f9f9; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%; padding: 10px; box-sizing: border-box;
            border: 1px solid #ccc; border-radius: 5px;
        }

        .alert-success {
            background: #d4edda; color: #155724; padding: 10px 15px;
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
                Admin Panel
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
