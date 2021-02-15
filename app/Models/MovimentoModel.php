<?php

namespace App\Models;

use CodeIgniter\Model;

class MovimentoModel extends Model
{

    // tabella di riferimento
    protected $table = 'tb_movimento';
    protected $primaryKey = 'movimento_id';

    protected $allowedFields = ['fk_utente_id', 'fk_anagrafica_id', 'fk_magazzino_provenienza', 'fk_magazzino_destinazione', 'fk_commessa_provenienza', 'fk_commessa_destinazione', 'movimento_data_richiesta','movimento_data_inzio_servizio', 'movimento_data_approvazione', 'movimento_note', 'movimento_tipo', 'movimento_stato','fk_affidamento_id','fk_attuale_riferimento_anagrafica','richiesta_id'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    // metodo richiamato prima dell'inserimento
    protected function beforeInsert(array $data)
    {
        //$data = $this->passwordHash($data);
        $data['data']['movimento_data_richiesta'] = date('Y-m-d H:i:s');

        return $data;
    }
}
