<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload Bukti Foto</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-red-500 via-yellow-400 to-yellow-300">

  <form action="<?= base_url('kirim_foto') ?>" method="post" enctype="multipart/form-data"
        class="w-full max-w-md bg-white/20 backdrop-blur-sm rounded-xl shadow-lg p-6 text-center space-y-4">

    <!-- Logo -->
    <img src="<?= base_url('img/nobgsobar.png') ?>" alt="Logo" class="w-1/2 sm:w-1/4 md:w-60 mx-auto max-w-full h-auto" />

    <!-- Judul -->
    <h2 class="text-white font-bold text-lg bg-black py-2 rounded-lg">UPLOAD BUKTI FOTO</h2>

    <!-- Container Preview -->
    <div id="previewContainer" class="hidden rounded-md h-48 w-full flex items-center justify-center overflow-hidden">
      <img id="previewImage" class="object-contain max-h-full max-w-full" />
    </div>

    <!-- Tombol Upload (di awal) -->
    <div id="uploadButtonTop" class="flex items-center gap-2 w-full justify-center">
      <label for="fileInput"
        class="cursor-pointer flex items-center gap-2 px-4 py-2 bg-white rounded-lg border-2 border-black font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0l-4 4m4-4l4 4" />
        </svg>
        PILIH FOTO
      </label>
      <input type="file" name="foto" id="fileInput" accept="image/*" class="hidden" required />
    </div>

    <!-- Tombol Upload (setelah gambar dipilih) -->
    <div id="uploadButtonBottom" class="hidden flex items-center gap-2 w-full justify-center">
      <label for="fileInput"
        class="cursor-pointer flex items-center gap-2 px-4 py-2 bg-white rounded-lg border-2 border-black font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0l-4 4m4-4l4 4" />
        </svg>
        GANTI FOTO
      </label>
    </div>

    <!-- Deskripsi -->
    <div class="text-left">
      <label for="deskripsi" class="text-sm font-bold text-black">Deskripsi:</label>
      <textarea name="deskripsi" id="deskripsi" rows="3" maxlength="500"
        placeholder="Masukkan deskripsi atau komentar"
        class="mt-1 w-full p-3 rounded-lg resize-none text-sm text-black bg-white border-2 border-yellow-300 
               focus:outline-none focus:ring-0 focus:shadow-lg focus:shadow-black/50"></textarea>
    </div>

    <!-- Tombol Kirim -->
    <button type="submit" class="w-full py-3 text-white font-bold rounded-lg bg-blue-600 hover:bg-blue-700">
      KIRIM FOTO
    </button>

    <a href="<?= base_url('logout') ?>" class="text-red-700 hover:text-red-900 underline">Logout</a>
  </form>

  <script>
    const fileInput = document.getElementById('fileInput');
    const previewImage = document.getElementById('previewImage');
    const previewContainer = document.getElementById('previewContainer');
    const uploadButtonTop = document.getElementById('uploadButtonTop');
    const uploadButtonBottom = document.getElementById('uploadButtonBottom');

    fileInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImage.src = e.target.result;
          previewContainer.classList.remove('hidden');
          uploadButtonTop.classList.add('hidden');
          uploadButtonBottom.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      } else {
        previewImage.src = '';
        previewContainer.classList.add('hidden');
        uploadButtonTop.classList.remove('hidden');
        uploadButtonBottom.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
