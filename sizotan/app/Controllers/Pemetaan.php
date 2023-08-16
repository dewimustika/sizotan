<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\D_zonarawan;

class Pemetaan extends BaseController
{
    protected $table = "zonarawan";
    private $D_zonarawan;
    private $auth;

    public function __construct()
    {
        $this->D_zonarawan = new D_zonarawan();
        $this->auth = new Auth();
    }

    public function zonarawan()
    {
        $data = [
            'zonarawan' => $this->D_zonarawan->get_all_data(),
        ];
        return view('homepage', $data);
    }

    public function backend()
    {
        $isLoggedIn = session()->get('isLoggedIn');
        $role = session()->get('role');

        if ($isLoggedIn && $this->auth->checkPermission($role, 'backend_access')) {
            // Tampilkan halaman backend.php
            $data = [
                'zonarawan' => $this->D_zonarawan->get_all_data(),
            ];
            return view('backend', $data);
        } else {
            // Redirect ke halaman login jika tidak memiliki izin akses
            return redirect()->to('/login');
        }
    }

    public function tambahzonarawan()
    {
        $data = [
            'zonarawan' => $this->D_zonarawan->get_all_data(),
        ];
        return view('tambahzona', $data);
    }

    public function simpan()
    {
        $nama = $this->request->getPost("nama");
        $latitude = $this->request->getPost("latitude");
        $longitude = $this->request->getPost("longitude");
        $radius = $this->request->getPost("radius");
        $jammulai = $this->request->getPost("jammulai");
        $jamselesai = $this->request->getPost("jamselesai");
        $jeniskejahatan = $this->request->getPost("jeniskejahatan");
        $antisipasi = $this->request->getPost("antisipasi");

        $data = [
            'nama' => $nama,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'radius' => $radius,
            'jammulai' => $jammulai,
            'jamselesai' => $jamselesai,
            'jeniskejahatan' => $jeniskejahatan,
            'antisipasi' => $antisipasi
        ];
        $this->D_zonarawan->simpanData($this->table, $data); // Menyimpan data ke model

        return redirect()->to('/backend'); // Mengarahkan pengguna ke halaman kelolapengaduan setelah penyimpanan berhasil
    }

    public function hapuszona($id)
    {
        $data = [
            'id' => $id
        ];
        $this->D_zonarawan->hapusData($data);
        session()->setFlashdata('pesan', 'Berhasil Menghapus Data');
        return redirect()->to(base_url('/backend'));
    }

    public function editzona($id)
    {
        // Mengambil data zona rawan berdasarkan ID
        $model = new D_zonarawan();
        $data['zonarawan'] = $model->getZonaRawanById($id);

        if (empty($data['zonarawan'])) {
            // Redirect atau tampilkan pesan jika data tidak ditemukan
            return redirect()->to('/backend')->with('error', 'Data tidak ditemukan.');
        }

        // Validasi form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'jeniskejahatan' => 'required',
            'jammulai' => 'required',
            'jamselesai' => 'required',
            'antisipasi' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            // Jika validasi gagal, tampilkan kembali halaman edit dengan pesan error
            return view('editzona', $data);
        } else {
            // Jika validasi berhasil, proses update data
            $model->updateZonaRawan($this->request->getPost(), $id);

            // Redirect ke halaman index atau tampilkan pesan sukses
            return redirect()->to('/backend')->with('success', 'Data berhasil diupdate.');
        }
    }

    public function detailZona($id)
    {
        $model = new D_zonarawan();
        $data['zona'] = $model->getZonaRawanById($id);

        return view('detailzona', $data);
    }
}
