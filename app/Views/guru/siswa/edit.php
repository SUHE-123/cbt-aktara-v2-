<?= $this->include('layout/header') ?>

<style>
  .siswa-edit-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .siswa-edit-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .siswa-edit-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    margin: 2rem auto;
    border-radius: 10px;
    width: 90%;
    max-width: 800px;
  }
</style>

<div class="d-flex siswa-edit-wrapper">
  <?= $this->include('layout/sidebar2') ?>
  <div class="siswa-edit-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <!-- Header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Edit Data Siswa</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Form -->
    <div class="siswa-edit-content">
      <form action="<?= base_url('/guru/siswa/update/' . $siswa['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label for="user_id">Id User</label>
          <select name="user_id" class="form-select">
            <option value="">-- Pilih User --</option>
            <?php foreach ($users as $user): ?>
              <option value="<?= $user['id'] ?>" <?= $siswa['user_id'] == $user['id'] ? 'selected' : '' ?>>
                <?= esc($user['nama_lengkap']) ?> (<?= esc($user['username']) ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" value="<?= esc($siswa['nama_lengkap']) ?>" required>
        </div>

        <div class="mb-3">
          <label>NIS</label>
          <input type="text" name="nis" class="form-control" value="<?= esc($siswa['nis']) ?>" required>
        </div>

        <div class="mb-3">
          <label>Jenis Kelamin</label>
          <select name="jenis_kelamin" class="form-select" required>
            <option value="L" <?= $siswa['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= $siswa['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
          </select>
        </div>

        <div class="mb-3">
          <label>Kelas</label>
          <input type="text" name="kelas" class="form-control" value="<?= esc($siswa['kelas']) ?>" required>
        </div>

        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control"><?= esc($siswa['alamat']) ?></textarea>
        </div>

        <div class="mb-3">
          <label>Kontak</label>
          <input type="text" name="kontak" class="form-control" value="<?= esc($siswa['kontak']) ?>">
        </div>

        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="<?= esc($siswa['email']) ?>">
        </div>

        <div class="mb-3">
          <label>Status Akun</label>
          <select name="status_akun" class="form-select" required>
            <option value="aktif" <?= $siswa['status_akun'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="nonaktif" <?= $siswa['status_akun'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
          </select>
        </div>

        <div class="mb-3">
          <label>Sekolah</label>
          <select name="sekolah_id" class="form-select" required>
            <option value="">-- Pilih Sekolah --</option>
            <?php foreach ($sekolah as $s): ?>
              <option value="<?= $s['id'] ?>" <?= $siswa['sekolah_id'] == $s['id'] ? 'selected' : '' ?>>
                <?= esc($s['nama_sekolah']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('/guru/siswa') ?>" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>

