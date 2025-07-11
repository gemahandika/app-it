<main>
    <div class="container-fluid px-4">
        <h5 class="mt-4 fw-bold" style="border-bottom: 1px solid black;">Data Agen & KP</h5>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn bg-cantik text-white btn-sm button-cantik" data-bs-toggle="modal" data-bs-target="#modalTambahCounter">
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

                <div class="d-flex flex-wrap gap-2">
                    <form id="formExportKaryawan" method="POST" action="<?= BASE_URL ?>/counter/export">
                        <input type="hidden" name="section" id="export_section">
                        <input type="hidden" name="gen" id="export_gen">
                        <input type="hidden" name="usia" id="export_usia">
                        <button type="submit" class="btn bg-cantik text-white btn-sm button-cantik">
                            <i class="fa fa-download"></i> Download
                        </button>
                    </form>
                    <form action="<?= BASE_URL ?>/counter/import" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file_excel" accept=".xls,.xlsx,.csv" required>
                        <button type="submit" class="btn bg-cantik text-white btn-sm button-cantik">
                            <i class="fa fa-upload"></i> Upload Data
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-cantik text-white">
                                <th class="small text-center">NO</th>
                                <th class="small text-center">ACTION</th>
                                <th class="small text-center">KATEGORI</th>
                                <th class="small text-center">CABANG</th>
                                <th class="small text-center">NAMA AGEN & KP</th>
                                <th class="small text-center">CUST ID</th>
                                <th class="small text-center">PIC</th>
                                <th class="small text-center">PHONE</th>
                                <th class="small text-center">SISTEM</th>
                                <th class="small text-center">PRINTER</th>
                                <th class="small text-center">DATEKEY</th>
                                <th class="small text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody id="karyawanResult">
                            <?php
                            extract($data);
                            require_once '../app/views/counter/_partial_tabel_counter.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tanbah -->
                <div class="modal fade" id="modalTambahCounter" tabindex="-1" aria-labelledby="modalTambahCounterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/counter/tambah" id="formTambahCounter" method="POST">
                                <div class="modal-header bg-cantik text-white">
                                    <h5 class="modal-title" id="modalTambahCounterLabel">Tambah Data Counter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kategori" class="form-label fw-bold">Kategori :</label>
                                            <select class="form-select" name="kategori" id="tambah-kategori" required>
                                                <option value="MES 1">MES 1</option>
                                                <option value="MES 2">MES 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cabang_counter" class="form-label fw-bold">Cabang : </label>
                                            <select class="form-select" name="cabang_counter" id="tambah-cabang" required>
                                                <?php foreach ($data['cabang'] as $row): ?>
                                                    <option value="<?= $row['nama_cabang']; ?>"><?= $row['nama_cabang']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_counter" class="form-label fw-bold">Nama Agen & KP :</label>
                                            <input type="text" name="nama_counter" id="tambah-counter" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID :</label>
                                            <input type="text" name="cust_id" id="tambah-cust_id" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pic" class="form-label fw-bold">PIC :</label>
                                            <input type="text" name="pic" id="tambah-pic" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label fw-bold">Phone :</label>
                                            <input type="text" name="phone" id="tambah-phone" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="sistem" class="form-label fw-bold">Sistem :</label>
                                            <select class="form-select" name="sistem" id="tambah-sistem" required>
                                                <option value="HYBRID">HYBRID</option>
                                                <option value="MEC">MEC</option>
                                                <option value="OFFLINE">OFFLINE</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="printer" class="form-label fw-bold">Printer :</label>
                                            <input type="number" name="printer" id="tambah-printer" class="form-control" min="0" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="datekey" class="form-label fw-bold">Datekey :</label>
                                            <input type="date" name="datekey" id="tambah-datekey" class="form-control" min="0" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label fw-bold">Status :</label>
                                            <select class="form-select" name="status" id="tambah-status" required>
                                                <option value="AGEN">AGEN</option>
                                                <option value="GERAI">GERAI</option>
                                                <option value="CABANG UTAMA">CABANG UTAMA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn bg-cantik text-white button-cantik">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEditCounter" tabindex="-1" aria-labelledby="modalEditCounterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/counter/edit" id="formEditCounter" method="POST">
                                <div class="modal-header bg-cantik text-white">
                                    <h5 class="modal-title" id="modalEditCounterLabel">Edit Data Counter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_counter" id="edit-idCounter">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kategori" class="form-label fw-bold">Kategori :</label>
                                            <select class="form-select" name="kategori" id="edit-kategori" required>
                                                <option value="MES 1">MES 1</option>
                                                <option value="MES 2">MES 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cabang_counter" class="form-label fw-bold">Cabang : </label>
                                            <select class="form-select" name="cabang_counter" id="edit-cabang" required>
                                                <?php foreach ($data['cabang'] as $row): ?>
                                                    <option value="<?= $row['nama_cabang']; ?>"><?= $row['nama_cabang']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_counter" class="form-label fw-bold">Nama Agen & KP :</label>
                                            <input type="text" name="nama_counter" id="edit-counter" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID :</label>
                                            <input type="text" name="cust_id" id="edit-cust_id" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pic" class="form-label fw-bold">PIC :</label>
                                            <input type="text" name="pic" id="edit-pic" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label fw-bold">Phone :</label>
                                            <input type="text" name="phone" id="edit-phone" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="sistem" class="form-label fw-bold">Sistem :</label>
                                            <select class="form-select" name="sistem" id="edit-sistem" required>
                                                <option value="HYBRID">HYBRID</option>
                                                <option value="MEC">MEC</option>
                                                <option value="OFFLINE">OFFLINE</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="printer" class="form-label fw-bold">Printer :</label>
                                            <input type="number" name="printer" id="edit-printer" class="form-control" min="0" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="datekey" class="form-label fw-bold">Datekey :</label>
                                            <input type="date" name="datekey" id="edit-datekey" class="form-control" min="0" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label fw-bold">Status :</label>
                                            <select class="form-select" name="status" id="tambah-status" required>
                                                <option value="AGEN">AGEN</option>
                                                <option value="GERAI">GERAI</option>
                                                <option value="CABANG UTAMA">CABANG UTAMA</option>
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

                <!-- Modal Tutup Counter -->
                <div class="modal fade" id="modalTutupCounter" tabindex="-1" aria-labelledby="modalTutupCounterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/counter/tutup" id="formTutupCounter" method="POST">
                                <div class="modal-header bg-cantik text-white">
                                    <h5 class="modal-title" id="modalTutupCounterLabel">TUTUP AGEN & KP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_counter" id="tutup-idCounter">
                                    <div class="row flex-column">
                                        <div class="col-12 mb-3">
                                            <label for="counter" class="form-label fw-bold">Nama Counter</label>
                                            <input class="form-control fw-bold" type="text" name="counter" id="tutup-counter" style="background-color: rgba(145, 53, 220, 0.3);" readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="cabang" class="form-label fw-bold">Cabang</label>
                                            <input class="form-control fw-bold" type="text" name="cabang" id="tutup-cabang" style="background-color: rgba(145, 53, 220, 0.3);" readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID</label>
                                            <input class="form-control fw-bold" type="text" name="cust_id" id="tutup-cust_id" style="background-color: rgba(145, 53, 220, 0.3);" readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="tgltutup" class="form-label fw-bold">Tgl Tutup</label>
                                            <input class="form-control" type="date" name="tgltutup" id="tutup-tgl" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="kettutup" class="form-label fw-bold">Keterangan Tutup</label>
                                            <input class="form-control" type="text" name="kettutup" id="tutup-ket" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn bg-cantik button-cantik text-white">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah User -->
                <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateUserLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/user_hybrid/create" id="formCreateUser" method="POST">
                                <div class="modal-header bg-cantik text-white">
                                    <h5 class="modal-title" id="modalCreateUserLabel">Form Create User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_counter" id="create-idCounter">
                                    <div class="row flex-column">
                                        <div class="col-12 mb-3">
                                            <label for="nama_counter" class="form-label fw-bold">Nama Counter</label>
                                            <input class="form-control fw-bold" type="text" name="nama_counter" id="create-nama_counter" style="background-color: rgba(145, 53, 220, 0.3);" readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID</label>
                                            <input class="form-control fw-bold" type="text" name="cust_id" id="create-cust_id" style="background-color: rgba(145, 53, 220, 0.3);" readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="username" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input class="form-control fw-bold" type="text" name="username" id="create-username" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="user_id" class="form-label fw-bold">User ID <span class="text-danger">*</span></label>
                                            <input class="form-control fw-bold" type="text" name="user_id" id="create-user_id" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="password" id="create-password" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="nik" class="form-label fw-bold">NIK <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="nik" id="create-nik" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="status" class="form-label fw-bold">Status</label>
                                            <select class="form-select" name="status" id="create-status" required>
                                                <option value="AGEN">AGEN</option>
                                                <option value="GERAI">GERAI</option>
                                                <option value="CABANG UTAMA">CABANG UTAMA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn bg-cantik button-cantik text-white">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</main>