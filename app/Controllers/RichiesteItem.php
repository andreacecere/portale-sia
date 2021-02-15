<?php

namespace App\Controllers;

use App\Models\AffidamentoModel;
use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\MagazzinoModel;
use App\Models\FornitoriModel;
use App\Models\UserModel;
use App\Models\RichiesteItemModel;
use App\Libraries\RoleUser;

class RichiesteItem extends BaseController
{
    protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}

    public function nuovaRichiesta(){

        $articoloModel = new ArticoloModel(); 
        $userModel = new UserModel(); 
        $magazzino_sediModel = new MagazzinoModel(); 
        $commesseModel = new CommesseModel(); 

        $articoli_presenti = $articoloModel->getTipoArticoli(); 
        $data['articoli_presenti'] = $articoli_presenti;

        $lista_dipendenti = $userModel->getListaAnagrafica(""); 
        $data['lista_dipendenti'] = $lista_dipendenti; 

        $magazzino_sedi = $magazzino_sediModel->getSedi(); 
        $data['magazzino_sedi'] = $magazzino_sedi; 

        $commesse = $commesseModel->getListacommesse();
        $data['commesse'] = $commesse; 

		echo view('templates/headers/assegnaItem_header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('richiesteItem/nuovaRichiesta',$data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');
    }

    public function getAttributo($tipologia_articolo_id)
	{
		$arrayInfo = array();
		$arrayDati = array();
		$dati = array();
		
        $model = new ArticoloModel();
        //$tipologia_articolo_id = $this->request->getPost('tipologia_articolo_id');
        $attributiItem = $model->getAttributiItem($tipologia_articolo_id);
        
        for ($i = 0; $i < count($attributiItem); $i++) {
            //echo $attributiItem[$i]['attributo_id'];
            $getAttributiItemSingolo = $model->getAttributiItemSingolo($attributiItem[$i]['attributo_id']);
            //echo "A".count($attributiItem);
            for ($j = 0; $j < count($getAttributiItemSingolo); $j++) {

                array_push($arrayDati, trim($getAttributiItemSingolo[$j]['descrizione']));
                $dati = array(
                    "DescrizioneArticolo" => ucfirst(strtolower($attributiItem[$i]['descrizione'])),
                    "Attributo" => $arrayDati
                );
            }
            array_push($arrayInfo, $dati);
            $arrayDati = [];
        }
        return json_encode($arrayInfo);
		
    }

    public function inserisciRichiestaItem(){

        $modelArticolo = new ArticoloModel();
        $modelrichieste = new RichiesteItemModel();
        $utentiModel = new UserModel(); 
        $sedeModel = new MagazzinoModel(); 
        $commessaModel = new CommesseModel();

        
        $prodotto = $this->request->getPost('prodotto');
        $attributi = $this->request->getPost('attributi');
        $quantita = $this->request->getPost('quantita');
        $destinatario = $this->request->getPost('destinatario');
        $sede = $this->request->getPost('sede');
        $commessa = $this->request->getPost('commessa');
        $note = $this->request->getPost('note');

        //echo "Destinatario: ".$destinatario;

        $tipologia_articolo_id = $modelArticolo->getTipoArticolo_id($prodotto); 
        $fk_destinatario = $utentiModel->getInfoUtente($destinatario);
        $fk_sede = $sedeModel->getSede($sede); 
        $fk_commessa = $commessaModel->getCommessa($commessa); 


        if ( empty($tipologia_articolo_id[0]['tipologia_articolo_id']) ){
            $tipologia_articolo_id = 0; 
        }
        else{
            $tipologia_articolo_id = $tipologia_articolo_id[0]['tipologia_articolo_id'];
            $prodotto = ""; 
        }
        $session_user_id = session()->get('id');
        //echo "Tipologia: ".$note;

        $inserimentoRichiesta = $modelrichieste->inserisciRichiestaITEM(trim($tipologia_articolo_id),$prodotto,trim($attributi),trim($quantita),trim($fk_destinatario[0]['anagrafica_id']),trim($fk_sede[0]['magazzino_id']),trim($fk_commessa[0]['commessa_id']),$note,$session_user_id); 
        
        if ( $inserimentoRichiesta ){
            echo "inserimento_avvenuto"; 
        }
        else{
            echo "errore";
        }

    }

    
    
    public function visualizzaRichieste(){

        $modelRichieste = new RichiesteItemModel(); 
        $item = $modelRichieste->visualizzaRichiesteITEM(); 
        $stati = $modelRichieste->getStati(); 

        $articoloModel = new ArticoloModel(); 
        $userModel = new UserModel(); 
        $magazzino_sediModel = new MagazzinoModel(); 
        $commesseModel = new CommesseModel();

        $lista_dipendenti = $userModel->getListaAnagrafica(""); 
        $data['lista_dipendenti'] = $lista_dipendenti; 

        $magazzino_sedi = $magazzino_sediModel->getSedi(); 
        $data['magazzino_sedi'] = $magazzino_sedi; 

        $commesse = $commesseModel->getListacommesse();
        $data['commesse'] = $commesse; 

        $data['richieste'] = $item; 
        $data['stati'] = $stati;


        if ( $this->request->getMethod() == 'post' ){
            $prodotto_richiesto = $this->request->getPost('prodotto_richiesto');
            $destinatario = $this->request->getPost('destinatario');
            $sede = $this->request->getPost('sede');
            $commessa = $this->request->getPost('commessa');
            $effettuata_da = $this->request->getPost('effettuata_da');
            $stati = $this->request->getPost('stati');
            $ricerca = $modelRichieste->ricercaRichiesta($prodotto_richiesto,$destinatario,$sede,$commessa,$effettuata_da,$stati);  

            $data['showTable'] = true; 

            $data['richieste'] = $ricerca; 
        }
        else{

            $data['showTable'] = true; 

        }

        echo view('templates/headers/assegnaItem_header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('richiesteItem/visualizzaRichieste',$data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');
    }


    public function cambioStatoRichiesta(){
        $modelRichieste = new RichiesteItemModel(); 
        
        

        $stato_richiesta = $this->request->getPost('stato_richiesta'); 
        $richiesta_item_id = $this->request->getPost('richiesta_item_id'); 
        $session_user_id = session()->get('id');

        $avanzamento = $modelRichieste->cambiaStatoRichiestaITEM($stato_richiesta,$richiesta_item_id,$session_user_id); 

    }


    public function getStatoRichiesta(){
        $modelRichieste = new RichiesteItemModel(); 
        $stati = $modelRichieste->getStati(); 
        return $stati;
        // return json_encode($stati);
    }

    public function timelineRichiesta($richiesta_item_id){
        $modelRichieste = new RichiesteItemModel(); 
        $timeline = $modelRichieste->timeline($richiesta_item_id);
        return json_encode($timeline);
    }

    public function verificaDisponibilita($richiesta_item_id,$quantita){
        $modelRichieste = new RichiesteItemModel(); 
        $verificaDisponibilita = $modelRichieste->verificaDisponibilita($richiesta_item_id,$quantita);
        if ( is_bool($verificaDisponibilita) ){
            return "disponibile"; //disponibile
        }
        else{
            return $verificaDisponibilita; //non disponibile
        }
        //return json_encode($timeline);
    }

    

}