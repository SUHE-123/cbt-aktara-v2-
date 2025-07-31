<?= $this->include('layout/header') ?>

<style>.kb-edit-wrapper{position:relative;background:url('<?= base_url('assets/img/toga.jpg') ?>') center/cover no-repeat;min-height:100vh}.kb-overlay{position:absolute;inset:0;background:rgba(0,0,0,.6);backdrop-filter:blur(8px);z-index:1}.kb-container{position:relative;z-index:2;background:rgba(255,255,255,.88);padding:2rem;margin:2rem;border-radius:10px}</style>

<div class="d-flex kb-edit-wrapper">
  <?= $this->include('layout/sidebar') ?>
  <div class="kb-overlay"></div>

  <div class="main-content flex-grow-1 d-flex flex-column">
    <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm z-3">
      <button id="toggleSidebar" class="btn btn-outline-light me-3"><i class="bi bi-list"></i></button>
      <h4 class="mb-0"><strong>Edit Koleksi Buku</strong></h4>
      <div><?= esc(session('nama_lengkap')) ?> | <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a></div>
    </div>

    <div class="container kb-container shadow">
      <form action="<?= base_url('/admin/koleksibuku/update/'.$buku['id_buku']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
          <label class="form-label">Jenis Buku</label>
          <select name="id_jenis_buku" class="form-select" required>
            <?php foreach($jenis as $j): ?>
              <option value="<?= $j['id'] ?>" <?= $buku['id_jenis_buku']==$j['id']?'selected':'' ?>><?= esc($j['nama_jenis_buku']) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= esc($buku['judul']) ?>" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="<?= esc($buku['pengarang']) ?>">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="<?= esc($buku['penerbit']) ?>">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" value="<?= esc($buku['tahun_terbit']) ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3"><?= esc($buku['deskripsi']) ?></textarea>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Ganti PDF (biarkan kosong jika tetap)</label>
            <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Ganti Cover</label>
            <input type="file" name="cover" class="form-control" accept="image/*">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Status Tampil</label>
          <select name="status" class="form-select">
            <option value="tampil" <?= $buku['status']=='tampil'?'selected':'' ?>>Tampil</option>
            <option value="tidak tampil" <?= $buku['status']=='tidak tampil'?'selected':'' ?>>Tidak Tampil</option>
          </select>
        </div>

        <button class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        <a href="<?= base_url('/admin/koleksibuku') ?>" class="btn btn-secondary ms-2">Batal</a>
      </form>
    </div>
  </div>
</div>

