<?php

namespace App\Models;

use CodeIgniter\Model;

class AffidamentoModel extends Model
{

    protected $table = 'tb_affidamento';
    protected $primaryKey = 'affidamento_id';

    protected $allowedFields = ['fk_utente_assegnatario_id', 'fk_anagrafica_destinatario_id', 'fk_articolo_id', 'fk_magazzino_id', 'fk_commessa_id', 'fk_magazzino_provenienza_id', 'fk_magazzino_destinazione_id', 'affidamento_tipo', 'affidamento_note', 'fk_condizione_id', 'attivo','fk_anagrafica_responsabile','anagrafica_responsabile_descrizione'];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data['data']['affidamento_data'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function getLastAffido($articolo_id, $seriale)
    {
        if (empty($seriale)) {
            //$builder = $this->db->table('tb_anagrafica')->select("anagrafica_id,nome,cognome",)->limit(100)->orderBy('data_aggiornamento', 'DESC');
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('affidamento_tipo = ', 'A')->where('articolo_id = ', $articolo_id)->limit(1)->orderBy('affidamento_data', 'DESC');
            return  $builder->get()->getResultArray();
        }

        if (empty($articolo_id)) {
            //$builder = $this->db->table('tb_anagrafica')->select("anagrafica_id,nome,cognome",)->limit(100)->orderBy('data_aggiornamento', 'DESC');
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('affidamento_tipo = ', 'A')->where('seriale_articolo = ', $seriale)->limit(1)->orderBy('affidamento_data', 'DESC');
            return  $builder->get()->getResultArray();
        }
    }

    public function aggiornatoAttivo($affidamento_id, $attivo)
    {
        // todo: leggere da tabella stato affidato
        $data = [
            'attivo' => $attivo,
        ];

        $builder = $this->db->table('tb_affidamento');
        $builder->where('affidamento_id', $affidamento_id);
        $builder->update($data);
    }
}
