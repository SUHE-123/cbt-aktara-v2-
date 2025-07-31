<?= $this->include('layout/header') ?>

<style>
  .analisa-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .analisa-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .analisa-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }
</style>

<div class="d-flex analisa-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="analisa-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Analisa Soal</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="flex-grow-1 analisa-content shadow">
      <form method="get" class="mb-4">
        <div class="row g-3">
          <div class="col-md-5">
            <label for="jadwal" class="form-label">Filter Berdasarkan Jadwal</label>
            <select name="jadwal" id="jadwal" class="form-select" onchange="this.form.submit()">
              <option value="">-- Semua Jadwal --</option>
              <?php foreach ($daftarJadwal as $jadwal): ?>
                <option value="<?= $jadwal['id_jadwal'] ?>" <?= $jadwalDipilih == $jadwal['id_jadwal'] ? 'selected' : '' ?>>
                  <?= esc($jadwal['nama_ujian'] ?? 'Tanpa Nama') ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-5">
            <label for="bank" class="form-label">Filter Berdasarkan Bank Soal</label>
            <select name="bank" id="bank" class="form-select" onchange="this.form.submit()">
              <option value="">-- Semua Bank --</option>
              <?php foreach ($daftarBank as $bank): ?>
                <option value="<?= $bank['id_bank'] ?>" <?= $bankDipilih == $bank['id_bank'] ? 'selected' : '' ?>>
                  <?= esc($bank['bank_code']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="analisaTable">
          <thead class="table-dark">
            <tr class="text-center">
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Nomor Peserta</th>
              <th>Kelas</th>
              <th>Soal</th>
              <th>Jawaban Siswa</th>
              <th>Kunci Jawaban</th>
              <th>Skor</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($analisa as $a): ?>
              <?php
                $skor = $a['jawaban_siswa'] === $a['kunci_jawaban'] ? $a['bobot'] : 0;
              ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= esc($a['nama_lengkap']) ?></td>
                <td><?= esc($a['nomor_peserta']) ?></td>
                <td><?= esc($a['kelas']) ?></td>
                <td><?= esc($a['soal']) ?></td>
                <td class="text-center"><?= esc($a['jawaban_siswa']) ?></td>
                <td class="text-center"><?= esc($a['kunci_jawaban']) ?></td>
                <td class="text-center"><?= $skor ?></td>
              </tr>
            <?php endforeach ?>
            <?php if (empty($analisa)): ?>
              <tr><td colspan="8" class="text-center">Data tidak ditemukan.</td></tr>
            <?php endif; ?>
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
    $('#analisaTable').DataTable({
      responsive: true,
      ordering: true
    });
  });
</script>
