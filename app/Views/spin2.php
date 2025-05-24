<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Spin Wheel</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/spin2.css') ?>" />
</head>
<body>
<!-- <input type="text" id="indexId" value="<?= session()->get('noAgen') ?>"></input> -->
  <div class="wrapper">
    <p class="judul">SPIN WHEEL</p>
    <!-- Pointer Panah -->
    <!-- <span class="panah"></span> -->

    <!-- Roda Spin -->
    <div class="container" id="wheel">
      <!-- Segmen akan di-generate oleh JavaScript -->
    </div>

    <!-- Tombol Spin -->
    <button id="spin">SPIN</button>
  </div>
  <p class="text-white mt-4 font-bold text-lg">Sisa Spin: <?= $turn_left ?></p>
  <p id="totalSpin" hidden><?= $total_spin ?? 0 ?></p>
      
  <script src="<?= base_url('assets/js/spin2.js') ?>"></script>
</body>
</html>
