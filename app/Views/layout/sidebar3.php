<?php
  $uri = service('uri');
  $segment2 = $uri->getSegment(3);
?>

<style>
.sidebar {
    overflow-y: auto;
    max-height: 100vh;
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
}
.sidebar::-webkit-scrollbar {
    width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 4px;
}

.sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transition: background 0.3s ease;
}

.sidebar .nav-link.toggle::after {
    content: "\f078";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    float: right;
    transition: transform 0.3s ease;
}

.sidebar .nav-link.toggle.active::after {
    transform: rotate(180deg);
}
</style>

<div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark shadow-sm" style="width: 250px;">
    <!-- Profil Siswa -->
    <div class="text-center mb-4">
        <img src="<?= base_url('uploads/profile/' . (session()->get('foto') ?? 'default.png')) ?>" alt="Foto Siswa" class="rounded-circle border mb-2" style="width: 80px; height: 80px; object-fit: cover;">
        <h5 class="mb-1"><?= esc(session()->get('nama_lengkap') ?? 'Siswa CBT') ?></h5>
        <a href="<?= base_url('/siswa/profil') ?>" class="btn btn-sm btn-outline-light mt-2"><i class="bi bi-person-circle"></i> Edit Profil</a>
    </div>

    <hr>

    <!-- Menu Navigasi -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?= base_url('/siswa/dashboard') ?>" class="nav-link fw-bold <?= $segment2 == 'dashboard' ? 'active bg-white text-dark' : 'text-white' ?>">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="<?= base_url('/siswa/perpustakaan') ?>" class="nav-link fw-bold <?= $segment2 == 'perpustakaan' ? 'active bg-white text-dark' : 'text-white' ?>">
                <i class="bi bi-book-half me-2"></i> Perpustakaan
            </a>
        </li>

        <li>
            <a href="#" class="nav-link fw-bold text-white toggle <?= in_array($segment2, ['home', 'konfirmasi', 'pelaksanaan', 'hasil']) ? 'active' : '' ?>" data-target="#ujianMenu">
                <i class="bi bi-pencil-square me-2"></i> Pelaksanaan Ujian
            </a>
            <div class="submenu ms-3" id="ujianMenu" style="display: <?= in_array($segment2, ['home', 'konfirmasi', 'pelaksanaan', 'hasil']) ? 'block' : 'none' ?>;">
                <a href="<?= base_url('/siswa/ujian') ?>" class="nav-link <?= $segment2 == 'home' ? 'bg-white text-dark fw-bold' : 'text-white' ?>">Home</a>
                <a href="<?= base_url('/siswa/ujian/konfirmasi') ?>" class="nav-link <?= $segment2 == 'konfirmasi' ? 'bg-white text-dark fw-bold' : 'text-white' ?>">Konfirmasi Ujian</a>
                <a href="<?= base_url('/siswa/ujian/hasil') ?>" class="nav-link <?= $segment2 == 'hasil' ? 'bg-white text-dark fw-bold' : 'text-white' ?>">Hasil Ujian</a>
            </div>
        </li>
    </ul>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.nav-link.toggle').forEach(function(toggle) {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('data-target');
        const submenu = document.querySelector(targetId);
        const isVisible = submenu.style.display === 'block';
        submenu.style.display = isVisible ? 'none' : 'block';
        this.classList.toggle('active', !isVisible);
        this.setAttribute('aria-expanded', !isVisible);
      });
    });
  });
</script>

<!-- Bootstrap (pastikan sudah include JS Bootstrap 5) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const footer = document.getElementById('mainFooter');

    toggleBtn?.addEventListener('click', () => {
      sidebar?.classList.toggle('hidden');
      mainContent?.classList.toggle('full');
      footer?.classList.toggle('full-footer');
    });
  });
</script>
