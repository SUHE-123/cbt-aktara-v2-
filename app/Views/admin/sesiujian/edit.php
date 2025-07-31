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
      <h4 class="mb-0"><strong>Edit Sesi Ujian</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>


    <div class="sekolah-edit-container shadow">
      <form action="<?= base_url('/admin/sesiujian/update/' . $sesi['id_sesi']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label for="sesi" class="form-label">Nama Sesi</label>
          <input type="text" name="sesi" id="sesi" value="<?= esc($sesi['sesi']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="kode" class="form-label">Kode Sesi</label>
          <input type="text" name="kode" id="kode" value="<?= esc($sesi['kode']) ?>" class="form-control" required>
        </div>

      <div class="mb-3">
          <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
          <input type="time" name="waktu_mulai" class="form-control" value="<?= esc($sesi['waktu_mulai']) ?>" required>
      </div>

      <div class="mb-3">
          <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
          <input type="time" name="waktu_selesai" class="form-control" value="<?= esc($sesi['waktu_selesai']) ?>" required>
      </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        <a href="<?= base_url('/admin/sesiujian') ?>" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>

    </div>
    