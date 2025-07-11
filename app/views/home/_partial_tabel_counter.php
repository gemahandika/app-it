<?php

if (!empty($counter)) : ?>
    <?php $no = 1;
    foreach ($counter as $counter) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="small text-center"><?= $counter['nama_counter'] ?></td>
            <td class="small text-center"><?= $counter['status'] ?></td>
            <td class="small text-center"><?= $counter['pic'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="42" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>