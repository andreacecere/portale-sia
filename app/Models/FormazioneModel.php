<?php

namespace App\Models;

use CodeIgniter\Model;

class FormazioneModel extends Model
{

    public function inserisciAttestato($descrizione,$durata_mesi){

        $check_esistenza = $this->verificaEsistenzaAttestato(trim($descrizione)); 
        if ( count($check_esistenza) == 0  ){
            $data = [
                'descrizione' => $descrizione,
                'durata_mesi'  => $durata_mesi
            ];
            $builder = $this->db->table('tb_attestato');
            $builder->insert($data);
            return true; 
        }
        else{
            return false; 
        }

    }   
    
    public function modificaAttestato($descrizione,$durata_mesi,$visibile,$attestato_id){
    
        $data = [
            'descrizione' => $descrizione,
            'durata_mesi' => $durata_mesi,
            'visibile' => $visibile
        ];

        $builder = $this->db->table('tb_attestato');
        $builder->where('attestato_id', $attestato_id);
        $builder->update($data);
        return true; 
    }

    public function verificaEsistenzaAttestato($descrizione){
        $builder = $this->db->table('tb_attestato')->select("*")->where('descrizione',$descrizione);
        return  $builder->get()->getResultArray();
    }

    public function getAllAttestati(){
        $builder = $this->db->table('tb_attestato')->select("*");
        return  $builder->get()->getResultArray();
    }

    public function getAttestato($id_attestato){
        $builder = $this->db->table('tb_attestato')->select("*")->where('attestato_id',$id_attestato);
        return  $builder->get()->getResultArray();
    }

    public function getListaAttestatiInPossessoDipendente($anagrafica_id){
        $builder = $this->db->table('v_attestati_in_possesso')->select("*")->where('fk_anagrafica',$anagrafica_id);
        return  $builder->get()->getResultArray();
    }

    public function getCountAttestatiFormazione(){
        $builder = $this->db->table('tb_attestato')->countAllResults(); 
        return  $builder;//->get()->getResultArray();
    }

    public function getListaAttestatiNonInPossesso($anagrafica_id){
        $query = $this->db->query("SELECT * FROM tb_attestato WHERE NOT exists ( SELECT * FROM tb_anagrafica_attestato WHERE tb_attestato.attestato_id = tb_anagrafica_attestato.fk_attestato AND tb_anagrafica_attestato.fk_anagrafica = {$anagrafica_id} )");
        $row = $query->getResultArray();
        return $row;
    }

    public function ottieniInformazioniAttestato($attestato_id){
        $builder = $this->db->table('tb_attestato')->select("*")->where('attestato_id',$attestato_id);
        return  $builder->get()->getResultArray();
    }

    public function ottieniInformazioniAttestatoInPossesso($anagrafica_id,$risorsa_attestato_id){
        $builder = $this->db->table('v_attestati_in_possesso')->select("*")->where('fk_anagrafica',$anagrafica_id)->where('attestato_id',$risorsa_attestato_id);
        return  $builder->get()->getResultArray();
    }

    public function aggiornaAttestatiOperatore($valoriAttestati_validi,$valoriAttestati_non_validi,$anagrafica_id){
        /* 
            valoriAttestati_validi => vanno sempre in update 
            valoriAttestati_non_valiti => controllo, se il valore ( data_inizio ) presente nel db è uguale a quello passato
                                            se uguale allora non faccio nulla, altrimenti provvedo a settare 
                                            visibile = 0 in tb_anagrafica_attestato e creare un nuovo record 
        */


        $arrayValoriAttestati_validi = explode(",",$valoriAttestati_validi); 
        $arrayValoriAttestati_non_validi = explode(",",$valoriAttestati_non_validi);
        
        //$newArrayValoriAttestati_validi = array(); 

        for($i=0; $i<count($arrayValoriAttestati_validi); $i++){
            if ( !empty($arrayValoriAttestati_validi[$i]) ){
                $valore = $arrayValoriAttestati_validi[$i]; 
                $valori = explode("|",$valore);            
                $esito = $this->inserimento_aggiornamento_valori($valori,0,$anagrafica_id); 

            }
            //return $esito; 
        }


        for($i=0; $i<count($arrayValoriAttestati_non_validi); $i++){
            //echo "OK"; 
            if ( !empty($arrayValoriAttestati_non_validi[$i]) ){
                $valore = $arrayValoriAttestati_non_validi[$i]; 
                $valori = explode("|",$valore);           
                //print_r($valori); 
                $this->inserimento_aggiornamento_valori($valori,1,$anagrafica_id); 
            }
        }
        //return $esito; 
    }        


    //}

    public function inserimento_aggiornamento_valori($valore,$operazione,$anagrafica_id){
        
        if ( $operazione == 0 ){
           
            //effettuo update in quanto considero gli attestati ancora validi
            $info = $this->ottieniInformazioniAttestatoInPossesso($anagrafica_id,$valore[0]);

            if ( strcmp($info[0]['data_inizio'],$valore[1])!=0 ){

                $durata_mesi = $info[0]['durata_mesi'];             
                //$new_data_fine = date('Y-m-d', strtotime("+".(int)$durata_mesi." months", strtotime($valore[2])));
                $date = new \DateTime($valore[1]);
                $date->modify('+'.(int)$durata_mesi.' month');
                $new_data_fine = $date->format('Y-m-d');
                
                $data = [
                    'data_inizio' => $valore[1],
                    'data_fine' => $new_data_fine
                ];
            
                $builder = $this->db->table('tb_anagrafica_attestato');
                $builder->where('fk_attestato', $valore[0]);
                $builder->where('fk_anagrafica', $anagrafica_id);
                $result=$builder->update($data);
            }

        
        }
        else
        {
            //effettuo un nuovo insert in quanto gli attestati non sono più validi
            $info = $this->ottieniInformazioniAttestatoInPossesso($anagrafica_id,$valore[0]);
            if ( $info[0]['data_inizio'] != $valore[1] ){
                $durata_mesi = $info[0]['durata_mesi'];             
                //$new_data_fine = date('Y-m-d', strtotime("+".(int)$durata_mesi." months", strtotime($valore[2])));

                $date = new \DateTime($valore[1]);
                $date->modify('+'.(int)$durata_mesi.' month');
                $new_data_fine = $date->format('Y-m-d');

                echo $new_data_fine;
                

                $data = [
                    'valido' => 0 
                ];
            
                $builder = $this->db->table('tb_anagrafica_attestato');
                $builder->where('fk_attestato', $valore[0]);
                $builder->where('fk_anagrafica', $anagrafica_id);
                $builder->update($data);

                $data = [
                    'fk_anagrafica' => $anagrafica_id,
                    'fk_attestato'  => $valore[0],
                    'data_inizio' => $valore[1], 
                    'data_fine' => $new_data_fine,
                    'valido' => 1
                ];
                $builder = $this->db->table('tb_anagrafica_attestato');
                $builder->insert($data);

            }
        }
        return true; 
       
    }

    public function attribuisciAttestatoRisorsa($attestato_disponibile_id,$data_inizio,$data_fine,$anagrafica_id){
        
        $data = [
            'fk_anagrafica' => $anagrafica_id,
            'fk_attestato'  => $attestato_disponibile_id,
            'data_inizio' => $data_inizio, 
            'data_fine' => $data_fine,
            'valido' => 1
        ];
        $builder = $this->db->table('tb_anagrafica_attestato');
        $id=$builder->insert($data);

        return $id; 
    }

    public function uploadAttestato($attestato_id,$anagrafica_id){
        $data = [
            'allegato' => 1,
            'data_caricamento_attestato' => date('Y-m-d')
        ];
    
        $builder = $this->db->table('tb_anagrafica_attestato');
        $builder->where('fk_attestato', $attestato_id);
        $builder->where('fk_anagrafica', $anagrafica_id);
        $builder->update($data);

        return true; 
    }

    public function ricercaAttestati($nominativo_id,$commessa_id,$in_forza_fino_al,$tipologia_certificato_id,$id_mansione,$contratto){
        
        $valore = ""; 

        if ( !empty($nominativo_id) ){
            $valore .= "anagrafica_id = ".$nominativo_id." AND ";
        }
        if ( !empty($commessa_id) ){
            $valore .= "commessa_id = ".$commessa_id." AND "; 
        }
        if ( !empty($in_forza_fino_al) ){
            $valore .= "data_fine_rapporto <= DATE('".$in_forza_fino_al."')"." AND "; 
        }
        if ( !empty($tipologia_certificato_id) ){
            $valore .= "attestato_id = ".$tipologia_certificato_id." AND "; 
        }
        if ( !empty($id_mansione) ){
            $valore .= "id_mansione = ".$id_mansione." AND "; 
        }
        if ( $contratto == "TI"){
            $valore .= "YEAR(data_fine_rapporto) = 2999 AND "; 
        }

        $valore = substr($valore,0,-4);
        //echo "SELECT * FROM v_ricerca_attestati WHERE ".$valore;
        if ( empty($nominativo_id) && empty($commessa_id) && empty($in_forza_fino_al) && empty($tipologia_certificato_id) && empty($id_mansione) && empty($contratto) ){
            $query = $this->db->query('SELECT * FROM v_ricerca_attestati');
        }
        else{
            $query = $this->db->query('SELECT * FROM v_ricerca_attestati WHERE '.$valore); 
        }

        $row = $query->getResultArray();

        return $row; 
    }

    public function attestatiInScadenza(){
        $builder = $this->db->table('v_attestati_in_possesso')->select("*")->where('data_fine <= DATE_ADD(CURDATE(), INTERVAL 10 DAY)')->where('data_fine > now()')->where('inScadenza','Si');
        return  $builder->get()->getResultArray();
    }
    


}