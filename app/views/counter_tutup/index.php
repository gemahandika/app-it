<main>
    <div class="container-fluid px-4">
        <h5 class="mt-4 fw-bold" style="border-bottom: 1px solid black;">Data Agen & KP Tutup</h5>
        <div class="card mb-4 mt-4">
            <div class="row border-bottom p-2">
                <!-- <div class="d-flex flex-wrap gap-4 mb-3">
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-rocket text-primary"></i>
                        <span class="fw-semibold">Induction:</span>
                        <span class="text-dark"><b><?= $jumlah_training['induction']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-heart text-danger"></i>
                        <span class="fw-semibold">Service by Heart:</span>
                        <span class="text-dark"><b><?= $jumlah_training['service']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-shield-alt text-info"></i>
                        <span class="fw-semibold">Code of Conduct:</span>
                        <span class="text-dark"><b><?= $jumlah_training['codeofconduct']; ?></b></span>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-lightbulb text-success"></i>
                        <span class="fw-semibold">Vision & Strategy:</span>
                        <span class="text-dark"><b><?= $jumlah_training['vmts']; ?></b></span>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-graduation-cap text-primary"></i>
                        <span class="fw-semibold">Profesi SCO:</span>
                        <span class="text-dark"><b><?= $jumlah_training['sco']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-user-tie text-info"></i>
                        <span class="fw-semibold">Profesi Sales:</span>
                        <span class="text-dark"><b><?= $jumlah_training['sales']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-box text-danger"></i>
                        <span class="fw-semibold">Kurir Dev. Program:</span>
                        <span class="text-dark"><b><?= $jumlah_training['jsc']; ?></b></span>
                    </div>
                </div> -->

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
            <div id="karyawanResultResign"></div>

            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-ungu text-white">
                                <th class="small text-center">NO</th>
                                <th class="small text-center">ACTION</th>
                                <th class="small text-center">KATEGORI</th>
                                <th class="small text-center">CABANG</th>
                                <th class="small text-center">NAMA AGEN & KP</th>
                                <th class="small text-center">CUST ID</th>
                                <th class="small text-center">TGL TUTUP</th>
                                <th class="small text-center">KETERANGAN TUTUP</th>
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
                            require_once '../app/views/counter_tutup/_partial_tabel_counter_tutup.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Edit Counter tutup-->
                <div class="modal fade" id="modalCounterTutup" tabindex="-1" aria-labelledby="modalCounterTutupLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/counter_tutup/editCounterTutup" id="formCounterTutup" method="POST">
                                <div class="modal-header bg-ungu text-white">
                                    <h6 class="modal-title" id="modalCounterTutupLabel">EDIT DATA TRAINING</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_counter" id="edit-idCounterTutup">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="nama_counter" class="form-label fw-bold">Nama Agen & KP</label>
                                            <input class="form-control text-dark fw-bold" style="background-color: rgba(107, 245, 144, 0.3);" type="text" name="nama_counter" id="edit-nama_counter" required readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="cust_id" class="form-label fw-bold">Cust ID</label>
                                            <input class="form-control text-dark fw-bold" style="background-color: rgba(107, 245, 144, 0.3);" type="text" name="cust_id" id="edit-cust_id" required readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="tgl_tutup" class="form-label fw-bold">Tanggal Tutup</label>
                                            <input class="form-control text-dark" type="date" name="tgl_tutup" id="edit-tgl_tutup">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="ket_tutup" class="form-label fw-bold">Keterangan Tutup</label>
                                            <input class="form-control text-dark" type="text" name="ket_tutup" id="edit-ket_tutup">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="status" class="form-label fw-bold">Status</label>
                                            <select class="form-select" name="status" id="edit-status">
                                                <option value="TUTUP">TUTUP</option>
                                                <option value="AGEN">AGEN</option>
                                                <option value="GERAI">GERAI</option>
                                                <option value="CABANG UTAMA">CABANG UTAMA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn bg-ungu text-white button1-hover">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>