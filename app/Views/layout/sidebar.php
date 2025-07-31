<?php
  $uri = service('uri');
  $segment2 = $uri->getSegment(2);
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
    <!-- Profil Admin -->
    <div class="text-center mb-4">
        <img src="<?= base_url('uploads/profile/' . (session()->get('foto') ?? 'default.png')) ?>" alt="Foto Admin" class="rounded-circle border mb-2" style="width: 80px; height: 80px; object-fit: cover;">
        <h5 class="mb-1"><?= esc(session()->get('nama_lengkap') ?? 'Admin CBT') ?></h5>
        <?php if (session()->get('email')): ?>
            <p class="mb-1 text-muted small"><i class="bi bi-envelope"></i> <?= esc(session()->get('email')) ?></p>
        <?php endif; ?>
        <?php if (session()->get('no_hp')): ?>
            <p class="mb-2 text-muted small"><i class="bi bi-telephone"></i> <?= esc(session()->get('no_hp')) ?></p>
        <?php endif; ?>
        <a href="<?= base_url('/admin/profil') ?>" class="btn btn-sm btn-outline-light mt-2"><i class="bi bi-person-circle"></i> Edit Profil</a>
    </div>

    <hr>

    <!-- Menu Navigasi -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?= base_url('/admin/dashboard') ?>" class="nav-link fw-bold <?= $segment2 == 'dashboard' ? 'active bg-white text-dark' : 'text-white' ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <!-- Toggle Item Template -->
        <?php
        $menuItems = [
            'dataUmumMenu' => [
                'icon' => 'bi-folder',
                'title' => 'Data Umum',
                'segments' => ['jenisbuku','koleksibuku','sekolah','guru','siswa','mapel'],
                'items' => [
                    'jenisbuku' => 'Jenis Buku',
                    'koleksibuku' => 'Koleksi Buku',
                    'sekolah' => 'Sekolah',
                    'guru' => 'Guru',
                    'siswa' => 'Siswa',
                    'mapel' => 'Mata Pelajaran'
                ]
            ],
            'dataUjianMenu' => [
                'icon' => 'bi-journal-text',
                'title' => 'Data Ujian',
                'segments' => ['jenisujian','sesiujian','nomorpeserta','banksoal','jadwalujian','alokasiewaktu','tokenujian'],
                'items' => [
                    'jenisujian' => 'Jenis Ujian',
                    'sesiujian' => 'Sesi Ujian',
                    'nomorpeserta' => 'Nomor Peserta',
                    'banksoal' => 'Bank Soal',
                    'jadwalujian' => 'Jadwal Ujian',
                    'alokasiwaktu' => 'Alokasi Waktu',
                    'token' => 'Token Ujian'
                ]
            ],
            'pelaksanaanMenu' => [
                'icon' => 'bi-play-circle',
                'title' => 'Pelaksanaan Ujian',
                'segments' => ['kartupeserta','statusujian','hasilujian','analisasoal','rekapnilai'],
                'items' => [
                    'kartupeserta' => 'Cetak Kartu Ujian',
                    'statusujian' => 'Status Ujian',
                    'hasilujian' => 'Hasil Ujian',
                    'analisasoal' => 'Analisa Soal',
                    'rekapnilai' => 'Rekap Nilai'
                ]
            ]
        ];

        foreach ($menuItems as $id => $menu) {
            $isActive = in_array($segment2, $menu['segments']);
            echo "<li>
                <a href=\"#\" class=\"nav-link fw-bold text-white toggle\" data-target=\"#$id\" aria-expanded=\"$isActive\">
                    <i class=\"bi {$menu['icon']} me-2\"></i> {$menu['title']}
                </a>
                <div class=\"submenu ms-3\" id=\"$id\" style=\"display: " . ($isActive ? 'block' : 'none') . ";\">
            ";
            foreach ($menu['items'] as $key => $label) {
                $activeClass = $segment2 == $key ? 'bg-white text-dark fw-bold' : 'text-white';
                echo "<a href=\"" . base_url("/admin/$key") . "\" class=\"nav-link $activeClass\">$label</a>";
            }
            echo "</div></li>";
        }
        ?>

        <!-- User Management -->
        <li>
            <a href="<?= base_url('/admin/users') ?>" class="nav-link fw-bold <?= $segment2 == 'users' ? 'active bg-white text-dark' : 'text-white' ?>">
                <i class="bi bi-people me-2"></i> User Management
            </a>
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