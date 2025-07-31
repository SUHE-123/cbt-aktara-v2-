<?= $this->include('layout/header') ?>

<style>
  .rekap-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
  }

  .rekap-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(5px);
    z-index: 1;
  }

  .rekap-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255,255,255,0.95);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }

  .filter-form select {
    margin-bottom: 1rem;
  }
</style>

<div class="d-flex rekap-wrapper">
  <?= $this->include('layout/sidebar2') ?>
  <div class="rekap-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Rekap Nilai Ujian</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="rekap-content shadow">
    <a href="<?= base_url('guru/rekapnilai/pdf') ?>" target="_blank" class="btn btn-danger mb-3">
        <i class="bi bi-file-earmark-pdf"></i> Unduh PDF
    </a>

      <form method="get" class="row g-2 filter-form">
        <div class="col-md-3">
          <select name="kelas" class="form-select" onchange="this.form.submit()">
            <option value="all">-- Semua Kelas --</option>
            <?php foreach ($kelasList as $k): ?>
              <option value="<?= $k['kelas'] ?>" <?= $kelasDipilih == $k['kelas'] ? 'selected' : '' ?>><?= esc($k['kelas']) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-md-3">
          <select name="sekolah" class="form-select" onchange="this.form.submit()">
            <option value="all">-- Semua Sekolah --</option>
            <?php foreach ($sekolahList as $s): ?>
              <option value="<?= $s['id'] ?>" <?= $sekolahDipilih == $s['id'] ? 'selected' : '' ?>><?= esc($s['nama_sekolah']) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-md-3">
          <select name="mapel" class="form-select" onchange="this.form.submit()">
            <option value="all">-- Semua Mapel --</option>
            <?php foreach ($mapelList as $m): ?>
              <option value="<?= $m['id'] ?>" <?= $mapelDipilih == $m['id'] ? 'selected' : '' ?>><?= esc($m['nama_mapel']) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="col-md-3">
          <select name="ujian" class="form-select" onchange="this.form.submit()">
            <option value="all">-- Semua Ujian --</option>
            <?php foreach ($ujianList as $u): ?>
              <option value="<?= $u['id_jadwal'] ?>" <?= $ujianDipilih == $u['id_jadwal'] ? 'selected' : '' ?>><?= esc($u['id_jenis_ujian']) ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </form>

      <hr>

      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="rekapTable">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Kelas</th>
              <th>Sekolah</th>
              <th>Mapel</th>
              <th>Ujian</th>
              <th>Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($rekap)): ?>
              <?php $no = 1; foreach ($rekap as $r): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= esc($r['nama_lengkap']) ?></td>
                  <td><?= esc($r['kelas']) ?></td>
                  <td><?= esc($r['nama_sekolah']) ?></td>
                  <td><?= esc($r['nama_mapel']) ?></td>
                  <td><?= esc($r['nama_ujian']) ?></td>
                  <td><strong><?= esc($r['nilai']) ?></strong></td>
                </tr>
              <?php endforeach ?>
            <?php else: ?>
              <tr><td colspan="7" class="text-center">Tidak ada data rekap nilai ditemukan.</td></tr>
            <?php endif ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function () {
    $('#rekapTable').DataTable({ responsive: true });
  });
</script>
