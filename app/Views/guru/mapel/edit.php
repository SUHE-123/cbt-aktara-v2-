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
  <?= $this->include('layout/sidebar2') ?>

  <!-- Main Content -->
  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="guru-edit-overlay"></div>

    <!-- Header Halaman -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Edit Data Mata Pelajaran</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

<div class="guru-edit-container shadow">
  <form action="<?= base_url('/guru/mapel/update/' . $mapel['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
            <input type="text" name="nama_mapel" class="form-control" value="<?= esc($mapel['nama_mapel']) ?>" required>
          </div>
          <div class="col-md-6">
            <label for="kode_mapel" class="form-label">Kode Mapel</label>
            <input type="text" name="kode_mapel" class="form-control" value="<?= esc($mapel['kode_mapel']) ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="jenjang" class="form-label">Jenjang</label>
            <select name="jenjang" class="form-select">
              <option value="">-- Pilih Jenjang --</option>
              <option value="SD" <?= $mapel['jenjang'] == 'SD' ? 'selected' : '' ?>>SD</option>
              <option value="SMP" <?= $mapel['jenjang'] == 'SMP' ? 'selected' : '' ?>>SMP</option>
              <option value="SMA" <?= $mapel['jenjang'] == 'SMA' ? 'selected' : '' ?>>SMA</option>
              <option value="SMK" <?= $mapel['jenjang'] == 'SMK' ? 'selected' : '' ?>>SMK</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="jurusan" class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="<?= esc($mapel['jurusan']) ?>">
          </div>
        </div>

        <!-- Tambahan Pilih Guru -->
        <div class="mb-3">
          <label for="guru_id" class="form-label">Guru Pengampu</label>
          <select name="guru_id" class="form-select">
            <option value="">-- Pilih Guru --</option>
            <?php foreach ($guru as $g): ?>
              <option value="<?= $g['id'] ?>" <?= $g['id'] == $mapel['guru_id'] ? 'selected' : '' ?>>
                <?= esc($g['nama_lengkap']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-4">
          <label for="status" class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="aktif" <?= $mapel['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="nonaktif" <?= $mapel['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        <a href="<?= base_url('/guru/mapel') ?>" class="btn btn-secondary ms-2">Batal</a>
      </form>
    </div>
  </div>
</div>