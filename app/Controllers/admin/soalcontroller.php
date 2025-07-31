<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SoalModel;
use App\Models\BankSoalModel;

class soalcontroller extends BaseController
{
    protected $soalModel;
    protected $bankSoalModel;

    public function __construct()
    {
        $this->soalModel = new SoalModel();
        $this->bankSoalModel = new BankSoalModel();
    }

    public function index($id_bank)
    {
        $data['bank'] = $this->bankSoalModel->find($id_bank);
        $data['soal'] = $this->soalModel->where('id_bank', $id_bank)->findAll();

        return view('admin/soal/index', $data);
    }

    public function create($id_bank)
    {
        $data['id_bank'] = $id_bank;
        return view('admin/soal/create', $data);
    }

        public function store($id_bank)
    {
        $data = [
            'id_bank' => $id_bank,
            'soal' => $this->request->getPost('soal'),
            'opsi_a' => $this->request->getPost('opsi_a'),
            'opsi_b' => $this->request->getPost('opsi_b'),
            'opsi_c' => $this->request->getPost('opsi_c'),
            'opsi_d' => $this->request->getPost('opsi_d'),
            'opsi_e' => $this->request->getPost('opsi_e') ?? null, // Opsi E opsional
            'jawaban' => $this->request->getPost('jawaban'),
            'bobot' => $this->request->getPost('bobot') ?? 1,
        ];

        // Tangani file_soal
        $fileSoal = $this->request->getFile('file_soal');
        if ($fileSoal && $fileSoal->isValid() && !$fileSoal->hasMoved()) {
            $newName = $fileSoal->getRandomName();
            $fileSoal->move('writable/uploads/soal', $newName);
            $data['file_soal'] = $newName;
        }

        // Tangani file_a - file_e
        foreach (['a', 'b', 'c', 'd', 'e'] as $opt) {
            $file = $this->request->getFile("file_$opt");
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('writable/uploads/soal', $newName);
                $data["file_$opt"] = $newName;
            }
        }

        $this->soalModel->insert($data);

        return redirect()->to("/admin/soal/{$id_bank}")->with('success', 'Soal berhasil ditambahkan.');
    }

    

    public function edit($id_soal)
    {
        $data['soal'] = $this->soalModel->find($id_soal);
        return view('admin/soal/edit', $data);
    }

    public function update($id_soal)
    {
        $soal = $this->soalModel->find($id_soal);
    
        $data = [
            'soal' => $this->request->getPost('soal'),
            'opsi_a' => $this->request->getPost('opsi_a'),
            'opsi_b' => $this->request->getPost('opsi_b'),
            'opsi_c' => $this->request->getPost('opsi_c'),
            'opsi_d' => $this->request->getPost('opsi_d'),
            'opsi_e' => $this->request->getPost('opsi_e') ?? null, // Opsi E opsional
            'jawaban' => $this->request->getPost('jawaban'),
            'bobot' => $this->request->getPost('bobot') ?? 1,
        ];
    
        $fileSoal = $this->request->getFile('file_soal');
        if ($fileSoal && $fileSoal->isValid() && !$fileSoal->hasMoved()) {
            $newName = $fileSoal->getRandomName();
            $fileSoal->move('writable/uploads/soal', $newName);
            $data['file_soal'] = $newName;
        }
    
        foreach (['a', 'b', 'c', 'd', 'e'] as $opt) {
            $file = $this->request->getFile("file_$opt");
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('writable/uploads/soal', $newName);
                $data["file_$opt"] = $newName;
            }
        }
    
        $this->soalModel->update($id_soal, $data);
    
        return redirect()->to("/admin/soal/{$soal['id_bank']}")->with('success', 'Soal berhasil diperbarui.');
    }
    

    public function delete($id_soal)
    {
        $soal = $this->soalModel->find($id_soal);
        $id_bank = $soal['id_bank'];

        $this->soalModel->delete($id_soal);

        return redirect()->to("/admin/soal/{$id_bank}")->with('success', 'Soal berhasil dihapus.');
    }
}
