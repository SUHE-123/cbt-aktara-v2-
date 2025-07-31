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
    width: 100%;
    height: 100%;
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
    background-color: rgba(255, 255, 255, 0.92);
    border: none;
    color: #000;
  }

  .section-title {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid #fff;
    padding-bottom: 5px;
  }

  .form-label, .form-select {
    color: #000;
  }

  .table thead {
    background-color: #343a40;
    color: #fff;
  }
</style>

<div class="d-flex ujian-bg">
  <?= $this->include('layout/sidebar3') ?>

  <div class="main-content flex-grow-1 ujian-content">
    <!-- Navbar -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm">
      <button class="btn btn-outline-light me-2" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0">Hasil Ujian</h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- Filter -->
    <div class="section-title">Filter Hasil Ujian</div>
    <form method="get" class="row g-3 mb-4">
      <div class="col-md-4">
        <label for="mapel" class="form-label">Mata Pelajaran</label>
        <select name="mapel" id="mapel" class="form-select">
          <option value="">Semua</option>
          <?php foreach ($mapel_options as $mapel): ?>
            <option value="<?= $mapel['id'] ?>" <?= ($filter_mapel == $mapel['id']) ? 'selected' : '' ?>>
                <?= esc($mapel['nama_mapel']) ?>
            </option>
            <?php endforeach; ?>

        </select>
      </div>
      <div class="col-md-4">
        <label for="jenis" class="form-label">Jenis Ujian</label>
        <select name="jenis" id="jenis" class="form-select">
          <option value="">Semua</option>
          <?php foreach ($jenis_options as $jenis): ?>
            <option value="<?= $jenis['id_jenis_ujian'] ?>" <?= ($filter_jenis == $jenis['id_jenis_ujian']) ? 'selected' : '' ?>>
                <?= esc($jenis['jenis_ujian']) ?>
            </option>
            <?php endforeach; ?>


        </select>
      </div>
      <div class="col-md-4 align-self-end">
        <button type="submit" class="btn btn-light">Terapkan Filter</button>
      </div>
    </form>

    <!-- Tabel Hasil -->
    <div class="section-title">Detail Jawaban Ujian</div>
    <?php if (!empty($hasil_ujian)): ?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped bg-white text-dark">
          <thead>
            <tr>
              <th>#</th>
              <th>Mata Pelajaran</th>
              <th>Jenis Ujian</th>
              <th>Tanggal</th>
              <th>Soal</th>
              <th>Jawaban Siswa</th>
              <th>Kunci Jawaban</th>
              <th>Bobot</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($hasil_ujian as $i => $row): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= esc($row['nama_mapel'] ?? '-') ?></td>
                <td><?= esc($row['jenis_ujian'] ?? '-') ?></td>
                <td><?= esc(date('d-m-Y', strtotime($row['tanggal_mulai'] ?? ''))) ?></td>
                <td><?= esc($row['soal']) ?></td>
                <td><?= esc($row['jawaban_siswa'] ?? '-') ?></td>
                <td><?= esc($row['kunci_jawaban']) ?></td>
                <td><?= esc($row['bobot']) ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="fst-italic text-light">Belum ada data hasil ujian yang tersedia.</p>
    <?php endif ?>
  </div>
</div>
