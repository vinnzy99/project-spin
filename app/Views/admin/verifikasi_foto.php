<?= $this->include('admin/layout/navbar') ?>

<h2>Verifikasi Bukti Foto</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div style="color: green;"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div style="color: red;"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<?php if (empty($fotos)): ?>
    <p>Tidak ada bukti foto yang perlu diverifikasi.</p>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%;border-collapse: collapse;">
        <thead style="background:#f5f5f5;">
            <tr>
                <th>ID</th>
                <th>No Agen</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fotos as $foto): ?>
                <tr>
                    <td><?= esc($foto->id) ?></td>
                    <td><?= esc($foto->no_agen) ?></td>
                    <td><?= esc($foto->deskripsi) ?></td>
                    <td>
                        <img src="/<?= esc($foto->path_foto) ?>" alt="Foto" width="100">
                    </td>
                    <td>
                        <form action="/admin/set-verifikasi" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= esc($foto->id) ?>">
                            <input type="hidden" name="aksi" value="terima">
                            <button type="submit" style="background:green;color:white;padding:5px 10px;">Terima</button>
                        </form>

                        <form action="/admin/set-verifikasi" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= esc($foto->id) ?>">
                            <input type="hidden" name="aksi" value="tolak">
                            <button type="submit" style="background:red;color:white;padding:5px 10px;">Tolak</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
