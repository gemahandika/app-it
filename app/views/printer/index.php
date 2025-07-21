<main>
    <div class="container-fluid px-4">
        <h5 class="mt-4 fw-bold" style="border-bottom: 1px solid black;">Data Printer Label</h5>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn bg-cantik text-white btn-sm button-cantik" data-bs-toggle="modal" data-bs-target="#modalTambahPrinter">
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

                <!-- <div class="d-flex flex-wrap gap-2">
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
                </div> -->
            </div>
            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-cantik text-white">
                                <th class="small text-center">NO</th>
                                <th class="small text-center">ACTION</th>
                                <th class="small text-center">TYPE</th>
                                <th class="small text-center">SERIAL NUMBER</th>
                                <th class="small text-center">NAMA AGEN & KP</th>
                                <th class="small text-center">CUST ID</th>
                                <th class="small text-center">STATUS</th>
                                <th class="small text-center">KETERANGAN</th>
                                <th class="small text-center">DATE DISTRIBUSI</th>
                                <th class="small text-center">REMAKS</th>

                            </tr>
                        </thead>
                        <tbody id="karyawanResult">
                            <?php
                            extract($data);
                            require_once '../app/views/printer/_partial_tabel_printer.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tanbah -->
                <div class="modal fade" id="modalTambahPrinter" tabindex="-1" aria-labelledby="modalTambahPrinterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/printer/tambah" id="formTambahPrinter" method="POST">
                                <div class="modal-header bg-cantik text-white">
                                    <h5 class="modal-title" id="modalTambahPrinterLabel">Tambah Data Printer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_counter" class="form-label fw-bold">Nama Agen / Kp : </label>
                                            <select class="form-select" name="nama_counter" id="tambah-nama_counter" required>
                                                <option value="Pilih Agen / Kp">- Pilih Data -</option>
                                                <?php foreach ($data['counter'] as $row): ?>
                                                    <option value="<?= $row['nama_counter']; ?>"><?= $row['nama_counter']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID :</label>
                                            <input type="text" name="cust_id" id="tambah-cust_id" class="form-control" style="background-color: rgba(145, 53, 220, 0.3);" required readonly>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="serial_number" class="form-label fw-bold">Serial Number :</label>
                                            <select class="form-select" name="serial_number" id="tambah-serial_number" required>
                                                <option value="">- Pilih Serial Number-</option>
                                                <?php foreach ($data['sn'] as $row): ?>
                                                    <option value="<?= $row['serial_number']; ?>"><?= $row['serial_number']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="type" class="form-label fw-bold">Type :</label>
                                            <input type="text" name="type" id="tambah-type" class="form-control" style="background-color: rgba(145, 53, 220, 0.3);" required readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="keterangan" class="form-label fw-bold">Keterangan :</label>
                                            <select class="form-select" name="keterangan" id="tambah-keterangan" required>
                                                <option value="di Agen">di Agen</option>
                                                <option value="di Kp & Opr">di Kp & Opr</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label fw-bold">Status :</label>
                                            <input type="text" name="status" id="tambah-status" class="form-control" style="background-color: rgba(145, 53, 220, 0.3);" required readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="date_distribusi" class="form-label fw-bold">Tanggal Distribusi :</label>
                                            <input type="date" name="date_distribusi" id="tambah-date_distribusi" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="remaks" class="form-label fw-bold">Remaks :</label>
                                            <input type="text" name="remaks" id="tambah-remaks" class="form-control" min="0" required>
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

                <!-- Modal EDIT -->
                <div class="modal fade" id="modalEditPrinter" tabindex="-1" aria-labelledby="modalEditPrinterLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/printer/editPrinter" id="formEditPrinter" method="POST">
                                <div class="modal-header bg-cantik text-white">
                                    <h5 class="modal-title" id="modalEditPrinterLabel">Edit Data Printer</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_printer" id="edit-id_printer" readonly required>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="type" class="form-label fw-bold">Type :</label>
                                            <select class="form-select" name="type" id="edit-type" required>
                                                <option value="OX-130">OX-130</option>
                                                <option value="CP-2240">CP-2240</option>
                                                <option value="OS-200">OS-200</option>
                                                <option value="OS-241NU">OS-241NU</option>
                                                <option value="LAINNYA">LAINNYA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="serial_number" class="form-label fw-bold">Serial Number :</label>
                                            <input type="text" name="serial_number" id="edit-serial_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nama_counter" class="form-label fw-bold">Nama Agen / Kp : </label>
                                            <select class="form-select" name="nama_counter" id="edit-nama_counter" required>
                                                <option value="Pilih Agen / Kp">- Pilih Data -</option>
                                                <?php foreach ($data['counter'] as $row): ?>
                                                    <option value="<?= $row['nama_counter']; ?>"><?= $row['nama_counter']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID :</label>
                                            <input type="text" name="cust_id" id="edit-cust_id" class="form-control" style="background-color: rgba(145, 53, 220, 0.3);" required readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label fw-bold">Status :</label>
                                            <select class="form-select" name="status" id="edit-status" required>
                                                <option value="di Pinjamkan">di Pinjamkan</option>
                                                <option value="Pribadi">Pribadi</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="keterangan" class="form-label fw-bold">Keterangan :</label>
                                            <select class="form-select" name="keterangan" id="edit-keterangan" required>
                                                <option value="di Agen">di Agen</option>
                                                <option value="di Kp & Opr">di Kp & Opr</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="date_distribusi" class="form-label fw-bold">Tanggal Distribusi :</label>
                                            <input type="date" name="date_distribusi" id="edit-date_distribusi" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="remaks" class="form-label fw-bold">Remaks :</label>
                                            <input type="text" name="remaks" id="edit-remaks" class="form-control" min="0" required>
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