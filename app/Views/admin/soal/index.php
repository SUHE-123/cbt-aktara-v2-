<?= $this->include('layout/header') ?>

<style>
  .soal-wrapper {
    position: relative;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') no-repeat center center;
    background-size: cover;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .soal-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(8px);
    z-index: 1;
  }

  .soal-content {
    position: relative;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    margin: 2rem;
    border-radius: 8px;
  }

  .opsi {
    font-weight: 500;
    margin-bottom: 0.5rem;
  }

  .preview-img {
    max-height: 100px;
    margin-top: 5px;
  }

  .preview-link {
    display: inline-block;
    margin-top: 5px;
    font-size: 0.875rem;
  }
</style>

<?php
function previewFile($filename) {
  if (!$filename) return '';
  $path = base_url('uploads/soal/' . $filename);
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
    return "<img src=\"$path\" class=\"preview-img\">";
  } elseif ($ext === 'pdf') {
    return "<a href=\"$path\" target=\"_blank\" class=\"preview-link btn btn-sm btn-outline-primary\"><i class=\"bi bi-file-earmark-pdf\"></i> Lihat PDF</a>";
  } else {
    return "<a href=\"$path\" target=\"_blank\" class=\"preview-link btn btn-sm btn-outline-secondary\"><i class=\"bi bi-file-earmark\"></i> Lihat File</a>";
  }
}
?>

<div class="d-flex soal-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="soal-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Daftar Soal</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <div class="flex-grow-1 soal-content shadow">
      <a href="<?= base_url('/admin/banksoal') ?>" class="btn btn-success mb-3">← Kembali ke Bank Soal</a>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Soal</th>
              <th>Opsi A - E</th>
              <th>Jawaban</th>
              <th>Bobot</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($soal) > 0): ?>
              <?php $no = 1; foreach ($soal as $s): ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td>
                    <?= esc($s['soal']) ?>
                    <?php if (!empty($s['file_soal'])): ?>
                      <div class="mt-2"><?= previewFile($s['file_soal']) ?></div>
                    <?php endif ?>
                  </td>
                  <td>
                    <div class="opsi">
                      A. <?= esc($s['opsi_a']) ?>
                      <?= previewFile($s['file_a']) ?>
                    </div>
                    <div class="opsi">
                      B. <?= esc($s['opsi_b']) ?>
                      <?= previewFile($s['file_b']) ?>
                    </div>
                    <div class="opsi">
                      C. <?= esc($s['opsi_c']) ?>
                      <?= previewFile($s['file_c']) ?>
                    </div>
                    <div class="opsi">
                      D. <?= esc($s['opsi_d']) ?>
                      <?= previewFile($s['file_d']) ?>
                    </div>
                    <div class="opsi">
                      E. <?= previewFile($s['file_e']) ?>
                    </div>
                  </td>
                  <td class="text-center"><?= esc($s['jawaban']) ?></td>
                  <td class="text-center"><?= esc($s['bobot']) ?></td>
                  <td class="text-nowrap text-center">
                    <form action="<?= base_url('admin/soal/delete/' . $s['id_soal']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus soal ini?');">
                      <?= csrf_field() ?>
                      <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
              <?php endforeach ?>
            <?php else: ?>
              <tr><td colspan="6" class="text-center">Belum ada soal.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
