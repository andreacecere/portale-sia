<?php

namespace App\Controllers;

use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\UserModel;
use App\Models\FormazioneModel;
use App\Libraries\RoleUser;
use App\Models\AutomezziModel; 


class Dashboard extends BaseController
{
	protected $role_user,$uri; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}

	public function index()
	{
	
		$articoliModel = new ArticoloModel(); 
		$userModel = new UserModel(); 
		$commesseModel = new CommesseModel(); 
		$formazioneModel = new FormazioneModel(); 
		$automezzi = new AutomezziModel(); 

		$cntTerminaliLiberi = $articoliModel->getCountITEM("palmare","disponibile"); 
		$cntSimLiberi = $articoliModel->getCountITEM("sim","disponibile"); 
		$cntTerminaliAffidati = $articoliModel->getCountITEM("palmare","affidato"); 
		$cntSimLiberiAffidati = $articoliModel->getCountITEM("sim","affidato"); 

		$risorse = $userModel->getCountRisorse(); 
		$commesse = $commesseModel->getCountCommesse(); 
		$documenti_da_caricare = $userModel->getCountDocumentiDaCaricare(); 
		$documenti_caricati = $userModel->getCountDocumentiCaricati(); 
		$attestati_formazione = $formazioneModel->getCountAttestatiFormazione(); 
		$attestatiInScadenza = $formazioneModel->attestatiInScadenza(); 

	
		$data['cntTerminaliLiberi'] = $cntTerminaliLiberi;
		$data['cntSimLiberi'] = $cntSimLiberi; 
		$data['cntTerminaliAffidati'] = $cntTerminaliAffidati;
		$data['cntSimLiberiAffidati'] = $cntSimLiberiAffidati;
		$data['risorse'] = $risorse;
		$data['commesse'] = $commesse; 
		$data['documenti_da_caricare'] = $documenti_da_caricare;
		$data['documenti_caricati'] = $documenti_caricati;
		$data['attestati_formazione'] = $attestati_formazione; 
		$data['attestatiInScadenza'] = $attestatiInScadenza;

		$schede_carburanti = $automezzi->mostraCostiTotaliPerSchedaCarburante(); 
		$totale_schede_carburanti = $automezzi->contaSchedeCarburanti(); 
		$data['schede_carburanti'] = $schede_carburanti;
		$data['totale_schede_carburanti'] = $totale_schede_carburanti;


		//TODO: fare la tabella dei max consumi per scheda carb

		

		echo view('templates/headers/assegnaItem_header');
		$this->role_user->sidebar_ruoli($data); 
		
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione ){
			if (session()->get('ruolo_dsc') == "addetto_gestione_automezzi")
				echo view('dashboard_automezzi',$data);
			elseif(session()->get('ruolo_dsc') == "addetto_alla_formazione" )
				echo view('dashboard_formazione',$data);
			else
				echo view('dashboard',$data);
		}
		else
			echo view('accesso_negato');

		echo view('templates/footers/footer');
		
		
	}

}
