<!-- app/Views/layout/navbar.php -->

<style>
    nav {
        background-color: #333;
        overflow: hidden;
        padding: 10px 20px;
    }

    nav a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 10px 16px;
        text-decoration: none;
        font-size: 16px;
        transition: 0.3s;
    }

    nav a:hover {
        background-color: #575757;
        color: white;
    }

    nav a.right {
        float: right;
    }

    @media screen and (max-width: 600px) {
        nav a {
            float: none;
            display: block;
            text-align: left;
        }

        nav a.right {
            float: none;
        }
    }
</style>

<nav>

    <?php if (session()->get('logged_in')): ?>
        <?php if (session()->get('role') === 'admin'): ?>
            <a href="/admin/dashboard">Dashboard Admin</a>
            <a href="/admin/verifikasi_foto">Verifikasi Foto</a>
        <?php else: ?>
            <a href="/b">Upload Bukti Foto</a>
            <a href="/spin">Spin</a>
        <?php endif; ?>
        <a href="/logout" class="right">Logout</a>
    <?php else: ?>
        <a href="/" class="right">Login</a>
    <?php endif; ?>
</nav>
