<?= $this->include('layout/header') ?>

<style>
  .siswa-create-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .siswa-create-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .siswa-create-content {
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

<div class="d-flex siswa-create-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="siswa-create-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <!-- Header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Tambah Data Siswa</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Form -->
    <div class="siswa-create-content">
      <form action="<?= base_url('/admin/siswa/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label for="user_id">id user</label>
          <select name="user_id" class="form-select" >
            <option value="">-- Pilih User --</option>
            <?php foreach ($users as $user): ?>
              <option value="<?= $user['id'] ?>">
                <?= esc($user['nama_lengkap']) ?> (<?= esc($user['username']) ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>NIS</label>
          <input type="text" name="nis" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Jenis Kelamin</label>
          <select name="jenis_kelamin" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>

        <div class="mb-3">
          <label>Kelas</label>
          <input type="text" name="kelas" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control"></textarea>
        </div>

        <div class="mb-3">
          <label>Kontak</label>
          <input type="text" name="kontak" class="form-control">
        </div>

        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
          <label>Status Akun</label>
          <select name="status_akun" class="form-select" required>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
          </select>
        </div>

        <div class="mb-3">
          <label>Sekolah</label>
          <select name="sekolah_id" class="form-select" required>
            <option value="">-- Pilih Sekolah --</option>
            <?php foreach ($sekolah as $s): ?>
              <option value="<?= $s['id'] ?>"><?= esc($s['nama_sekolah']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('/admin/siswa') ?>" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
