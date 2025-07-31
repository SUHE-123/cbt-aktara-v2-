<?= $this->include('layout/header') ?>

<style>
  .library-bg {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
  }

  .library-bg::before {
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

  .library-bg::after {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 2;
  }

  .library-content {
    position: relative;
    z-index: 3;
    padding: 2rem;
    color: white;
  }

  .card-custom {
    background-color: rgba(255, 255, 255, 0.85);
    color: #000;
    border: none;
  }

  .section-title {
    margin-bottom: 1rem;
    border-bottom: 2px solid #fff;
    padding-bottom: 5px;
  }

  .navbar-dashboard {
    position: sticky;
    top: 0;
    z-index: 999;
  }
</style>

<div class="d-flex" style="min-height: 100vh;">
  <!-- Sidebar -->
  <?= $this->include('layout/sidebar3') ?>

  <!-- Main Content -->
  <div class="main-content w-100">
    
    <!-- Navbar -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm">
      <button class="btn btn-outline-light me-2" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>CBT AKTARA V2 (Perpustakaan)</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Background & Content -->
    <div class="library-bg">
      <div class="container py-4 library-content">

        <!-- Filter -->
        <div class="section-title">Filter Buku</div>
        <form class="row g-2 mb-4" method="get" action="<?= base_url('siswa/perpustakaan') ?>">
          <div class="col-md-4">
            <select name="jenis" class="form-select">
              <option value="">-- Semua Jenis Buku --</option>
              <?php foreach ($jenis_buku as $jb): ?>
                <option value="<?= $jb['id'] ?>" <?= ($jenis == $jb['id']) ? 'selected' : '' ?>>
                  <?= esc($jb['nama_jenis_buku']) ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-md-4">
            <input type="text" name="judul" class="form-control" placeholder="Cari Judul (A-Z)" value="<?= esc($judul) ?>">
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
          </div>
        </form>

        <!-- Daftar Buku -->
        <div class="row">
          <?php if (!empty($koleksi_buku)): ?>
            <?php foreach ($koleksi_buku as $buku): ?>
              <div class="col-md-3 mb-4">
                <div class="card card-custom h-100 shadow">
                  <?php
                    $cover = !empty($buku['cover']) ? base_url('uploads/cover/' . $buku['cover']) : base_url('uploads/cover/default.png');
                  ?>
                  <img src="<?= $cover ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Cover Buku">
                  <div class="card-body d-flex flex-column">
                    <h6 class="card-title"><?= esc($buku['judul']) ?></h6>
                    <p class="card-text">
                      Jenis: <?= esc($buku['nama_jenis_buku'] ?? '-') ?><br>
                      Pengarang: <?= esc($buku['pengarang']) ?><br>
                      Tahun: <?= esc($buku['tahun_terbit']) ?>
                    </p>
                    <a href="<?= base_url('siswa/perpustakaan/baca/' . $buku['id_buku']) ?>" class="btn btn-primary btn-sm mt-auto">Baca</a>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          <?php else: ?>
            <div class="col-12">
              <p class="text-light">Tidak ada buku yang ditemukan.</p>
            </div>
          <?php endif ?>
        </div>

      </div>
    </div>

  </div>
</div>
