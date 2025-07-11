<main>
    <div class="container-fluid px-4">
        <h5 class="mt-4 fw-bold" style="border-bottom: 1px solid black;">Data User Hybrid</h5>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-end align-items-center">
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

                <!-- <div class="d-flex flex-wrap gap-2">
                    <form action="<?= BASE_URL ?>/karyawan_resign/importResign" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file_excel" accept=".xls,.xlsx,.csv" required>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-upload"></i> Upload Data
                        </button>
                    </form>
                    <form id="formExportKaryawan" method="POST" action="<?= BASE_URL ?>/karyawan_resign/export">
                        <input type="hidden" name="section" id="export_section">
                        <input type="hidden" name="gen" id="export_gen">
                        <input type="hidden" name="usia" id="export_usia">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> Download
                        </button>
                    </form>
                    <a href="<?= BASE_URL ?>/karyawan_resign/templateResign" class="btn btn-secondary btn-sm">
                        <i class="fa fa-file-excel-o"></i> Download Template Excel
                    </a>
                </div> -->
            </div>
            <!-- <div class="filter-wrapper position-relative" style="z-index: 1;">
                <form id="filterForm" class="row card-header g-3 mb-2 gap-2">
                    <div class="col-md-3">
                        <label for="filter_section_resign" class="form-label">Filter Section</label>
                        <select id="filter_section_resign" class="form-select select2 filter-karyawan-resign">
                            <option value="">-- Pilih Section --</option>
                            <?php foreach ($list_section as $s): ?>
                                <option value="<?= $s['section'] ?>"><?= $s['section'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter_gen_resign" class="form-label">Filter Gen</label>
                        <select id="filter_gen_resign" class="form-select select2 filter-karyawan-resign">
                            <option value="">-- Pilih Gen --</option>
                            <?php foreach ($list_gen as $g): ?>
                                <option value="<?= $g['gen'] ?>"><?= $g['gen'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter_usia_resign" class="form-label">Filter Usia</label>
                        <select id="filter_usia_resign" class="form-select select2 filter-karyawan-resign">
                            <option value="">-- Pilih Usia --</option>
                            <?php foreach ($list_usia as $u): ?>
                                <option value="<?= $u['usia'] ?>"><?= $u['usia'] ?> TAHUN</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <a href="<?= BASE_URL; ?>/karyawan_resign" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div> -->
            <div id="karyawanResultResign"></div>

            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-cantik text-white">
                                <th class="small text-center">NO</th>
                                <th class="small text-center">ACTION</th>
                                <th class="small text-center">USER ID</th>
                                <th class="small text-center">PASSWORD</th>
                                <th class="small text-center">FULLNAME</th>
                                <th class="small text-center">NAMA AGEN & KP</th>
                                <th class="small text-center">NIK</th>
                                <th class="small text-center">CUST ID</th>
                                <th class="small text-center">USER ORIGIN</th>
                                <th class="small text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="karyawanResult">
                            <?php
                            extract($data);
                            require_once '../app/views/user_hybrid/_partial_tabel_user_hybrid.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Edit User Hybrid -->
                <div class="modal fade" id="modalEditUserHybrid" tabindex="-1" aria-labelledby="modalEditUserHybridLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/user_hybrid/editUserHybrid" id="formEditUserHybrid" method="POST">
                                <div class="modal-header bg-ungu text-white">
                                    <h6 class="modal-title" id="modalEditUserHybridLabel">Edit Data User Hybrid</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_hybrid" id="edit-idHybrid">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="nama_counter" class="form-label fw-bold">Nama Counter : </label>
                                            <select class="form-select" name="nama_counter" id="edit-nama_counter" required>
                                                <?php foreach ($data['counter'] as $row): ?>
                                                    <option value="<?= $row['nama_counter']; ?>"><?= $row['nama_counter']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="user_id" class="form-label fw-bold">User ID</label>
                                            <input class="form-control text-dark" type="text" name="user_id" id="edit-user_id" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="password" class="form-label fw-bold">Password</label>
                                            <input class="form-control" type="text" name="password" id="edit-password">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="username" class="form-label fw-bold">Fullname</label>
                                            <input class="form-control" type="text" name="username" id="edit-username">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="nik" class="form-label fw-bold">Nik</label>
                                            <input class="form-control" type="text" name="nik" id="edit-nik">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID</label>
                                            <input class="form-control" type="text" name="cust_id" id="edit-cust_id">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="status" class="form-label fw-bold">Status</label>
                                            <select class="form-select" name="status" id="edit-status" required>
                                                <option value="AGEN">AGEN</option>
                                                <option value="GERAI">GERAI</option>
                                                <option value="CABANG UTAMA">CABANG UTAMA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn bg-ungu button1-hover text-white">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>