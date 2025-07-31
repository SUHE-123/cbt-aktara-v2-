<?= $this->include('layout/header') ?>

<style>
  .sekolah-index-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .sekolah-index-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .sekolah-index-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }
</style>

<div class="d-flex sekolah-index-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="sekolah-index-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Data Mata Pelajaran</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="flex-grow-1 sekolah-index-content shadow">
      <a href="<?= base_url('/admin/mapel/create') ?>" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Mapel
      </a>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="mapelTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Kode</th>
              <th>Nama Mapel</th>
              <th>Jenjang</th>
              <th>Jurusan</th>
              <th>Guru</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($mapel as $m): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($m['kode_mapel']) ?></td>
                <td><?= esc($m['nama_mapel']) ?></td>
                <td><?= esc($m['jenjang']) ?></td>
                <td><?= esc($m['jurusan']) ?></td>
                <td><?= esc($m['nama_guru'] ?? '') ?></td>
                <td>
                  <span class="badge bg-<?= $m['status'] === 'aktif' ? 'success' : 'secondary' ?>">
                    <?= ucfirst(esc($m['status'])) ?>
                  </span>
                </td>
                <td>
                  <a href="<?= base_url('admin/mapel/edit/' . $m['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                  <form action="<?= base_url('admin/mapel/delete/' . $m['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
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
    $('#mapelTable').DataTable({
      responsive: true,
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        paginate: {
          previous: "Sebelumnya",
          next: "Berikutnya"
        }
      }
    });
  });
</script>
