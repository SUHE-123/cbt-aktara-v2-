<?= $this->include('layout/header') ?>

<style>
  .ujian-bg {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
  }

  .ujian-bg::before {
    content: "";
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    filter: blur(6px);
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
  }

  .ujian-bg::after {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 2;
  }

  .ujian-content {
    position: relative;
    z-index: 3;
    padding: 2rem;
    color: white;
  }

  .card-custom {
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    color: #000;
  }

  .section-title {
    margin-top: 2rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid #fff;
    padding-bottom: 5px;
  }
</style>

<div class="d-flex ujian-bg">
  <?= $this->include('layout/sidebar3') ?>

  <div class="main-content flex-grow-1 ujian-content">
    <!-- Navbar -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm">
      <button class="btn btn-outline-light me-2" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0">Home Ujian</h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Ujian Hari Ini -->
    <div class="section-title">Jadwal Ujian Hari Ini</div>
    <?php if (!empty($ujian_hari_ini)): ?>
      <div class="row">
        <?php foreach ($ujian_hari_ini as $ujian): ?>
          <div class="col-md-4 mb-3">
            <div class="card card-custom shadow-sm">
              <div class="card-body">
                <h5 class="card-title"><?= esc($ujian['nama_mapel']) ?> - <?= esc($ujian['jenis_ujian']) ?></h5>
                <p class="card-text">
                  Tanggal: <?= date('d-m-Y', strtotime($ujian['tanggal_mulai'])) ?><br>
                  Durasi: <?= esc($ujian['durasi']) ?> menit<br>
                  Token: <strong><?= esc($ujian['token']) ?></strong>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    <?php else: ?>
      <p class="fst-italic text-light">Tidak ada ujian hari ini.</p>
    <?php endif ?>

    <!-- Ujian Sebelumnya -->
    <div class="section-title">Ujian Sebelumnya</div>
    <?php if (!empty($ujian_sebelumnya)): ?>
      <div class="row">
        <?php foreach ($ujian_sebelumnya as $ujian): ?>
          <div class="col-md-4 mb-3">
            <div class="card card-custom shadow-sm">
              <div class="card-body">
                <h6 class="card-title"><?= esc($ujian['nama_mapel']) ?> - <?= esc($ujian['jenis_ujian']) ?></h6>
                <p class="card-text">
                  Tanggal: <?= date('d-m-Y', strtotime($ujian['tanggal_mulai'])) ?><br>
                  Durasi: <?= esc($ujian['durasi']) ?> menit
                </p>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    <?php else: ?>
      <p class="fst-italic text-light">Belum ada riwayat ujian sebelumnya.</p>
    <?php endif ?>
  </div>
</div>
