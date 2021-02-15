<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticoloModel extends Model
{
    // tabella di riferimento
    protected $table = 'tb_articolo';
    protected $primaryKey = 'articolo_id';

    //[articolo_id]
    //[codice_articolo]
    //[fk_tipologia_articolo_id]
    //[fk_magazzino_id]
    //[fk_fornitore_id]
    //[fk_stato_articolo_id]
    //[fk_condizione_id]
    //[data_creazione]
    //[fk_utente_creazione_id]
    //[data_modifica]
    //[fk_utente_modifica_id]
    //[attributi]
    //[note]

    protected $allowedFields = ['codice_articolo', 'articolo_seriale', 'fk_tipologia_articolo_id', 'fk_magazzino_id', 'fk_fornitore_id', 'fk_stato_articolo_id', 'fk_condizione_id', 'data_creazione', 'fk_utente_creazione_id', 'data_modifica', 'fk_utente_modifica_id', 'attributi', 'note', 'ultimo_affido_anagrafica', 'ultimo_affido_commessa', 'ultimo_affido_user', 'ultimo_affido_data', 'ultimo_affido_magazzino'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    // metodo richiamato prima dell'inserimento
    protected function beforeInsert(array $data)
    {
        //$data = $this->passwordHash($data);
        $data['data']['data_creazione'] = date('Y-m-d H:i:s');

        return $data;
    }

    // metodo richiamato prima dell'update
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

    public function getStatoArticoli()
    {
        $builder = $this->db->table('tb_stato_articolo');
        return  $builder->get()->getResultArray();
    }

    public function getCondizioneArticoli()
    {
        $builder = $this->db->table('tb_condizione');
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
            //if((empty($idTipoArticolo)) 
            //if (empty($idTipoArticolo))
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('stato_articolo = ', 'libero');
        else
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('stato_articolo = ', 'libero');

        return  $builder->get()->getResultArray();
    }

    public function getArticolo($idTipoArticolo, $seriale, $idArticolo)
    {
        if ($seriale != null || $seriale <> '') {
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('seriale = ', $seriale)->where('stato_articolo = ', 'libero');
            //$builder = $this->db->table('v_lista_articoli_presenti_completa')->where('seriale = ', $seriale);
            return  $builder->get()->getResultArray();
        }

        if ($idTipoArticolo != null and $seriale != null) {
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('seriale = ', $seriale)->where('stato_articolo = ', 'libero');;
            //$builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('seriale = ', $seriale);
            return  $builder->get()->getResultArray();
        }

        if ($idTipoArticolo != null and ($seriale == null || empty($seriale))) {
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo)->where('stato_articolo = ', 'libero');
            //$builder = $this->db->table('v_lista_articoli_presenti_completa')->where('fk_tipologia_articolo_id = ', $idTipoArticolo);
            return  $builder->get()->getResultArray();
        }

        if ($idArticolo != null || $idArticolo <> '') {
            $builder = $this->db->table('v_lista_articoli_presenti_completa')->where('articolo_id = ', $idArticolo)->where('stato_articolo = ', 'libero');;
            //$builder = $this->db->table('v_lista_articoli_presenti_completa')->where('articolo_id = ', $idArticolo);
            return  $builder->get()->getResultArray();
        }

        //return  $builder->get()->getResultArray();
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
                //'tipologia_articolo_id' => rand(),
                'descrizione' => $nome_item,
                'fk_categoria_articolo_id' => $categoria_id
            ];
            $builder = $this->db->table('tb_tipologia_articolo');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
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
                //creo una nuova categoria
                $data = [
                    //'categoria_articolo_id' => rand(),
                    'descrizione' => $nome_categoria,
                ];
            } else {
                $builder = $this->db->table('tb_categoria_articolo')->where('descrizione = ', $categoria);
                foreach ($builder->get()->getResultArray() as $row) {
                    $categoria_id = $row['categoria_articolo_id'];
                }
                //associa ad una categoria
                $data = [
                    //'categoria_articolo_id' => rand(),
                    'descrizione' => $nome_categoria,
                    'parent' => $categoria_id
                ];
            }
            $builder = $this->db->table('tb_categoria_articolo');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
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

        $builder = $this->db->table('tb_attributo')->where('descrizione = ', $descrizione);
        if ($builder->countAllResults() > 0) {
            return "Attenzione, risulta già presente una categoria con questo nome";
        } else {
            $data = [
                //'attributo_id' => rand(),
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
    }

    public function getNodoPadre()
    {
        $query = $this->db->query('SELECT tb_categoria_articolo.*
                                    FROM tb_categoria_articolo 
                                    WHERE parent is null');
        $row = $query->getResultArray();
        return $row;
    }

    public function albero()
    {
        // $queryParent = $this->db->query("SELECT categoria_articolo_id
        //                                 FROM tb_categoria_articolo 
        //                                 WHERE parent is null"); 
        // $rowParent = $queryParent->getResultArray();
        // return $rowParent;

        $query = $this->db->query('SELECT tb_categoria_articolo.*
                                    FROM tb_categoria_articolo 
                                    WHERE parent is null
                                    UNION ALL 
                                    SELECT tb2.categoria_articolo_id, tb2.descrizione, tb2.parent
                                    FROM tb_categoria_articolo tb1 LEFT JOIN tb_categoria_articolo tb2 ON tb1.categoria_articolo_id = tb2.parent
                                    WHERE tb2.parent is not null');
        $row = $query->getResultArray();
        $row = $this->buildTree($row);

        return $row;
        //return json_encode($row);

    }

    public function test()
    {
        $query = $this->db->query('SELECT tb_categoria_articolo.*
                                    FROM tb_categoria_articolo 
                                    WHERE parent is null
                                    ');
        $row = $query->getResultArray();
        return $row;
    }

    public function test2()
    {
        $query = $this->db->query('SELECT tb_categoria_articolo.*
                                    FROM tb_categoria_articolo 
                                    WHERE parent is null
                                    ');
        $row = $query->getResultArray();
    }

    function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element) {
            //print_r($element);
            if ($element['parent'] == $parentId) {
                $children = $this->buildTree($elements, $element['categoria_articolo_id']);
                if ($children) {
                    $element['Figlio'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function getListaAffidi($anagrafica_id, $tipoAffido, $attivo)
    {
        if (empty($anagrafica_id)) {
            //$builder = $this->db->table('tb_anagrafica')->select("anagrafica_id,nome,cognome",)->limit(100)->orderBy('data_aggiornamento', 'DESC');
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('attivo = ', $attivo)->where('affidamento_tipo = ', $tipoAffido)->limit(100)->orderBy('affidamento_data', 'DESC');
            return  $builder->get()->getResultArray();
        } else {
            $builder = $this->db->table('v_lista_affidamento')->select("*")->where('attivo = ', $attivo)->where('affidamento_tipo = ', $tipoAffido)->where('anagrafica_id = ', $anagrafica_id)->orderBy('affidamento_data', 'DESC');
            return  $builder->get()->getResultArray();
        }
    }

    public function cercaArticoli($seriale, $tipoArticolo, $statoArticolo, $condizioneArticolo, $commessa, $sede)
    {
        $queryTxt = "SELECT * from v_lista_articoli_presenti_completa articolo_id is not null and ";

        if (!empty($seriale))
            $queryTxt .= " seriale = {$seriale}";
        if (!empty($tipoArticolo))
            $queryTxt .= " fk_tipologia_articolo_id = {$tipoArticolo}";
        if (!empty($statoArticolo))
            $queryTxt .= " fk_stato_articolo_id = {$statoArticolo}";
        if (!empty($condizioneArticolo))
            $queryTxt .= " fk_condizione_id = {$condizioneArticolo}";
        if (!empty($commessa))
            $queryTxt .= " seriale = {$commessa}";
        if (!empty($sede))
            $queryTxt .= " fk_magazzino_id = {$sede}";

        $query = $this->db->query('SELECT *
                                    FROM v_lista_articoli_presenti_completa 
                                    WHERE parent is null');
        $row = $query->getResultArray();
        return $row;

        $builder = $this->db->table('')

            ->where('stato_articolo = ', 'libero');
        return  $builder->get()->getResultArray();
    }

    public function aggiornaStato($idArticolo, $stato)
    {
        // todo: leggere da tabella stato affidato
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

    public function richiestaSpostamento($data)
    {
        /*echo "<pre>" . json_encode($data, JSON_PRETTY_PRINT) .
            "</pre>"; */

        //$builder = $this->db->table('tb_affidamento');
        //$builder->where('affidamento_id', $affidamento_id);
        //print_r($builder->get()->getResultArray());

        $this->db->transStart();

        for ($i = 0; $i < count($data); $i++) {
            $builder = $this->db->table('tb_affidamento');
            $builder->where('affidamento_id', $data[$i]['affidamento_id']);

            $affido = $builder->get()->getResultArray();

            $newAffido = [
                'fk_utente_assegnatario_id' => $data[$i]['user_id'],
                'fk_anagrafica_destinatario_id' => $data[$i]['risorsa'],
                'fk_articolo_id' => $affido['fk_articolo_id'],
                'fk_commessa_id' => $data[$i]['commessa_destinazione_input'],
                'fk_magazzino_provenienza_id' => $affido['fk_magazzino_provenienza_id'],
                'fk_magazzino_destinazione_id' => $data[$i]['commessa_destinazione_input'],
                'affidamento_tipo' => 'P',
                'fk_condizione_id' => $affido['fk_condizione_id']
            ];

            // aggiornamento Item
            $builder = $this->db->table('tb_affidamento');
            $builder->set($newAffido);
            $builder->insert($newAffido);

            $newMovimentoRisorsa = [
                'fk_utente_id' => $data[$i]['user_id'],
                'fk_anagrafica_id' => $data[$i]['risorsa'],
                'fk_magazzino_provenienza' => $affido['fk_magazzino_provenienza_id'],
                'fk_magazzino_destinazione' => $data[$i]['commessa_destinazione_input'],
                'fk_commessa_provenienza' => $affido['commessa_destinazione_input'],
                'fk_commessa_destinazione' => $data[$i]['commessa_destinazione_input'],
                'movimento_data_richiesta' => date("Y/m/d h:i:s"),
                'movimento_data_inizio_servizio' => $data[$i]['commessa_destinazione_input'],
                'movimento_stato' => 'P'
            ];

            $builder = $this->db->table('tb_movimento');
            $builder->set($newMovimentoRisorsa);
            $builder->insert($newMovimentoRisorsa);

            $updateItem = [
                'fk_stato_articolo_id' => '5',
            ];

            // aggiornamento Item
            $builder = $this->db->table('tb_articolo');
            $builder->where('articolo_id', $affido['fk_articolo_id']);
            $builder->update($updateItem);
        }



        //echo $data[1]['affidamento_id'];

        //$builder = $this->db->table('tb_affidamento');
        //$builder->where('affidamento_id', $data[1]['affidamento_id']);
        //print_r($builder->get()->getResultArray());

        //$this->db->transStart();
    }
}
