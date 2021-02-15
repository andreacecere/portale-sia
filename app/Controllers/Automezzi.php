<?php

namespace App\Controllers;

use App\Models\AffidamentoModel;
use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\MagazzinoModel;
use App\Models\FornitoriModel;
use App\Models\UserModel;
use App\Libraries\RoleUser;
use App\Models\AutomezziModel; 

class Automezzi extends BaseController
{
    protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}

    public function ricercaAutomezzi(){

        $data = []; 

        if ( $this->request->getMethod() == 'post' ){


        }

        $data['showTable'] = false; 
        echo view('templates/headers/assegnaItem_header');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('automezzi/ricercaAutomezzi', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');

    }

    public function importaConsumi(){

		$fornitori = new FornitoriModel();
		$fornitori_carb = $fornitori->getTipologiaFornitori("carburante");
		// print_r($fornitori_carb);
		
        $data['fornitori_carb'] = $fornitori_carb; 

        echo view('templates/headers/assegnaItem_header');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('automezzi/importaConsumi', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');

	}
	
	public function caricaFileConsumi(){

		$importa_consumi = new AutomezziModel(); 
		

		$file = $this->request->getFile('file');
		$fornitore = $this->request->getPost('fonitore');
		$nome_file = $file->getName();
		$path = "upload/consumi_carburante/";
		$file->move($path, $nome_file);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		$spreadsheet = $reader->load($path.$nome_file);
		$data = $spreadsheet->getActiveSheet()->toArray();
		//print_r($data);
		$fk_fornitore_id = $fornitore;
		foreach($data as $row){
			if ( strpos($row[0],"Codice SAP") === false){
				$codice_sap = strtoupper(trim($row[0]));
				$numero_carta = strtoupper(trim($row[1]));
				$cliente = strtoupper(trim($row[2]));
				$targa = strtoupper(trim($row[3]));
				$numero_fattura = strtoupper(trim($row[4]));
				$data_fattura = strtoupper(trim($row[5]));
				$compagnia_fornitrice = strtoupper(trim($row[6]));
				$localita_punto_vendita = strtoupper(trim($row[9]));
				$tipo_transazione = strtoupper(trim($row[10]));
				$scontrino = strtoupper(trim($row[11]));
				$dt_transazione = strtoupper(trim($row[12]));
				$ora_transazione = strtoupper(trim($row[13]));
				$data_ora_transazione = date('Y-m-d H:i:s',strtotime($dt_transazione." ".$ora_transazione));
				$prodotto = strtoupper(trim($row[14]));
				$volume = strtoupper(trim($row[15]));
				$prezzo_unitario = strtoupper(trim($row[16]));
				$importo = strtoupper(trim($row[17]));
				$chilometraggio = strtoupper(trim($row[18]));
				$self_service = strtoupper(trim($row[19]));
				$festivo = strtoupper(trim($row[20]));
				$codice_autista = strtoupper(trim($row[21]));

				$esito = $importa_consumi->importaConsumiXLS($fk_fornitore_id,$codice_sap,$numero_carta,$cliente,$targa,$numero_fattura,$data_fattura,$compagnia_fornitrice,$localita_punto_vendita,$tipo_transazione,$scontrino,$data_ora_transazione,$prodotto,$volume,$prezzo_unitario,$importo,$chilometraggio,$self_service,$festivo,$codice_autista);
			}

        }
	}

	public function consumiCarburante()
	{
		$data = [];
		helper(['form']);
		$model = new ArticoloModel();
		$automezziModel = new AutomezziModel(); 

		//$listaTipoProdotti = $model->getTipoArticoli();
		//$data['listaTipoProdotti'] = $listaTipoProdotti;

		$listaLocalita = $automezziModel->getListaLocalita(); 
		$data['listaLocalita'] = $listaLocalita; 
		

		if ($this->request->getMethod() == 'get') {
			$userModel = new UserModel();
			$elencoRisorse = $userModel->getListaAnagrafica('');
			$data['elencoRisorse'] = $elencoRisorse;

			$schedeCarburanti = $automezziModel->getSchedaCarburante();
			$data['schedeCarburanti'] = $schedeCarburanti;

			$data['listaProdotti'] = [];
			$showTable = false;
			$data['showTable'] = $showTable;
		}


		if ($this->request->getMethod() == 'post') {
			$userModel = new UserModel();
			$elencoRisorse = $userModel->getListaAnagrafica('');
			$data['elencoRisorse'] = $elencoRisorse;
			$schedeCarburanti = $automezziModel->getSchedaCarburante();
			$data['schedeCarburanti'] = $schedeCarburanti;
			
			$scheda_carburante = $this->request->getPost('scheda_carburante'); 
			$id_nominativo_risorsa = $this->request->getPost('risorsa2'); 
			$mese = $this->request->getPost("mese");
			$anno = $this->request->getPost("anno");
			$localita = $this->request->getPost("localita"); 
			$targa = $this->request->getPost("targa");

			$elencoAffidi = $automezziModel->getSchedeCarburanti($scheda_carburante,$id_nominativo_risorsa,$mese,$anno,$localita,$targa); 
			$data['elencoAffidi'] = $elencoAffidi;

			$showTable = true;
			$data['showTable'] = $showTable;
		}

		echo view('templates/headers/assegnaItem_header');
		// echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('automezzi/consumiCarburante', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
	}

	public function dettaglioConsumiCarburante($scheda_carburante){
		

		$automezziModel = new AutomezziModel(); 
		$dettaglio = $automezziModel->dettaglioConsumiCarburante($scheda_carburante); 
		$costo = $automezziModel->costiSchedaCarburante($scheda_carburante); 
		//print_r($dettaglio);
		$data['dettaglio'] = $dettaglio;
		$data['costo'] = $costo; 

		echo view('templates/headers/assegnaItem_header');
		$this->role_user->sidebar_ruoli($data); 
		$permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
			echo view('automezzi/dettaglioConsumiCarburante', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
	}


}