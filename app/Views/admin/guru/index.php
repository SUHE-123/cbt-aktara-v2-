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
      <h4 class="mb-0"><strong>Data Guru</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="flex-grow-1 sekolah-index-content shadow">
      <a href="<?= base_url('/admin/guru/create') ?>" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Guru
      </a>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="guruTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>NIP</th>
              <th>Jenis Kelamin</th>
              <th>Mata Pelajaran</th>
              <th>Email</th>
              <th>Kontak</th>
              <th>Alamat</th>
              <th>User Login</th>
              <th>Sekolah</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($guru as $g): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($g['nama_lengkap']) ?></td>
                <td><?= esc($g['nip']) ?></td>
                <td><?= esc($g['jenis_kelamin']) ?></td>
                <td><?= esc($g['mata_pelajaran']) ?></td>
                <td><?= esc($g['email']) ?></td>
                <td><?= esc($g['kontak']) ?></td>
                <td><?= esc($g['alamat']) ?></td>
                <td>
                  <?= esc($g['user_nama'] ?? '') ?> 
                  (<?= esc($g['user_username'] ?? '-') ?>)
                </td>
                <td><?= esc($g['nama_sekolah'] ?? '-') ?></td>
                <td>
                  <span class="badge bg-<?= $g['status_akun'] === 'aktif' ? 'success' : 'secondary' ?>">
                    <?= ucfirst($g['status_akun']) ?>
                  </span>
                </td>
                <td>
                  <a href="<?= base_url('admin/guru/edit/' . $g['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                  <form action="<?= base_url('admin/guru/delete/' . $g['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus guru ini?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
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
    $('#guruTable').DataTable();
  });
</script>
