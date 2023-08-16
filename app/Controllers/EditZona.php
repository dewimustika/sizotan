<?php

namespace App\Controllers;

use App\Models\D_editzona;

class ZonaRawan extends BaseController
{
    public function editzona($id)
    {
        // Mengambil data zona rawan berdasarkan ID
        $model = new D_editzona();
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

    public function edit($id)
    {
        $model = new D_editzona();

        $data['zonarawan'] = $model->find($id);

        if (!$data['zonarawan']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Zona Rawan tidak ditemukan: ' . $id);
        }

        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama' => 'required',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model->update($id, [
                    'nama' => $this->request->getPost('nama'),
                    'latitude' => $this->request->getPost('latitude'),
                    'longitude' => $this->request->getPost('longitude')
                ]);

                return redirect()->to('/zonarawan')->with('success', 'Zona Rawan berhasil diperbarui.');
            }
        }

        return view('zonarawan/editzona', $data);
    }

    public function backend()
    {
        return view('backend');
    }
}
