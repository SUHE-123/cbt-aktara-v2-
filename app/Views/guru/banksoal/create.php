<?= $this->include('layout/header') ?>

<style>
  .form-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .form-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .form-container {
    position: relative;
    z-index: 2;
    padding: 2rem;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.9);
  }

  .soal-group {
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    border-radius: 6px;
  }
</style>

<div class="d-flex form-wrapper">
  <?= $this->include('layout/sidebar2') ?>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="form-overlay"></div>

    <!-- Header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Tambah Data Bank Soal & Soal</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="container py-5 form-container mt-4 shadow">
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <form action="<?= base_url('/guru/banksoal/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Data Bank Soal -->
        <div class="mb-3">
          <label for="bank_code" class="form-label">Kode Bank</label>
          <input type="text" name="bank_code" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="id_mapel" class="form-label">Mata Pelajaran</label>
          <select name="id_mapel" class="form-select" required>
            <option value="">-- Pilih Mapel --</option>
            <?php foreach ($mapel as $m): ?>
              <option value="<?= $m['id'] ?>"><?= esc($m['nama_mapel']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="jumlah_soal" class="form-label">Jumlah Soal</label>
          <input type="number" name="jumlah_soal" id="jumlahSoal" class="form-control" min="1" required>
        </div>

        <hr>

        <!-- Soal Dynamic -->
        <div id="soalContainer"></div>

        <button type="submit" class="btn btn-success mt-3"><i class="bi bi-save"></i> Simpan</button>
        <a href="<?= base_url('/guru/banksoal') ?>" class="btn btn-secondary ms-2">Kembali</a>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('jumlahSoal').addEventListener('change', function () {
  const jumlah = parseInt(this.value);
  const container = document.getElementById('soalContainer');
  container.innerHTML = '';

  for (let i = 0; i < jumlah; i++) {
    container.innerHTML += `
      <div class="soal-group">
        <h5>Soal ${i + 1}</h5>

        <div class="mb-2">
          <label>Soal</label>
          <textarea name="soal[${i}][soal]" class="form-control" rows="2" required></textarea>
        </div>

        <div class="mb-2">
          <label>File Soal (gambar/pdf)</label>
          <input type="file" name="soal[${i}][file_soal]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
        </div>

        <div class="row g-2">
          <div class="col-md-6">
            <label>Opsi A</label>
            <input type="text" name="soal[${i}][opsi_a]" class="form-control">
          </div>
          <div class="col-md-6">
            <label>File A</label>
            <input type="file" name="soal[${i}][file_a]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
          </div>

          <div class="col-md-6">
            <label>Opsi B</label>
            <input type="text" name="soal[${i}][opsi_b]" class="form-control">
          </div>
          <div class="col-md-6">
            <label>File B</label>
            <input type="file" name="soal[${i}][file_b]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
          </div>

          <div class="col-md-6">
            <label>Opsi C</label>
            <input type="text" name="soal[${i}][opsi_c]" class="form-control">
          </div>
          <div class="col-md-6">
            <label>File C</label>
            <input type="file" name="soal[${i}][file_c]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
          </div>

          <div class="col-md-6">
            <label>Opsi D</label>
            <input type="text" name="soal[${i}][opsi_d]" class="form-control">
          </div>
          <div class="col-md-6">
            <label>File D</label>
            <input type="file" name="soal[${i}][file_d]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
          </div>

          <div class="col-md-6">
            <label>File E (opsional)</label>
            <input type="file" name="soal[${i}][file_e]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
          </div>
        </div>

        <div class="mt-3">
          <label>Jawaban</label>
          <select name="soal[${i}][jawaban]" class="form-select" required>
            <option value="">-- Pilih Jawaban --</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
          </select>
        </div>

        <div class="mt-2">
          <label>Bobot</label>
          <input type="number" name="soal[${i}][bobot]" class="form-control" value="1" min="1">
        </div>
      </div>
    `;
  }
});
</script>
