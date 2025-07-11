<?php

if (!empty($user_hybrid)) : ?>
    <?php $no = 1;
    foreach ($user_hybrid as $user_hybrid) : ?>
        <tr>
            <td class="small text-center"><?= $no++ ?></td>
            <td class="d-flex p-2">
                <button class="btn bg-ungu button1-hover text-white btn-sm btn-editUserHybrid" data-id="<?= $user_hybrid['id_hybrid']; ?>">
                    <i class="fa fa-edit"></i> Edit
                </button>
            </td>
            <td class="small text-center"><?= $user_hybrid['user_id'] ?></td>
            <td class="small text-center"><?= $user_hybrid['password'] ?></td>
            <td class="small text-center"><?= $user_hybrid['username'] ?></td>
            <td class="small text-center"><?= $user_hybrid['nama_counter'] ?></td>
            <td class="small text-center"><?= $user_hybrid['nik'] ?></td>
            <td class="small text-center"><?= $user_hybrid['cust_id'] ?></td>
            <td class="small text-center"><?= $user_hybrid['user_origin'] ?></td>
            <td class="small text-center"><?= $user_hybrid['status'] ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="42" class="text-center">Tidak ada data tersedia</td>
    </tr>
<?php endif; ?>