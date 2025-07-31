<?= $this->include('layout/header') ?>

<style>
    .confirm-wrapper {
        min-height: 100vh;
        background: url('<?= base_url('assets/img/toga.jpg') ?>') center center / cover no-repeat;
        position: relative;
        overflow: hidden;
    }

    .confirm-wrapper::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(8px);
        z-index: 1;
    }

    .confirm-content {
        position: relative;
        z-index: 2;
        padding: 2rem;
        color: white;
    }

    .card-custom {
        background-color: rgba(255, 255, 255, 0.9);
        border: none;
        color: #000;
    }

    .section-title {
        margin-bottom: 1rem;
        border-bottom: 2px solid #fff;
        padding-bottom: 5px;
    }
</style>

<div class="d-flex confirm-wrapper">
    <?= $this->include('layout/sidebar3') ?>
    <div class="main-content flex-grow-1 confirm-content">
        
        <!-- Navbar -->
        <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm mb-3">
            <button class="btn btn-outline-light me-2" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0">Konfirmasi Ujian</h4>
            <div>
                <?= esc(session('nama_lengkap')) ?> |
                <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
            </div>
        </div>

        <!-- Flashdata -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php elseif (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif ?>

        <div class="section-title">Daftar Jadwal Ujian</div>

        <?php if (!empty($jadwal_ujian)): ?>
            <div class="row">
                <?php foreach ($jadwal_ujian as $jadwal): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card card-custom shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= esc($jadwal['nama_mapel']) ?></h5>
                                <p class="card-text">
                                    Tanggal: <?= date('d-m-Y', strtotime($jadwal['tanggal_mulai'])) ?><br>
                                    Jenis: <?= esc($jadwal['jenis_ujian']) ?><br>
                                    Kode Bank: <?= esc($jadwal['bank_code']) ?>
                                </p>

                                <form method="post" action="<?= base_url('siswa/ujian/konfirmasi') ?>" class="mt-auto">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_jadwal" value="<?= $jadwal['id_jadwal'] ?>">
                                    <div class="mb-2">
                                        <input type="text" name="token_ujian" class="form-control" placeholder="Masukkan Token Ujian...">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Konfirmasi Token</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <p class="text-light">Tidak ada jadwal ujian yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>
