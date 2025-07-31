<?= $this->include('layout/header') ?>

<style>
  .guru-edit-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }
  .guru-edit-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }
  .guru-edit-container {
    position: relative;
    z-index: 2;
    padding: 2rem;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.9);
    margin: 2rem;
  }
  .soal-group {
    padding: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    background-color: #f8f8f8;
    border-radius: 6px;
  }
</style>

<div class="d-flex guru-edit-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="guru-edit-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Edit Bank Soal & Soal</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="guru-edit-container shadow">
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <form action="<?= base_url('/admin/banksoal/update/' . $bank['id_bank']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Bank Soal -->
        <div class="mb-3">
          <label for="bank_code" class="form-label">Kode Bank</label>
          <input type="text" name="bank_code" class="form-control" value="<?= esc($bank['bank_code']) ?>" required>
        </div>

        <div class="mb-3">
          <label for="id_mapel" class="form-label">Mata Pelajaran</label>
          <select name="id_mapel" class="form-select" required>
            <option value="">-- Pilih Mapel --</option>
            <?php foreach ($mapel as $m): ?>
              <option value="<?= $m['id'] ?>" <?= $bank['id_mapel'] == $m['id'] ? 'selected' : '' ?>>
                <?= esc($m['nama_mapel']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="jumlah_soal" class="form-label">Jumlah Soal</label>
          <input type="number" name="jumlah_soal" class="form-control" value="<?= esc($bank['jumlah_soal']) ?>" required>
          <div class="form-text">Jumlah soal tidak akan menambah atau menghapus soal yang ada.</div>
        </div>

        <hr>
        <h5><strong>Edit Soal</strong></h5>

        <?php if (!empty($soal)): ?>
          <?php foreach ($soal as $i => $s): ?>
            <div class="soal-group">
              <input type="hidden" name="soal[<?= $s['id_soal'] ?>][id_soal]" value="<?= $s['id_soal'] ?>">

              <div class="mb-2">
                <label>Soal</label>
                <textarea name="soal[<?= $s['id_soal'] ?>][soal]" class="form-control" rows="2"><?= esc($s['soal']) ?></textarea>
              </div>

              <div class="mb-2">
                <label>File Soal (kosongkan jika tidak diubah)</label>
                <input type="file" name="soal[<?= $s['id_soal'] ?>][file_soal]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
              </div>

              <div class="row g-2">
                <?php foreach (['a', 'b', 'c', 'd', 'e'] as $huruf): ?>
                  <?php if ($huruf !== 'e'): ?>
                    <div class="col-md-6">
                      <label>Opsi <?= strtoupper($huruf) ?></label>
                      <input type="text" name="soal[<?= $s['id_soal'] ?>][opsi_<?= $huruf ?>]" class="form-control" value="<?= esc($s['opsi_' . $huruf]) ?>">
                    </div>
                  <?php endif; ?>
                  <div class="col-md-6">
                    <label>File <?= strtoupper($huruf) ?> (kosongkan jika tidak diubah)</label>
                    <input type="file" name="soal[<?= $s['id_soal'] ?>][file_<?= $huruf ?>]" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="mt-2">
                <label>Jawaban</label>
                <select name="soal[<?= $s['id_soal'] ?>][jawaban]" class="form-select">
                  <option value="">-- Pilih Jawaban --</option>
                  <?php foreach (['A','B','C','D','E'] as $opsi): ?>
                    <option value="<?= $opsi ?>" <?= $s['jawaban'] == $opsi ? 'selected' : '' ?>><?= $opsi ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mt-2">
                <label>Bobot</label>
                <input type="number" name="soal[<?= $s['id_soal'] ?>][bobot]" class="form-control" value="<?= esc($s['bobot']) ?>">
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="alert alert-info">Belum ada soal yang terkait dengan bank ini.</div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-save"></i> Update</button>
        <a href="<?= base_url('/admin/banksoal') ?>" class="btn btn-secondary ms-2">Batal</a>
      </form>
    </div>
  </div>
</div>
