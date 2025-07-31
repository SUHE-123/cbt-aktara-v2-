<?= $this->include('layout/header') ?>

<style>
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
</style>

<div class="d-flex sekolah-index-wrapper">
  <?= $this->include('layout/sidebar2') ?>
  <div class="sekolah-index-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <!-- HEADER -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <h4 class="mb-0"><strong>Data Bank Soal</strong></h4>
      <div>
        <?= esc(session('nama_lengkap')) ?> |
        <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
      </div>
    </div>

    <!-- ISI KONTEN -->
    <div class="flex-grow-1 sekolah-index-content shadow">
      <!-- Tombol Tambah -->
      <a href="<?= base_url('/guru/banksoal/create') ?>" class="btn btn-primary mb-3">
        <i class=""></i> Tambah Bank Soal
      </a>

      <!-- Notifikasi -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <!-- Tabel -->
      <div class="table-responsive">
        <table id="bankTable" class="table table-striped table-bordered align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Kode Bank</th>
              <th>Mata Pelajaran</th>
              <th>Jumlah Soal</th>
              <th class="text-nowrap">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($bank as $b): ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= esc($b['bank_code']) ?></td>
                <td><?= esc($b['nama_mapel'] ?? '-') ?></td>
                <td class="text-center"><?= esc($b['jumlah_soal']) ?></td>
                <td class="text-nowrap text-center">
                  <!-- Tombol Aksi -->
                  <a href="<?= base_url('guru/banksoal/edit/' . $b['id_bank']) ?>" class="btn btn-sm btn-warning mb-1">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <a href="<?= base_url('guru/soal/' . $b['id_bank']) ?>" class="btn btn-sm btn-info text-white mb-1">
                    <i class="bi bi-list-task"></i> Lihat Soal
                  </a>
                  <form action="<?= base_url('guru/banksoal/delete/' . $b['id_bank']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus bank soal ini?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger mb-1">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
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
  $(function() {
    $('#bankTable').DataTable();
  });
</script>
