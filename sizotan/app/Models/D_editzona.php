<?php

namespace App\Models;

use CodeIgniter\Model;

class D_editzona extends Model
{
    protected $table = 'zonarawan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'latitude', 'longitude'];

    public function getZonaRawanById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function updateZonaRawan($data, $id)
    {
        return $this->update($id, $data);
    }
}
