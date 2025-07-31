<?= $this->include('layout/header') ?>

<style>
  .sekolah-create-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .sekolah-create-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .sekolah-create-container {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }
</style>

<div class="d-flex sekolah-create-wrapper">
  <!-- Sidebar -->
  <?= $this->include('layout/sidebar') ?>

  <!-- Main Content -->
  <div class="main-content flex-grow-1 d-flex flex-column">
    <!-- Overlay -->
    <div class="sekolah-create-overlay"></div>

    <!-- Header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Tambah Data Sekolah</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Form Container -->
    <div class="sekolah-create-container shadow">
      <form action="<?= base_url('/admin/sekolah/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>NPSN</label>
            <input type="text" name="npsn" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label>Nama Sekolah</label>
            <input type="text" name="nama_sekolah" class="form-control" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>Jenjang</label>
            <input type="text" name="jenjang" class="form-control" placeholder="SD/SMP/SMA/SMK" required>
          </div>
          <div class="col-md-6">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="Negeri">Negeri</option>
              <option value="Swasta">Swasta</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label>Desa/Kelurahan</label>
            <input type="text" name="desa_kelurahan" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control">
          </div>
          <div class="col-md-4">
            <label>Kab/Kota</label>
            <input type="text" name="kab_kota" class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>Kontak</label>
            <input type="text" name="kontak" class="form-control">
          </div>
          <div class="col-md-6">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
          </div>
        </div>

        <div class="mb-3">
          <label>Kepala Sekolah</label>
          <input type="text" name="kepala_sekolah" class="form-control">
        </div>

        <div class="mb-4">
          <label>Logo Sekolah</label>
          <input type="file" name="logo" class="form-control">
          <small class="text-muted">Format yang diperbolehkan: jpg, png. Max 2MB.</small>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('/admin/sekolah') ?>" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
