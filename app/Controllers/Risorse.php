<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\AffidamentoModel;
use App\Libraries\RoleUser;

class Risorse extends BaseController
{

	protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}

	public function elencoRisorse()
	{
		$userModel = new UserModel();
		$articoloModel = new ArticoloModel();

		if ($this->request->getMethod() == 'post') {
			$data['elencoRisorse'] = $userModel->getListaAnagrafica($this->request->getVar('input_anagrafica_id'));
		} else {
			$elencoRisorse = $userModel->getListaAnagrafica('');
			$data['elencoRisorse'] = $elencoRisorse;
		}

		echo view('templates/headers/assegnaItem_header');
	
		$this->role_user->sidebar_ruoli($data);
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('risorse/elencoRisorse', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
	}
	


	public function spostaRisorsa($nominativo = null){
		helper(['form']);
		$model = new ArticoloModel();
		$userModel = new UserModel();
		$commessaModel = new CommesseModel();

		if ( !empty($nominativo) ){
			$nominativo = str_replace("%20"," ",$nominativo); 
			$data['nominativo'] = $nominativo;
		}

		$elencoRisorse = $userModel->getListaAnagrafica('');
		$data['elencoRisorse'] = $elencoRisorse;

		$listaCommesse = $commessaModel->getListaCommesse();
		$data['listaCommesse'] = $listaCommesse;

		if ($this->request->getMethod() == 'post') {

			$formSubmit = $this->request->getPost('submitForm');
			
			$data_servizio_input = $this->request->getPost('data_servizio_input');
			$data['data_servizio_input'] = $data_servizio_input;

			switch ($formSubmit) {
				case "formItem":
					$elencoAffidi = $model->getListaAffidi($this->request->getPost('risorsa'), 'A', 1);
					$data['elencoAffidi'] = $elencoAffidi;
					$showTable = true;
					$data['showTable'] = $showTable;
					break;
				case "formConferma":

					$tipologia_spostamento = $this->request->getPost('tipologia_spostamento');
					$risorsa_id = $this->request->getPost('risorsa'); 
					$commessa_attuale = $this->request->getPost('commessa_attuale');
					$commessa_attuale_id = $this->request->getPost('commessa_attuale_id');
					$sede_attuale = $this->request->getPost('sede_attuale');
					$sede_attuale_id = $this->request->getPost('sede_attuale_id');
					$commessa_destinazione = $this->request->getPost('commessa_destinazione');
					$sede_di_destinazione = $this->request->getPost('sede_di_destinazione');
					$sede_di_destinazione_id = $this->request->getPost('sede_di_destinazione_id');
					$data_presunta_presa_in_carico = $this->request->getPost('data_presunta_presa_in_carico');
					
					$responsabile_attuale = $this->request->getPost('responsabile_attuale');
					$responsabile_attuale_id = $this->request->getPost('responsabile_attuale_id');

					$responsabile_attuale_commessa_destinazione = $this->request->getPost('responsabile_attuale_commessa_destinazione');
					$responsabile_attuale_commessa_destinazione_id = $this->request->getPost('responsabile_attuale_commessa_destinazione_id');

					$elencoAffidi = $model->getListaAffidi($risorsa_id, 'A', 1);
					$data['elencoAffidi'] = $elencoAffidi;
					$showTable = true;
					$data['showTable'] = $showTable;
					$infoArray = array();

					$infoArray = [
						'fk_utente_id' => session()->get('id'),
						'fk_anagrafica_id' => $risorsa_id,
						'commessa_attuale' => $commessa_attuale_id, 
						'magazzino_attuale' => $sede_attuale_id,
						'commessa_destinazione' => $commessa_destinazione, 
						'magazzino_destinazione' => $sede_di_destinazione_id,
						'data_servizio_input' => $data_presunta_presa_in_carico,
						'riferimento_commessa_output' => $responsabile_attuale_commessa_destinazione_id,
						'responsabile_attuale_id' => $responsabile_attuale_id,
						'tipologia_spostamento' => $tipologia_spostamento

					];


					foreach ($_POST as $key => $value) {
						if ( is_int($key) ){
							if ($value == "on")
								$action = $key.";sposta";
							else
								$action = $key.";resta";
								array_push($infoArray,$action);
							}
					}
					

					$esito = $model->richiestaSpostamento($infoArray);
					if (is_bool($esito)) {
						$key = "sposamento_avvenuto";
						$messaggio = "Spostamento della risorsa è stata notificata";
					} else {
						$key = "errore_spostamento";
						$messaggio = $esito;
					}

					return redirect()->back()->with($key, $messaggio);

				break;	
			}
		}
		
		if ($this->request->getMethod() == 'get') {
			$data['elencoAffidi'] = [];
			$showTable = false;
			$data['showTable'] = $showTable;
		}

		echo view('templates/headers/assegnaItem_header');
		//echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data);
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('risorse/spostaRisorsa', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');
	}


	public function effettuaSpostamento(){
		
	}

	public function infoRisorsa($risorsa_selezionata){
		$userModel = new UserModel(); 
		$infoRisorsa = $userModel->getInfoRisorsa(trim($risorsa_selezionata)); 
		return json_encode($infoRisorsa);
	}
	public function infoCommessaDestinazione($commessa_destinazione_id){
		$userModel = new UserModel(); 
		$infoCommessa = $userModel->infoCommessaDestinazione(trim($commessa_destinazione_id)); 
		return json_encode($infoCommessa);
	}


	public function spostaRisorsa_old($nominativo = null)
	{
		 
		$model = new ArticoloModel();
		$userModel = new UserModel();
		$commessaModel = new CommesseModel();

		helper(['form']);

		if ( !empty($nominativo) ){
			$nominativo = str_replace("%20"," ",$nominativo); 
			$data['nominativo'] = $nominativo;
			//echo "Nominativo: ".$nominativo;
		}


		$elencoRisorse = $userModel->getListaAnagrafica('');
		$data['elencoRisorse'] = $elencoRisorse;

		$listaCommesse = $commessaModel->getListaCommesse();
		$data['listaCommesse'] = $listaCommesse;

		if ($this->request->getMethod() == 'post') {

			$formSubmit = $this->request->getPost('submitForm');
			
			$data_servizio_input = $this->request->getPost('data_servizio_input');
			$data['data_servizio_input'] = $data_servizio_input;

			switch ($formSubmit) {
				case "formItem":
					$elencoAffidi = $model->getListaAffidi($this->request->getPost('risorsa'), 'A', 1);
					$data['elencoAffidi'] = $elencoAffidi;
					$showTable = true;
					$data['showTable'] = $showTable;
					break;
				case "formConferma":
					//echo $this->request->getPost('risorsa');
					$elencoAffidi = $model->getListaAffidi($this->request->getPost('risorsa'), 'A', 1);
					$data['elencoAffidi'] = $elencoAffidi;
					$showTable = true;
					$data['showTable'] = $showTable;
					$infoArray = array();

					$sede_attuale_id = $model->getMagazzino($this->request->getPost('sede_input'));
					$commessa_attuale_id = $model->getCommessa($this->request->getPost('commessa_input'));
					$commessa_destinazione_id = $this->request->getPost('commessa_destinazione_input');
					$sede_destinazione_id = $model->getMagazzino($this->request->getPost('sede_new_commessa_input'));
					
					//print_r($sede_destinazione_id);

					$infoArray = [

						'fk_utente_id' => session()->get('id'),
						'fk_anagrafica_id' => $this->request->getPost('anagrafica_input'),
						'commessa_attuale' => $commessa_attuale_id[0]['commessa_id'],
						'magazzino_attuale' => $sede_attuale_id[0]['magazzino_id'],
						'commessa_destinazione' => $commessa_destinazione_id,
						'magazzino_destinazione' => $sede_destinazione_id[0]['magazzino_id'],
						'data_servizio_input' => $this->request->getPost('data_servizio_input'),
						'riferimento_commessa_output' => $this->request->getPost('riferimento_commessa_output')
					];



					foreach ($_POST as $key => $value) {
						if ( is_int($key) ){
							if ($value == "on")
								$action = $key.";sposta";
							else
								$action = $key.";resta";
								array_push($infoArray,$action);
							}
					}
					
					$esito = $model->richiestaSpostamento($infoArray);
					if (is_bool($esito)) {
						$key = "sposamento_avvenuto";
						$messaggio = "Spostamento della risorsa è stata notificata";
					} else {
						$key = "errore_spostamento";
						$messaggio = $esito;
					}
					
					return redirect()->back()->with($key, $messaggio);
				break;	
			}
		}

		if ($this->request->getMethod() == 'get') {
			$data['elencoAffidi'] = [];
			$showTable = false;
			$data['showTable'] = $showTable;
		}

		echo view('templates/headers/assegnaItem_header');
		//echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data);
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('risorse/spostaRisorsa_old', $data);
		else
			echo view('accesso_negato');
		
		
		echo view('templates/footers/assegnaItem_footer');
	}
}
