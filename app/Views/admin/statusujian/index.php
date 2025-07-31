<?= $this->include('layout/header') ?>

<style>
  .status-ujian-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .status-ujian-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .status-ujian-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }
</style>

<div class="d-flex status-ujian-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="status-ujian-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Status Ujian Siswa</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="flex-grow-1 status-ujian-content shadow">
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="statusUjianTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Mapel</th>
              <th>Jenis Ujian</th>
              <th>Status</th>
              <th>Waktu Mulai</th>
              <th>Waktu Selesai</th>
              <th>Skor</th>
              <th>Benar</th>
              <th>Salah</th>
              <th>Kosong</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($statusUjian as $row): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($row['nama_lengkap']) ?></td>
                <td><?= esc($row['kelas']) ?></td>
                <td><?= esc($row['nama_mapel']) ?></td>
                <td><?= esc($row['jenis_ujian']) ?></td>
                <td><?= esc(ucwords($row['status'])) ?></td>
                <td><?= esc($row['waktu_mulai']) ?></td>
                <td><?= esc($row['waktu_selesai']) ?></td>
                <td><?= esc($row['skor']) ?></td>
                <td><?= esc($row['jumlah_benar']) ?></td>
                <td><?= esc($row['jumlah_salah']) ?></td>
                <td><?= esc($row['jumlah_kosong']) ?></td>
              </tr>
            <?php endforeach ?>
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
    $('#statusUjianTable').DataTable();
  });
</script>
