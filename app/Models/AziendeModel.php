<?php

namespace App\Models;

use CodeIgniter\Model;

class AziendeModel extends Model
{

    public function getAziende(){
        $builder = $this->db->table('tb_azienda'); 
        return  $builder->get()->getResultArray();
    }

}