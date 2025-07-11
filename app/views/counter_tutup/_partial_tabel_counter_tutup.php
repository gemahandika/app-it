<?php

if (!empty($counter_tutup)) : ?>
    <?php $no = 1;
    foreach ($counter_tutup as $counter_tutup) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="d-flex p-2">
                <button class="btn bg-ungu button1-hover text-white btn-sm btn-counterTutup" data-id="<?= $counter_tutup['id_counter']; ?>">
                    <i class="fa fa-edit"></i> Edit
                </button>
            </td>
            <td class="small text-center"><?= $counter_tutup['kategori'] ?></td>
            <td class="small text-center"><?= $counter_tutup['cabang_counter'] ?></td>
            <td class="small text-center"><?= $counter_tutup['nama_counter'] ?></td>
            <td class="small text-center"><?= $counter_tutup['cust_id'] ?></td>
            <td class="small text-center"><?= $counter_tutup['tgl_tutup'] ?></td>
            <td class="small text-center"><?= $counter_tutup['ket_tutup'] ?></td>
            <td class="small text-center"><?= $counter_tutup['pic'] ?></td>
            <td class="small text-center"><?= $counter_tutup['phone'] ?></td>
            <td class="small text-center"><?= $counter_tutup['sistem'] ?></td>
            <td class="small text-center"><?= $counter_tutup['printer'] ?></td>
            <td class="small text-center"><?= $counter_tutup['datekey'] ?></td>
            <td class="small text-center"><?= $counter_tutup['status'] ?></td>

        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="17" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>