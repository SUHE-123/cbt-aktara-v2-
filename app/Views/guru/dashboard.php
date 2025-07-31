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

  .dashboard-content {
    position: relative;
    z-index: 2;
  }
</style>

<div class="d-flex" style="min-height: 100vh;">
  <!-- Sidebar -->
  <?= $this->include('layout/sidebar2') ?>

  <!-- Main Content -->
  <div class="main-content w-100">
    
    <!-- Header Dashboard -->
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

    <!-- Dashboard Content with Blur Background -->
    <div class="dashboard-bg">
      <div class="container py-5 dashboard-content">
        <div class="bg-dark bg-opacity-75 rounded p-4 text-white shadow">
          <h5 class="mb-4">Selamat Datang di Dashboard Guru CBT</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">Siswa</h5>
                  <p class="card-text"><?= $jumlah_siswa ?> orang</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                  <h5 class="card-title">Mata Pelajaran</h5>
                  <p class="card-text"><?= $jumlah_mapel ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                  <h5 class="card-title">Token</h5>
                  <p class="card-text"><?= $token_aktif ?></p>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- end content -->
      </div> <!-- end container -->
    </div> <!-- end background -->

  </div> <!-- end main content -->
</div> <!-- end wrapper -->

<?= $this->include('layout/footer') ?>
