<?= $this->include('layout/header') ?>

<style>
  .siswa-index-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') center center / cover no-repeat;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .siswa-index-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .siswa-index-content {
    position: relative;
    z-index: 2;
    padding: 2rem;
    background-color: rgba(255, 255, 255, 0.92);
    border-radius: 10px;
    margin: 2rem;
  }
</style>

<div class="d-flex siswa-index-wrapper">
  <!-- Sidebar -->
  <?= $this->include('layout/sidebar2') ?>

  <!-- Overlay -->
  <div class="siswa-index-overlay"></div>

  <!-- Main Content -->
  <div class="main-content flex-grow-1 d-flex flex-column">

    <!-- Header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Data Siswa</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Konten -->
    <div class="flex-grow-1 siswa-index-content shadow-sm">
      <a href="<?= base_url('/guru/siswa/create') ?>" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah Siswa
      </a>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="siswaTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>NIS</th>
              <th>Jenis Kelamin</th>
              <th>Kelas</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Email</th>
              <th>Status Akun</th>
              <th>User</th>
              <th>Sekolah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($siswa as $s): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($s['nama_lengkap']) ?></td>
                <td><?= esc($s['nis']) ?></td>
                <td><?= esc($s['jenis_kelamin']) === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                <td><?= esc($s['kelas']) ?></td>
                <td><?= esc($s['alamat']) ?></td>
                <td><?= esc($s['kontak']) ?></td>
                <td><?= esc($s['email']) ?></td>
                <td>
                  <span class="badge bg-<?= $s['status_akun'] === 'aktif' ? 'success' : 'secondary' ?>">
                    <?= esc(ucfirst($s['status_akun'])) ?>
                  </span>
                </td>
                <td><?= esc($s['user_nama'] ?? '-') ?> (<?= esc($s['username'] ?? '-') ?>)</td>
                <td><?= esc($s['nama_sekolah'] ?? '-') ?></td>
                <td>
                  <a href="<?= base_url('guru/siswa/edit/' . $s['id']) ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                  <form action="<?= base_url('guru/siswa/delete/' . $s['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
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

<!-- DataTables CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    $('#siswaTable').DataTable({
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
