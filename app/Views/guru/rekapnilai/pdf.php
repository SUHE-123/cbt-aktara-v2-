<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
        h3 { text-align: center; margin-bottom: 0; }
    </style>
</head>
<body>
    <h3>Rekap Nilai Ujian</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Sekolah</th>
                <th>Mapel</th>
                <th>Jenis Ujian</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($rekap as $r): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($r['nama_lengkap']) ?></td>
                    <td><?= esc($r['kelas']) ?></td>
                    <td><?= esc($r['nama_sekolah']) ?></td>
                    <td><?= esc($r['nama_mapel']) ?></td>
                    <td><?= esc($r['jenis_ujian']) ?></td>
                    <td><?= esc($r['nilai']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
