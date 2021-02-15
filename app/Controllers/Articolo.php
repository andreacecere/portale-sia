<?php

namespace App\Controllers;

use App\Models\AffidamentoModel;
use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\MagazzinoModel;
use App\Models\FornitoriModel;
use App\Models\UserModel;
use App\Libraries\RoleUser;

class Articolo extends BaseController
{
	protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}

	public function assegnaArticolo2()
	{
		$data = [];
		helper(['form']);
		$model = new ArticoloModel();

		$listaTipoProdotti = $model->getTipoArticoli();
		$data['listaTipoProdotti'] = $listaTipoProdotti;

		if ($this->request->getMethod() == 'get') {
			$data['listaProdotti'] = [];
			$showTable = false;
			$data['showTable'] = $showTable;
		} else {
			$idTipoArticolo = $this->request->getVar('tipo_articolo');
			$seriale = $this->request->getVar('input_seriale_articolo');



			$listaProdotti = $model->getArticolo($idTipoArticolo, $seriale, null);
			$data['listaProdotti'] = $listaProdotti;

			$showTable = true;
			$data['showTable'] = $showTable;
		}

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		echo view('item/assegnaArticolo', $data);
		echo view('templates/footers/footer');
	}

	public function assegnaArticolo()
	{
		$data = [];
		helper(['form']);
		$model = new ArticoloModel();

		$listaTipoProdotti = $model->getTipoArticoli();
		$data['listaTipoProdotti'] = $listaTipoProdotti;

		if ($this->request->getMethod() == 'get') {
			$data['listaProdotti'] = [];
			$showTable = false;
			$data['showTable'] = $showTable;
		} else {
			$idTipoArticolo = $this->request->getVar('tipo_articolo');
			$seriale = $this->request->getVar('input_seriale_articolo');

			if (empty($idTipoArticolo) && empty($seriale)) {
				$data['listaProdotti'] = [];
				$showTable = false;
				$data['showTable'] = $showTable;
				session()->setFlashdata('error', 'Attenzione inserire almeno un parametro');
			} else {
				session()->remove('error');
				$listaProdotti = $model->getArticolo($idTipoArticolo, $seriale, null);
				$data['listaProdotti'] = $listaProdotti;

				$showTable = true;
				$data['showTable'] = $showTable;
			}
		}

		echo view('templates/headers/assegnaItem_header');
		//echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/assegnaArticolo', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
	}


	public function cercaArticolo()
	{
		$data = [];
		helper(['form']);
		$model = new ArticoloModel();
		$commessaModel = new CommesseModel();
		$magazzinoModel = new MagazzinoModel();
		$fornitoriModel = new FornitoriModel();

		if ( $this->request->getMethod() == 'post' ){
			$seriale = $this->request->getPost('seriale_input');
			$tipoArticolo = $this->request->getPost('tipo_articolo');
			$statoArticolo = $this->request->getPost('stato_articolo');
			$condizioneArticolo = $this->request->getPost('condizione_input');
			$commessa = $this->request->getPost('commessa_input');
			$sede = $this->request->getPost('sede_input');

			$ricercaMateriale = $model->ricercaMateriale($seriale,$tipoArticolo,$statoArticolo,$condizioneArticolo,$commessa,$sede);
			

			$data['showTable'] = true; 
			$data['ricerca'] = $ricercaMateriale; 
		}
		else{
			$data['showTable'] = false; 
		}

		
		$listaTipoProdotti = $model->getTipoArticoli();
		$data['listaTipoProdotti'] = $listaTipoProdotti;

		$listaProdotti = $model->getListaArticoli(null);
		$listaStatoProdotti = $model->getStatoArticoli();
		$listaCondizioni = $model->getCondizioneArticoli();
		$listaCommesse = $commessaModel->getListaCommesse();
		$listaMagazzini = $magazzinoModel->getSedi();
		$listaFornitori = $fornitoriModel->getFornitoriRicerca('');

		$data['listaTipoProdotti'] = $listaTipoProdotti;
		$data['listaProdotti'] = $listaProdotti;
		$data['listaStatoProdotti'] = $listaStatoProdotti;
		$data['listaCondizioni'] = $listaCondizioni;
		$data['listaCommesse'] = $listaCommesse;
		$data['listaMagazzini'] = $listaMagazzini;
		$data['listaFornitori'] = $listaFornitori;

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 

		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/cercaArticolo', $data);		
		else
			echo view('accesso_negato');

		echo view('templates/footers/assegnaItem_footer');
		
	}

	public function dettaglioArticolo($idArticolo)
	{
	
		$model = new ArticoloModel();
		$articolo = $model->getArticolo(null, null, $idArticolo);

		if (count($articolo) == 0){
			
			$articolo = $model->getArticoloAffidato(null, null, $idArticolo);
		}

		$data['articolo'] = $articolo;
		$listaTipoProdotti = $model->getTipoArticoli();
		$data['listaTipoProdotti'] = $listaTipoProdotti;
		$data['articoloID'] = $idArticolo; 

		$storico_movimento = $model->storico_movimenti($idArticolo); 

		$data['storicoMovimentiDocumenti'] = $storico_movimento; 

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/dettaglioArticolo', $data);
		else
			echo view('accesso_negato');
		echo view('templates/footers/assegnaItem_footer');
	}

	public function dettaglioAffidi($nominativo){
		$model = new ArticoloModel();
		$userModel = new UserModel();
		$nominativo = str_replace("%20"," ",$nominativo);
		$elencoRisorse = $userModel->getListaAnagrafica($nominativo);
		$elencoAffidi = $model->getListaAffidi($nominativo, 'A', 1);
		$data['elencoAffidi'] = $elencoAffidi;
		
		$showTable = true;
		$data['showTable'] = $showTable;
		
		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('risorse/dettaglioAffidi', $data);
		else
			echo view('accesso_negato');
		echo view('templates/footers/assegnaItem_footer');

	}

	public function elencoAffidi()
	{
		$model = new ArticoloModel();
		$userModel = new UserModel();

		$elencoRisorse = $userModel->getListaAnagrafica('');
		$data['elencoRisorse'] = $elencoRisorse;

		if ($this->request->getMethod() == 'post') {
			$elencoAffidi = $model->getListaAffidi($this->request->getPost('input_anagrafica_id'), 'A', 1);
			$data['elencoAffidi'] = $elencoAffidi;
			$showTable = true;
			$data['showTable'] = $showTable;
		} else {
			$data['elencoAffidi'] = [];
			$showTable = false;
			$data['showTable'] = $showTable;
		}

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('risorse/elencoAffidi', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');
	}

	public function affidaArticolo_old($idArticolo)
	{
		$model = new ArticoloModel();
		$userModel = new UserModel();
		$articoloModel = new ArticoloModel();

		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'risorsa' => 'required',
			];

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$seriale = ($this->request->getPost('articolo_seriale'));
				$articolo = $model->getArticolo(null, $seriale, null);
				$articoloId = $articolo[0]['articolo_id'];

				$data = [
					'fk_utente_assegnatario_id' => session()->get('id'),
					'fk_anagrafica_destinatario_id' => $this->request->getPost('risorsa'),
					'fk_articolo_id' => $articoloId,
					'fk_commessa_id' => $this->request->getPost('fk_commessa_input'),
					'fk_magazzino_provenienza_id' => $articolo[0]['fk_magazzino_id'],
					'fk_magazzino_destinazione_id' => $this->request->getPost('fk_sede_input'),
					'affidamento_tipo' => 'A',
					'affidamento_note' => $this->request->getPost('note_input'),
					'fk_condizione_id' => $this->request->getPost('fk_condizione_id')
				];
				$data2 = [
					'articolo_id' => $articoloId,
					'ultimo_affido_anagrafica' => $this->request->getPost('risorsa_nominativo'),
					'ultimo_affido_commessa' => $this->request->getPost('commessa_input'),
					'ultimo_affido_user' => session()->get('username'),
					'ultimo_affido_data' => date("Y/m/d h:i:s"),
					'fk_stato_articolo_id' => '1',
					'ultimo_affido_magazzino' => $this->request->getPost('sede_input')
				];

				$affidamentoModel = new AffidamentoModel();

				$affidamentoModel->save($data);
				$articoloModel->save($data2);

				
				session()->setFlashdata('success', 'Affidamento completato');
			}
		}

		$data['articolo'] = [];
		$articolo = $model->getArticoloAffidato(null, null, $idArticolo);
		$risorse = $userModel->getListaAnagrafica('');

		$data['articolo'] = $articolo;
		$data['elencoRisorse'] = $risorse;

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		echo view('item/affidaArticolo', $data);
		echo view('templates/footers/footer');
	}

	public function getResponsabile($fk_commessa_id){

		$model = new ArticoloModel();
		$fk_responsabile = $model->getResponsabile($fk_commessa_id);
		if ( !empty($fk_responsabile) ){
			$data['responsabile_id'] = $fk_responsabile[0]['responsabile_id']; 
			$data['nominativo_responsabile'] = $fk_responsabile[0]['nominativo_responsabile']; 
		}
		else{
			$data['responsabile_id'] = 0; 
			$data['nominativo_responsabile'] = ""; 
		}

		return json_encode($data); 
	}

	public function affidaArticolo($idArticolo)
	{
		$model = new ArticoloModel();
		$userModel = new UserModel();
		$articoloModel = new ArticoloModel();

		

		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'risorsa' => 'required',
			];

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$seriale = ($this->request->getPost('articolo_seriale'));
				$articolo = $model->getArticolo(null, $seriale, null);
				$articoloId = $articolo[0]['articolo_id'];
				$id_stato_articolo_affidato = $model->getIDStatoAffidato(); 

				$data = [
					'fk_utente_assegnatario_id' => session()->get('id'),
					'fk_anagrafica_destinatario_id' => $this->request->getPost('risorsa'),
					'fk_articolo_id' => $articoloId,
					'fk_commessa_id' => $this->request->getPost('fk_commessa_input'),
					'fk_magazzino_provenienza_id' => $articolo[0]['fk_magazzino_id'],
					'fk_magazzino_destinazione_id' => $this->request->getPost('fk_sede_input'),
					'affidamento_tipo' => 'A',
					'affidamento_note' => $this->request->getPost('note_input'),
					'fk_condizione_id' => $this->request->getPost('fk_condizione_id'),
					'fk_anagrafica_responsabile' => $this->request->getPost('responsabile_input_id'),
					'anagrafica_responsabile_descrizione' => $this->request->getPost('responsabile_input_dsc'),
				];
				$data2 = [
					'articolo_id' => $articoloId,
					'ultimo_affido_anagrafica' => $this->request->getPost('risorsa_nominativo'),
					'ultimo_affido_commessa' => $this->request->getPost('commessa_input'),
					'ultimo_affido_user' => session()->get('username'),
					'ultimo_affido_data' => date("Y/m/d h:i:s"),
					'fk_stato_articolo_id' => $id_stato_articolo_affidato[0]['stato_articolo_id'],//'1',
					'ultimo_affido_magazzino' => $this->request->getPost('sede_input')
				];

				$affidamentoModel = new AffidamentoModel();

				$affidamentoModel->save($data);
				$articoloModel->save($data2);

				
				session()->setFlashdata('success', 'Affidamento completato');
				$articolo = $model->getArticoloAffidato(null, null, $articoloId);
				$data['articolo'] = $articolo;	
				$data['pdfIDAffido'] = $affidamentoModel->getInsertID(); 			
				

			}
		}

		if ($this->request->getMethod() == 'get') {
			$articolo = $model->getArticolo(null, null, $idArticolo);
			$data['articolo'] = $articolo;
		}

		
		$risorse = $userModel->getListaAnagrafica('');
		$data['elencoRisorse'] = $risorse;

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/affidaArticolo', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
	}


	
	public function disaffidaArticolo($idArticolo)
	{
		$model = new ArticoloModel();
		$userModel = new UserModel();
		$articoloModel = new ArticoloModel();
		$affidamentoModel = new AffidamentoModel();

		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			$affidamentoId = ($this->request->getPost('affidamento_id'));
			$affidamento = $model->getUltimoAffido(null, null, 'A', $affidamentoId);
			$data = [
				'fk_utente_assegnatario_id' => session()->get('id'),
				'fk_anagrafica_destinatario_id' => $affidamento[0]['fk_anagrafica_destinatario_id'],
				'fk_articolo_id' => $affidamento[0]['articolo_id'],
				'fk_commessa_id' =>  $affidamento[0]['fk_commessa_id'],
				'fk_magazzino_provenienza_id' => $affidamento[0]['fk_magazzino_provenienza_id'],
				'fk_magazzino_destinazione_id' => $affidamento[0]['fk_magazzino_destinazione_id'],
				'affidamento_tipo' => 'D',
				'affidamento_note' => $this->request->getPost('note_input'),
				'fk_condizione_id' => $this->request->getPost('condizione_articolo'),
				'anagrafica_responsabile_descrizione' => $this->request->getPost('responsabile_descrizione')

			];
			$data2 = [
				'articolo_id' => $affidamento[0]['articolo_id'],
				'ultimo_affido_anagrafica' => null,
				'ultimo_affido_commessa' => null,
				'ultimo_affido_user' => null,
				'ultimo_affido_data' => null,
				'fk_stato_articolo_id' => '2', // stato 
				'fk_condizione_id' => $this->request->getPost('condizione_articolo'),
				'ultimo_affido_magazzino' => null
			];
			$affidamentoModel = new AffidamentoModel();

			$affidamentoModel->save($data);
			$articoloModel->save($data2);
			$affidamentoModel->aggiornatoAttivo($affidamentoId, 0);

			$listaCondizioniArticolo = $model->getCondizioni($affidamento[0]['fk_tipologia_articolo_id']);
			$data['listaCondizioniArticolo'] = $listaCondizioniArticolo;

			$articolo = $model->getUltimoAffido($affidamento[0]['articolo_id'], null, 'D', null);
			$data['articolo'] = $articolo;
			$data['pdfIDAffido'] = $affidamentoModel->getInsertID(); 

			session()->setFlashdata('success', 'Disaffido completato');
		}

		if ($this->request->getMethod() == 'get') {
			$articolo = $model->getUltimoAffido($idArticolo, null, 'A', null);
			$data['articolo'] = $articolo;
			$listaCondizioniArticolo = $model->getCondizioni($articolo[0]['fk_tipologia_articolo_id']);
			$data['listaCondizioniArticolo'] = $listaCondizioniArticolo;
		}

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/disaffidaArticolo', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
	}

	public function getInfoDipendente()
	{
		if ($this->request->getMethod() == 'post') {
			$userModel = new UserModel();
			$risorse = $userModel->getListaAnagrafica($this->request->getVar('anagrafica_id'));
			echo json_encode($risorse);
		}
	}

	public function getInfoDipendente2($anagrafica_id)
	{
		$userModel = new UserModel();
		$risorse = $userModel->getListaAnagrafica($anagrafica_id);
		echo json_encode($risorse);

	}

	public function getInfoCommessa()
	{
		if ($this->request->getMethod() == 'post') {
			$commessaModel = new CommesseModel();
			$commesse = $commessaModel->getInfoCommessa($this->request->getVar('commessa_id'));
			echo json_encode($commesse);
		}
	}

	public function modificaArticolo2($idArticolo)
	{
		$model = new ArticoloModel();
		$articolo = $model->getArticolo(null, null, $idArticolo);

		$listaTipoProdotti = $model->getTipoArticoli();
		$data['listaTipoProdotti'] = $listaTipoProdotti;

		$listaCondizioniArticolo = $model->getCondizioni($articolo[0]['fk_tipologia_articolo_id']);
		$data['listaCondizioniArticolo'] = $listaCondizioniArticolo;

		$fornitoriModel = new FornitoriModel();
		$listaFornitoriArticolo = $fornitoriModel->getFornitoriRicerca('');
		$data['listaFornitoriArticolo'] = $listaFornitoriArticolo;

		$data['articolo'] = $articolo;

		session()->remove('success');

		if ($this->request->getMethod() == 'post') {
			$dataToUpdate = [
				'articolo_id' => $this->request->getPost('articolo_id'),
				'fk_tipologia_articolo_id' => $this->request->getPost('tipo_articolo'),
				'fk_fornitore_id' => $this->request->getPost('fornitore_articolo'),
				'fk_condizione_id' => $this->request->getPost('condizione_articolo'),
				'note' => $this->request->getPost('note'),
			];

			$model->save($dataToUpdate);
			session()->setFlashdata('success', 'Articolo aggiornato');
			$articolo = $model->getArticolo(null, null, $this->request->getPost('articolo_id'));
			$data['articolo'] = $articolo;
		}

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/modificaArticolo', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
	}


	public function modificaArticolo($idArticolo)
	{
		$articoloModel = new ArticoloModel();

		if ($this->request->getMethod() == 'get') {
			
			$articolo = $articoloModel->getArticolo(null, null, $idArticolo);

			if (count($articolo) == 0)
				$articolo = $articoloModel->getArticoloAffidato(null, null, $idArticolo);


			$listaTipoProdotti = $articoloModel->getTipoArticoli();
			$data['listaTipoProdotti'] = $listaTipoProdotti;

			$listaCondizioniArticolo = $articoloModel->getCondizioni($articolo[0]['fk_tipologia_articolo_id']);
			$data['listaCondizioniArticolo'] = $listaCondizioniArticolo;

			$fornitoriModel = new FornitoriModel();
			$listaFornitoriArticolo = $fornitoriModel->getFornitori();
			$data['listaFornitoriArticolo'] = $listaFornitoriArticolo;

			$data['articolo'] = $articolo;
		}

		if ($this->request->getMethod() == 'post') {
			$dataToUpdate = [
				'articolo_id' => $this->request->getPost('articolo_id'),
				'fk_tipologia_articolo_id' => $this->request->getPost('tipo_articolo'),
				'fk_fornitore_id' => $this->request->getPost('fornitore_articolo'),
				'fk_condizione_id' => $this->request->getPost('condizione_articolo'),
				'note' => $this->request->getPost('note_articolo'),
			];

			$articoloModel->save($dataToUpdate);


			session()->setFlashdata('success', 'Item aggiornato');
			return redirect()->to('/modificaArticolo/' . $idArticolo);
		}

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/modificaArticolo', $data);
		else
			echo view('accesso_negato');
		// echo view('item/modificaArticolo', $data);
		echo view('templates/footers/footer');
	}


	public function getCondizioniJson()
	{
		if ($this->request->getMethod() == 'post') {
			$articoloModel = new ArticoloModel();
			$elencoCondizioni = $articoloModel->getCondizioni($this->request->getVar('tipo_articolo'));
			//echo json_encode($elencoCondizioni);
			$response['elencoCondizioni'] = array();
			$response['elencoCondizioni'] = $elencoCondizioni;
			echo json_encode($response);
		}
	}

	public function getFornitoriJson()
	{
		if ($this->request->getMethod() == 'post') {

			$fornitoriModel = new FornitoriModel();
			$listaFornitoriArticolo = $fornitoriModel->getFornitoriRicerca($this->request->getVar('tipo_articolo'));

			$response['listaFornitoriArticolo'] = array();
			$response['listaFornitoriArticolo'] = $listaFornitoriArticolo;

			echo json_encode($response);
		}
	}

	// public function consumiCarburante()
	// {
	// 	$data = [];
	// 	helper(['form']);
	// 	$model = new ArticoloModel();

	// 	$listaTipoProdotti = $model->getTipoArticoli();
	// 	$data['listaTipoProdotti'] = $listaTipoProdotti;

	// 	if ($this->request->getMethod() == 'get') {
	// 		$userModel = new UserModel();
	// 		$elencoRisorse = $userModel->getListaAnagrafica('');
	// 		$data['elencoRisorse'] = $elencoRisorse;

	// 		$schedeCarburanti = $model->getSchedaCarburante();
	// 		$data['schedeCarburanti'] = $schedeCarburanti;

	// 		$data['listaProdotti'] = [];
	// 		$showTable = false;
	// 		$data['showTable'] = $showTable;
	// 	}


	// 	if ($this->request->getMethod() == 'post') {
	// 		$userModel = new UserModel();
	// 		$elencoRisorse = $userModel->getListaAnagrafica('');
	// 		$data['elencoRisorse'] = $elencoRisorse;
	// 		$schedeCarburanti = $model->getSchedaCarburante();
	// 		$data['schedeCarburanti'] = $schedeCarburanti;
			
	// 		$scheda_carburante = $this->request->getPost('scheda_carburante'); 
	// 		$id_nominativo_risorsa = $this->request->getPost('risorsa2'); 
	// 		$mese = $this->request->getPost("mese");
	// 		$anno = $this->request->getPost("anno");

	// 		$elencoAffidi = $model->getSchedeCarburanti($scheda_carburante,$id_nominativo_risorsa,$mese,$anno); 
	// 		$data['elencoAffidi'] = $elencoAffidi;

	// 		$showTable = true;
	// 		$data['showTable'] = $showTable;
	// 	}

	// 	echo view('templates/headers/assegnaItem_header');
	// 	// echo view('templates/sidebar/sidebar');
	// 	$this->role_user->sidebar_ruoli($data); 
	// 	$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
	// 	if ( $permesso_visualizzazione )
	// 		echo view('item/consumiCarburante', $data);
	// 	else
	// 		echo view('accesso_negato');
		
	// 	echo view('templates/footers/footer');
	// }


	public function ottieniAttributiAssociatiITEM($idArticolo){
		$model = new ArticoloModel();
		$articolo = $model->getAttributiItem($idArticolo);
		
		for($i=0; $i<count($articolo); $i++){
			echo $articolo[$i]['descrizione']." ";
		}
	}

	public function inserisciItem()
	{
		
		 
		$model = new ArticoloModel();
		$magazzinoModel = new MagazzinoModel();
		$fornitoriModel = new FornitoriModel();

		$sediMagazzino = $magazzinoModel->getSedi();
		$fornitori = $fornitoriModel->getFornitori();

		$articoli = $model->getTipoArticoli();
		$listaCondizioni = $model->getCondizioneArticoli();
		$listaStatoProdotti = $model->getStatoArticoli();

		

		$data['nomePagina'] = "Inserisci Item";
		$data['headerCard'] = "Inserisci Item";
		$data['articoli'] = $articoli;
		$data['sediMagazzino'] = $sediMagazzino;
		$data['fornitori'] = $fornitori;
		$data['condizioni'] = $listaCondizioni;
		$data['stato'] = $listaStatoProdotti;
		
		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('item/inserimento/inserisciItem', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');

		
	}

	public function doInserisciItem()
	{

		if ($this->request->getMethod() == 'post') {

			$model = new ArticoloModel();

			$tipo_articolo = $this->request->getPost("tipo_articolo");
			$magazzino = $this->request->getPost("magazzino");
			$fornitore = $this->request->getPost("fornitore");
			$condizione = $this->request->getPost("condizione");
			$seriale = $this->request->getPost('seriale');
			$note = $this->request->getPost('note');
			$fk_utente_creazione_id = session()->get('id');
			$arrayDati = $this->request->getPost('arrayDati');
			$stato = $this->request->getPost('stato');

			$attributi = array('attributi' => $arrayDati);

			$attributi = stripslashes(json_encode($attributi));
			$attributi1 = substr($attributi, 0, 13);
			$attributi2 = substr($attributi, 14, -2);
			$attributiFinali = $attributi1 . $attributi2 . "}";

			$aggiungiItem = $model->insertItem($tipo_articolo, $magazzino, $fornitore, $condizione, $stato, $seriale, $note, $fk_utente_creazione_id, $attributiFinali);
			if (is_bool($aggiungiItem)) {
				$key = "inserimento_item";
				$messaggio = "Inserimento item avvenuta";
			} else {
				$key = "errore_inserimento_item";
				$messaggio = $aggiungiItem;
			}
			return $messaggio;


		}
	}

	public function ottieniAttributiAssociati()
	{
		$arrayInfo = array();
		$arrayDati = array();
		$dati = array();
		if ($this->request->getMethod() == 'post') {
			$model = new ArticoloModel();
			$tipologia_articolo_id = $this->request->getPost('tipologia_articolo_id');
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
			// echo "<pre>";
			// print_r($arrayInfo);
			// echo "</pre>";
			return json_encode($arrayInfo);
		}
	}


	public function test(){
		$arrayInfo = array();
		$arrayDati = array();
		$dati = array();
		
			$model = new ArticoloModel();
			$tipologia_articolo_id = $this->request->getPost('tipologia_articolo_id');
			$attributiItem = $model->getAttributiItem(1);
			
			for ($i = 0; $i < count($attributiItem); $i++) {
				
				$getAttributiItemSingolo = $model->getAttributiItemSingolo($attributiItem[$i]['attributo_id']);
				print_r($getAttributiItemSingolo);
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
			 echo "<pre>";
			 print_r($arrayInfo);
			 echo "</pre>";
			
		
	}


	public function testInfo($id_utente,$anagrafica_id,$commessa_id_selezionata){
		$model = new UserModel();
		$test = $model->getResponsabileCommessa($id_utente,$anagrafica_id,$commessa_id_selezionata); 
		print_r($test);
	}
}
