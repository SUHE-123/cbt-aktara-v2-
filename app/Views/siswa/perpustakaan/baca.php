<?= $this->include('layout/header') ?>

<style>
  .reader-bg {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
  }

  .reader-bg::before {
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

  .reader-bg::after {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 2;
  }

  .reader-content {
    position: relative;
    z-index: 3;
    padding: 2rem;
    color: white;
  }

  .pdf-viewer {
    width: 100%;
    height: 80vh;
    border: none;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
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
      <h4 class="mb-0"><strong>CBT AKTARA V2</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Background + Content -->
    <div class="reader-bg">
      <div class="container py-4 reader-content">
        
        <h5><?= esc($buku['judul']) ?></h5>
        <p class="text-light">Pengarang: <?= esc($buku['pengarang']) ?> | Tahun: <?= esc($buku['tahun_terbit']) ?></p>

        <iframe
          class="pdf-viewer"
          src="<?= base_url('uploads/pdf/' . $buku['file_pdf']) ?>#toolbar=0&navpanes=0&scrollbar=0"
          allowfullscreen
        ></iframe>

        <a href="<?= base_url('siswa/perpustakaan') ?>" class="btn btn-secondary mt-3">
          <i class="bi bi-arrow-left"></i> Kembali ke Daftar Buku
        </a>

      </div>
    </div>

  </div>
</div>
