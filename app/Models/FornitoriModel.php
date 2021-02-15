<?php

namespace App\Models;

use CodeIgniter\Model;

class FornitoriModel extends Model
{
    protected $table = 'tb_fornitore';

    public function getFornitori()
    {
        $builder = $this->db->table('v_fornitore_tipologia');
        return  $builder->get()->getResultArray();
    }

    public function getFornitoriRicerca($tipoArticolo)
    {
        
        if (empty($tipoArticolo))
            $builder = $this->db->table('v_lista_tipo_articoli_fornitori')->select('fornitore_id, ragione_sociale');
        else
            $builder = $this->db->table('v_lista_tipo_articoli_fornitori')->select('fornitore_id, ragione_sociale')->where('tipologia_articolo_id', $tipoArticolo);

        return  $builder->get()->getResultArray();
    }

    public function getDettaglioFornitore($fornitore_id)
    {
        $builder = $this->db->table('v_fornitore_tipologia')->where('fornitore_id = ', $fornitore_id);
        return  $builder->get()->getResultArray();
    }

    public function aggiungiNuovoFornitore($ragione_sociale, $partita_iva, $codice_fiscale, $indirizzo, $localita, $telefono, $email, $pec,$tipologia_id)
    {
        $builder = $this->db->table('tb_fornitore')->where('ragione_sociale = ', $ragione_sociale)->where('partita_iva = ', $partita_iva);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente un fornitore con questa ragione sociale e con questa partita iva";
        } else {
            $data = [
                //'fornitore_id' => rand(),
                'ragione_sociale' => $ragione_sociale,
                'partita_iva' => $partita_iva,
                'codice_fiscale'  => $codice_fiscale,
                'indirizzo'  => $indirizzo,
                'localita' => $localita,
                'telefono' => $telefono,
                'email' => $email,
                'pec' => $pec,
                'fk_tipologia_fornitore' => $tipologia_id
            ];
            $builder = $this->db->table('tb_fornitore');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
            } else {
                return "Errore - Non riesco ad inserire la commessa " . $this->db->error();
            }
        }
    }

    public function aggiornaFornitore($ragione_sociale, $partita_iva, $codice_fiscale, $indirizzo, $localita, $telefono, $email, $pec, $fornitore_id,$tipologia_id)
    {
        $data = [
            'fornitore_id' => $fornitore_id,
            'ragione_sociale' => $ragione_sociale,
            'partita_iva' => $partita_iva,
            'codice_fiscale'  => $codice_fiscale,
            'indirizzo'  => $indirizzo,
            'localita' => $localita,
            'telefono' => $telefono,
            'email' => $email,
            'pec' => $pec,
            'fk_tipologia_fornitore' => $tipologia_id
        ];
        $builder = $this->db->table('tb_fornitore');
        $builder->where('fornitore_id', $fornitore_id);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - Si è verificato un problema durante l'aggiornamento delle informazioni " . $this->db->error();
        }
    }

    public function getTipologiaFornitori($descrizione = null){
        if ( $descrizione == null )
            $builder = $this->db->table('tb_tipologia_fornitore')->select('id_tipologia_fornitore,descrizione')->orderBy('descrizione');
        elseif( $descrizione == "carburante" )
            $builder = $this->db->table('v_fornitore_tipologia')->select('id_tipologia_fornitore,ragione_sociale,fornitore_id')->WHERE('descrizione_tipologia_fornitore','Rifornimento carburante')->orderBy('ragione_sociale');
        return  $builder->get()->getResultArray();
    }

}
