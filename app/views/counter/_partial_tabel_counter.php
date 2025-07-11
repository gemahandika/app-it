<?php

if (!empty($counter)) : ?>
    <?php $no = 1;
    foreach ($counter as $counter) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="d-flex gap-2">
                <button class="btn bg-ungu text-white  button1-hover btn-sm btn-tutupCounter" data-id="<?= $counter['id_counter']; ?>">
                    <i class="fa fa-lock"></i> Tutup
                </button>
                <button class="btn btn-success btn-sm btn-editCounter" data-id="<?= $counter['id_counter']; ?>">
                    <i class="fa fa-edit"></i> Edit
                </button>
                <button class="btn btn-primary btn-sm btn-createUser" data-id="<?= $counter['id_counter']; ?>">
                    <i class="fa fa-plus"></i> User
                </button>
            </td>
            <td class="small text-center"><?= $counter['kategori'] ?></td>
            <td class="small text-center"><?= $counter['cabang_counter'] ?></td>
            <td class="small text-center"><?= $counter['nama_counter'] ?></td>
            <td class="small text-center"><?= $counter['cust_id'] ?></td>
            <td class="small text-center"><?= $counter['pic'] ?></td>
            <td class="small text-center"><?= $counter['phone'] ?></td>
            <td class="small text-center"><?= $counter['sistem'] ?></td>
            <td class="small text-center"><?= $counter['printer'] ?></td>
            <td class="small text-left"><?= $counter['datekey'] ?></td>
            <td class="small text-center"><?= $counter['status'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="42" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>