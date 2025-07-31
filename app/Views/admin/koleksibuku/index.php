<?= $this->include('layout/header') ?>

<style>
  .kb-index-wrapper{
    position:relative;
    background:url('<?= base_url('assets/img/toga.jpg') ?>') center/cover no-repeat;
    min-height:100vh;overflow-x:hidden
  }
  .kb-overlay{position:absolute;inset:0;background:rgba(0,0,0,.6);backdrop-filter:blur(8px);z-index:1}
  .kb-content{position:relative;z-index:2;background:rgba(255,255,255,.92);padding:2rem;margin:2rem;border-radius:10px}
</style>

<div class="d-flex kb-index-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="kb-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <!-- header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button id="toggleSidebar" class="btn btn-outline-light me-3"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Data Koleksi Buku</strong></h4>
      <div><?= esc(session('nama_lengkap')) ?> | <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a></div>
    </div>

    <!-- konten -->
    <div class="flex-grow-1 kb-content shadow-sm">
      <a href="<?= base_url('/admin/koleksibuku/create') ?>" class="btn btn-primary mb-3"><i class="bi bi-plus-lg"></i> Tambah Buku</a>

      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <div class="table-responsive">
        <table id="bukuTable" class="table table-striped table-bordered">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Jenis Buku</th>
              <th>Pengarang</th>
              <th>Penerbit / Th</th>
              <th>Deskripsi</th>
              <th>Status</th>
              <th>File</th>
              <th>Cover</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach($koleksi as $b): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($b['judul']) ?></td>
              <td><?= esc($b['nama_jenis_buku'] ?? '-') ?></td>
              <td><?= esc($b['pengarang']) ?></td>
              <td><?= esc($b['penerbit']).' / '.esc($b['tahun_terbit']) ?></td>
              <td style="max-width:200px; word-break: break-word;"><?= esc($b['deskripsi']) ?></td>
              <?php
                $statusVal  = $b['status'];                     // nilai mentah dari DB
                $isTampil   = ($statusVal === 'tampil');        // sesuaikan dengan value di form
                $badgeClass = $isTampil ? 'success' : 'secondary';
                $label      = $isTampil ? 'Tampil' : 'Tidak Tampil';
                ?>
                <td>
                <span class="badge bg-<?= $badgeClass ?>"><?= $label ?></span>
                </td>
              <td>
                <?php if($b['file_pdf']): ?>
                  <a href="<?= base_url('uploads/pdf/'.$b['file_pdf']) ?>" target="_blank" class="btn btn-sm btn-outline-info">PDF</a>
                <?php endif; ?>
              </td>
              <td>
                <?php if($b['cover']): ?>
                  <img src="<?= base_url('uploads/cover/'.$b['cover']) ?>" alt="cover" style="width:40px;height:40px;object-fit:cover">
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= base_url('admin/koleksibuku/edit/'.$b['id_buku']) ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                <form action="<?= base_url('admin/koleksibuku/delete/'.$b['id_buku']) ?>" method="post" style="display:inline" onsubmit="return confirm('Hapus buku?');">
                  <?= csrf_field() ?>
                  <button class="btn btn-sm btn-danger">Hapus</button>
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

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(function(){ $('#bukuTable').DataTable({responsive:true}); });
</script>

