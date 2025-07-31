<?= $this->include('layout/header') ?>

<style>
  .dashboard-bg {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
  }

  .dashboard-bg::before {
    content: "";
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    filter: blur(8px);
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
  }

  .dashboard-bg::after {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 2;
  }

  .dashboard-content {
    position: relative;
    z-index: 3;
  }

  .card-custom {
    background-color: rgba(255, 255, 255, 0.85);
    color: #000;
    border: none;
  }

  .section-title {
    margin-top: 2rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid #fff;
    padding-bottom: 5px;
  }
</style>

<div class="d-flex" style="min-height: 100vh;">
  <?= $this->include('layout/sidebar3') ?>

  <div class="main-content w-100">

    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm">
      <button class="btn btn-outline-light me-2" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>CBT AKTARA V2</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="dashboard-bg">
      <div class="container py-4 dashboard-content text-white">

        <h4>Selamat Datang, <?= esc(session('nama_lengkap')) ?>!</h4>

        <!-- Jadwal Ujian -->
        <div class="section-title"><strong>Jadwal Ujian</strong></div>
        <?php if (!empty($jadwal_ujian)): ?>
          <div class="row">
            <?php foreach ($jadwal_ujian as $jadwal): ?>
              <div class="col-md-4">
                <div class="card card-custom mb-3 shadow-sm">
                  <div class="card-body">
                    <h5 class="card-title"><?= esc($jadwal['nama_mapel'] ?? '-') ?></h5>
                    <p class="card-text mb-1">
                      <strong>Tanggal:</strong> <?= isset($jadwal['tanggal_mulai']) ? date('d-m-Y H:i', strtotime($jadwal['tanggal_mulai'])) : '-' ?><br>
                      <strong>Durasi:</strong> <?= esc($jadwal['durasi'] ?? '-') ?> menit<br>
                      <strong>Jenis:</strong> <?= esc($jadwal['jenis_ujian'] ?? '-') ?><br>
                      <strong>Bank:</strong> <?= esc($jadwal['bank_code'] ?? '-') ?>
                    </p>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        <?php else: ?>
          <p class="fst-italic">Belum ada jadwal ujian yang tersedia.</p>
        <?php endif; ?>


        <!-- 5 Buku Terbaru -->
        <div class="section-title">5 Buku Terbaru</div>
        <div class="row">
          <?php if (!empty($buku_terbaru)): ?>
            <?php foreach ($buku_terbaru as $buku): ?>
              <div class="col-md-3">
                <div class="card card-custom mb-3 shadow-sm">
                  <?php
                    $cover = !empty($buku['cover']) ? base_url('uploads/cover/' . $buku['cover']) : base_url('uploads/cover/default.png');
                  ?>
                  <img src="<?= $cover ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Cover Buku">
                  <div class="card-body">
                    <h6 class="card-title"><?= esc($buku['judul']) ?></h6>
                    <p class="card-text">
                      Pengarang: <?= esc($buku['pengarang']) ?><br>
                      Tahun: <?= esc($buku['tahun_terbit']) ?>
                    </p>
                    <a href="<?= base_url('siswa/perpustakaan/baca/' . $buku['id_buku']) ?>" class="btn btn-primary btn-sm">Baca</a>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          <?php else: ?>
            <p class="text-light">Belum ada buku yang tersedia.</p>
          <?php endif ?>
        </div>

      </div>
    </div>
  </div>
</div>
