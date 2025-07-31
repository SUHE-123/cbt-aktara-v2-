<?= $this->include('layout/header') ?>

<style>
  .detail-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .detail-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .detail-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }
</style>

<div class="d-flex detail-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="detail-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Detail Hasil Ujian</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="detail-content shadow">
      <a href="<?= base_url('admin/hasilujian') ?>" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="detailHasilTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Soal</th>
              <th>Jawaban Siswa</th>
              <th>Kunci Jawaban</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($data)): ?>
              <tr>
                <td colspan="5" class="text-center text-danger">Data tidak ditemukan.</td>
              </tr>
            <?php else: ?>
              <?php $no = 1; foreach ($data as $d): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($d['soal']) ?></td>
                  <td><?= esc($d['jawaban_siswa']) ?></td>
                  <td><?= esc($d['kunci_jawaban']) ?></td>
                  <td>
                    <?php if ($d['jawaban_siswa'] == $d['kunci_jawaban']): ?>
                      <span class="badge bg-success">Benar</span>
                    <?php else: ?>
                      <span class="badge bg-danger">Salah</span>
                    <?php endif ?>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php endif ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
    $('#detailHasilTable').DataTable({
      responsive: true,
      ordering: false
    });
  });
</script>
