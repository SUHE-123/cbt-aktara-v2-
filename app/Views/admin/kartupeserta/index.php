<?= $this->include('layout/header') ?>

<style>
  @media print {
    body * {
      visibility: hidden;
    }
    #printArea, #printArea * {
      visibility: visible;
    }
    #printArea {
      position: absolute;
      left: 0;
      top: 0;
    }
    .no-print {
      display: none;
    }
  }

  .sekolah-index-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .sekolah-index-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .sekolah-index-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }

  .card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1rem;
  }

  .kartu {
    border: 2px solid #000;
    padding: 1rem;
    background: #fff;
    position: relative;
    font-size: 14px;
    height: 230px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .kartu img.foto {
    width: 60px;
    height: 80px;
    object-fit: cover;
    border: 1px solid #aaa;
  }

  .kartu img.logo {
    width: 60px;
    height: 60px;
    object-fit: contain;
  }

  .qr {
    width: 70px;
    height: 70px;
  }

  .judul {
    text-align: center;
    font-weight: bold;
    font-size: 16px;
  }

  .data {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
  }

  .data-kiri, .data-kanan {
    width: 48%;
  }

  .header-kartu {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .form-filter {
    margin-bottom: 1rem;
  }
</style>

<div class="d-flex sekolah-index-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="sekolah-index-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Cetak Kartu Peserta</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="flex-grow-1 sekolah-index-content shadow">
      <form method="get" class="form-filter row g-2 align-items-center no-print">
        <div class="col-md-4">
          <select name="kelas" class="form-select" onchange="this.form.submit()">
            <option value="all">-- Semua Kelas --</option>
            <?php foreach ($daftarKelas as $k): ?>
              <option value="<?= $k['kelas'] ?>" <?= $kelasDipilih == $k['kelas'] ? 'selected' : '' ?>>
                <?= esc($k['kelas']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4">
          <select name="sekolah" class="form-select" onchange="this.form.submit()">
            <option value="all">-- Semua Sekolah --</option>
            <?php foreach ($daftarSekolah as $s): ?>
              <option value="<?= $s['id'] ?>" <?= $sekolahDipilih == $s['id'] ? 'selected' : '' ?>>
                <?= esc($s['nama_sekolah']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-4 text-end">
          <button type="button" onclick="window.print()" class="btn btn-success me-2">
            <i class="bi bi-printer"></i> Cetak
          </button>
        </div>
      </form>

      <div id="printArea">
        <div class="card-grid">
          <?php foreach ($peserta as $p): ?>
            <div class="kartu">
              <div class="header-kartu">
                <img class="logo" src="<?= base_url('uploads/logo/' . ($p['logo'] ?? 'default.png')) ?>" alt="Logo">
                <div class="judul">
                  Kartu Peserta Ujian<br><?= esc($p['nama_sekolah']) ?>
                </div>
                <img
                  class="qr"
                  src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?= urlencode($p['username'] . '_' . $p['nomor_peserta']) ?>"
                  alt="QR Code">
              </div>

              <div class="data">
                <div class="data-kiri">
                  <strong>Nama:</strong><br><?= esc($p['nama_lengkap']) ?><br>
                  <strong>Kelas:</strong><br><?= esc($p['kelas']) ?><br>
                  <strong>Nomor Peserta:</strong><br><?= esc($p['nomor_peserta']) ?>
                </div>
                <div class="data-kanan text-end">
                  <img class="foto" src="<?= base_url('uploads/foto/' . ($p['foto'] ?? 'default.png')) ?>" alt="Foto">
                  <div class="mt-2"><strong><?= esc($p['username']) ?></strong></div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
