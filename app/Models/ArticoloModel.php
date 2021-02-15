<?php

namespace App\Models;
use App\Libraries\PHPMailer_Lib;
use CodeIgniter\Model;

class ArticoloModel extends Model
{
    // tabella di riferimento
    protected $table = 'tb_articolo';
    protected $primaryKey = 'articolo_id';

    protected $allowedFields = ['codice_articolo', 'articolo_seriale', 'fk_tipologia_articolo_id', 'fk_magazzino_id', 'fk_fornitore_id', 'fk_stato_articolo_id', 'fk_condizione_id', 'data_creazione', 'fk_utente_creazione_id', 'data_modifica', 'fk_utente_modifica_id', 'attributi', 'note', 'ultimo_affido_anagrafica', 'ultimo_affido_commessa', 'ultimo_affido_user', 'ultimo_affido_data', 'ultimo_affido_magazzino'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data['data']['data_creazione'] = date('Y-m-d H:i:s');

        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data['data']['data_modifica'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function getTipoArticoli()
    {
        $builder = $this->db->table('v_lista_tipo_articoli_presenti');
        return $builder->get()->getResultArray();
    }

    public function getTipoArticolo_id($tipo_articolo){
        $builder = $this->db->table('v_lista_tipo_articoli_presenti')->where('tipo_articolo',$tipo_articolo);
        return $builder->get()->getResultArray();
    }

    public function getStatoArticoli()
    {
        $builder = $this->db->table('tb_stato_articolo');
        return  $builder->get()->getResultArray();
    }

    public function getCondizioneArticoli()
    {
        $builder = $this->db->table('tb_condizione')->orderBy("descrizione");
        return  $builder->get()->getResultArray();
    }

    public function getCondizioniArticoloSelezionato($fk_tipologia_articolo_id){
        $builder = $this->db->table('tb_tipologia_articolo_condizione')->join('tb_condizione','tb_tipologia_articolo_condizione.fk_condizione_id = tb_condizione.condizione_id')->where('fk_tipologia_articolo_id',$fk_tipologia_articolo_id);
        return  $builder->get()->getResultArray();
    }

    public function getCondizioni($idTipoArticolo)
    {
        if (empty($idTipoArticolo)) {
            $builder = $this->db->table('v_lista_tipo_articolo_condizione');
            return  $builder->get()->getResultArray();
        } else {
            $builder = $this->db->table('v_lista_tipo_articolo_condizione')->where('tipologia_articolo_id', $idTipoArticolo);
            return  $builder->get()->getResultArray();
        }
    }

    public function getListaArticoli($idTipoArticolo)
    {
        if ($idTipoArticolo == '')
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('stato_articolo = ', 'disponibile');
        else
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('stato_articolo = ', 'disponibile');

        return  $builder->get()->getResultArray();
    }

    public function getArticolo($idTipoArticolo, $seriale, $idArticolo)
    {
        if ($seriale != null || $seriale <> '') {
            
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('seriale = ', $seriale)->where('stato_articolo = ', 'disponibile');
            return  $builder->get()->getResultArray();
        }

        if ($idTipoArticolo != null and $seriale != null) {
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('seriale = ', $seriale)->where('stato_articolo = ', 'disponibile');;
            return  $builder->get()->getResultArray();
        }

        if ($idTipoArticolo != null and ($seriale == null || empty($seriale))) {
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('stato_articolo = ', 'disponibile');          
            return  $builder->get()->getResultArray();
        }

        if ($idArticolo != null || $idArticolo <> '') {
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('articolo_id = ', $idArticolo)->where('stato_articolo = ', 'disponibile');;
            return  $builder->get()->getResultArray();
        }
    }

    public function ottieniInfoItemAffidato($idAffidamento){
       
            
            $builder = $this->db->table('tb_affidamento')->select('fk_articolo_id')->where('affidamento_id = ',$idAffidamento);
            
            $valore = $builder->get()->getResultArray();
            $affidamento_id = $valore[0]['fk_articolo_id'];
            $info = $this->ottieniInfoItem($affidamento_id); 
            return $info;
    }

    public function ottieniInfoItem($fk_articolo_id){
        $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('articolo_id = ', $fk_articolo_id);
        return  $builder->get()->getResultArray();
    }

    

    public function getArticoloAffidato($idTipoArticolo, $seriale, $idArticolo)
    {

        if ($seriale != null || $seriale <> '') {
            
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('seriale = ', $seriale)->where('stato_articolo = ', 'affidato');
            return  $builder->get()->getResultArray();
        }

        if ($idTipoArticolo != null and $seriale != null) {
            
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('seriale = ', $seriale)->where('stato_articolo = ', 'affidato');;
            return  $builder->get()->getResultArray();
        }

        if ($idTipoArticolo != null and ($seriale == null || empty($seriale))) {
            
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('stato_articolo = ', 'Affidato');;
            return  $builder->get()->getResultArray();
        }

        if ($idArticolo != null || $idArticolo <> '') {
            
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('articolo_id = ', $idArticolo)->where('stato_articolo = ', 'affidato');;
            return  $builder->get()->getResultArray();
        }

        //return  $builder->get()->getResultArray();
    }

    public function getIDStatoAffidato(){
        $builder = $this->db->table('tb_stato_articolo')->where('descrizione = ', 'affidato');
        return  $builder->get()->getResultArray();
    }

    public function getAttributiItemSingolo($id){
        $builder = $this->db->table('tb_attributo_valore')->where('fk_attributo_id = ', $id);
        return  $builder->get()->getResultArray();
    }

    public function getAttributo($idAttributo){
        $builder = $this->db->table('tb_attributo')->where('attributo_id = ', $idAttributo);
        return  $builder->get()->getResultArray();
    }

    

    public function getResponsabile($fk_responsabile){

        $builder = $this->db->table('tb_commessa_responsabile')->select('responsabile_id,concat(nome," ",cognome) as nominativo_responsabile ')->join('tb_anagrafica','tb_commessa_responsabile.fk_anagrafica_id = tb_anagrafica.anagrafica_id','left')->where('tb_commessa_responsabile.fk_commessa_id = ', $fk_responsabile);
        return  $builder->get()->getResultArray();
    }


    public function getTipologiaArticoliPresenti()
    {
        $builder = $this->db->table('tb_tipologia_articolo')->select('tipologia_articolo_id,tb_tipologia_articolo.descrizione as descrizioneTipologiaArticolo,tb_categoria_articolo.descrizione as descrizioneCategoriaArticolo')->join('tb_categoria_articolo', 'tb_tipologia_articolo.fk_categoria_articolo_id = tb_categoria_articolo.categoria_articolo_id', 'left');
        return  $builder->get()->getResultArray();
    }

    public function getAttributiItem($id)
    {
        $builder = $this->db->table('tb_tipologia_articolo')->select('tb_tipologia_articolo.descrizione as nomeArticolo,tb_attributo.descrizione,attributo_id')->join('tb_attributo', 'tb_tipologia_articolo.tipologia_articolo_id = tb_attributo.fk_tipologia_articolo_id', 'left')->where('tipologia_articolo_id = ', $id);
        return  $builder->get()->getResultArray();
    }

    public function prodottiFoglie()
    {
        $builder = $this->db->table('v_categorie_prodotti_foglie')->orderBy('descrizione');
        return  $builder->get()->getResultArray();
    }

    public function aggiungiNuovoArticolo($nome_item, $categoria)
    {
        $builder = $this->db->table('tb_categoria_articolo')->where('descrizione = ', $categoria);
        foreach ($builder->get()->getResultArray() as $row) {
            $categoria_id = $row['categoria_articolo_id'];
        }
        $builder = $this->db->table('tb_tipologia_articolo')->where('descrizione = ', $nome_item)->where('fk_categoria_articolo_id = ', $categoria_id);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente un item con questo nome e con questa categoria";
        } else {
            $data = [
                'descrizione' => $nome_item,
                'fk_categoria_articolo_id' => $categoria_id
            ];
            $builder = $this->db->table('tb_tipologia_articolo');
            $builder->insert($data);
            
            
            if ($this->db->affectedRows() >= 0) {
                return $this->db->insertID();
            } else {
                return "Errore - Non riesco ad le informazioni " . $this->db->error();
            }
        }
    }

    public function aggiungiNuovoCategoria($tipoFunzione, $nome_categoria, $categoria)
    {

        $builder = $this->db->table('tb_categoria_articolo')->where('descrizione = ', $nome_categoria);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente una categoria con questo nome";
        } else {
            if ($tipoFunzione == 1) {
                $data = [
                    'descrizione' => strtoupper($nome_categoria),
                    'parent' => 0,
                ];
            } else {
                $builder = $this->db->table('tb_categoria_articolo')->where('descrizione = ', $categoria);
                foreach ($builder->get()->getResultArray() as $row) {
                    $categoria_id = $row['categoria_articolo_id'];
                }
                $data = [
                    'descrizione' => strtoupper($nome_categoria),
                    'parent' => $categoria_id
                ];
            }
            $builder = $this->db->table('tb_categoria_articolo');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return $this->db->insertID();
                //return true;
            } else {
                return "Errore - Non riesco ad le informazioni " . $this->db->error();
            }
        }
    }

    public function getAllCategorie()
    {
        $builder = $this->db->table('tb_categoria_articolo')->orderBy('descrizione');
        return  $builder->get()->getResultArray();
    }

    public function inserisciAttributi($fk_tipologia_articolo_id, $descrizione)
    {
        $data = [
            'fk_tipologia_articolo_id' => $fk_tipologia_articolo_id,
            'descrizione' => $descrizione,
        ];
        $builder = $this->db->table('tb_attributo');
        $builder->insert($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - Non riesco ad le informazioni " . $this->db->error();
        }
    }

    public function inserisciAttributiWizard($fk_tipologia_articolo_id, $descrizione){
        $data = [
            'fk_tipologia_articolo_id' => $fk_tipologia_articolo_id,
            'descrizione' => $descrizione,
        ];
        $builder = $this->db->table('tb_attributo');
        $builder->insert($data);
        if ($this->db->affectedRows() >= 0) {
            return $this->db->insertID();
        } else {
            return "Errore - Non riesco ad le informazioni " . $this->db->error();
        }
    }

    public function inserisciAttributiValore($fk_tipologia_articolo_id, $descrizione)
    {
            $data = [
                'fk_attributo_id' => $fk_tipologia_articolo_id,
                'descrizione' => $descrizione,
            ];
            $builder = $this->db->table('tb_attributo_valore');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
            } else {
                return "Errore - Non riesco ad le informazioni " . $this->db->error();
            }
    }

    public function inserisciAttributiValoreWizard($fk_tipologia_articolo_id, $descrizione)
    {
            $data = [
                'fk_attributo_id' => $fk_tipologia_articolo_id,
                'descrizione' => $descrizione,
            ];
            $builder = $this->db->table('tb_attributo_valore');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return $this->db->insertID();
            } else {
                return "Errore - Non riesco ad le informazioni " . $this->db->error();
            }
    }

    public function controllaEsistenzaITEM($nomeITEM){
        $query = $this->db->query("SELECT * FROM tb_tipologia_articolo WHERE descrizione = '{$nomeITEM}' "); 
        $row = $query->getResultArray();
        if ( empty($row) ){
            return true; 
        }
        else{
            return false; 
        }
        
    }

    public function albero()
    {

        $query = $this->db->query('SELECT tb_categoria_articolo.categoria_articolo_id as id, UPPER(tb_categoria_articolo.descrizione) as text, tb_categoria_articolo.parent as children
                                    FROM tb_categoria_articolo 
                                    WHERE parent = 0 
                                    UNION ALL 
                                    SELECT tb2.categoria_articolo_id, tb2.descrizione, tb2.parent
                                    FROM tb_categoria_articolo tb1 LEFT JOIN tb_categoria_articolo tb2 ON tb1.categoria_articolo_id = tb2.parent
                                    WHERE tb2.parent is not null');
       
        $row = $query->getResultArray();
        $row = $this->buildTree($row);

        return json_encode($row);
    }


    function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['children'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                $element['children'] = $children;
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function getListaAffidi($anagrafica_id, $tipoAffido, $attivo)
    {
        
        if (empty($anagrafica_id)) {
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('affidamento_tipo','A')->where('attivo',$attivo);
            return  $builder->get()->getResultArray();
        } 
        else {

            
            if ( is_string($anagrafica_id) ){
                if ( strlen($anagrafica_id) > 5 ){
                    $query = $this->db->query("SELECT * FROM int_magazzino.v_lista_affidamento WHERE CONCAT(nome,' ',cognome) = '{$anagrafica_id}' and attivo = 1 and affidamento_tipo = 'A' ");
                    $row = $query->getResultArray();
                    return $row; 
                }
                else{
                    $builder = $this->db->table('v_lista_affidamento')->select("*")->where('anagrafica_id ', $anagrafica_id)->where('affidamento_tipo','A')->where('attivo',1);
                }
            }
            else{
                
                $builder = $this->db->table('v_lista_affidamento')->select("*")->where('attivo = ', $attivo)->where('affidamento_tipo = ', $tipoAffido)->where('anagrafica_id = ', $anagrafica_id)->orderBy('affidamento_data', 'DESC');
            }
            return  $builder->get()->getResultArray();
        }
    }


    // public function getSchedaCarburante(){

    //     $builder = $this->db->table('tb_consumi_carburante')->select("numero_carta")->distinct(); 
    //     $row = $builder->get()->getResultArray();
    //     return $row;
    // }

    // public function getSchedeCarburanti($scheda_carburante,$id_nominativo_risorsa,$mese,$anno){
        
    //     $valore = ""; 
    //     if ( !empty($scheda_carburante) ){
    //         $valore .= "scheda_carburante = '".trim($scheda_carburante)."' AND "; 
    //     }
    //     if ( !empty($id_nominativo_risorsa) ){
    //         $valore .= "codice_autista = ".trim($id_nominativo_risorsa)." AND ";
    //     }
    //     if ( !empty($mese) ){
    //         if ( strlen($mese) < 2 ) {$mese = str_pad($mese,2,"0",STR_PAD_LEFT);}
    //         $valore .= "MONTH(data_ora) = ".trim($mese)." AND "; 
    //     }
    //     if ( !empty($anno) ){
    //         $valore .= "YEAR(data_ora) = ".trim($anno)." AND "; 
    //     }

    //     $valore = substr($valore,0,-4);
        
    //     $query = $this->db->query('SELECT tb_consumi_carburante.* , concat(tb_anagrafica.nome," ",tb_anagrafica.cognome) as nominativo FROM tb_consumi_carburante LEFT JOIN tb_anagrafica ON tb_consumi_carburante.Codice_Autista = tb_anagrafica.anagrafica_id WHERE '.$valore);
    //     $row = $query->getResultArray();
    //     return $row;

    // }

    public function ricercaMateriale($seriale,$tipo,$stato,$condizione,$commessa,$sede){
        
        $valore = ""; 
        if ( !empty($seriale) ){
            $valore .= "seriale LIKE '%".trim($seriale)."%' AND "; 
        }
        if ( !empty($tipo) ){
            $valore .= "fk_tipologia_articolo_id = ".trim($tipo)." AND ";
        }
        if ( !empty($stato) ){
            $valore .= "fk_stato_articolo_id = ".trim($stato)." AND "; 
        }
        if ( !empty($condizione) ){
            $valore .= "fk_condizione_id = ".trim($condizione)." AND "; 
        }
        if ( !empty($commessa) ){
            $valore .= "ultimo_affido_commessa = '".trim($commessa)."' AND "; 
        }
        if ( !empty($sede) ){
            $valore .= "sede = '".trim($sede)."' AND "; 
        }

        $valore = substr($valore,0,-4);
        
        $query = $this->db->query('SELECT * FROM v_lista_articoli_presenti_completa WHERE '.$valore);
        $row = $query->getResultArray();
        return $row;

    }

    public function ricercaModuli($seriale,$tipologia_documento,$data_movimento,$commessa,$id_operazione,$stato_documenti,$operatore){

                
        $valore = ""; 
        if ( !empty($seriale) ){
            $valore .= "articolo_seriale LIKE '%".trim($seriale)."%' AND "; 
        }
        if ( !empty($tipologia_documento) ){
            $valore .= "affidamento_tipo = '".trim($tipologia_documento)."' AND ";
        }
        if ( !empty($data_movimento) ){
            $valore .= "DATE(affidamento_data) = '".trim($data_movimento)."' AND ";
        }
        if ( !empty($id_operazione) ){
            $valore .= "affidamento_id = ".trim($id_operazione)." AND "; 
        }
        if ( !empty($stato_documenti) ){
            if ( $stato_documenti == 2 ){
                $valore .= "affidamento_modulo = 0 AND "; 
            }
            else
                $valore .= "affidamento_modulo = ".trim($stato_documenti)." AND "; 
        }

        if ( !empty($commessa) ){
            $valore .= "tb_affidamento.fk_commessa_id = '".trim($commessa)."' AND "; 
        }

        if ( !empty($operatore) ){
            $valore .= "t1.anagrafica_id = '".trim($operatore)."' AND "; 
        }


        $valore = substr($valore,0,-4);
 

        if ( empty($seriale) && empty($tipologia_documento) && empty($data_movimento) && empty($commessa) && empty($id_operazione) && $stato_documenti == 0 && empty($operatore) ){
            
            $query = $this->db->query('SELECT tb_affidamento.affidamento_id,tb_articolo.articolo_seriale, tb_articolo.codice_articolo,tb_affidamento.affidamento_tipo,tb_affidamento.affidamento_note,tb_affidamento.affidamento_data,CONCAT(tb_anagrafica.nome," ",tb_anagrafica.cognome) as nominativo_affidatario, CONCAT(t1.nome," ",t1.cognome) as nominativo_destinatario,affidamento_id,CASE WHEN affidamento_modulo = 0 THEN "No" ELSE "Si" END AS affidamento_modulo_dsc, affidamento_modulo,tb_tipologia_articolo.descrizione as descrizione_item,ultimo_affido_commessa,tb_affidamento.fk_commessa_id,tb_commessa.descrizione as commessa_descrizione
            FROM int_magazzino.tb_affidamento INNER JOIN tb_articolo ON tb_affidamento.fk_articolo_id = tb_articolo.articolo_id 
            INNER JOIN tb_anagrafica ON tb_affidamento.fk_utente_assegnatario_id = tb_anagrafica.anagrafica_id
            INNER JOIN tb_anagrafica as t1 ON tb_affidamento.fk_anagrafica_destinatario_id = t1.anagrafica_id
            INNER JOIN tb_tipologia_articolo ON tb_tipologia_articolo.tipologia_articolo_id = tb_articolo.fk_tipologia_articolo_id 
            INNER JOIN tb_commessa ON tb_affidamento.fk_commessa_id = tb_commessa.commessa_id');

        }
        else{
            $query = $this->db->query('SELECT tb_affidamento.affidamento_id,tb_articolo.articolo_seriale, tb_articolo.codice_articolo,tb_affidamento.affidamento_tipo,tb_affidamento.affidamento_note,tb_affidamento.affidamento_data,CONCAT(tb_anagrafica.nome," ",tb_anagrafica.cognome) as nominativo_affidatario, CONCAT(t1.nome," ",t1.cognome) as nominativo_destinatario,affidamento_id,CASE WHEN affidamento_modulo = 0 THEN "No" ELSE "Si" END AS affidamento_modulo_dsc, affidamento_modulo,tb_tipologia_articolo.descrizione as descrizione_item,ultimo_affido_commessa,tb_affidamento.fk_commessa_id,tb_commessa.descrizione as commessa_descrizione
            FROM int_magazzino.tb_affidamento INNER JOIN tb_articolo ON tb_affidamento.fk_articolo_id = tb_articolo.articolo_id 
            INNER JOIN tb_anagrafica ON tb_affidamento.fk_utente_assegnatario_id = tb_anagrafica.anagrafica_id
            INNER JOIN tb_anagrafica as t1 ON tb_affidamento.fk_anagrafica_destinatario_id = t1.anagrafica_id
            INNER JOIN tb_tipologia_articolo ON tb_tipologia_articolo.tipologia_articolo_id = tb_articolo.fk_tipologia_articolo_id 
            INNER JOIN tb_commessa ON tb_affidamento.fk_commessa_id = tb_commessa.commessa_id
            WHERE '.$valore); 



        }
        
        $row = $query->getResultArray();
        return $row;
    }


    public function flagModuloCaricato($idAffido){
        try{
            $builder = $this->db->table('tb_affidamento');
            $data = [
                'affidamento_modulo' => 1,
                'data_caricamento_modulo' => date('Y-m-d H:i:s')
            ];
            $builder->where('affidamento_id', $idAffido);
            $builder->update($data);
            return true; 
        }
        catch (\Exception $e)
        {
            die($e->getMessage());
        }
        
    }

    public function getSchedeCarburantiLibere()
    {
        $query = $this->db->query('SELECT * FROM int_magazzino.tb_articolo WHERE fk_tipologia_articolo_id = 3 AND articolo_seriale NOT IN ( SELECT seriale_articolo FROM int_magazzino.v_lista_affidamento ) ');
        $row = $query->getResultArray();
        return $row;
    }

    public function getControlloConsumiCarburante(){
        $builder = $this->db->table('tb_consumi_carburante')->select("tb_consumi_carburante.*, CONCAT(tb_anagrafica.nome,tb_anagrafica.cognome) as nominativo")->join('tb_anagrafica','tb_consumi_carburante.Codice_Autista = tb_anagrafica.anagrafica_id')->orderBy('DATA_ORA', 'ASC');
        return  $builder->get()->getResultArray();
    }

    public function aggiungiCondizioneDispositivo($condizione, $articolo)
    {
        
        $data = [
            'descrizione' => $condizione,
        ];
        $builder = $this->db->table('tb_condizione');
        $builder->insert($data);
        if ($this->db->affectedRows() >= 0) {
            $lastIDInsert = $this->db->insertID();
            $data = [
                'fk_tipologia_articolo_id' => $articolo,
                'fk_condizione_id' => $lastIDInsert,
            ];
            $builder = $this->db->table('tb_tipologia_articolo_condizione');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
            } else {
                return "Errore - " . $this->db->error();
            }
        } else {
            return "Errore - " . $this->db->error();
        }
    }


    public function aggiungiCondizioneDispositivoWizard($fk_tipologia_articolo_id,$fk_condizione_id){
        $data = [
            'fk_tipologia_articolo_id' => $fk_tipologia_articolo_id,
            'fk_condizione_id' => $fk_condizione_id,
        ];
        $builder = $this->db->table('tb_tipologia_articolo_condizione');
        $builder->insert($data);
    }

    public function getDettaglioArticolo($condizione_id)
    {
        $builder = $this->db->table('v_lista_tipo_articolo_condizione')->where('tipo_articolo_condizione_id = ', $condizione_id);
        return  $builder->get()->getResultArray();
    }

    public function aggiornaInformazioniCondizione($tipo_articolo_condizione_id, $articolo, $condizione)
    {
        $builder = $this->db->table('v_lista_tipo_articolo_condizione')->where('condizione_id = ', $condizione)->where('tipo_articolo_descrizione = ', $articolo);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente una condizione associata al seguente articolo";
        }

        $data = [
            'fk_condizione_id' => $condizione,
        ];
        $builder = $this->db->table('tb_tipologia_articolo_condizione');
        $builder->where('tipo_articolo_condizione_id = ', $tipo_articolo_condizione_id);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - " . $this->db->error();
        }
    }

    public function aggiungiNuovoStato($nuovo_stato)
    {
        $builder = $this->db->table('tb_stato_articolo')->where('descrizione = ', $nuovo_stato);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente uno stato con questa descrizione";
        }
        $data = [
            'descrizione' => $nuovo_stato,
        ];
        $builder = $this->db->table('tb_stato_articolo');
        $builder->insert($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - " . $this->db->error();
        }
    }

    public function aggiornaInformazioniStato($stato_id, $stato)
    {

        $data = [
            'descrizione' => $stato,
        ];
        $builder = $this->db->table('tb_stato_articolo');
        $builder->where('stato_articolo_id = ', $stato_id);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - " . $this->db->error();
        }
    }

    public function getDettaglioStato($stato_id)
    {
        $builder = $this->db->table('tb_stato_articolo')->where('stato_articolo_id = ', $stato_id);
        return  $builder->get()->getResultArray();
    }

    public function aggiornaStato($idArticolo, $stato)
    {
        $data = [
            'fk_stato_articolo_id' => $stato,
        ];

        $builder = $this->db->table('tb_articolo');
        $builder->where('articolo_id', $idArticolo);
        $builder->update($data);
    }

    public function getUltimoAffido($idArticolo, $seriale, $tipoAffido, $idAffido)
    {
        if (!empty($idAffido)) {
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('affidamento_id = ', $idAffido)->where('affidamento_tipo = ', $tipoAffido)->limit(1)->orderBy('affidamento_data', 'DESC');
            return  $builder->get()->getResultArray();
        }

        if (!empty($idArticolo)) {
            
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('articolo_id = ', $idArticolo)->where('affidamento_tipo = ', $tipoAffido)->limit(1)->orderBy('affidamento_data', 'DESC');
            return  $builder->get()->getResultArray();
        }

        if (!empty($seriale)) {
            
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('seriale_articolo = ', $seriale)->where('affidamento_tipo = ', $tipoAffido)->limit(1)->orderBy('affidamento_data', 'DESC');
            return  $builder->get()->getResultArray();
        }
    }

    public function getInfoAffido($idAffidamento)
    {
        if (!empty($idAffido)) {
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('affidamento_id = ', $idAffido);
            return  $builder->get()->getResultArray();
        }
    }

    public function getReponsabile($nominativo){
        $builder = $this->db->table('tb_anagrafica')->select("*")->where("CONCAT(nome,' ',cognome) = ", $nominativo);
        return  $builder->get()->getResultArray();

    }

    public function getCommessa($nome_commessa){
        $builder = $this->db->table('tb_commessa')->select("*")->where("descrizione =", $nome_commessa);
        return  $builder->get()->getResultArray();
    }

    public function getMagazzino($nome_sede){
        $builder = $this->db->table('tb_magazzino')->select("*")->where("descrizione =", $nome_sede);
        return  $builder->get()->getResultArray();
    }

    public function getMaxRichiesta(){
        $query = $this->db->query('SELECT CASE WHEN MAX(richiesta_id) is null THEN 1 ELSE MAX(richiesta_id)+1 END AS richiesta_id  FROM int_magazzino.tb_movimento;');
        $row = $query->getResultArray();
        return $row;
    }

    public function getInfoRichiestaSpostamento($richiesta_id){
        $builder = $this->db->table('v_richieste_movimento')->select("*")->where("richiesta_id =", $richiesta_id);
        return  $builder->get()->getResultArray();
    }

    public function verificaSpostamentoInvioEmail($id_utente_loggato,$fk_commessa_attuale,$fk_commessa_riferimento){
        $query = $this->db->query('SELECT * '); 
        $row = $query->getResultArray();
        return $row;
    }

    public function getResponsabileCommessa($id_utente,$commessa_id_attuale,$commessa_id_spostamento){
        $builder = $this->db->table('v_lista_responsabili_commesse')->select("*")->where('commessa_id = ', $commessa_id_attuale);
        $row = $builder->get()->getResultArray();
        if ( !empty($row) ){
            $anagrafica_id_commessa_attuale = $row[0]['anagrafica_id'];
            $builder = $this->db->table('v_lista_responsabili_commesse')->select("*")->where('commessa_id = ', $commessa_id_spostamento);
            $row_commessa = $builder->get()->getResultArray();
            $anagrafica_id_commessa_spostamento = $row_commessa[0]['anagrafica_id'];
            if ( $id_utente == $anagrafica_id_commessa_attuale && $id_utente == $anagrafica_id_commessa_spostamento ){
                return false; 
            }
            else{
                return true; 
            }

        }
    }

    

    public function richiestaSpostamento($data){

        $commessa_attuale = ""; 
        $commessa_destinazione = ""; 

        $maxIDRichiesta = $this->getMaxRichiesta(); 
        if ( $data['tipologia_spostamento'] == 'sposta' ){
            $richiesta_spostamento_risorsa = "1";
        }
        else{
            $richiesta_spostamento_risorsa = "0"; 
        }

        // echo "<pre>"; 
        // print_r($data);
        // echo "</pre>";
        
        // if ( $data['tipologia_spostamento'] == 'sposta' ){
        //     echo "Sposta la risorsa";
        //     $this->effettuaSpostamento(); 
        // }
        // else{
        //     echo "Richiedi la risorsa";
        //     $this->effettuaRichiestaSpostamento(); 
        // }

        // exit;

        $cntArray = count($data); 
       
        if ( $cntArray == 10  ){

            $commessa_attuale = $data['commessa_attuale']; 
            $commessa_destinazione = $data['commessa_destinazione']; 
            $messaggio_note = "Richiesta spostamento risorsa senza ITEM"; 
  

            $newAffido = [
                'fk_utente_id' => session()->get('id'),
                'fk_anagrafica_id' => $data['fk_anagrafica_id'],
                'fk_magazzino_provenienza' => $data['magazzino_attuale'],
                'fk_commessa_provenienza' => $data['commessa_attuale'],
                'fk_commessa_destinazione' => $data['commessa_destinazione'],
                'fk_magazzino_destinazione' => $data['magazzino_destinazione'],
                'movimento_tipo' => 'P',
                'fk_affidamento_id' => '',
                'movimento_data_richiesta' => date('Y-m-d H:i:s'),
                'movimento_stato' => '',
                'movimento_note' => 'Richiesta spostamento risorsa senza ITEM',
                'movimento_data_inizio_servizio' => $data['data_servizio_input'],
                'fk_attuale_riferimento_anagrafica' => $data['responsabile_attuale_id'],//$id_responsabile[0]['anagrafica_id'],
                'richiesta_id' => $maxIDRichiesta[0]['richiesta_id'],
                'richiesta_spostamento_risorsa' => $richiesta_spostamento_risorsa,
            ];
            $builder = $this->db->table('tb_movimento');
            $builder->insert($newAffido);
        }
        else{
            //echo "Ci sono item da spostare<br>"; 
            foreach($data as $valore){
                if ( strpos($valore,';') !== false ){
                    $codice_affidamento_id = explode(";",$valore); 

                    $commessa_attuale = $data['commessa_attuale']; 
                    $commessa_destinazione = $data['commessa_destinazione']; 
                    $messaggio_note = "Richiesta spostamento risorsa con ITEM";
                    
                    $newAffido = [
                        'fk_utente_id' => session()->get('id'),
                        'fk_anagrafica_id' => $data['fk_anagrafica_id'],
                        'fk_magazzino_provenienza' => $data['magazzino_attuale'],
                        'fk_commessa_provenienza' => $data['commessa_attuale'],
                        'fk_commessa_destinazione' => $data['commessa_destinazione'],
                        'fk_magazzino_destinazione' => $data['magazzino_destinazione'],
                        'movimento_tipo' => 'P',
                        'fk_affidamento_id' => $codice_affidamento_id[0],
                        'movimento_data_richiesta' => date('Y-m-d H:i:s'),
                        'movimento_stato' => $codice_affidamento_id[1],
                        'movimento_data_inizio_servizio' => $data['data_servizio_input'],
                        'fk_attuale_riferimento_anagrafica' => $data['responsabile_attuale_id'],//$id_responsabile[0]['anagrafica_id'],
                        'richiesta_id' => $maxIDRichiesta[0]['richiesta_id'],
                        'richiesta_spostamento_risorsa' => $richiesta_spostamento_risorsa,
                    ];

                    $builder = $this->db->table('tb_movimento');
                    $builder->insert($newAffido);

                    $dataUpdate = [
                       "affidamento_tipo" => 'P'
                    ];
                
                    $builder = $this->db->table('tb_affidamento');
                    $builder->where('affidamento_id', $codice_affidamento_id[0]);
                    $builder->update($dataUpdate);
    
                }
            }
        }
        if ($this->db->affectedRows() >= 0) {
            $esito_richiesta_invia_email = $this->getResponsabileCommessa(session()->get('id'),$commessa_attuale,$commessa_destinazione);
            if ( $esito_richiesta_invia_email ){
                $movimento = $this->getInfoRichiestaSpostamento($maxIDRichiesta[0]['richiesta_id']); 
                
                $newAffido = [
                    'fk_anagrafica_richiedente_id' => session()->get('id'),
                    'valore_richiesta_id' => $maxIDRichiesta[0]['richiesta_id'],
                    'comunicazione' =>  $messaggio_note,
                    'tipologia_email' => "RICHIESTA SPOSTAMENTO",
                    'info_in' => 'tb_movimento',
                    'data_creazione' => date('Y-m-d H:i:s'),
                ];

                $builder = $this->db->table('tb_avvisi_email');
                $builder->insert($newAffido);
                
                $email = $movimento[0]['email'];
                $nominativo_responsabile_commessa = $movimento[0]['nominativo_responsabile_commessa'];
                $data_richiesta = $movimento[0]['movimento_data_richiesta'];
                $data_inizio_servizio = $movimento[0]['movimento_data_inizio_servizio'];
                $nominativo_spostamento = $movimento[0]['nominativo_spostamento'];
                $magazzino_sede_partenza = $movimento[0]['magazzino_provenienza_dsc']; 
                $magazzino_sede_destinazione = $movimento[0]['magazzino_destinazione_dsc']; 
                $commessa_provenienza = $movimento[0]['commessa_provenienza'];
                $commessa_destinazione = $movimento[0]['commessa_destinazione'];
                $array_articoli = []; $array_tipologia = []; 
                for($i=0; $i<count($movimento); $i++){
                    array_push($array_articoli,$movimento[$i]['articolo_seriale']);
                    array_push($array_tipologia,$movimento[$i]['descrizione']);
                }



                $messaggio = "Gentile {$nominativo_responsabile_commessa}<br>"; 
                $messaggio .= "La risorsa <b>{$nominativo_spostamento}</b> sarà spostata in data {$data_inizio_servizio} "; 
                $messaggio .= "dalla sede <b>{$magazzino_sede_partenza}</b> della commessa <b>{$commessa_provenienza}</b> alla sede <b>{$magazzino_sede_destinazione}</b> della commessa <b>{$commessa_destinazione}</b> ";
                $messaggio .= "con i seguenti ITEM "; 
                $messaggio .= "<ul>";
                for($i=0; $i<count($array_articoli); $i++){
                    $messaggio .= "<li>".$array_articoli[$i]." - ".$array_tipologia[$i]."</li>";
                }
                $messaggio .= "</ul>";

                

                if ( $data['tipologia_spostamento'] == 'sposta' ){
                    //effettuo l'update di conferma in maniera diretta
                    $this->confermaSpostamento($maxIDRichiesta[0]['richiesta_id']);
                    $this->inviaEmail($email,$messaggio,$nominativo_responsabile_commessa,"SPOSTAMENTO"); 
                }
                else{
                    $this->inviaEmail($email,$messaggio,$nominativo_responsabile_commessa,"RICHIEDI"); 
                }
                


            }
            else{
                $this->confermaSpostamentoRapido(); 
            }
            return true;
        } else {
            return "Errore - Non riesco ad inserire le informazioni " . $this->db->error();
        }
    }

    public function effettuaSpostamento(){

    }
    public function effettuaRichiestaSpostamento(){

    }

    public function insertItem($tipo_articolo, $magazzino, $fornitore, $condizione, $stato, $seriale, $note, $fk_utente_creazione_id, $attributi)
    {
        $builder = $this->db->table('tb_articolo')->where('articolo_seriale', $seriale)->where('fk_tipologia_articolo_id',$tipo_articolo);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente un item con questo seriale";
        } else {
            $data = [
                'articolo_seriale' => $seriale,
                'fk_tipologia_articolo_id' => $tipo_articolo,
                'fk_magazzino_id' => $magazzino,
                'fk_fornitore_id' => $fornitore,
                'fk_stato_articolo_id' => $stato,
                'fk_condizione_id' => $condizione,
                'data_creazione' => date('Y-m-d H:i:s'),
                'fk_utente_creazione_id' => $fk_utente_creazione_id,
                'note' => $note,
                'attributi' => $attributi
            ];
            $builder = $this->db->table('tb_articolo');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
            } else {
                return "Errore - Non riesco ad inserire le informazioni " . $this->db->error();
            }
        }
    }

    public function storico_movimenti($fk_articolo_id){       
        $query = $this->db->query('SELECT t1.affidamento_id, t1.affidamento_data, t1.affidamento_tipo,t1.affidamento_note,affidamento_modulo,CASE WHEN affidamento_modulo = 0 THEN "No" ELSE "Si" END AS affidamento_modulo_descrizione,data_caricamento_modulo,t2.username as nominativo_assegnatario, CONCAT(t3.nome," ",t3.cognome) as nominativo_destinatario, descrizione as descrizione_commessa, settore as settore_commessa
        FROM tb_affidamento as t1 LEFT JOIN tb_utente as t2 ON t1.fk_utente_assegnatario_id = t2.utente_id
        LEFT JOIN tb_anagrafica as t3 ON t1.fk_anagrafica_destinatario_id = t3.anagrafica_id
        LEFT JOIN tb_commessa ON t1.fk_commessa_id = tb_commessa.commessa_id
        WHERE fk_articolo_id = '.$fk_articolo_id.' ORDER BY t1.affidamento_data desc'); 
        $row = $query->getResultArray();
        return $row;
    }


    public function richieste_movimento($user_id){
        $infoArray = array(); 
        $builder = $this->db->table('v_utenti')->where('utente_id', $user_id);
        $row = $builder->get()->getResultArray();
        $nome = $row[0]['nome']; 
        $cognome = $row[0]['cognome']; 
        $nominativo = trim($nome)." ".trim($cognome); 

        $builder = $this->db->table('v_richieste_movimento')->select("*")->where('CONCAT(nome," ",cognome)',$nominativo)->where('movimento_tipo','P')->groupBy('richiesta_id');
        
        $row = $builder->get()->getResultArray();

        for($i=0; $i<count($row); $i++){
            $info = $this->richieste_movimento2($row[$i]['richiesta_id']);
            
            array_push($infoArray,$info);
            
        }

        return json_encode($infoArray);

    }
    public function richieste_movimento2($richiesta_id){
        $builder = $this->db->table('v_richieste_movimento')->select("*")->where('richiesta_id',$richiesta_id);
        return  $builder->get()->getResultArray();
    }

    public function getRichiestePending($utente_id){
        $builder = $this->db->table('v_utenti')->where('utente_id', $utente_id);
        $row = $builder->get()->getResultArray();
        $nome = $row[0]['nome']; 
        $cognome = $row[0]['cognome']; 
        $nominativo = trim($nome)." ".trim($cognome); 

        //$query = $this->db->query("SELECT movimento_id as cnt FROM tb_movimento WHERE movimento_tipo = 'P' GROUP BY richiesta_id ");
        $builder = $this->db->table('v_richieste_movimento')->select("*")->where('nominativo_responsabile_commessa',$nominativo)->where('movimento_tipo','P')->groupBy('richiesta_id');
        $row = $builder->get()->getResultArray();
        //$row = $query->getResultArray();
        return $row;
    }

    public function confermaSpostamento($id){
        
        $builder = $this->db->table('tb_movimento')->select("*,tb_movimento.fk_commessa_destinazione as commessa_destinazione_finale")->join('tb_anagrafica','tb_movimento.fk_attuale_riferimento_anagrafica = tb_anagrafica.anagrafica_id')->join('tb_affidamento','tb_movimento.fk_affidamento_id = tb_affidamento.affidamento_id','left')->where('richiesta_id',$id);
        $row = $builder->get()->getResultArray();
        
        for($i=0; $i<count($row); $i++){
            
            $updateItem2 = [
                'movimento_tipo' => 'C',
                'movimento_data_approvazione' => date('Y-m-d H:i:s')
            ];            
            $builder = $this->db->table('tb_movimento');
            $builder->where('richiesta_id', $row[$i]['richiesta_id']);
            $builder->update($updateItem2);

            if ( $row[$i]['fk_affidamento_id'] != 0 ){
                $updateItem2 = [
                    'affidamento_tipo' => 'D',
                ];
        
                // // aggiornamento Item
                $builder = $this->db->table('tb_affidamento');
                $builder->where('affidamento_id', $row[$i]['fk_affidamento_id']);
                $builder->update($updateItem2);
            }

        }

        $builder = $this->db->table('tb_movimento')->select("*,tb_movimento.fk_commessa_destinazione as commessa_destinazione_finale")->join('tb_anagrafica','tb_movimento.fk_attuale_riferimento_anagrafica = tb_anagrafica.anagrafica_id')->join('tb_affidamento','tb_movimento.fk_affidamento_id = tb_affidamento.affidamento_id','left')->where('richiesta_id',$id);
        $row = $builder->get()->getResultArray();

        
        if ( $row[0]['fk_affidamento_id'] != 0 ){

            for($i=0; $i<count($row); $i++){
    
                $fk_utente_assegnatario_id = session()->get('id'); 
                $fk_anagrafica_destinatario_id = $row[$i]['fk_anagrafica_destinatario_id']; 
                $fk_commessa_id = $row[$i]['fk_commessa_destinazione'];
                $fk_magazzino_provenienza_id = $row[$i]['fk_magazzino_provenienza_id']; 
                $fk_magazzino_destinazione_id = $row[$i]['fk_magazzino_destinazione_id']; 
                $fk_anagrafica_responsabile = $row[$i]['fk_attuale_riferimento_anagrafica'];
                $anagrafica_responsabile_descrizione = $row[$i]['nome']." ".$row[$i]['cognome'];
                $affidamento_data = $row[$i]['movimento_data_approvazione'];
                $condizione_articolo = $row[$i]['fk_condizione_id'];
                $fk_articolo_id = $row[$i]['fk_articolo_id'];
                
                $data = [
                    'fk_utente_assegnatario_id' => $fk_utente_assegnatario_id,
                    'fk_anagrafica_destinatario_id' => $fk_anagrafica_destinatario_id,
                    'fk_commessa_id' => $fk_commessa_id, 
                    'fk_magazzino_provenienza_id' => $fk_magazzino_provenienza_id, 
                    'fk_magazzino_destinazione_id' => $fk_magazzino_destinazione_id, 
                    'fk_anagrafica_responsabile' => $fk_anagrafica_responsabile, 
                    'anagrafica_responsabile_descrizione' => $anagrafica_responsabile_descrizione, 
                    'affidamento_data' => $affidamento_data, 
                    'affidamento_tipo' => 'A', 
                    'fk_condizione_id' => $condizione_articolo,
                    'attivo' => 1,
                    'fk_articolo_id' => $fk_articolo_id
                ];
                $builder = $this->db->table('tb_affidamento');
                $builder->insert($data);
    
                $updateItem3 = [
                    'fk_commessa_id' => $fk_commessa_id,
                ];
        
                // aggiornamento Item
                $builder = $this->db->table('tb_anagrafica');
                $builder->where('anagrafica_id', $fk_anagrafica_destinatario_id);
                $builder->update($updateItem3);
            }
        }
        else{
            $fk_commessa_id = $row[0]['fk_commessa_destinazione'];
            $fk_anagrafica_destinatario_id = $row[0]['fk_anagrafica_id']; 
            $updateItem3 = [
                'fk_commessa_id' => $fk_commessa_id,
            ];
    
            // aggiornamento Item
            $builder = $this->db->table('tb_anagrafica');
            $builder->where('anagrafica_id', $fk_anagrafica_destinatario_id);
            $builder->update($updateItem3);
        }
        
        $movimento = $this->getInfoRichiestaSpostamento($id); 

        $newAffido = [
            'fk_anagrafica_richiedente_id' => session()->get('id'),
            'valore_richiesta_id' => $id,
            'comunicazione' =>  "CONFERMA SPOSTAMENTO RISORSA",
            'tipologia_email' => "CONFERMA SPOSTAMENTO RISORSA",
            'info_in' => 'tb_movimento',
            'data_creazione' => date('Y-m-d H:i:s'),
        ];

        $builder = $this->db->table('tb_avvisi_email');
        $builder->insert($newAffido);

        $email = $movimento[0]['email'];
        $nominativo_responsabile_commessa = $movimento[0]['nominativo_responsabile_commessa'];
        $data_richiesta = $movimento[0]['movimento_data_richiesta'];
        $data_inizio_servizio = $movimento[0]['movimento_data_inizio_servizio'];
        $nominativo_spostamento = $movimento[0]['nominativo_spostamento'];
        $magazzino_sede_partenza = $movimento[0]['magazzino_provenienza_dsc']; 
        $magazzino_sede_destinazione = $movimento[0]['magazzino_destinazione_dsc']; 
        $commessa_provenienza = $movimento[0]['commessa_provenienza'];
        $commessa_destinazione = $movimento[0]['commessa_destinazione'];
        $array_articoli = []; $array_tipologia = []; 
        for($i=0; $i<count($movimento); $i++){
            array_push($array_articoli,$movimento[$i]['articolo_seriale']);
            array_push($array_tipologia,$movimento[$i]['descrizione']);
        }

        $messaggio = "Gentile {$nominativo_responsabile_commessa}<br>"; 
        $messaggio .= "La risorsa <b>{$nominativo_spostamento}</b> <b>sarà spostata</b> sotto la tua area di competenza  "; 
        $messaggio .= "dalla sede <b>{$magazzino_sede_partenza}</b> della commessa <b>{$commessa_provenienza}</b> alla sede <b>{$magazzino_sede_destinazione}</b> della commessa <b>{$commessa_destinazione}</b> ";
        $messaggio .= "<ul>";
        for($i=0; $i<count($array_articoli); $i++){
            $messaggio .= "<li>".$array_articoli[$i]." - ".$array_tipologia[$i]."</li>";
        }
        $messaggio .= "</ul>";

        $this->inviaEmail($email,$messaggio,$nominativo_responsabile_commessa,"CONSENTI_SPOSTAMENTO"); 


    }

    public function confermaSpostamentoRapido(){
        $builder = $this->db->table('tb_movimento')->select("*")->where("movimento_tipo = 'P' and fk_commessa_provenienza = fk_commessa_destinazione");
        $row = $builder->get()->getResultArray();
        
        for($i=0; $i<count($row); $i++){
            
            $updateItem2 = [
                'movimento_tipo' => 'C',
                'movimento_data_approvazione' => date('Y-m-d H:i:s'),
                'spostamento_rapido' => 1
            ];            
            $builder = $this->db->table('tb_movimento');
            $builder->where('richiesta_id', $row[$i]['richiesta_id']);
            $builder->update($updateItem2);

            if ( $row[$i]['fk_affidamento_id'] != 0 ){
                $updateItem2 = [
                    'affidamento_tipo' => 'D',
                ];
        
                $builder = $this->db->table('tb_affidamento');
                $builder->where('affidamento_id', $row[$i]['fk_affidamento_id']);
                $builder->update($updateItem2);
            }

        }

        $builder = $this->db->table('tb_movimento')->select("*,tb_movimento.fk_commessa_destinazione as commessa_destinazione_finale")->join('tb_anagrafica','tb_movimento.fk_attuale_riferimento_anagrafica = tb_anagrafica.anagrafica_id')->join('tb_affidamento','tb_movimento.fk_affidamento_id = tb_affidamento.affidamento_id','left')->where("movimento_tipo = 'C' and fk_commessa_provenienza = fk_commessa_destinazione and spostamento_rapido is null");
        $row = $builder->get()->getResultArray();
            $fk_commessa_id = $row[0]['fk_commessa_destinazione'];
            $fk_anagrafica_destinatario_id = $row[0]['fk_anagrafica_id']; 
            $updateItem3 = [
                'fk_commessa_id' => $fk_commessa_id,
            ];
    
            $builder = $this->db->table('tb_anagrafica');
            $builder->where('anagrafica_id', $fk_anagrafica_destinatario_id);
            $builder->update($updateItem3);

    }

    public function confermaRifiuto($id){
        $updateItem = [
            'movimento_tipo' => 'R',
            'movimento_data_approvazione' => date('Y-m-d H:i:s')
        ];

        // aggiornamento Item
        $builder = $this->db->table('tb_movimento');
        $builder->where('richiesta_id', $id);
        $builder->update($updateItem);

        $builder = $this->db->table('tb_movimento')->select("*")->where('richiesta_id',$id);
        $row = $builder->get()->getResultArray();
        
        for($i=0; $i<count($row); $i++){

            $updateItem2 = [
                'affidamento_tipo' => 'A',
            ];
    
            // aggiornamento Item
            $builder = $this->db->table('tb_affidamento');
            $builder->where('affidamento_id', $row[$i]['fk_affidamento_id']);
            $builder->update($updateItem2);

        }
        
        $movimento = $this->getInfoRichiestaSpostamento($id); 

        $newAffido = [
            'fk_anagrafica_richiedente_id' => session()->get('id'),
            'valore_richiesta_id' => $id,
            'comunicazione' =>  "RIFIUTO SPOSTAMENTO RISORSA",
            'tipologia_email' => "RIFIUTO SPOSTAMENTO RISORSA",
            'info_in' => 'tb_movimento',
            'data_creazione' => date('Y-m-d H:i:s'),
        ];

        $builder = $this->db->table('tb_avvisi_email');
        $builder->insert($newAffido);

        $email = $movimento[0]['email'];
        $nominativo_responsabile_commessa = $movimento[0]['nominativo_responsabile_commessa'];
        $data_richiesta = $movimento[0]['movimento_data_richiesta'];
        $data_inizio_servizio = $movimento[0]['movimento_data_inizio_servizio'];
        $nominativo_spostamento = $movimento[0]['nominativo_spostamento'];
        $magazzino_sede_partenza = $movimento[0]['magazzino_provenienza_dsc']; 
        $magazzino_sede_destinazione = $movimento[0]['magazzino_destinazione_dsc']; 
        $commessa_provenienza = $movimento[0]['commessa_provenienza'];
        $commessa_destinazione = $movimento[0]['commessa_destinazione'];

        $messaggio = "Gentile {$nominativo_responsabile_commessa}<br>"; 
        $messaggio .= "La risorsa <b>{$nominativo_spostamento}</b> <b>non</b> sarà più spostata "; 
        $messaggio .= "dalla sede <b>{$magazzino_sede_partenza}</b> della commessa <b>{$commessa_provenienza}</b> alla sede <b>{$magazzino_sede_destinazione}</b> della commessa <b>{$commessa_destinazione}</b> ";
        

        $this->inviaEmail($email,$messaggio,$nominativo_responsabile_commessa,"RIFIUTO_SPOSTAMENTO"); 

    }

    public function inviaEmail($email_destinatario,$tabella,$nominativo_responsabile_commessa,$motivazione){
        $mail = new PHPMailer_Lib(); 
        $email = $mail->load();
        $email->SMTPDebug = 3; 
		$email->Host = "smtp.easyservizi.it";
		$email->Port = 587; 
		$email->SMTPSecure = 'tls';
        $email->SMTPAuth = false;
        $email->CharSet = "UTF-8";
        $email->Encoding = 'base64';

		$email->setFrom("noreply@easyservizi.it", "noreply@easyservizi.it");
        $email->addAddress($email_destinatario, $email_destinatario);
        
        if ( $motivazione == "SPOSTAMENTO" ){
            $email->Subject = 'Richiesta spostamento risorsa';
            $email->msgHTML("Salve ".strtoupper($nominativo_responsabile_commessa)."<br>questa email è stata generata dal sistema per avvisarti che la risorsa indicata sarà spostata sotto la tua area di competenza<br><br>".$tabella);
		    $email->AltBody = 'HTML messaging not supported';
        }
        elseif ( $motivazione == "CONSENTI_SPOSTAMENTO" ){
            $email->Subject = 'Consenti spostamento risorsa';
            $email->msgHTML("<p>Salve ".strtoupper($nominativo_responsabile_commessa)."<p><p>Questa email è stata generata dal sistema per avvisarti che la risorsa indicata in tabella <b>sarà spostata</b> sotto la tua area di competenza</p><hr><br>".$tabella);
            $email->AltBody = 'HTML messaging not supported';
        }
        elseif ( $motivazione == "RIFIUTO_SPOSTAMENTO" ){
            $email->Subject = 'Rifiuto spostamento risorsa';
            $email->msgHTML("<p>Salve ".strtoupper($nominativo_responsabile_commessa)."<p><p>Questa email è stata generata dal sistema per avvisarti che la risorsa indicata <b>non sarà spostata</b> sotto la tua area di competenza</p><hr><br>".$tabella);
            $email->AltBody = 'HTML messaging not supported';
        }
        if ( $motivazione == "RICHIEDI" ){
            $email->Subject = 'Richiesta spostamento risorsa';
            $email->msgHTML("Salve ".strtoupper($nominativo_responsabile_commessa)."<br>questa email è stata generata dal sistema per avvisarti che la risorsa indicata sarà spostata sotto la tua area di competenza, per <u>confermare</u> o <u>rifiutare</u> puoi procedere cliccando sul seguente link <a href='http://magazzino.local/controlloRichieste'>Clicca qui</a><br><br><hr><br><br>".$tabella);
		    $email->AltBody = 'HTML messaging not supported';
        }

		if(!$email->Send()){
		 	echo "Mailer Error: " . $email->ErrorInfo;
		}
		
    }

    public function inviaEmail_remainder($email_destinatario,$tipologia_documento,$destinatario,$affidamento_id,$affidamento_tipo){
        $mail = new PHPMailer_Lib(); 
        $email = $mail->load();
        $email->SMTPDebug = 3; 
		$email->Host = "smtp.easyservizi.it";
		$email->Port = 587; 
		$email->SMTPSecure = 'tls';
        $email->SMTPAuth = false;
        $email->CharSet = "UTF-8";
        $email->Encoding = 'base64';

        if ( $affidamento_tipo == "A" ){
            $link_genera_modulo_affido = "http://192.168.0.161/reportserver/reportserver/httpauthexport?id=13734&format=pdf&user=user&apikey=test123&p_affidamento_id={$affidamento_id}"; 
        }
        else{
            $link_genera_modulo_affido = "http://192.168.0.161/reportserver/reportserver/httpauthexport?id=14509&format=pdf&user=user&apikey=test123&p_affidamento_id={$affidamento_id}"; 
        }

		$email->setFrom("noreply@easyservizi.it", "noreply@easyservizi.it");
        $email->addAddress($email_destinatario, $email_destinatario);
        
        $email->Subject = 'Documenti mancanti';
        $email->msgHTML("<p>Salve ".strtoupper($destinatario)."<p><p>Questa email è stata generata dal sistema per avvisarti che manca il documento di <b>{$tipologia_documento}</b> della risorsa <b>{$destinatario}</b></p><p>Puoi generarlo cliccando sul seguente link: <a href='{$link_genera_modulo_affido}'>Clicca qui</a></p><br>");
        $email->AltBody = 'HTML messaging not supported';

		if(!$email->Send()){
		 	echo "Mailer Error: " . $email->ErrorInfo;
		}
    }

    public function getCountITEM($item,$stato){
        $builder = $this->db->table('v_lista_articoli_presenti_completa')->selectCount('seriale')->where('tipo_articolo',$item)->where('stato_articolo',$stato);
        $row = $builder->get()->getResultArray();
        return $row;        
    }

    public function remainder(){

        $data_giornaliera = date_create(date('Y-m-d'));
        

        $builder = $this->db->table('v_remainder')->select('*')->orderBy('affidamento_id');
        $row = $builder->get()->getResultArray();
        
        for($i=0; $i<count($row); $i++){
            $affidamento_data = date_create($row[$i]['affidamento_data']);
            $affidamento_id = $row[$i]['affidamento_id']; 
            $operatore = $row[$i]['operatore']; 
            $operatore_email = $row[$i]['operatore_email'];
            $responsabile_email = $row[$i]['responsabile_email'];
            $responsabile = $row[$i]['responsabile']; 
            $affidamento_tipo = $row[$i]['affidamento_tipo']; 
            $affidamento_tipo_dsc = $row[$i]['affidamento_tipo_dsc']; 
            $articolo_seriale = $row[$i]['articolo_seriale']; 
            $descrizione_articolo = $row[$i]['descrizione']; 
            $anagrafica_operatore = $row[$i]['anagrafica_operatore']; 
            $anagrafica_responsabile = $row[$i]['anagrafica_responsabile']; 

            $intervallo = date_diff($affidamento_data, $data_giornaliera); 
            
            $tabella = "<table style='border-collapse: collapse;width:100%'>
                        <tr>
                            <th style='border-bottom: 1px solid #ddd'>Tipologia di documento</th>
                            <th style='border-bottom: 1px solid #ddd'>Seriale</th>
                            <th style='border-bottom: 1px solid #ddd'>Descrizione</th>
                        </tr>";

            $tabella .= "<tr>
                        <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($affidamento_tipo_dsc)."</td>
                        <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($articolo_seriale)."</td>
                        <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($descrizione_articolo)."</td>
                    </tr>"; 
            
            if ( $intervallo >= "1" && $intervallo < "1" ){
                $data = [
                    'fk_anagrafica_id' => $anagrafica_operatore,
                    'fk_affidamento_id' => $affidamento_id,
                    'comunicazione' => "Invio comunicazione di mancanza modulo {$affidamento_tipo_dsc} per il seriale {$articolo_seriale} all'operatore!",
                ];
                $builder = $this->db->table('tb_avvisi_email');
                $builder->insert($data);
                $this->inviaEmail_remainder($operatore_email,$affidamento_tipo_dsc,$operatore,$affidamento_id,$affidamento_tipo);
            }
            elseif( $intervallo >= "2" && $intervallo < "2" ){
                $data = [
                    'fk_anagrafica_id' => $anagrafica_responsabile,
                    'fk_affidamento_id' => $affidamento_id,
                    'comunicazione' => "Invio comunicazione di mancanza modulo {$affidamento_tipo_dsc} per il seriale {$articolo_seriale} al responsabile!",
                ];
                $builder = $this->db->table('tb_avvisi_email');
                $builder->insert($data);
                $this->inviaEmail_remainder($responsabile_email,$affidamento_tipo_dsc,$responsabile,$affidamento_id,$affidamento_tipo);
            }
            elseif( $intervallo >= "3" ){
                $data = [
                    'fk_anagrafica_id' => $anagrafica_responsabile,
                    'fk_affidamento_id' => $affidamento_id,
                    'comunicazione' => "Invio comunicazione di mancanza modulo {$affidamento_tipo_dsc} per il seriale {$articolo_seriale} alla mailing list!",
                ];
                $builder = $this->db->table('tb_avvisi_email');
                $builder->insert($data);
                $this->inviaEmail_remainder("mauro.spezzaferro@easyservizi.it",$affidamento_tipo_dsc,$responsabile,$affidamento_id,$affidamento_tipo);
            }
    
        }
        
    }




}
