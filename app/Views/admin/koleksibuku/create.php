<?= $this->include('layout/header') ?>

<style>
  .kb-form-wrapper{position:relative;background:url('<?= base_url('assets/img/toga.jpg') ?>') center/cover no-repeat;min-height:100vh;overflow-x:hidden}
  .kb-overlay{position:absolute;inset:0;background:rgba(0,0,0,.6);backdrop-filter:blur(8px);z-index:1}
  .kb-container{position:relative;z-index:2;background:rgba(255,255,255,.88);padding:2rem;margin:2rem;border-radius:10px}
</style>

<div class="d-flex kb-form-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="kb-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <!-- header -->
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button id="toggleSidebar" class="btn btn-outline-light me-3"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Tambah Koleksi Buku</strong></h4>
      <div><?= esc(session('nama_lengkap')) ?> | <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a></div>
    </div>

    <!-- form -->
    <div class="container kb-container shadow">
      <form action="<?= base_url('/admin/koleksibuku/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label class="form-label">Jenis Buku</label>
          <select name="id_jenis_buku" class="form-select" required>
            <option value="">-- Pilih --</option>
            <?php foreach($jenis as $j): ?>
              <option value="<?= $j['id'] ?>"><?= esc($j['nama_jenis_buku']) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pengarang</label>
            <input type="text" name="pengarang" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" min="1900" max="<?= date('Y') ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">File PDF</label>
            <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Cover (jpg/png)</label>
            <input type="file" name="cover" class="form-control" accept="image/*">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Status Tampil</label>
          <select name="status" class="form-select">
            <option value="tampil" selected>Tampil</option>
            <option value="tidak tampil">Tidak Tampil</option>
          </select>
        </div>

        <button class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
        <a href="<?= base_url('/admin/koleksibuku') ?>" class="btn btn-secondary ms-2">Kembali</a>
      </form>
    </div>
  </div>
</div>

