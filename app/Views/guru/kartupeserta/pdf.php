<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kartu Peserta Ujian</title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 12px;
      margin: 20px;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      page-break-inside: avoid;
    }

    .kartu {
      border: 2px solid #000;
      padding: 10px;
      height: 230px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .kartu img.foto {
      width: 60px;
      height: 80px;
      object-fit: cover;
      border: 1px solid #aaa;
    }

    .kartu img.logo {
      width: 60px;
      height: 60px;
      object-fit: contain;
    }

    .qr {
      width: 70px;
      height: 70px;
    }

    .judul {
      text-align: center;
      font-weight: bold;
      font-size: 14px;
    }

    .data {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .data-kiri, .data-kanan {
      width: 48%;
    }

    .header-kartu {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .page-break {
      page-break-after: always;
    }
  </style>
</head>
<body>

  <h2 style="text-align:center; margin-bottom: 20px;">Kartu Peserta Ujian</h2>

  <div class="card-grid">
    <?php foreach ($peserta as $p): ?>
      <div class="kartu">
        <div class="header-kartu">
          <img class="logo" src="<?= FCPATH . 'uploads/logo/' . ($p['logo'] ?? 'default.png') ?>" alt="Logo">
          <div class="judul">
            <?= esc($p['nama_sekolah']) ?>
          </div>
          <img
            class="qr"
            src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?= urlencode($p['username'] . '_' . $p['nomor_peserta']) ?>"
            alt="QR Code">
        </div>

        <div class="data">
          <div class="data-kiri">
            <strong>Nama:</strong><br><?= esc($p['nama_lengkap']) ?><br>
            <strong>Kelas:</strong><br><?= esc($p['kelas']) ?><br>
            <strong>Nomor Peserta:</strong><br><?= esc($p['nomor_peserta']) ?>
          </div>
          <div class="data-kanan" style="text-align:right;">
            <img class="foto" src="<?= FCPATH . 'uploads/foto/' . ($p['foto'] ?? 'default.png') ?>" alt="Foto">
            <div class="mt-1"><strong><?= esc($p['username']) ?></strong></div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
