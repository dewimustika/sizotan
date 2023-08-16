<?php

namespace App\Models;

use CodeIgniter\Model;

class D_pengaduan extends Model
{
    protected $table = 'tbl_pengaduan';

    public function get_all_data()
    {
        $db = \Config\Database::connect(); // Mendapatkan objek database baru
        return $db->table('tbl_pengaduan')->get()->getResultArray();
    }

    function simpanData($table, $data)
    {
        $db = \Config\Database::connect(); // Mendapatkan objek database baru
        $db->table($table)->insert($data);

        return true;
    }

    function hapusData($data)
    {
        $this->db->table('tbl_pengaduan')->where('id', $data['id'])->delete($data);
    }

    public function updateData($data)
    {
        $this->db->table($this->table)->where('id', $data['id'])->update(['status' => $data['status']]);
    }

    public function get_filtered_data($status)
    {
        $db = \Config\Database::connect();

        if ($status === 'Sudah Dikonfirmasi' || $status === 'Belum Dikonfirmasi') {
            return $db->table($this->table)->where('status', $status)->get()->getResultArray();
        } elseif ($status === 'Default') {
            return $db->table($this->table)->where('status', '')->orWhere('status', null)->get()->getResultArray();
        } else {
            return $db->table($this->table)->get()->getResultArray();
        }
    }
}
