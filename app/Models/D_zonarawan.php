<?php

namespace App\Models;

use CodeIgniter\Model;

class D_zonarawan extends Model
{
    protected $table = 'zonarawan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'latitude', 'longitude', 'radius', 'jeniskejahatan', 'jammulai', 'jamselesai', 'antisipasi'];

    public function get_all_data()
    {
        $db = \Config\Database::connect(); // Mendapatkan objek database baru
        return $db->table('zonarawan')->get()->getResultArray();
    }

    function simpanData($table, $data)
    {
        $db = \Config\Database::connect(); // Mendapatkan objek database baru
        $db->table($table)->insert($data);

        return true;
    }

    function hapusData($data)
    {
        $this->db->table('zonarawan')->where('id', $data['id'])->delete($data);
    }

    public function getZonaRawanById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function updateZonaRawan($data, $id)
    {
        return $this->update($id, $data);
    }
}
