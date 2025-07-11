   <main>
       <div class="container-fluid px-4">
           <h5 class="mt-4 fw-bold" style="border-bottom: solid 1px black;">Dashboard</h5>
           <?php Flasher::flash();  ?>
           <div class="card mb-4 mt-4 pb-4" style="overflow: visible; z-index: 1">
               <form method=" GET" class="px-3 pt-3">
                   <div class="row g-3 align-items-end">

                       <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                           <label for="tgl_dari" class="form-label fw-bold">Year :</label>
                           <select id="branch" name="branch" class="form-select select2">
                               <option value="">-- All --</option>
                               <?php foreach ($data['branch_list'] as $row): ?>
                                   <option value="<?= $row['branch']; ?>" <?= isset($_GET['branch']) && $_GET['branch'] === $row['branch'] ? 'selected' : '' ?>>
                                       <?= $row['branch']; ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>
                       </div>

                       <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                           <label for="tgl_ke" class="form-label fw-bold">Category:</label>
                           <select id="branch" name="branch" class="form-select select2">
                               <option value="">-- All --</option>
                               <?php foreach ($data['kategori'] as $row): ?>
                                   <option value="<?= $row['kategori']; ?>" <?= isset($_GET['kategori']) && $_GET['kategori'] === $row['kategori'] ? 'selected' : '' ?>>
                                       <?= $row['kategori']; ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>
                       </div>

                       <div class="col-12 col-md-3 col-lg-2">
                           <label for="branch" class="form-label fw-bold">Location:</label>
                           <select id="branch" name="branch" class="form-select select2">
                               <option value="">-- All --</option>
                               <?php foreach ($data['branch_list'] as $row): ?>
                                   <option value="<?= $row['branch']; ?>" <?= isset($_GET['branch']) && $_GET['branch'] === $row['branch'] ? 'selected' : '' ?>>
                                       <?= $row['branch']; ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>
                       </div>
                       <div class="col-12 col-md-3 col-lg-2">
                           <label for="branch" class="form-label fw-bold">Status:</label>
                           <select id="branch" name="branch" class="form-select select2">
                               <option value="">-- All --</option>
                               <?php foreach ($data['branch_list'] as $row): ?>
                                   <option value="<?= $row['branch']; ?>" <?= isset($_GET['branch']) && $_GET['branch'] === $row['branch'] ? 'selected' : '' ?>>
                                       <?= $row['branch']; ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>
                       </div>
                       <div class="col-12 col-md-3 col-lg-2">
                           <label for="branch" class="form-label fw-bold">Description:</label>
                           <select id="branch" name="branch" class="form-select select2">
                               <option value="">-- All --</option>
                               <?php foreach ($data['branch_list'] as $row): ?>
                                   <option value="<?= $row['branch']; ?>" <?= isset($_GET['branch']) && $_GET['branch'] === $row['branch'] ? 'selected' : '' ?>>
                                       <?= $row['branch']; ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>
                       </div>

                       <div class="col-12 col-md-3 col-lg-2">
                           <label for="branch" class="form-label fw-bold">Cabang :</label>
                           <select id="branch" name="branch" class="form-select select2">
                               <option value="">-- All --</option>
                               <?php foreach ($data['branch_list'] as $row): ?>
                                   <option value="<?= $row['branch']; ?>" <?= isset($_GET['branch']) && $_GET['branch'] === $row['branch'] ? 'selected' : '' ?>>
                                       <?= $row['branch']; ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>
                       </div>

                   </div>
               </form>
           </div>
           <?php if (!empty($data['filter_badge'])): ?>
               <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                   <i class="fas fa-filter me-2"></i>
                   <div><?= $data['filter_badge']; ?></div>
               </div>
           <?php endif; ?>
           <div class="row">
               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card mb-4">
                           <div class="card-body bg-card text-white text-uppercase  text-center">Total Online Hybrid</div>
                           <div class="card-footer text-dark d-flex justify-content-around align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-laptop fa-2x"></i>
                               <h2 class="mb-0 fw-bold"><?= $totalHybrid ?></h2>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card mb-4">
                           <div class="card-body bg-card text-white text-uppercase  text-center">Total Online MEC</div>
                           <div class="card-footer text-dark d-flex justify-content-around align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-mobile fa-2x"></i>
                               <h2 class="mb-0 fw-bold"><?= $totalMec ?></h2>
                           </div>
                       </div>
                   </a>
               </div>
               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card mb-4">
                           <div class="card-body bg-card text-white text-uppercase  text-center">Total Agen Offline</div>
                           <div class="card-footer text-dark d-flex justify-content-around align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-edit fa-2x"></i>
                               <h2 class="mb-0 fw-bold"><?= $totalOffline ?></h2>
                           </div>
                       </div>
                   </a>
               </div>
               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card  mb-4">
                           <div class="card-body bg-card text-white text-uppercase  text-center">Total Printer Label</div>
                           <div class="card-footer text-dark d-flex justify-content-around align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-print fa-2x"></i>
                               <h2 class="mb-0 fw-bold">100</h2>
                           </div>
                       </div>
                   </a>
               </div>
           </div>

           <div class="card-body col-xl-7">
               <div id="tableWrapper p-2">
                   <table id="example" class="display nowrap " style="width:100%">
                       <thead>
                           <tr class="bg-ungu text-white">
                               <th class="small text-center">NO</th>
                               <th class="small text-center">NAMA AGEN</th>
                               <th class="small text-center">STATUS</th>
                               <th class="small text-center">PIC AGEN</th>
                           </tr>
                       </thead>
                       <tbody id="karyawanResult">
                           <?php
                            extract($data);
                            require_once '../app/views/home/_partial_tabel_counter.php';
                            ?>
                       </tbody>
                   </table>
               </div>
           </div>

       </div>
   </main>