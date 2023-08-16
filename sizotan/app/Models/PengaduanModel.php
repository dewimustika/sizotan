<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'tbl_pengaduan'; // Ganti 'nama_tabel_pengaduan' dengan nama tabel yang sesuai
    protected $primaryKey = 'id'; // Ganti 'id' dengan nama primary key yang sesuai
    protected $allowedFields = ['nama', 'no_telp', 'jenis_pengaduan', 'waktu_kejadian', 'lokasi_kejadian', 'foto', 'deskripsi_pengaduan', 'Status']; // Sesuaikan dengan kolom-kolom yang ada di tabel pengaduan
}
