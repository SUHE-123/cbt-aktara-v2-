<?= $this->include('layout/header') ?>

<style>
  .form-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .form-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .form-container {
    position: relative;
    z-index: 2;
    padding: 2rem;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.85);
  }
</style>

<div class="d-flex form-wrapper">
  <!-- Sidebar -->
  <?= $this->include('layout/sidebar') ?>

  <!-- Main Content -->
  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="form-overlay"></div>

    <!-- Header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Tambah Mata Pelajaran</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="container py-5 form-container mt-4 shadow">
      <form action="<?= base_url('/admin/mapel/store') ?>" method="post">
        <?= csrf_field() ?>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="kode_mapel" class="form-label">Kode Mapel</label>
            <input type="text" name="kode_mapel" class="form-control" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select name="jenjang" class="form-select">
              <option value="">-- Pilih Jenjang --</option>
              <option value="SD">SD</option>
              <option value="SMP">SMP</option>
              <option value="SMA">SMA</option>
              <option value="SMK">SMK</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="jurusan" class="form-label">Jurusan (jika ada)</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Contoh: IPA, IPS, TKJ, AKL">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="guru_id" class="form-label">Guru Pengampu</label>
            <select name="guru_id" class="form-select">
              <option value="">-- Pilih Guru --</option>
              <?php foreach ($guru as $g): ?>
                <option value="<?= $g['id'] ?>"><?= esc($g['nama_lengkap']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="aktif" selected>Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
        <a href="<?= base_url('/admin/mapel') ?>" class="btn btn-secondary ms-2">Kembali</a>
      </form>
    </div>
  </div>
</div>

