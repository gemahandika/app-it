<?php

if (!empty($kembali)) : ?>
    <?php $no = 1;
    foreach ($kembali as $kembali) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="small text-center"><?= $kembali['type'] ?></td>
            <td class="small text-center"><?= $kembali['serial_number'] ?></td>
            <td class="small text-center"><?= $kembali['nama_counter'] ?></td>
            <td class="small text-center"><?= $kembali['cust_id'] ?></td>
            <td class="small text-center"><?= $kembali['status'] ?></td>
            <td class="small text-center"><?= $kembali['keterangan'] ?></td>
            <td class="small text-center"><?= $kembali['date_service'] ?></td>
            <td class="small text-center"><?= $kembali['remaks'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="42" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>