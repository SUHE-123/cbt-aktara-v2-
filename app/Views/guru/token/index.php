<?= $this->include('layout/header') ?>

<style>
  .token-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .token-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .main-content {
    position: relative;
    z-index: 2;
    width: 100%;
  }

  .navbar-dashboard {
    position: sticky;
    top: 0;
    z-index: 10;
  }

  .token-content {
    background-color: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    margin: 2rem auto;
    border-radius: 8px;
    max-width: 500px;
    text-align: center;
  }

  .token-value {
    font-size: 3rem;
    font-weight: bold;
    color: #007bff;
    margin-bottom: 1rem;
    letter-spacing: 5px;
  }
</style>

<div class="d-flex token-wrapper">
  <?= $this->include('layout/sidebar2') ?>
  <div class="token-overlay"></div>

  <div class="main-content d-flex flex-column align-items-center justify-content-start">
    
    <!-- NAVBAR -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm w-100">
      <button class="btn btn-outline-light me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Token Ujian</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- KONTEN TOKEN -->
    <div class="token-content shadow mt-5">
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif ?>

      <div class="token-value">
        <?= esc($token['token']) ?>
      </div>

      <form action="<?= base_url('guru/token/generate') ?>" method="post" onsubmit="return confirm('Yakin ingin generate token baru?')">
        <?= csrf_field() ?>
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-arrow-clockwise"></i> Generate Ulang Token
        </button>
      </form>
    </div>
  </div>
</div>
