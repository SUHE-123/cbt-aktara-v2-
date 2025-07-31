<?= $this->include('layout/header') ?>

<style>
  .guru-edit-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .guru-edit-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .guru-edit-container {
    position: relative;
    z-index: 2;
    padding: 2rem;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.9);
    margin: 2rem;
  }
</style>

<div class="d-flex guru-edit-wrapper">
  <!-- Sidebar -->
  <?= $this->include('layout/sidebar') ?>

  <!-- Main Content -->
  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="guru-edit-overlay"></div>

    <!-- Header Halaman -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Edit Data Guru</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Form Edit -->
    <div class="guru-edit-container shadow">
      <form action="<?= base_url('/admin/guru/update/' . $guru['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>ID User</label>
            <select name="user_id" class="form-select">
              <option value="">-- Pilih User --</option>
              <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>" <?= $guru['user_id'] == $user['id'] ? 'selected' : '' ?>>
                  <?= esc($user['nama_lengkap']) ?> (<?= esc($user['username']) ?>)
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="<?= esc($guru['nama_lengkap']) ?>" class="form-control" required>
          </div>

          <div class="col-md-6 mb-3">
            <label>NIP</label>
            <input type="text" name="nip" value="<?= esc($guru['nip']) ?>" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
              <option value="Laki-laki" <?= $guru['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
              <option value="Perempuan" <?= $guru['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran" value="<?= esc($guru['mata_pelajaran']) ?>" class="form-control">
          </div>

            <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?= esc($guru['email']) ?>" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Kontak</label>
            <input type="text" name="kontak" value="<?= esc($guru['kontak']) ?>" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="<?= esc($guru['alamat']) ?>" class="form-control">
          </div>


          <div class="col-md-6 mb-3">
            <label>Status Akun</label>
            <select name="status_akun" class="form-select">
              <option value="aktif" <?= $guru['status_akun'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
              <option value="nonaktif" <?= $guru['status_akun'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Sekolah</label>
            <select name="sekolah_id" class="form-select" required>
              <option value="">-- Pilih Sekolah --</option>
              <?php foreach ($sekolah as $s): ?>
                <option value="<?= $s['id'] ?>" <?= $guru['sekolah_id'] == $s['id'] ? 'selected' : '' ?>>
                  <?= esc($s['nama_sekolah']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('/admin/guru') ?>" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
