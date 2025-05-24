<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
 <style>
  .text-shadow {
    text-shadow: 2px 2px 2px  rgba(0, 0, 0, 0.5);
  }
</style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-red-500 via-yellow-400 to-yellow-300">

  <div class="w-full max-w-md bg-white/20 backdrop-blur-sm rounded-xl shadow-lg p-6 text-center space-y-3">
    
    <!-- Logo -->
    <img src="<?= base_url('img/nobgsobar.png') ?>" alt="Logo" class="w-1/2 sm:w-1/4 md:w-60 mx-auto max-w-full h-auto "/>

    <!-- Judul -->
    <h2 class=" text-4xl text-orange-500 font-extrabold text-shadow">
  Register
</h2>



    <!-- Form Login -->
    <form class="space-y-4" action="#" method="POST">
      <!-- Username -->
      <div class="text-left">
        <label for="username" class="block text-sm font-bold text-black mb-1">Username:</label>
        <input type="text" id="username" name="username" required
               class="w-full p-3 rounded-lg bg-white/ backdrop-blur-sm text-black placeholder-gray-700 text-sm border-2 border-gray-300" 
               placeholder="Masukkan username">
      </div>

    <div class="text-left">
        <label for="email" class="block text-sm font-bold text-black mb-1">Email:</label>
        <input type="text" id="email" name="email" required
               class="w-full p-3 rounded-lg bg-white/ backdrop-blur-sm text-black placeholder-gray-700 text-sm border-2 border-gray-300" 
               placeholder="Masukkan email">
      </div>

      <!-- Password -->
      <div class="text-left">
        <label for="password" class="block text-sm font-bold text-black mb-1">Password:</label>
        <input type="password" id="password" name="password" required
               class="w-full p-3 rounded-lg bg-white backdrop-blur-sm text-black placeholder-gray-700 text-sm border-2 border-gray-300"
               placeholder="Masukkan password">
      </div>

      <!-- Tombol Login -->
      <button type="submit"
              class="w-full mt-4 py-2 text-white font-bold rounded-lg bg-blue-500 backdrop-blur-sm hover:bg-blue-700 transition">
        REGISTER
      </button>

      <p class="text-sm">Sudah punya akun?<a href="<?= base_url('login') ?>" class="hover:text-blue-500 underline">Login Here</a></p>
    </form>
  </div>

</body>
</html>
