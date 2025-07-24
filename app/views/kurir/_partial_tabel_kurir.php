<?php

if (!empty($id_kurir)) : ?>
    <?php $no = 1;
    foreach ($id_kurir as $id_kurir) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="d-flex gap-2">
                <button class="btn bg-ungu button1-hover text-white btn-sm btn-editKurir" data-id="<?= $id_kurir['id_sca']; ?>">
                    <i class="fa fa-edit"></i> Edit
                </button>
            </td>
            <td class="small text-center"><?= $id_kurir['kurir_id'] ?></td>
            <td class="small text-center"><?= $id_kurir['password_sca'] ?></td>
            <td class="small text-center"><?= $id_kurir['fullname_sca'] ?></td>
            <td class="small text-center"><?= $id_kurir['nik_sca'] ?></td>
            <td class="small text-center"><?= $id_kurir['phone_sca'] ?></td>
            <td class="small text-center"><?= $id_kurir['zona_sca'] ?></td>
            <td class="small text-center"><?= $id_kurir['cabang_sca'] ?></td>
            <td class="small text-center"><?= $id_kurir['status_sca'] ?></td>
            <td class="small text-center"><?= $id_kurir['jobtask_sca'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="42" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>