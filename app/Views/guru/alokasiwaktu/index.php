<?= $this->include('layout/header') ?>

<style>
  .alokasi-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .alokasi-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .alokasi-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }
</style>

<div class="d-flex alokasi-wrapper">
  <?= $this->include('layout/sidebar2') ?>
  <div class="alokasi-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Data Alokasi Waktu Ujian</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="alokasi-content shadow flex-grow-1">
      <a href="<?= base_url('/guru/alokasiwaktu/create') ?>" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Alokasi Waktu
      </a>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="alokasiTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Mapel</th>
              <th>Jenis Ujian</th>
              <th>Tanggal Mulai</th>
              <th>Sesi</th>
              <th>Waktu</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($alokasi as $a): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($a['nama_mapel'] ?? '-') ?></td>
                <td><?= esc($a['jenis_ujian'] ?? '-') ?></td>
                <td><?= date('d-m-Y H:i', strtotime($a['tanggal_mulai'])) ?></td>
                <td><?= esc($a['sesi']) ?></td>
                <td><?= $a['waktu_mulai'] . ' - ' . $a['waktu_selesai'] ?></td>
                <td>
                  <a href="<?= base_url('guru/alokasiwaktu/edit/' . $a['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                  <form action="<?= base_url('guru/alokasiwaktu/delete/' . $a['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin hapus alokasi ini?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </td>
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
    $('#alokasiTable').DataTable();
  });
</script>
