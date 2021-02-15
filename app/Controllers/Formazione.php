<?php

namespace App\Controllers;

use App\Models\AffidamentoModel;
use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\MagazzinoModel;
use App\Models\FornitoriModel;
use App\Models\UserModel;
use App\Models\FormazioneModel; 
//use App\Models\RisorseModel;
use App\Libraries\RoleUser;

class Formazione extends BaseController{
    protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	} 


    public function inserisciAttestato(){
        //$session = \Config\Services::session();
        $formazioneModel = new FormazioneModel(); 
        $attestati_presenti = $formazioneModel->getAllAttestati(); 
            
        if ( $this->request->getMethod() == 'post' ){
            $descrizione = $this->request->getPost('descrizione'); 
            $durata_in_mesi = $this->request->getPost('durata_in_mesi'); 
            $esito = $formazioneModel->inserisciAttestato(mb_strtoupper ($descrizione),$durata_in_mesi);           
            
            if ($esito) {
                session()->setFlashdata('inserimento_avvenuto', 'Inserimento avvenuto');
            } else {
                session()->setFlashdata('errore_inserimento', 'Attenzione, risulta già presente questo attestato <b>'.$descrizione.'</b>');
            }
            
            return redirect()->to('inserisciAttestato');
        }

        $data['attestati_presenti'] = $attestati_presenti; 

        echo view('templates/headers/assegnaItem_header');
        // echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data); 
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('formazione/inserisciAttestato',$data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');
        
    }

    public function getCountAttestatiFormazione(){
        $formazioneModel = new FormazioneModel();

        $attestati_formazione = $formazioneModel->getCountAttestatiFormazione();
    }

    public function dettaglioAttestato($id){

        $formazioneModel = new FormazioneModel();
        $attestato = $formazioneModel->getAttestato($id);  
        $data['attestato'] = $attestato;

        if ( $this->request->getMethod() == 'post' ){
            
            $descrizione = $this->request->getPost('descrizione'); 
            $durata_in_mesi = $this->request->getPost('durata_in_mesi'); 
            $visibile = $this->request->getPost('visibile'); 

            $modifica_attestato = $formazioneModel->modificaAttestato(strtolower(trim($descrizione)),trim($durata_in_mesi),trim($visibile),trim($id));
            
            if (is_bool($modifica_attestato)) {
                
                $key = "modifica_attestato";
                $messaggio = "Spostamento della risorsa è stata notificata";
            } else {
                $key = "errore_modifica";
                $messaggio = $modifica_attestato;
            }
            echo $key; 
            
            return redirect()->back()->with($key, $messaggio);

        }

        echo view('templates/headers/assegnaItem_header');
        // echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data); 
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('formazione/dettaglioAttestato',$data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');
    }


    public function ottieniListaAttestati($anagrafica_id){
        $formazioneModel = new FormazioneModel(); 
        $listaAttestati = $formazioneModel->getListaAttestatiInPossessoDipendente($anagrafica_id);
        echo json_encode($listaAttestati); 
    }

    public function ottieniListaAttestatiNonAncoraDisponibile($anagrafica_id){
        $formazioneModel = new FormazioneModel(); 
        $listaAttestatiDisponibili = $formazioneModel->getListaAttestatiNonInPossesso($anagrafica_id); 
        echo json_encode($listaAttestatiDisponibili); 
    }

    public function ottieniInformazioniAttestato($attestato_id){
        $formazioneModel = new FormazioneModel(); 
        $info = $formazioneModel->ottieniInformazioniAttestato($attestato_id); 
        echo $info[0]['durata_mesi'];
    }

    public function aggiornaAttestatiOperatore(){
        $formazioneModel = new FormazioneModel(); 

        $valoriAttestati_validi = $this->request->getPost('valoriAttestati_validi');
        $valoriAttestati_non_validi = $this->request->getPost('valoriAttestati_non_validi');
        $anagrafica_id = $this->request->getPost('anagrafica_id');

        $aggiornaAttestati = $formazioneModel->aggiornaAttestatiOperatore(trim($valoriAttestati_validi),trim($valoriAttestati_non_validi),trim($anagrafica_id)); 

        if ( $aggiornaAttestati ){
            echo "1"; 
        }

    }

    public function attribuisciAttestatoRisorsa(){

        $formazioneModel = new FormazioneModel(); 

        $attestato_disponibile_id = $this->request->getPost('attestato_disponibile_id'); 
        $data_inizio = $this->request->getPost('data_inizio'); 
        $data_fine = $this->request->getPost('data_fine'); 
        $anagrafica_id = $this->request->getPost('anagrafica_id'); 

        $esito_inserimento = $formazioneModel->attribuisciAttestatoRisorsa(trim($attestato_disponibile_id),trim($data_inizio),trim($data_fine),trim($anagrafica_id)); 

        echo $esito_inserimento->connID->insert_id;

        //echo "1";
    }

    public function uploadAllegato(){
        //$info = $this->request->getPost($formData);

        $anagrafica_id = $this->request->getPost("anagrafica_id");
        $attestato_id = $this->request->getPost("attestato_id");
        $allegato = $this->request->getFile("allegato");

        $formazioneModel = new FormazioneModel(); 
        $ottieniInformazioniAttestato = $formazioneModel->ottieniInformazioniAttestato($attestato_id); 

        $nome_attestato = $ottieniInformazioniAttestato[0]['descrizione']; 

        $nome_attestato=$this->clean($nome_attestato);
       // $nome_attestato=str_replace(" ","_",$nome_attestato); 
       /* $nome_attestato = str_replace("\\","_",$nome_attestato); 
        $nome_attestato = str_replace("*","_",$nome_attestato); 
        $nome_attestato = str_replace("/","_",$nome_attestato);
        $nome_attestato = str_replace("&","_",$nome_attestato);
        $nome_attestato = str_replace("%","_",$nome_attestato);
        $nome_attestato = str_replace("£","_",$nome_attestato);*/    

        $path = "upload/attestati_formazione/".$anagrafica_id;

        if ( !file_exists($path) ){
            mkdir($path);
        }
        $fileName = "attestato_".$nome_attestato.".pdf";
        if ( !file_exists($path."/".$fileName) ){
            $allegato->move($path,$fileName);            
        }
        else{
            rename($path."/".$fileName,$path."/".$fileName."_".date('Ymd').".pdf");
            $allegato->move($path,$fileName);
        }

        $esito_modifica_allegato = $formazioneModel->uploadAttestato($attestato_id,$anagrafica_id);

    }


    public function verificaDocumentiPerOperatore($anagrafica_id){
        $formazioneModel = new FormazioneModel(); 
        $attestati_in_possesso = $formazioneModel->getListaAttestatiInPossessoDipendente($anagrafica_id); 

        return json_encode($attestati_in_possesso); 
    }


    public function ricercaAttestati(){
        $formazioneModel = new FormazioneModel(); 
        $userModel = new UserModel(); 
        $commessaModel = new CommesseModel(); 

        $elencoRisorse = $userModel->getListaAnagrafica('');
        $data['elencoRisorse'] = $elencoRisorse;

        $elencoCommesse = $commessaModel->getListacommesse(); 
        $data['elencoCommesse'] = $elencoCommesse; 

        $elencoAttestati = $formazioneModel->getAllAttestati(); 
        $data['elencoAttestati'] = $elencoAttestati; 

        $elencoMansioni = $userModel->getAllMansioni(); 
        $data['elencoMansioni'] = $elencoMansioni; 

        if ( $this->request->getMethod() == 'post' ){
            $nominativo_id = $this->request->getPost('anagrafica_id');
            $commessa_id = $this->request->getPost('commessa_id'); 
            $in_forza_fino_al = $this->request->getPost('data_fine_contratto'); 
            $tipologia_certificato_id = $this->request->getPost('tipologia_attestato_id');
            $id_mansione = $this->request->getPost('id_mansione');
            $contratto = $this->request->getPost('contratto');

            $ricercaAttestati = $formazioneModel->ricercaAttestati(trim($nominativo_id),trim($commessa_id),trim($in_forza_fino_al),trim($tipologia_certificato_id),trim($id_mansione),trim($contratto));

            $data['showTable'] = true; 
            $data['ricercaAttestati'] = $ricercaAttestati; 

        }else{

            $data['showTable'] = false; 

        }



        echo view('templates/headers/assegnaItem_header');
        // echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data); 
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('formazione/ricercaAttestati',$data);
		else
			echo view('accesso_negato');
			
		echo view('templates/footers/assegnaItem_footer');

    }
    

    function clean($string) {

        $string = str_replace(' ', '_', $string); 
        $string = str_replace('\\', '_', $string); 
        $string = str_replace('/', '_', $string);
        $string = str_replace('$', '_', $string);
        $string = str_replace('?', '_', $string);
        $string = str_replace('=', '_', $string);
        $string = str_replace('&', '_', $string);
        $string = str_replace('%', '_', $string);      
        $string = str_replace('\'', '_', $string);
        $string = str_replace('\"', '_', $string);
        $string = str_replace('^', '_', $string);             
     
        return $string; 
     }


}