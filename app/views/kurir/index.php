<main>
    <div class="container-fluid px-4">
        <h5 class="mt-4 fw-bold" style="border-bottom: 1px solid black;">Data ID Kurir</h5>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn bg-ungu button1-hover text-white btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKurir">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                </div>
                <?php Flasher::flash(); ?>
                <?php if (isset($_SESSION['flash_stack'])): ?>
                    <?php foreach ($_SESSION['flash_stack'] as $flash): ?>
                        <script>
                            Swal.fire({
                                icon: '<?= $flash['tipe']; ?>',
                                title: '<?= $flash['pesan']; ?>',
                                text: '<?= $flash['aksi']; ?>',
                                confirmButtonText: 'Oke',
                                allowOutsideClick: false
                            });
                        </script>
                    <?php endforeach;
                    unset($_SESSION['flash_stack']); ?>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-ungu text-white">
                                <th class="small text-center">NO</th>
                                <th class="small text-center">ACTION</th>
                                <th class="small text-center">COURIER ID</th>
                                <th class="small text-center">PASSWORD</th>
                                <th class="small text-center">NAME</th>
                                <th class="small text-center">NIK</th>
                                <th class="small text-center">PHONE</th>
                                <th class="small text-center">ZONE</th>
                                <th class="small text-center">BRANCH</th>
                                <th class="small text-center">STATUS</th>
                                <th class="small text-center">JOBTASK</th>
                            </tr>
                        </thead>
                        <tbody id="karyawanResult">
                            <?php
                            extract($data);
                            require_once '../app/views/kurir/_partial_tabel_kurir.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="modalTambahKurir" tabindex="-1" aria-labelledby="modalTambahKurirLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/kurir/tambah" id="formTambahKurir" method="POST">
                                <div class="modal-header bg-ungu text-white">
                                    <h5 class="modal-title" id="modalTambahKurirLabel">Tambah Data Kurir</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kurir_id" class="form-label fw-bold">Courier ID :</label>
                                            <input type="text" name="kurir_id" id="tambah-kurir_id" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password_sca" class="form-label fw-bold">Password :</label>
                                            <input type="text" name="password_sca" id="tambah-password_sca" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fullname_sca" class="form-label fw-bold">Name : </label>
                                            <input type="text" name="fullname_sca" id="tambah-fullname_sca" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="nik_sca" class="form-label fw-bold">Nik :</label>
                                            <input type="text" name="nik_sca" id="tambah-nik_sca" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_sca" class="form-label fw-bold">Phone :</label>
                                            <input type="text" name="phone_sca" id="tambah-phone_sca" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="zona_sca" class="form-label fw-bold">Zone :</label>
                                            <input type="text" name="zona_sca" id="tambah-zona_sca" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cabang_sca" class="form-label fw-bold">Branch : </label>
                                            <select class="form-select" name="cabang_sca" id="tambah-cabang_sca" required>
                                                <option value="Pilih Branch">- Pilih Data -</option>
                                                <?php foreach ($data['cabang'] as $row): ?>
                                                    <option value="<?= $row['nama_cabang']; ?>"><?= $row['nama_cabang']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status_sca" class="form-label fw-bold">Status :</label>
                                            <select class="form-select" name="status_sca" id="edit-status_sca" required>
                                                <option value="AGEN">AGEN</option>
                                                <option value="KCU">KCU</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="jobtask_sca" class="form-label fw-bold">Jobtask :</label>
                                            <select class="form-select" name="jobtask_sca" id="edit-jobtask_sca" required>
                                                <option value="DELIVERY">DELIVERY</option>
                                                <option value="PICKUP">PICKUP</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn bg-ungu text-white button1-hover">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal EDIT -->
                <div class="modal fade" id="modalEditKurir" tabindex="-1" aria-labelledby="modalEditKurirLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/kurir/editKurir" id="formEditKurir" method="POST">
                                <div class="modal-header bg-cantik text-white">
                                    <h5 class="modal-title" id="modalEditKurirLabel">Edit Data Kurir</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_sca" id="edit-id_sca" readonly required>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kurir_id" class="form-label fw-bold">Courier ID :</label>
                                            <input type="text" name="kurir_id" id="edit-kurir_id" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password_sca" class="form-label fw-bold">Password :</label>
                                            <input type="text" name="password_sca" id="edit-password_sca" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="fullname_sca" class="form-label fw-bold">Name : </label>
                                            <input type="text" name="fullname_sca" id="edit-fullname_sca" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="nik_sca" class="form-label fw-bold">Nik :</label>
                                            <input type="text" name="nik_sca" id="edit-nik_sca" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone_sca" class="form-label fw-bold">Phone :</label>
                                            <input type="text" name="phone_sca" id="edit-phone_sca" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="zona_sca" class="form-label fw-bold">Zone :</label>
                                            <input type="text" name="zona_sca" id="edit-zona_sca" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cabang_sca" class="form-label fw-bold">Branch : </label>
                                            <select class="form-select" name="cabang_sca" id="edit-cabang_sca" required>
                                                <option value="Pilih Branch">- Pilih Data -</option>
                                                <?php foreach ($data['cabang'] as $row): ?>
                                                    <option value="<?= $row['nama_cabang']; ?>"><?= $row['nama_cabang']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status_sca" class="form-label fw-bold">Status :</label>
                                            <select class="form-select" name="status_sca" id="edit-status_sca" required>
                                                <option value="AGEN">AGEN</option>
                                                <option value="KCU">KCU</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="jobtask_sca" class="form-label fw-bold">Jobtask :</label>
                                            <select class="form-select" name="jobtask_sca" id="edit-jobtask_sca" required>
                                                <option value="DELIVERY">DELIVERY</option>
                                                <option value="PICKUP">PICKUP</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn bg-cantik text-white button-cantik">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</main>