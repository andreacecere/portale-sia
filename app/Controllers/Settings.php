<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\CommesseModel;
use App\Models\AziendeModel;
use App\Models\FornitoriModel;
use App\Models\ArticoloModel;
use App\Models\MagazzinoModel;
use App\Libraries\RoleUser;

class Settings extends BaseController
{

    private $userModel;
    private $commesseModel;
    private $aziendeModel;
    private $fornitoriModel;
    private $articoloModel;
    private $magazzinoModel; 
    private $session;
    protected $role_user; 

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
        $this->commesseModel = new CommesseModel();
        $this->aziendeModel = new AziendeModel();
        $this->fornitoriModel = new FornitoriModel();
        $this->articoloModel = new ArticoloModel();
        $this->magazzinoModel = new MagazzinoModel();

        $this->role_user = new RoleUser(); 

        helper(['form', 'text']);
    }

    public function indexUtenti()
    {

        $utenti = $this->userModel->getUsers();
        $data["nomePagina"] = "Gestione utenti";
        $data['utenti'] = $utenti;
        $data['headerCard'] = "Lista utenti attivi";

        echo view('templates/headers/header');
        $this->role_user->sidebar_ruoli($data);
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('settings/utenti/dashboard', $data);
		else
			echo view('accesso_negato');
        echo view('templates/footers/footer');
    }

    public function dettaglioUtente($id)
    {

        $utente_id = $id;
        $utenti = $this->userModel->getDettaglioUser($utente_id);
        
        $ruoli = $this->userModel->getRuoli();
        $commesse = $this->commesseModel->getCommesse();
        $aziende = $this->aziendeModel->getAziende();

        $data['utente'] = $utenti;
        $data['ruoli'] = $ruoli;
        $data['commessa'] = $commesse;
        $data['aziende'] = $aziende;


        if ($this->request->getMethod() == 'post') {
            $password = $this->request->getVar("password");
            $stato = $this->request->getVar("stato");
            $nome = $this->request->getVar("nome");
            $cognome = $this->request->getVar("cognome");
            $azienda = $this->request->getVar("azienda");
            $commessa = $this->request->getVar("commessa");
            $email = $this->request->getVar("email");
            $ruolo = $this->request->getVar("ruolo");

            $esito = $this->userModel->modificaUtente($utente_id, strtolower($password), $stato, strtolower($nome), strtolower($cognome), strtolower($azienda), strtolower($commessa), strtolower($email), $ruolo);
            if (is_bool($esito)) {
                $key = "aggiorna_utente";
                $messaggio = "Inserimento avvenuto";
            } else {
                $key = "errore_aggiorna_utente";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/header');
        
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('settings/utenti/dettaglioUtente', $data);
		else
			echo view('accesso_negato');
        echo view('templates/footers/footer');
    }

    public function dettaglioAnagraficaUtente()
    {
        if ($this->request->getMethod() == 'post') {
            $utente_id = $this->request->getVar('utente_id');
            $dettaglioUtente = $this->userModel->getAnagrafica($utente_id);
            echo json_encode($dettaglioUtente);
        }
    }


    public function aggiungiUtente()
    {

        $utenti = $this->userModel->getAnagrafica("");
        $commesse = $this->commesseModel->getCommesse();
        $ruoli = $this->userModel->getRuoli();
        $data['utenti'] = $utenti;
        $data['commesse'] = $commesse;
        $data['ruoli'] = $ruoli;

        if ($this->request->getMethod() == 'post') {


            $anagrafica_id = $this->request->getVar("anagrafica_id");
            $ruolo = $this->request->getVar("ruolo");
            $commessa = $this->request->getVar("commessa");
            $nome = trim(strip_slashes($this->request->getVar('nome')));
            $cognome = trim(strip_slashes($this->request->getVar('cognome')));
            $password = $this->request->getVar("password");
            $username = $nome . "." . $cognome;


            $esito = $this->userModel->insertAnagraficaUtente($anagrafica_id, $username, $commessa, $ruolo, $password);
            if (is_bool($esito)) {
                $key = "inserimento_utente";
                $messaggio = "Inserimento avvenuto";
            } else {
                $key = "errore_inserimento_utente";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/assegnaItem_header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('settings/utenti/aggiungiUtente', $data);
		else
			echo view('accesso_negato');
        
        echo view('templates/footers/assegnaItem_footer');
    }


    public function aggiungiUtente_nonpresente()
    {

        $commesse = $this->commesseModel->getCommesse();
        $data['commesse'] = $commesse;

        if ($this->request->getMethod() == 'post') {
            $nome = trim(strip_slashes($this->request->getVar('nome')));
            $cognome = trim(strip_slashes($this->request->getVar('cognome')));
            $codice_fiscale = trim($this->request->getVar('codice_fiscale'));
            $indirizzo = trim($this->request->getVar('indirizzo'));
            $localita = trim($this->request->getVar('localita'));
            $telefono = trim($this->request->getVar('telefono'));
            $email = trim($this->request->getVar('email'));
            $attivo = $this->request->getVar('attivo');
            $commesse = $this->request->getVar('commesse');

            $inserisciAnagraficaUtente = $this->userModel->insertAnagraficaUtente($nome, $cognome, $codice_fiscale, $indirizzo, $localita, $telefono, $email, $attivo, $commesse);
            if (is_bool($inserisciAnagraficaUtente))
                $this->session->setFlashdata("success", "Inserimento avvenuto");
            else
                $this->session->setFlashdata("errore", $inserisciAnagraficaUtente);
        }

        echo view('templates/headers/header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('settings/utenti/aggiungiUtente', $data);
		else
			echo view('accesso_negato');       
        echo view('templates/footers/footer');
    }

    /* Sezione: Commesse  */

    public function indexCommesse()
    {

        $commesse = $this->commesseModel->getCommesse();
        $data["nomePagina"] = "Gestione commesse";
        $data['commesse'] = $commesse;
        $data['headerCard'] = "Lista commesse";

        echo view('templates/headers/header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/commesse/dashboard', $data);
        else
            echo view('accesso_negato'); 
        
        echo view('templates/footers/footer');
    }

    public function aggiungiCommessa()
    {

        $aziende = $this->aziendeModel->getAziende();
        $data['aziende'] = $aziende;


        if ($this->request->getMethod() == 'post') {

            $nome_commessa = $this->request->getVar('nome_commessa');
            $settore = $this->request->getVar('settore');
            $azienda = $this->request->getVar('azienda');

            $esito = $this->commesseModel->aggiungiNuovaCommessa($nome_commessa, $settore, $azienda);
            if (is_bool($esito)) {
                $key = "inserimento_commessa";
                $messaggio = "Inserimento commessa avvenuta";
            } else {
                $key = "errore_inserimento_commessa";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }
        echo view('templates/headers/header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/commesse/aggiungiCommesse', $data);
        else
            echo view('accesso_negato'); 
        echo view('templates/footers/footer');
    }

    public function testMagazzino($id,$id1){
        $magazzino = $this->commesseModel->testMagazzino($id,$id1); 
    }

    public function dettaglioCommessa($id)
    {

        $commessa_id = $id;
        $commesse = $this->commesseModel->getDettaglioCommessa($commessa_id);
        $settoriCommessa = $this->commesseModel->getSettori();
        $aziende = $this->aziendeModel->getAziende();
        $responsabili = $this->userModel->getResponsabiliCommessa(); 
        $magazzino = $this->magazzinoModel->getSedi();
        //print_r($commesse); 

        $data['commessa'] = $commesse;
        $data['settori'] = $settoriCommessa;
        $data['aziende'] = $aziende;
        $data['responsabile'] = $responsabili; 
        $data['magazzino'] = $magazzino;

        if ($this->request->getMethod() == 'post') {

            

            $nome_commessa = $this->request->getVar('nome_commessa');
            $settore = $this->request->getVar('settore');
            $azienda = $this->request->getVar('azienda');
            $responsabile = $this->request->getVar('responsabile'); 
            $magazzino_sede = $this->request->getPost('magazzino_sede'); 
            
            $esito = $this->commesseModel->aggiornaCommessa($nome_commessa, $settore, $azienda, $commessa_id,$responsabile,$magazzino_sede);
            if (is_bool($esito)) {
                $key = "inserimento_commessa";
                $messaggio = "Inserimento commessa avvenuta";
            } else {
                $key = "errore_inserimento_commessa";
                $messaggio = $esito;
            }
            //print_r($esito);
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/assegnaItem_header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/commesse/dettaglioCommessa', $data);
        else
            echo view('accesso_negato'); 
        echo view('templates/footers/assegnaItem_footer');
    }

    /* Sezione: Fornitori  */

    public function indexFornitori()
    {

        $fornitori = $this->fornitoriModel->getFornitori();
        $data["nomePagina"] = "Gestione fornitori";
        $data['fornitori'] = $fornitori;
        $data['headerCard'] = "Lista fornitori";

        echo view('templates/headers/header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/fornitori/dashboard', $data);
        else
            echo view('accesso_negato'); 
        echo view('templates/footers/footer');
    }

    public function aggiungiFornitore()
    {

        

        $getTipologiaFornitori = $this->fornitoriModel->getTipologiaFornitori(); 

        if ($this->request->getMethod() == 'post') {

            $ragione_sociale = $this->request->getVar('ragione_sociale');
            $partita_iva = $this->request->getVar('partita_iva');
            $codice_fiscale = $this->request->getVar('codice_fiscale');
            $indirizzo = $this->request->getVar('indirizzo');
            $localita = $this->request->getVar('localita');
            $telefono = $this->request->getVar('telefono');
            $email = $this->request->getVar('email');
            $pec = $this->request->getVar('pec');
            $tipologia_id = $this->request->getPost('tipologia');


            $esito = $this->fornitoriModel->aggiungiNuovoFornitore($ragione_sociale, $partita_iva, $codice_fiscale, $indirizzo, $localita, $telefono, $email, $pec,$tipologia_id);

            if (is_bool($esito)) {
                $key = "inserimento_fornitore";
                $messaggio = "Inserimento commessa avvenuta";
            } else {
                $key = "errore_inserimento_fornitore";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }



        echo view('templates/headers/assegnaItem_header');
        $data['tipologia'] = $getTipologiaFornitori;

        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/fornitori/aggiungiFornitore', $data);
        else
            echo view('accesso_negato'); 
        echo view('templates/footers/assegnaItem_footer');
    }

    public function dettaglioFornitore($id)
    {

        $fornitore_id = $id;
        $fornitore = $this->fornitoriModel->getDettaglioFornitore($fornitore_id);
        $getTipologiaFornitori = $this->fornitoriModel->getTipologiaFornitori(); 

        if ($this->request->getMethod() == 'post') {

            $ragione_sociale = $this->request->getVar('ragione_sociale');
            $partita_iva = $this->request->getVar('partita_iva');
            $codice_fiscale = $this->request->getVar('codice_fiscale');
            $indirizzo = $this->request->getVar('indirizzo');
            $localita = $this->request->getVar('localita');
            $telefono = $this->request->getVar('telefono');
            $email = $this->request->getVar('email');
            $pec = $this->request->getVar('pec');
            $tipologia = $this->request->getPost('tipologia');


            $esito = $this->fornitoriModel->aggiornaFornitore($ragione_sociale, $partita_iva, $codice_fiscale, $indirizzo, $localita, $telefono, $email, $pec, $fornitore_id,$tipologia);

            if (is_bool($esito)) {
                $key = "modifica_fornitore";
                $messaggio = "Modifica fornitore avvenuta";
            } else {
                $key = "errore_modifica_fornitore";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }


        $data['fornitore'] = $fornitore;
        $data['tipologia'] = $getTipologiaFornitori;
        echo view('templates/headers/assegnaItem_header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/fornitori/dettaglioFornitore', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }


    /* Sezione: Item */

    public function indexItem()
    {

        $articoli = $this->articoloModel->getTipologiaArticoliPresenti();
        $data["nomePagina"] = "Gestione item";
        $data['articoli'] = $articoli;
        $data['headerCard'] = "Lista item";

        echo view('templates/headers/header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/item/dashboard', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/footer');
    }

    public function dettaglioItem($id)
    {

        $dettaglio_id = $id;
        $attributi = $this->articoloModel->getAttributiItem($dettaglio_id);
        if ($this->request->getMethod() == 'post') {

            $nome_attributo = $this->request->getVar('nome_attributo');
            $esito = $this->articoloModel->inserisciAttributi($dettaglio_id, $nome_attributo);

            if (is_bool($esito)) {
                $key = "inserimento_attributo";
                $messaggio = "Insermento avvenuto";
            } else {
                $key = "errore_inserimento_attributo";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }
        

        $data['attributi'] = $attributi;
        echo view('templates/headers/header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/item/dettaglioItem', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/footer');
    }

    public function aggiungiAttributo($idAttributo){
        $attributi = $this->articoloModel->getAttributiItemSingolo($idAttributo);
        $attributo = $this->articoloModel->getAttributo($idAttributo);
        $data['attributiPresenti'] = $attributi; 
        $data['attributo'] = $attributo;
        $data['idAttributo'] = $attributo[0]['fk_tipologia_articolo_id']; 
        //print_r($data);

        if ( $this->request->getMethod() == 'post' ){
            $valore = $this->request->getVar('valore');
            $esito = $this->articoloModel->inserisciAttributiValore($idAttributo,$valore);

            if (is_bool($esito)) {
                $key = "inserimento_attributo_valore";
                $messaggio = "Insermento avvenuto";
            } else {
                $key = "errore_inserimento_valore";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/item/aggiungiAttributo',$data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/footer');
    }

    public function aggiungiItem()
    {
        
        $categorieFoglie = $this->articoloModel->prodottiFoglie();
        $data['categorieFoglie'] = $categorieFoglie;

        if ($this->request->getMethod() == 'post') {

            $nome_item = $this->request->getVar('nome_item');
            $categoria = $this->request->getVar('categoria');

            $esito = $this->articoloModel->aggiungiNuovoArticolo($nome_item, $categoria);

            if ( is_numeric($esito)){
                $key = "inserimento_item";
                $messaggio = "Inserimento item avvenuta";
                return redirect()->to('dettaglioItem/'.$esito);
            }
            if ( is_bool($esito) ){
                $key = "errore_inserimento_item";
                $messaggio = $esito;
                return redirect()->back()->with($key, $messaggio);
            }
        }

        echo view('templates/headers/assegnaItem_header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/item/aggiungiItem', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }

    public function aggiungiItemWizard(){
        
        if ($this->request->getMethod() == 'get') {
            $nome_item = $this->request->getGet("nome_item"); 
            $categoria = $this->request->getGet("categoria"); 
            
            $insertID = $this->articoloModel->aggiungiNuovoArticolo($nome_item, $categoria);
            echo $insertID; 
            
        }
    }

    public function inserisciAttributiWizard($fk_tipologia_id,$nome_attributo){
        $insertID = $this->articoloModel->inserisciAttributiWizard($fk_tipologia_id, $nome_attributo);
        echo $insertID;
    }

    public function inserisciAttributiValoreWizard($fk_attributo_id,$nome_attributo){
        $insertID = $this->articoloModel->inserisciAttributiValoreWizard($fk_attributo_id, $nome_attributo);
        echo $insertID;
    }

    public function aggiungiCategoria()
    {

        $categorieFoglie = $this->articoloModel->prodottiFoglie();
        $getAllCategorie = $this->articoloModel->getAllCategorie();
        //$getNodoPadre = $this->articoloModel->getNodoPadre();
        //$albero = $this->articoloModel->albero();
        //$test = $this->articoloModel->test();

        $data['categorieFoglie'] = $categorieFoglie;
        $data['allCategorie'] = $getAllCategorie;
        //$data['nodoPadre'] = $getNodoPadre;
        //$data['albero'] = $albero;
        //$data['test'] = $test;

        if ($this->request->getMethod() == 'post') {

            $tipoFunzione = $this->request->getVar('tipoFunzione'); //1->Aggiungo una nuova categoria; 2->Associo ad una categoria
            $nome_categoria = $this->request->getVar('nome_categoria');
            $categoria = $this->request->getVar('categoria');

            $esito = $this->articoloModel->aggiungiNuovoCategoria($tipoFunzione, $nome_categoria, $categoria);

            if (is_bool($esito)) {
                $key = "inserimento_categoria";
                $messaggio = "Inserimento categoria avvenuta";
            } else {
                $key = "errore_inserimento_categoria";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/assegnaItem_header');
        //echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/item/aggiungiCategoria', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }

    public function albero(){
        //$categoria = $this->request->getVar("categoria");
        //$struttura = $this->articoloModel->albero($categoria);
        $struttura = $this->articoloModel->albero();
        echo $struttura;
        //echo json_encode($struttura);
    }


    /* SEDI_MAGAZZINO */

    public function indexSedi(){
        $magazzino = $this->magazzinoModel->getSedi();
        $data["nomePagina"] = "Gestione Sedi";
        $data['sedi'] = $magazzino;
        $data['headerCard'] = "Lista sedi";

        echo view('templates/headers/assegnaItem_header');
        
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/sedi/dashboard', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/footer');
    }

    public function dettaglioSede($id)
    {

        $dettaglio_id = $id;
        $sede = $this->magazzinoModel->getDettaglioSede($dettaglio_id);
        $getListaAnagrafica = $this->userModel->getListaAnagrafica(""); 

        if ($this->request->getMethod() == 'post') {

            
        
            $sede_magazzino = $this->request->getVar('sede_magazzino');
            $indirizzo_magazzino = $this->request->getVar('indirizzo_magazzino');
            $cap_magazzino = $this->request->getVar('cap_magazzino');
            $localita_magazzino = $this->request->getVar('localita_magazzino');
            $frazione_magazzino = $this->request->getVar('frazione_magazzino');
            $telefono_magazzino = $this->request->getVar('telefono_magazzino');
            $email_magazzino = $this->request->getVar('email_magazzino');
            $magazziniere = $this->request->getVar('magazziniere');
            $telefono_magazziniere = $this->request->getVar('telefono_magazziniere');

            //print_r($_REQUEST);
        
        
            $esito = $this->magazzinoModel->aggiornaInformazioniMagazzino($dettaglio_id, $sede_magazzino,$indirizzo_magazzino,$cap_magazzino,$localita_magazzino,$frazione_magazzino,$telefono_magazzino,$email_magazzino,$magazziniere,$telefono_magazziniere);

            if (is_bool($esito)) {
                $key = "aggiornamento_sede";
                $messaggio = "Aggiornamento avvenuto";
            } else {
                $key = "errore_aggiornamento_sede";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }


        $data['attributi'] = $sede;
        $data['listaAnagrafica'] = $getListaAnagrafica; 
        echo view('templates/headers/assegnaItem_header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/sedi/dettaglioSede', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }

    public function aggiungiSede()
    {

        $data = []; 

        if ($this->request->getMethod() == 'post') {

            $sede_magazzino = $this->request->getVar('sede_magazzino');
            $indirizzo_magazzino = $this->request->getVar('indirizzo_magazzino');
            $cap_magazzino = $this->request->getVar('cap_magazzino');
            $localita_magazzino = $this->request->getVar('localita_magazzino');
            $frazione_magazzino = $this->request->getVar('frazione_magazzino');
            $telefono_magazzino = $this->request->getVar('telefono_magazzino');
            $email_magazzino = $this->request->getVar('email_magazzino');

            $esito = $this->magazzinoModel->aggiungiNuovaSede($sede_magazzino, $indirizzo_magazzino, $cap_magazzino,$localita_magazzino,$frazione_magazzino,$telefono_magazzino,$email_magazzino);

            if (is_bool($esito)) {
                $key = "inserimento_sede";
                $messaggio = "Inserimento sede avvenuta";
            } else {
                $key = "errore_inserimento_sede";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/assegnaItem_header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/sedi/aggiungiSede', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }

    /* CONDIZIONI */

    public function indexCondizioni(){
        $articolo = $this->articoloModel->getCondizioni("");
        $data["nomePagina"] = "Gestione Condizioni";
        $data['articolo'] = $articolo;
        $data['headerCard'] = "Lista condizioni";

        echo view('templates/headers/header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/condizioni/dashboard', $data);
        else
            echo view('accesso_negato');
        
        echo view('templates/footers/footer');
    }

    public function aggiungiCondizione()
    {

        $data = []; 
        $tipologiaArticolo = $this->articoloModel->getTipologiaArticoliPresenti(); 
        $data['tipologiaArticolo'] = $tipologiaArticolo; 
        if ($this->request->getMethod() == 'post') {

            $condizione = $this->request->getVar('condizione');
            $articolo = $this->request->getVar('articolo');

            $esito = $this->articoloModel->aggiungiCondizioneDispositivo($condizione, $articolo);

            if (is_bool($esito)) {
                $key = "inserimento_condizione";
                $messaggio = "Inserimento condizione avvenuta";
            } else {
                $key = "errore_inserimento_condizione";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/assegnaItem_header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/condizioni/aggiungiCondizione', $data);
        else
            echo view('accesso_negato');
        
        echo view('templates/footers/assegnaItem_footer');
    }

    public function aggiungiCondizioneDispositivoWizard($fk_tipologia_articolo_id,$fk_condizione_id){
        $esito = $this->articoloModel->aggiungiCondizioneDispositivoWizard($fk_tipologia_articolo_id, $fk_condizione_id);
    }

    public function controllaEsistenzaITEM($nomeITEM){
        $esito = $this->articoloModel->controllaEsistenzaITEM($nomeITEM); 
        if ( !$esito )
            echo "errore";
         
    }

    public function dettaglioCondizione($id)
    {

        $dettaglio_id = $id;
        $sede = $this->articoloModel->getDettaglioArticolo($dettaglio_id);
        $articoli = $this->articoloModel->getCondizioneArticoli($id = null ); 
        
        if ($this->request->getMethod() == 'post') {

            $articolo = $this->request->getVar("articolo"); 
            $condizione = $this->request->getVar("condizione");
            
            $esito = $this->articoloModel->aggiornaInformazioniCondizione($dettaglio_id,$articolo,$condizione);

            if (is_bool($esito)) {
                $key = "aggiornamento_condizione";
                $messaggio = "Aggiornamento avvenuto";
            } else {
                $key = "errore_aggiornamento_condizione";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }


        $data['attributi'] = $sede;
        $data['articoli'] = $articoli;
        echo view('templates/headers/assegnaItem_header');
        
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/condizioni/dettaglioCondizione', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }

    /* STATI */

    public function indexStati(){
        $articolo = $this->articoloModel->getStatoArticoli();
        $data["nomePagina"] = "Gestione Stati";
        $data['stato'] = $articolo;
        $data['headerCard'] = "Lista Stati";

        echo view('templates/headers/header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/stati/dashboard', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/footer');
    }

    public function aggiungiStato()
    {

        $data = []; 
        $tipologiaArticolo = $this->articoloModel->getTipologiaArticoliPresenti(); 
        $data['tipologiaArticolo'] = $tipologiaArticolo; 
        if ($this->request->getMethod() == 'post') {

            $nuovo_stato = $this->request->getVar("nuovo_stato");

            $esito = $this->articoloModel->aggiungiNuovoStato($nuovo_stato);

            if (is_bool($esito)) {
                $key = "inserimento_stato";
                $messaggio = "Inserimento stato avvenuto";
            } else {
                $key = "errore_inserimento_stato";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }

        echo view('templates/headers/assegnaItem_header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/stati/aggiungiStato', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }

    public function dettaglioStato($id)
    {

        $dettaglio_id = $id;
        $stato = $this->articoloModel->getDettaglioStato($dettaglio_id);
        
        if ($this->request->getMethod() == 'post') {

            $nuovo_stato = $this->request->getVar("nuovo_stato"); 
            
            $esito = $this->articoloModel->aggiornaInformazioniStato($dettaglio_id,$nuovo_stato);
            // echo $esito; 
            //print_r($_REQUEST);

            if (is_bool($esito)) {
                $key = "aggiornamento_stato";
                $messaggio = "Aggiornamento avvenuto";
            } else {
                $key = "errore_aggiornamento_stato";
                $messaggio = $esito;
            }
            return redirect()->back()->with($key, $messaggio);
        }


        $data['attributi'] = $stato;
        
        echo view('templates/headers/assegnaItem_header');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/stati/dettaglioStati', $data);
        else
            echo view('accesso_negato');
        echo view('templates/footers/assegnaItem_footer');
    }


    public function wizard(){

        

        $categorieFoglie = $this->articoloModel->prodottiFoglie();
        $data['categorieFoglie'] = $categorieFoglie;
        $articoloCondizioni = $this->articoloModel->getCondizioneArticoli();
        $data['condizioni'] = $articoloCondizioni; 
        if ( count($categorieFoglie) == 0 ){
            return redirect()->to('aggiungiCategoria');
        }

        echo view('templates/headers/assegnaItem_header');
        
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
        if ( $permesso_visualizzazione )
            echo view('settings/item/wizard',$data);
        else
            echo view('accesso_negato');
        
        
        echo view('templates/footers/assegnaItem_footer');
        
    }


}
