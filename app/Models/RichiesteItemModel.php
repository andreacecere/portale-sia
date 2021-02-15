<?php

namespace App\Models;

use CodeIgniter\Model;


class RichiesteItemModel extends Model
{

    protected $table = 'tb_richiesta_item';
    protected $primaryKey = 'richieste_item_id';

    protected $allowedFields = ['fk_articolo_id','fk_articolo_richiesto_id','articolo_richiesto','quantita','fk_destinatario','fk_sede','fk_commessa','note','fk_richiesta_utente_id','visibile'];


    public function inserisciRichiestaITEM($tipologia_articolo_id,$prodotto,$attributi,$quantita,$fk_destinatario,$fk_sede,$fk_commessa,$note,$utente_id){
        
        $data = [
            'fk_tipo_articolo_id' => $tipologia_articolo_id,
            'articolo_richiesto' => $prodotto,
            'quantita' => $quantita,
            'fk_destinatario' => $fk_destinatario,
            'fk_sede' => $fk_sede, 
            'fk_commessa' => $fk_commessa,
            'note' => $note,
            'fk_richiesta_utente_id' => $utente_id

        ];
        $builder = $this->db->table('tb_richiesta_item');
        $builder->insert($data);
        $last_id = $this->db->insertID();

        $data = [
            'fk_richiesta_item_id' => $last_id,
            'fk_stato_richiesta' => 1,
            'visibile' => 1
        ];
        $builder = $this->db->table('tb_stato_richiesta_item');
        $builder->insert($data);

        if ($this->db->affectedRows() >= 0) {
            return true; 
        }
        else{
            return false; 
        }        
    }

    public function visualizzaRichiesteITEM(){
        $builder = $this->db->table('v_richieste_item')->select('*')->where('visibile',1)->where('stato_richiesta_id <>',3)->where('stato_richiesta_id <>',5);
        return  $builder->get()->getResultArray();
    }

    public function getStati(){
        $builder = $this->db->table('tb_stato_richiesta')->select('descrizione,stato_richiesta_id');
        return  $builder->get()->getResultArray();
    }

    public function cambiaStatoRichiestaITEM($stato_richiesta,$richiesta_item_id,$session_user_id){
        $data = [
            'visibile' => 0,
            //'data_aggiornamento_richiesta' => date('Y-m-d H:i:s'),
            'fk_utente_aggiornamento' => $session_user_id
        ];
        $builder = $this->db->table('tb_stato_richiesta_item');
        $builder->where('stato_richiesta_item_id',$richiesta_item_id);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            //Select * from tb_stato_richiesta_item where stato_richiesta_id = e prelevo fk_richiesta_item_id
            $builder = $this->db->table('tb_stato_richiesta_item')->select('*')->where('stato_richiesta_item_id',$richiesta_item_id);
            $row = $builder->get()->getResultArray();
            echo "Stato_richiesta: ".$richiesta_item_id;
            //print_r($row);
            //echo "Valore: ".$row[0]['fk_richiesta_item_id'];
            $data = [
                'fk_richiesta_item_id' => $row[0]['fk_richiesta_item_id'],
                'fk_stato_richiesta' => $stato_richiesta,
                'visibile' => 1,
                'data_aggiornamento_richiesta' => date('Y-m-d H:i:s'),
                'fk_utente_aggiornamento' => $session_user_id
            ];
            $builder = $this->db->table('tb_stato_richiesta_item');
            $builder->insert($data);
        }
    }

    public function ricercaRichiesta($prodotto_richiesto,$destinatario,$sede,$commessa,$effettuata_da,$stati){
        $valore = ""; 
        if ( !empty($prodotto_richiesto) ){
            $valore .= "dsc_prodotto_richiesto LIKE '%".trim($prodotto_richiesto)."%' AND "; 
        }
        if ( !empty($destinatario) ){
            $valore .= "destinatario LIKE '%".trim($destinatario)."%' AND "; 
        }
        if ( !empty($sede) ){
            $valore .= "sede LIKE '%".trim($sede)."%' AND "; 
        }
        if ( !empty($commessa) ){
            $valore .= "commessa LIKE '%".trim($commessa)."%' AND "; 
        }
        if ( !empty($effettuata_da) ){
            $valore .= "richiedente LIKE '%".trim($effettuata_da)."%' AND "; 
        }
        if ( !empty($stati) ){
            $valore .= "stato_richiesta LIKE '%".trim($stati)."%' AND "; 
        }

        $valore = substr($valore,0,-4);
        //echo "SELECT * FROM v_richieste_item WHERE ".$valore;

        if ( empty($prodotto_richiesto) && empty($destinatario) && empty($sede) && empty($commessa) && empty($effettuata_da) && empty($stati) ){
            $query = $this->db->query('SELECT * FROM v_richieste_item WHERE visibile = 1 ');    
        }
        else{
            $query = $this->db->query('SELECT * FROM v_richieste_item WHERE '.$valore." AND visibile = 1 ");
        }
        $row = $query->getResultArray();
        return $row;
    }

    public function timeline($richiesta_item_id){

        $builder = $this->db->table('v_timeline_richieste_item')->select('*')->where('stato_richiesta_item_id',$richiesta_item_id)->limit(1);
        $row = $builder->get()->getResultArray();

        $builder = $this->db->table('v_timeline_richieste_item')->select('*')->where('fk_richiesta_item_id',$row[0]['fk_richiesta_item_id']);
        $row = $builder->get()->getResultArray();
        return $row; 
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";
    }

    public function verificaDisponibilita($richiesta_item_id,$quantita){
        
        $builder = $this->db->table('v_richieste_item')->select('*')->where('richiesta_item_id',$richiesta_item_id)->limit(1);
        $row = $builder->get()->getResultArray();

        $dsc_prodotto_richiesto = $row[0]['dsc_prodotto_richiesto'];
        $cntRisorse = $this->db->table('v_lista_articoli_presenti_completa')->select('*')->where('tipo_articolo',$dsc_prodotto_richiesto)->where('stato_articolo','disponibile')->countAllResults();
        //echo $dsc_prodotto_richiesto; 
        // if ( $cntRisorse == 0 ){
        //     return "ARichieste: {$quantita} / Disponibili: {$cntRisorse}"; 
        // }
        if ( $quantita > $cntRisorse || $cntRisorse == 0 ){
            return "Richieste: {$quantita} / Disponibili: {$cntRisorse}"; 
        }
        else{
            return true; 
        }
        //echo "Qnt Richieste: ".$quantita." DB: ".$cntRisorse;
    }
}