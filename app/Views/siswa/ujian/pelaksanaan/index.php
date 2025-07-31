<?= $this->include('layout/header') ?>

<style>
.ujian-wrapper {
    min-height: 100vh;
    background: url('<?= base_url('assets/img/toga.jpg') ?>') center center / cover no-repeat;
    position: relative;
    overflow: hidden;
}
.ujian-wrapper::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(6px);
    z-index: 1;
}
.ujian-content {
    position: relative;
    z-index: 2;
    padding: 2rem;
    color: white;
}
.card-custom {
    background-color: rgba(255, 255, 255, 0.92);
    border: none;
    color: #000;
}
</style>

<div class="d-flex ujian-wrapper">
    <?= $this->include('layout/sidebar3') ?>

    <div class="main-content flex-grow-1 ujian-content">
        <!-- Navbar -->
        <div class="navbar-dashboard d-flex justify-content-between align-items-center px-4 py-3 bg-dark text-white shadow-sm mb-3">
            <button class="btn btn-outline-light me-2" id="toggleSidebar">
                <i class="bi bi-list"></i>
            </button>
            <h4 class="mb-0">Pelaksanaan Ujian</h4>
            <div>
                <?= esc(session('nama_lengkap')) ?> |
                <a href="<?= base_url('logout') ?>" class="text-white ms-2">Logout</a>
            </div>
        </div>

        <!-- Timer -->
        <div class="alert alert-warning text-center fw-bold" id="timer">
            Sisa Waktu: <span id="countdown">00:00</span>
        </div>

        <!-- Form Soal -->
        <form id="formUjian" action="<?= base_url('siswa/ujian/pelaksanaan/simpan-jawaban') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_jadwal" value="<?= esc($id_jadwal) ?>">

            <?php foreach ($soalList as $index => $soal): ?>
                <div class="card card-custom shadow-sm mb-4">
                    <div class="card-body">
                        <h5>Soal Nomor <?= $index + 1 ?></h5>
                        <p><?= nl2br(esc($soal['soal'])) ?></p>

                        <?php if (!empty($soal['file_soal'])): ?>
                            <div class="mb-3">
                                <img src="<?= base_url('uploads/soal/' . $soal['file_soal']) ?>" alt="Gambar Soal" class="img-fluid rounded border" style="max-height:300px;">
                            </div>
                        <?php endif; ?>

                        <?php foreach (['A', 'B', 'C', 'D', 'E'] as $opsi): ?>
                            <?php if (!empty($soal['opsi_' . strtolower($opsi)])): ?>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio"
                                           name="jawaban[<?= $soal['id_soal'] ?>]"
                                           id="soal_<?= $soal['id_soal'] ?>_<?= $opsi ?>"
                                           value="<?= $opsi ?>"
                                           <?= (isset($jawabanMap[$soal['id_soal']]) && $jawabanMap[$soal['id_soal']] === $opsi) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="soal_<?= $soal['id_soal'] ?>_<?= $opsi ?>">
                                        <?= $opsi ?>. <?= esc($soal['opsi_' . strtolower($opsi)]) ?>
                                    </label>

                                    <?php if (!empty($soal['gambar_opsi_' . strtolower($opsi)])): ?>
                                        <div class="mt-2 ms-4">
                                            <img src="<?= base_url('uploads/gambar_opsi/' . $soal['gambar_opsi_' . strtolower($opsi)]) ?>" alt="Gambar Opsi <?= $opsi ?>" class="img-fluid rounded border" style="max-height:200px;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-success">Simpan Semua Jawaban</button>
                <button type="button" class="btn btn-outline-light position-fixed bottom-0 start-0 m-4 shadow" id="backToTopBtn" style="display: none; z-index: 999;">
                    <i class="bi bi-arrow-up"></i> Atas
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Timer Script -->
<script>
    let durasi = <?= (int) $durasi ?> * 60; // dalam detik
    const countdownEl = document.getElementById('countdown');
    const form = document.getElementById('formUjian');

    function updateTimer() {
        let menit = Math.floor(durasi / 60);
        let detik = durasi % 60;
        countdownEl.textContent = `${String(menit).padStart(2, '0')}:${String(detik).padStart(2, '0')}`;

        if (durasi <= 0) {
            clearInterval(timerInterval);
            alert('Waktu ujian habis! Jawaban akan disimpan otomatis.');
            form.submit();
        }

        durasi--;
    }

    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);
</script>

<script>
    // Tombol Kembali ke Atas
    const backToTopBtn = document.getElementById("backToTopBtn");

    window.addEventListener("scroll", function () {
        backToTopBtn.style.display = window.scrollY > 200 ? "block" : "none";
    });

    backToTopBtn.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
