<?php
namespace App\Models;

use CodeIgniter\Model;

class AutomezziModel extends Model
{
    protected $table = 'tb_consumi_carburante';


    public function getListaLocalita(){
        $builder = $this->db->table('tb_consumi_carburante')->select('localita')->groupby('localita');
        $row = $builder->get()->getResultArray();
        return $row;        
    }

    public function getSchedaCarburante(){

        $builder = $this->db->table('tb_consumi_carburante')->select("numero_carta")->distinct(); 
        $row = $builder->get()->getResultArray();
        return $row;
    }

    public function getSchedeCarburanti($scheda_carburante,$id_nominativo_risorsa,$mese,$anno,$localita,$targa){
        
        $valore = ""; 
        if ( !empty($scheda_carburante) ){
            $valore .= "numero_carta = '".trim($scheda_carburante)."' AND "; 
        }
        if ( !empty($id_nominativo_risorsa) ){
            $valore .= "codice_autista = ".trim($id_nominativo_risorsa)." AND ";
        }
        if ( !empty($mese) ){
            if ( strlen($mese) < 2 ) {$mese = str_pad($mese,2,"0",STR_PAD_LEFT);}
            $valore .= "MONTH(data_transazione) = ".trim($mese)." AND "; 
        }
        if ( !empty($anno) ){
            $valore .= "YEAR(data_transazione) = ".trim($anno)." AND "; 
        }
        if ( !empty($localita) ){
            $valore .= "localita = '".trim($localita)."' AND "; 
        }
        if ( !empty($targa) ){
            $valore .= "targa = '".trim($targa)."' AND "; 
        }
        //echo $valore; 
        if ( empty($scheda_carburante) && empty($id_nominativo_risorsa) && empty($mese) && empty($anno) && empty($localita) && empty($targa) ){
            $builder = $this->db->table('tb_consumi_carburante')->select("*")->limit(100); 
        }
        else{
            $valore = substr($valore,0,-4);
            //$query = $this->db->query('SELECT tb_consumi_carburante.* , concat(tb_anagrafica.nome," ",tb_anagrafica.cognome) as nominativo FROM tb_consumi_carburante LEFT JOIN tb_anagrafica ON tb_consumi_carburante.Codice_Autista = tb_anagrafica.anagrafica_id WHERE '.$valore);
            $builder = $this->db->table('tb_consumi_carburante')->select("*")->where($valore);     
        }
        $row = $builder->get()->getResultArray();
        return $row;

    }


    public function importaConsumiXLS($fk_fornitore_id,$codice_sap,$numero_carta,$cliente,$targa,$numero_fattura,$data_fattura,$compagnia_fornitrice,$localita_punto_vendita,$tipo_transazione,$scontrino,$data_ora_transazione,$prodotto,$prezzo_unitario,$volume,$importo,$chilometraggio,$self_service,$festivo,$codice_autista){
        $data = [
            'fk_fornitore_id' => $fk_fornitore_id,
            'codice_sap' => $codice_sap,
            'numero_carta'  => $numero_carta,
            'nome_cliente'  => $cliente,
            'targa' => $targa,
            'numero_fattura' => $numero_fattura,
            'data_fattura' => date('Y-m-d',strtotime($data_fattura)),
            'compagnia_fornitrice' => $compagnia_fornitrice,
            'localita' => $localita_punto_vendita,
            'tipo_transazione' => $tipo_transazione,
            'scontrino' => $scontrino,
            'data_transazione' => $data_ora_transazione,
            'tipo_prodotto' => $prodotto,
            'volume' => $volume,
            'prezzo_unitario' => $prezzo_unitario,
            'importo' => $importo,
            'chilometraggio' => $chilometraggio,
            'self_service' => $self_service,
            'festivo' => $festivo,
            'codice_autista' => $codice_autista
        ];
        $builder = $this->db->table('tb_consumi_carburante');
        $builder->insert($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - Non riesco ad inserire la commessa " . $this->db->error();
        }
    }

    public function dettaglioConsumiCarburante($scheda_carburante){
        // $builder = $this->db->table('tb_consumi_carburante')->select("*")->where('consumi_carburante_id',$consumo_carburante_id); 
        // $row = $builder->get()->getResultArray();

        $builder = $this->db->table('tb_consumi_carburante')->select("*")->where('numero_carta',$scheda_carburante); 
        $row = $builder->get()->getResultArray();

        return $row;
    }

    public function costiSchedaCarburante($scheda_carburante){
        // $builder = $this->db->table('tb_consumi_carburante')->selectSum('importo')->where('numero_carta',$scheda_carburante); 
        // $row = $builder->get()->getResultArray();
        // return $row; 
        $query = $this->db->query("SELECT ROUND(SUM(importo),2) as importo
        FROM int_magazzino.tb_consumi_carburante
        WHERE numero_carta = '{$scheda_carburante}'
        ");
        $row = $query->getResultArray(); 
        return $row; 
    }

    public function mostraCostiTotaliPerSchedaCarburante(){
        $query = $this->db->query("SELECT numero_carta,ROUND(SUM(importo),2) as importo
        FROM int_magazzino.tb_consumi_carburante
        GROUP BY numero_carta
        HAVING importo > 100
        ORDER BY importo desc;");
        $row = $query->getResultArray(); 
        return $row; 
    }

    public function contaSchedeCarburanti(){
        $query = $this->db->query("SELECT COUNT(DISTINCT(numero_carta)) as numero_carta
        FROM int_magazzino.tb_consumi_carburante");
        $row = $query->getResultArray(); 
        return $row;
    }


}
?>