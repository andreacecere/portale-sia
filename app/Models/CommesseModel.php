<?php

namespace App\Models;

use CodeIgniter\Model;

class CommesseModel extends Model
{
    protected $table = 'tb_commesse';

    public function getCommesse()
    {
        //$builder = $this->db->table('tb_commessa')->select('commessa_id,tb_commessa.descrizione,settore,tb_azienda.descrizione as azienda')->join('tb_azienda', 'tb_commessa.fk_azienda_id = tb_azienda.azienda_ID');
        
        $builder = $this->db->table('tb_commessa')->select('commessa_id,tb_commessa.descrizione,settore,tb_azienda.descrizione as azienda,UPPER(CONCAT(nome," ",cognome)) as nominativo_responsabile,tb_magazzino.descrizione as descrizioneMagazzino')->join('tb_azienda','tb_commessa.fk_azienda_id = tb_azienda.azienda_ID','left')->join('tb_commessa_responsabile','tb_commessa.commessa_id = tb_commessa_responsabile.fk_commessa_id','left')->join('tb_anagrafica','tb_commessa_responsabile.fk_anagrafica_id = tb_anagrafica.anagrafica_id','left')->join('tb_commessa_magazzino','tb_commessa.commessa_id = tb_commessa_magazzino.fk_commessa_id','left')->join('tb_magazzino','tb_commessa_magazzino.fk_magazzino_id = tb_magazzino.magazzino_id','left'); 

        
        
        return  $builder->get()->getResultArray();
    }

    public function getListacommesse()
    {
        $builder = $this->db->table('tb_commessa')->select('commessa_id,descrizione');
        return  $builder->get()->getResultArray();
    }

    public function getDettaglioCommessa($commessa_id)
    {
        // $builder = $this->db->table('tb_commessa')->where('commessa_id = ', $commessa_id);
        //$builder = $this->db->table('tb_commessa')->select('commessa_id,tb_commessa.descrizione,settore,tb_azienda.descrizione as azienda')->join('tb_azienda', 'tb_commessa.fk_azienda_id = tb_azienda.azienda_ID')->where('commessa_id = ', $commessa_id);
        
        //$builder = $this->db->table('tb_commessa')->select('commessa_id,tb_commessa.descrizione,settore,tb_azienda.descrizione as azienda,anagrafica_id,CONCAT(nome," ",cognome) as nominativo_responsabile, nome, cognome')->join('tb_azienda','tb_commessa.fk_azienda_id = tb_azienda.azienda_ID','left')->join('tb_commessa_responsabile','tb_commessa.commessa_id = tb_commessa_responsabile.fk_commessa_id','left')->join('tb_anagrafica','tb_commessa_responsabile.fk_anagrafica_id = tb_anagrafica.anagrafica_id','left')->where('commessa_id = ', $commessa_id);;

        $builder = $this->db->table('tb_commessa')->select('commessa_id,tb_commessa.descrizione,settore,tb_azienda.descrizione as azienda,UPPER(CONCAT(nome," ",cognome)) as nominativo_responsabile,tb_magazzino.descrizione as descrizioneMagazzino')->join('tb_azienda','tb_commessa.fk_azienda_id = tb_azienda.azienda_ID','left')->join('tb_commessa_responsabile','tb_commessa.commessa_id = tb_commessa_responsabile.fk_commessa_id','left')->join('tb_anagrafica','tb_commessa_responsabile.fk_anagrafica_id = tb_anagrafica.anagrafica_id','left')->join('tb_commessa_magazzino','tb_commessa.commessa_id = tb_commessa_magazzino.fk_commessa_id','left')->join('tb_magazzino','tb_commessa_magazzino.fk_magazzino_id = tb_magazzino.magazzino_id','left')->where('commessa_id',$commessa_id); 
        
        return  $builder->get()->getResultArray();
    }

    public function getInfoCommessa($commessa_id)
    {
        $builder = $this->db->table('v_lista_commessa_magazzino')->select('*')->where('fk_commessa_id = ', $commessa_id);
        return  $builder->get()->getResultArray();
    }

    public function getSettori()
    {
        $builder = $this->db->table('tb_commessa')->select("settore")->groupBy("settore");
        return  $builder->get()->getResultArray();
    }

    public function aggiungiNuovaCommessa($nome_commessa, $settore, $azienda)
    {
        $builder = $this->db->table('tb_commessa')->where('descrizione = ', $nome_commessa)->where('settore = ', $settore)->where('fk_azienda_id = ', $azienda);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente una commessa con questo nome,in questo settore e associata a questa azienda";
        } else {
            $data = [
                //'commessa_id' => rand(),
                'fk_azienda_id' => $azienda,
                'descrizione'  => $nome_commessa,
                'settore'  => $settore
            ];
            $builder = $this->db->table('tb_commessa');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
            } else {
                return "Errore - Non riesco ad inserire la commessa ";
            }
        }
    }

    public function getCommessa($nome_commessa)
    {
        $builder = $this->db->table('tb_commessa')->select("*")->where('descrizione = ',$nome_commessa);
        return  $builder->get()->getResultArray();
    }

    public function verificaEsistenzaResponsabileCommessa($commessa_id){
        $builder = $this->db->table('tb_commessa_responsabile')->select("*")->where('fk_commessa_id = ',$commessa_id);
        return  $builder->get()->getResultArray();
    }

    public function aggiornaCommessa($nome_commessa, $settore, $azienda, $commessa_id,$responsabile,$magazzino_sede_id)
    {
        // echo 'fk_azienda_id: '.$azienda."<br>";
        // echo 'descrizione: '.$nome_commessa."<br>";
        // echo 'settore: '.$settore."<br>";
        // echo "commessa_id".$commessa_id."<br>";
        // echo "<hr>"; 
        

        $data = [
            'fk_azienda_id' => $azienda,
            'descrizione'  => $nome_commessa,
            'settore'  => $settore
        ];

        $builder = $this->db->table('tb_commessa');
        $builder->where('commessa_id', $commessa_id);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            $check = $this->verificaEsistenzaResponsabileCommessa($commessa_id);
            //print_r($check);
            if ( empty($check) ){
                //echo "Vuoto devo effettuare l'insert"; 
                $data = [
                    //'commessa_id' => rand(),
                    'fk_commessa_id' => $commessa_id,
                    'fk_anagrafica_id'  => $responsabile,
                    'attivo'  => 1
                ];
                $builder = $this->db->table('tb_commessa_responsabile');
                $builder->insert($data);
            }
            else{
                //echo "Valore già presente effettuo l'update";
                $data = [
                    'fk_commessa_id' => $commessa_id,
                    'fk_anagrafica_id'  => $responsabile,
                    'attivo'  => 1
                ];
        
                $builder = $this->db->table('tb_commessa_responsabile');
                $builder->where('fk_commessa_id', $commessa_id);
                $builder->update($data);
            }
            
            $builder = $this->db->table('tb_commessa_magazzino')->select("*")->where('fk_commessa_id = ',$commessa_id);
            $row = $builder->get()->getResultArray();
            
            if ( count($row) >= 1 ){
                $data = [
                    'fk_commessa_id' => $commessa_id,
                    'fk_magazzino_id' => $magazzino_sede_id,
                ];
        
                $builder = $this->db->table('tb_commessa_magazzino');
                $builder->where('fk_commessa_id', $commessa_id);
                $builder->update($data);
            }
            else{
                $data = [
                    'fk_commessa_id' => $commessa_id,
                    'fk_magazzino_id'  => $magazzino_sede_id,
                ];
                $builder = $this->db->table('tb_commessa_magazzino');
                $builder->insert($data);
            }


            return true; 
        } else {
            return "Errore - Si è verificato un problema durante l'aggiornamento delle informazioni " . $this->db->error();
        }
    }

    public function getCountCommesse(){
        $builder = $this->db->table('tb_commessa')->selectCount('descrizione');
        $row = $builder->get()->getResultArray();
        return $row;        
    }

    public function testMagazzino($commessa_id,$magazzino_sede_id){
        $builder = $this->db->table('tb_commessa_magazzino')->select("*")->where('fk_commessa_id = ',$commessa_id);
        $row = $builder->get()->getResultArray();
        
        if ( count($row) >= 1 ){
            $data = [
                'fk_commessa_id' => $commessa_id,
                'fk_magazzino_id' => $magazzino_sede_id,
            ];
    
            $builder = $this->db->table('tb_commessa_magazzino');
            $builder->where('fk_commessa_id', $commessa_id);
            $builder->update($data);
        }
        else{
            $data = [
                'fk_commessa_id' => $commessa_id,
                'fk_magazzino_id'  => $magazzino_sede_id,
            ];
            $builder = $this->db->table('tb_commessa_magazzino');
            $builder->insert($data);
        }
    }
}
