<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\D_pengaduan;

class Pages extends BaseController
{
    protected $table = "tbl_pengaduan";
    private $D_pengaduan;
    private $auth;

    public function index()
    {
        return view('homepage');
    }
    public function pengaduan()
    {
        return view('pengaduan');
    }
    public function login()
    {
        return view('login');
    }

    public function backend()
    {
        return view('backend');
    }

    public function __construct()
    {
        $this->D_pengaduan = new D_pengaduan();
        $this->auth = new Auth();
    }

    public function kelolapengaduan()
    {
        $isLoggedIn = session()->get('isLoggedIn');
        $role = session()->get('role');

        if ($isLoggedIn && $this->auth->checkPermission($role, 'kelolapengaduan_access')) {
            // Ambil nilai filter dari URL
            $statusFilter = $this->request->getGet('status');

            // Tampilkan halaman kelolapengaduan.php
            $data = [
                'pengaduan' => $this->D_pengaduan->get_filtered_data($statusFilter), // Menambahkan parameter filter
                'statusFilter' => $statusFilter, // Mengirim nilai filter ke view
            ];
            return view('kelolapengaduan', $data);
        } else {
            // Redirect ke halaman login jika tidak memiliki izin akses
            return redirect()->to('/login');
        }
    }

    public function hapuspengaduan($id)
    {
        $data = [
            'id' => $id
        ];
        $this->D_pengaduan->hapusData($data);
        session()->setFlashdata('pesan', 'Berhasil Menghapus Data');
        return redirect()->to(base_url('/kelolapengaduan'));
    }


    public function simpan()
    {
        $nama = $this->request->getPost("nama");
        $ktp = $this->request->getPost("ktp");
        $telp = $this->request->getPost("telp");
        $jenis = $this->request->getPost("jenis");
        $deskripsi = $this->request->getPost("deskripsi");
        $waktuKejadian = $this->request->getPost("waktu_kejadian");
        $lokasiKejadian = $this->request->getPost("lokasi_kejadian");

        $foto = $this->request->getFile('foto');

        if ($foto != null && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/', $newName);
        }
        $data = [
            'nama' => $nama,
            'no_telp' => $telp,
            'jenis_pengaduan' => $jenis,
            'foto' => $foto->getName(), // Ubah disini
            'deskripsi_pengaduan' => $deskripsi,
            'waktu_kejadian' => $waktuKejadian,
            'lokasi_kejadian' => $lokasiKejadian,
        ];
        $this->D_pengaduan->simpanData($this->table, $data);

        return redirect()->to('/pengaduan');
    }

    public function konfirmasipengaduan($id)
    {
        $data = [
            'id' => $id,
            'status' => 'Sudah Dikonfirmasi'
        ];
        $this->D_pengaduan->updateData($data); // Anggap ada method updateData() di model D_pengaduan untuk melakukan pembaruan data
        session()->setFlashdata('pesan', 'Berhasil Mengkonfirmasi Pengaduan');
        return redirect()->to(base_url('/kelolapengaduan'));
    }
}
