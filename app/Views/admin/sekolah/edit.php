<?= $this->include('layout/header') ?>

<style>
  .sekolah-edit-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .sekolah-edit-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .sekolah-edit-container {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }
</style>

<div class="d-flex sekolah-edit-wrapper">
  <?= $this->include('layout/sidebar') ?>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="sekolah-edit-overlay"></div>

    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Edit Data Sekolah</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="sekolah-edit-container shadow">
      <form action="<?= base_url('/admin/sekolah/update/' . $sekolah['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>NPSN</label>
            <input type="text" name="npsn" class="form-control" value="<?= esc($sekolah['npsn']) ?>" required>
          </div>
          <div class="col-md-6">
            <label>Nama Sekolah</label>
            <input type="text" name="nama_sekolah" class="form-control" value="<?= esc($sekolah['nama_sekolah']) ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>Jenjang</label>
            <input type="text" name="jenjang" class="form-control" value="<?= esc($sekolah['jenjang']) ?>" required>
          </div>
          <div class="col-md-6">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="Negeri" <?= $sekolah['status'] == 'Negeri' ? 'selected' : '' ?>>Negeri</option>
              <option value="Swasta" <?= $sekolah['status'] == 'Swasta' ? 'selected' : '' ?>>Swasta</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control"><?= esc($sekolah['alamat']) ?></textarea>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label>Desa/Kelurahan</label>
            <input type="text" name="desa_kelurahan" class="form-control" value="<?= esc($sekolah['desa_kelurahan']) ?>">
          </div>
          <div class="col-md-4">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" value="<?= esc($sekolah['kecamatan']) ?>">
          </div>
          <div class="col-md-4">
            <label>Kab/Kota</label>
            <input type="text" name="kab_kota" class="form-control" value="<?= esc($sekolah['kab_kota']) ?>">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="<?= esc($sekolah['provinsi']) ?>">
          </div>
          <div class="col-md-6">
            <label>Kode Pos</label>
            <input type="text" name="kode_pos" class="form-control" value="<?= esc($sekolah['kode_pos']) ?>">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label>Kontak</label>
            <input type="text" name="kontak" class="form-control" value="<?= esc($sekolah['kontak']) ?>">
          </div>
          <div class="col-md-6">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($sekolah['email']) ?>">
          </div>
        </div>

        <div class="mb-3">
          <label>Kepala Sekolah</label>
          <input type="text" name="kepala_sekolah" class="form-control" value="<?= esc($sekolah['kepala_sekolah']) ?>">
        </div>

        <div class="mb-4">
          <label>Logo Sekolah</label>
          <?php if (!empty($sekolah['logo'])): ?>
            <div class="mb-2">
              <img src="<?= base_url('uploads/logo/' . $sekolah['logo']) ?>" alt="Logo Sekolah" width="100">
            </div>
          <?php endif; ?>
          <input type="file" name="logo" class="form-control">
          <small class="text-muted">Kosongkan jika tidak ingin mengubah logo.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('/admin/sekolah') ?>" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
