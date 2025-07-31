<?= $this->include('layout/header') ?>

<!-- Latar belakang & overlay blur -->
<style>
    .blur-background {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('<?= base_url('assets/img/toga.jpg') ?>') center center / cover no-repeat;
        z-index: -2;
    }

    .blur-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        background-color: rgba(0, 0, 0, 0.3);
        z-index: -1;
    }
</style>

<div class="blur-background"></div>
<div class="blur-overlay"></div>

<!-- Konten -->
<div class="container mt-5 text-white position-relative">
    <div class="bg-dark bg-opacity-75 text-white rounded shadow p-5">

        <h4 class="mb-4">Edit Profil Admin</h4>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/profil/update') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <!-- Foto profil -->
                <div class="col-md-4 text-center">
                    <img src="<?= base_url('uploads/profile/' . ($user['foto'] ?? 'suhe formal.jpg')) ?>"
                        alt="Foto Profil" class="img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Ganti Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>

                <!-- Data profil -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?? '' ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" name="no_hp" value="<?= $user['no_hp'] ?? '' ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (opsional)</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

