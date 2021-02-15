<?php 

namespace App\Libraries;
class RoleUser{

	private $nome_view;
	private $ruolo;  
	private $view; 


    public function sidebar_ruoli($data){
		if ( session()->get('ruolo_dsc') == "admin" || session()->get('ruolo_dsc') == "sa" ){
			$this->nome_view = "sidebar"; 
		}
		elseif ( session()->get('ruolo_dsc') == "coordinatore" ){
			$this->nome_view = "sidebar_coordinatore"; 			
		}
		elseif ( session()->get('ruolo_dsc') == "addetto_alla_formazione" ){
			$this->nome_view = "sidebar_addetto_alla_formazione"; 
		}
		elseif ( session()->get('ruolo_dsc') == "addetto_gestione_automezzi" ){
			$this->nome_view = "sidebar_addetto_gestione_automezzi";
		}
		echo view('templates/sidebar/'.$this->nome_view,$data);
	}

	public function mostra_view($nome_url,$ruolo){
		//echo "URL: ".$nome_url;
		$this->view = [
			
			"dashboard" => "admin;sa;coordinatore;addetto_alla_formazione;addetto_gestione_automezzi",
			//ITEM
			"cercaArticolo" => "admin;sa;coordinatore",
			"elencoAffidi" => "admin;sa;coordinatore",
			"assegnaArticolo" => "admin;sa;coordinatore",
			"documenti" => "admin;sa;coordinatore",
			"consumiCarburante" => "admin;sa;coordinatore;addetto_gestione_automezzi",
			//END ITEM
			//RICHIESTE
			"nuovaRichiesta" => "admin;sa;coordinatore",
			"visualizzaRichieste" => "admin;sa;coordinatore",
			//END RICHIESTE
			//FORMAZIONE
			"ricercaAttestati" => "admin;sa;addetto_alla_formazione", 
			"inserisciAttestato" => "admin;sa;addetto_alla_formazione",
			"dettaglioAttestato" => "admin;sa;addetto_alla_formazione",
			//END FORMAZIONE
			//RISORSE
			"elencoRisorse" => "admin;sa;coordinatore;addetto_alla_formazione",
			"spostaRisorsa" => "admin;sa;coordinatore",
			"controllRichieste" => "admin;sa;coordinatore",
			//END RISORSE
			//SETTINGS
			"wizard" => "admin;sa", 
			"inserisciItem" => "admin;sa",
			"gestioneItem" => "admin;sa",
			"gestioneCondizioni" => "admin;sa",
			"gestioneStati" => "admin;sa",
			"gestioneUtenti" => "admin;sa",
			"gestioneCommesse" => "admin;sa",
			"gestioneFornitori" => "admin;sa",
			"gestioneSedi" => "admin;sa",
			//END SETTINGS
			//AUTOMEZZI
			"ricercaAutomezzi" => "sa;admin;addetto_gestione_automezzi",
			"importaConsumi" => "sa;admin;addetto_gestione_automezzi",
			"dettaglioConsumiCarburante" => "sa;admin;addetto_gestione_automezzi;coordinatore",
			//END AUTOMEZZI
			"dettaglioUtente" => "admin;sa",
			"dettaglioArticolo" => "admin;sa;coordinatore", 
			"modificaArticolo" => "admin;sa;coordinatore",
			"affidaArticolo" => "admin;sa;coordinatore",
			"dettaglioDocumento" => "admin;sa;coordinatore",
			"dettaglioAffidi" => "admin;sa;coordinatore",
			"controlloRichieste" => "admin;sa;coordinatore",
			"dettaglioFornitore" => "admin;sa;coordinatore",
			"dettaglioSede" => "admin;sa;coordinatore",
			"dettaglioCondizione" => "admin;sa;coordinatore",
			"aggiungiFornitore" => "admin;sa;coordinatore",
			"aggiungiCategoria" => "admin;sa;coordinatore",
			"aggiungiItem" => "admin;sa;coordinatore",
			"aggiungiCondizione" => "admin;sa;coordinatore",
			"aggiungiStato" => "admin;sa;coordinatore",
			"dettaglioItem" => "admin;sa;coordinatore",
			"aggiungiAttributo" => "admin;sa;coordinatore",
			"aggiungiUtente" => "admin;sa;coordinatore",
			"dettaglioCommessa" => "admin;sa",
			"aggiungiSede" => "admin;sa",
			"aggiungiCommessa" => "admin;sa"

		];
		
		if ( strpos($this->view[$nome_url],$ruolo) !== false ){
			return true; 
		}
		else{
			return false; 
		}
	}
}

