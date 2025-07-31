<?= $this->include('layout/header') ?>

<style>
  .alokasi-edit-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .alokasi-edit-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .alokasi-edit-container {
    position: relative;
    z-index: 2;
    padding: 2rem;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.9);
    margin: 2rem;
  }
</style>

<div class="d-flex alokasi-edit-wrapper">
  <?= $this->include('layout/sidebar2') ?>
  <div class="alokasi-edit-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Edit Alokasi Waktu Ujian</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="container alokasi-edit-container shadow mt-4">
      <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
              <li><?= esc($error) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('guru/alokasiwaktu/update/' . $alokasi['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label for="id_jadwal">Jadwal Ujian</label>
          <select name="id_jadwal" id="id_jadwal" class="form-select" required>
            <option value="">-- Pilih Jadwal --</option>
            <?php foreach ($jadwal as $j): ?>
              <option value="<?= $j['id_jadwal'] ?>" <?= $j['id_jadwal'] == $alokasi['id_jadwal'] ? 'selected' : '' ?>>
                <?= esc($j['id_jadwal'] . ' - ' . date('d M Y H:i', strtotime($j['tanggal_mulai']))) ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="id_sesi">Sesi Ujian</label>
          <select name="id_sesi" id="id_sesi" class="form-select" required>
            <option value="">-- Pilih Sesi --</option>
            <?php foreach ($sesi as $s): ?>
              <option value="<?= $s['id_sesi'] ?>" <?= $s['id_sesi'] == $alokasi['id_sesi'] ? 'selected' : '' ?>>
                <?= esc($s['sesi']) ?> (<?= $s['waktu_mulai'] ?> - <?= $s['waktu_selesai'] ?>)
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        <a href="<?= base_url('guru/alokasiwaktu') ?>" class="btn btn-secondary ms-2">Batal</a>
      </form>
    </div>
  </div>
</div>
