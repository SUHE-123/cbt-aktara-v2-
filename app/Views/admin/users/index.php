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
  <?= $this->include('layout/sidebar') ?>

  <!-- Overlay -->
  <div class="siswa-index-overlay"></div>

  <!-- Main Content -->
  <div class="main-content flex-grow-1 d-flex flex-column">

    <!-- Header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Data User</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Konten -->
    <div class="flex-grow-1 siswa-index-content shadow-sm">
      <a href="<?= base_url('/admin/users/create') ?>" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg"></i> Tambah User
      </a>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($users as $u): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td>
                <img src="<?= base_url('uploads/foto/' . ($u['foto'] ?? 'default.png')) ?>" alt="Foto" width="50" height="50" class="rounded-circle" style="object-fit: cover;">
              </td>
              <td><?= esc($u['nama_lengkap']) ?></td>
              <td><?= esc($u['username']) ?></td>
              <td><?= esc($u['email']) ?></td>
              <td><?= esc($u['no_hp']) ?></td>
              <td><?= esc($u['role']) ?></td>
              <td>
                <a href="<?= base_url('/admin/users/edit/' . $u['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                <form action="<?= base_url('/admin/users/delete/' . $u['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin hapus?');">
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
