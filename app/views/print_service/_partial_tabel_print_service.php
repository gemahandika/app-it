<?php

if (!empty($printer)) : ?>
    <?php $no = 1;
    foreach ($printer as $printer) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="d-flex gap-2">
                <button class="btn bg-ungu button1-hover text-white btn-sm btn-editPrintService" data-id="<?= $printer['id_printer']; ?>">
                    <i class="fa fa-edit"></i> Edit
                </button>
            </td>
            <td class="small text-center"><?= $printer['type'] ?></td>
            <td class="small text-center"><?= $printer['serial_number'] ?></td>
            <td class="small text-center"><?= $printer['nama_counter'] ?></td>
            <td class="small text-center"><?= $printer['cust_id'] ?></td>
            <td class="small text-center"><?= $printer['status'] ?></td>
            <td class="small text-center"><?= $printer['keterangan'] ?></td>
            <td class="small text-center"><?= $printer['date_service'] ?></td>
            <td class="small text-center"><?= $printer['remaks'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="42" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>