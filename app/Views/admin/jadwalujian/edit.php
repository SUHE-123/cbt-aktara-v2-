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
      <h4 class="mb-0"><strong>Edit Data Jadwal Ujian</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Form Edit -->
    <div class="guru-edit-container shadow">
        <form action="<?= base_url('admin/jadwalujian/update/' . $jadwal['id_jadwal']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="row mb-3">
            <div class="col-md-6">
            <label>Mata Pelajaran</label>
            <select name="id_mapel" class="form-select" required>
                <?php foreach ($mapel as $m): ?>
                <option value="<?= $m['id'] ?>" <?= $m['id'] == $jadwal['id_mapel'] ? 'selected' : '' ?>>
                    <?= esc($m['nama_mapel']) ?>
                </option>
                <?php endforeach; ?>
            </select>
            </div>
            <div class="col-md-6">
            <label>Bank Soal</label>
            <select name="id_bank" class="form-select" required>
                <?php foreach ($bank as $b): ?>
                <option value="<?= $b['id_bank'] ?>" <?= $b['id_bank'] == $jadwal['id_bank'] ? 'selected' : '' ?>>
                    <?= esc($b['bank_code']) ?>
                </option>
                <?php endforeach; ?>
            </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
            <label>Jenis Ujian</label>
            <select name="id_jenis_ujian" class="form-select" required>
                <?php foreach ($jenis as $j): ?>
                <option value="<?= $j['id_jenis_ujian'] ?>" <?= $j['id_jenis_ujian'] == $jadwal['id_jenis_ujian'] ? 'selected' : '' ?>>
                    <?= esc($j['jenis_ujian']) ?>
                </option>
                <?php endforeach; ?>
            </select>
            </div>
            <div class="col-md-6">
            <label>Sekolah</label>
            <select name="id_sekolah" class="form-select" required>
                <?php foreach ($sekolah as $s): ?>
                <option value="<?= $s['id'] ?>" <?= $s['id'] == $jadwal['id_sekolah'] ? 'selected' : '' ?>>
                    <?= esc($s['nama_sekolah']) ?>
                </option>
                <?php endforeach; ?>
            </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
            <label>Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai" class="form-control"
                value="<?= date('Y-m-d\TH:i', strtotime($jadwal['tanggal_mulai'])) ?>" required>
            </div>
            <div class="col-md-6">
            <label>Tanggal Tenggat</label>
            <input type="datetime-local" name="tanggal_tenggat" class="form-control"
                value="<?= date('Y-m-d\TH:i', strtotime($jadwal['tanggal_tenggat'])) ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
            <label>Durasi (menit)</label>
            <input type="number" name="durasi" class="form-control" value="<?= esc($jadwal['durasi']) ?>" required>
            </div>
            <div class="col-md-6">
            <label>Durasi Minimal (menit)</label>
            <input type="number" name="durasi_minimal" class="form-control" value="<?= esc($jadwal['durasi_minimal']) ?>">
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
            <label>Acak Soal</label>
            <select name="acak_soal" class="form-select">
                <option value="1" <?= $jadwal['acak_soal'] == 1 ? 'selected' : '' ?>>Ya</option>
                <option value="0" <?= $jadwal['acak_soal'] == 0 ? 'selected' : '' ?>>Tidak</option>
            </select>
            </div>
            <div class="col-md-4">
            <label>Gunakan Token</label>
            <select name="token" class="form-select">
                <option value="1" <?= $jadwal['token'] == 1 ? 'selected' : '' ?>>Ya</option>
                <option value="0" <?= $jadwal['token'] == 0 ? 'selected' : '' ?>>Tidak</option>
            </select>
            </div>
            <div class="col-md-4">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="1" <?= $jadwal['status'] == 1 ? 'selected' : '' ?>>Aktif</option>
                <option value="0" <?= $jadwal['status'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
            </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        <a href="<?= base_url('admin/jadwalujian') ?>" class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
    </div>
    </div>
    

