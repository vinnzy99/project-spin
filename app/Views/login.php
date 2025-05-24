<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .text-shadow {
      text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-red-500 via-yellow-400 to-yellow-300">

  <div class="w-full max-w-md bg-white/20 backdrop-blur-sm rounded-xl shadow-lg p-6 text-center space-y-2">
    
    <!-- Logo -->
    <img src="<?= base_url('img/nobgsobar.png') ?>" alt="Logo" class="w-1/2 sm:w-1/4 md:w-60 mx-auto max-w-full h-auto" />

    <!-- Judul -->
    <h2 class="text-4xl text-orange-500 font-extrabold text-shadow py-4">
      LOGIN
    </h2>

  <!-- Pesan Error (hanya jika ada) -->
    <?php if (session()->getFlashdata('error') === 'Nomor telepon anda salah!'): ?>
      <div class="bg-red-600 text-white text-sm p-3 mb-4 rounded-lg shadow">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- Form Login -->
    <form class="space-y-4" action="<?= base_url('login') ?>" method="POST">

      <div class="text-left">
        <label for="no_agen" class="block text-sm font-bold text-black mb-1">No. Agen:</label>
        <input type="text" id="no_agen" name="no_agen" required
               class="w-full p-3 rounded-lg bg-white/ backdrop-blur-sm text-black placeholder-gray-700 text-sm border-2 border-gray-300"
               placeholder="Masukkan nomor agen" />
      </div>

      <div class="text-left">
        <label for="no_telp" class="block text-sm font-bold text-black mb-1">No. Telepon:</label>
        <input type="text" id="no_telp" name="no_telp" required
               class="w-full p-3 rounded-lg bg-white/ backdrop-blur-sm text-black placeholder-gray-700 text-sm border-2 border-gray-300"
               placeholder="Masukkan nomor telepon" />
      </div>

      <!-- Tombol Login -->
      <button type="submit"
              class="w-full py-2 text-white font-bold rounded-lg bg-blue-500 backdrop-blur-sm hover:bg-blue-700 transition">
        LOGIN
      </button>

    </form>
  </div>

</body>
</html>
