<?php

namespace App\Controllers;

use App\Models\AffidamentoModel;
use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\UserModel; 
use App\Libraries\RoleUser;

class Documenti extends BaseController
{

    protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}


    public function ricercaDocumenti(){
        $data = [];
        helper(['form']);
        $articoli = new ArticoloModel(); 
        $commessaModel = new CommesseModel();
        $userModel = new UserModel();

        $elencoRisorse = $userModel->getListaAnagrafica('');
        $data['elencoRisorse'] = $elencoRisorse;
        
        $listaCommesse = $commessaModel->getListaCommesse();
        

            $seriale = $this->request->getGet('seriale_input');
			$tipoArticolo = $this->request->getGet('tipo_articolo');
			$data_movimento = $this->request->getGet('data');
			$commessa = $this->request->getGet('commessa_input');
            $id_operazione = $this->request->getGet('id_operazione');
            $stato_documenti = $this->request->getGet('stato_documenti');
            $operatore = $this->request->getGet('operatore');
            $ricercaModuli = $articoli->ricercaModuli($seriale,$tipoArticolo,$data_movimento,$commessa,$id_operazione,$stato_documenti,$operatore,$operatore);
            $data['showTable'] = true; 
            $data['ricerca'] = $ricercaModuli; 

        $data['listaCommesse'] = $listaCommesse;
        echo view('templates/headers/assegnaItem_header');
        // echo view('templates/sidebar/sidebar');
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('item/documenti/cercaDocumento', $data);
		else
			echo view('accesso_negato');
        
        echo view('templates/footers/footer');
		
    }
    public function dettaglioDocumento($idAffidamento){
        $model = new ArticoloModel();
		$articolo = $model->ottieniInfoItemAffidato($idAffidamento);
        $data['articolo'] = $articolo;
		$listaTipoProdotti = $model->getTipoArticoli();
		$data['listaTipoProdotti'] = $listaTipoProdotti;
        echo view('templates/headers/assegnaItem_header');
        $this->role_user->sidebar_ruoli($data);
        // echo view('templates/sidebar/sidebar');
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('item/documenti/dettaglioDocumento', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/assegnaItem_footer');
    }

    public function uploadModulo($idArticolo){
        $articoli = new ArticoloModel(); 
		$path = "upload/documenti_affido/";
		if ( $this->request->getMethod() == 'post' ){

			$tipologia_documento = $this->request->getPost('documento'); 

			$nomeFile = $this->request->getFile('file');
			$msg = "Il file è stato caricato con successo!"; 
			$name = $nomeFile->getName();
			if ( $tipologia_documento == 'affido')
                $fileName = "AFFIDO_".$idArticolo.".pdf";
            else
                $fileName = "DISAFFIDO_".$idArticolo.".pdf";
            if ( !file_exists($path.$fileName) ){
                $nomeFile->move($path,$fileName);
            }
            
            $flagModuloCaricato = $articoli->flagModuloCaricato($idArticolo);
            return redirect()->back();
		}
    }
    
    public function ricercaModuli($idArticolo,$tipologia){
        $ch = curl_init();
        $link = urlencode("https://www.google.com");
        $source = "http://192.168.0.161/reportserver/reportserver/httpauthexport?id=13734&format=pdf&user=user&apikey=test123&p_affidamento_id=$idArticolo";
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        if ( $tipologia == 'A' )
            $destination = 'upload/documenti_affido/AFFIDO_'.$idArticolo.'.pdf';
        else
            $destination = 'upload/documenti_affido/DISAFFIDO_'.$idArticolo.'.pdf';
        $file = fopen($destination, "w+");
        fputs($file, $data);
        fclose($file);
        $arrayFile = []; 
        $path = "upload/documenti_affido/";
        $files = scandir($path);
        foreach ($files as $file) {
            if ( $file != "." && $file != ".." ){
                if (strpos($file, $idArticolo.".pdf") !== false) {
                    
                    array_push($arrayFile,$path.$file);
                }
            }
        }

        echo json_encode($arrayFile);
    }


    public function remainder(){
        // echo "OK"; 
        $articoli = new ArticoloModel(); 
        $remainder = $articoli->remainder();

    }

   

    public function caricaFirma(){
        
        $path = "upload/documenti_affido/";
        $firma = $this->request->getPost('imgBase64'); 
        $id_operazione = $this->request->getPost('id_operazione');
        //echo $id_operazione; 
        $img = str_replace('data:image/jpeg;base64,', '', $firma);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $path . "FIRMA_".$id_operazione . '.jpeg';
        $success = file_put_contents($file, $data);
    }

    public function ottieniFotoFirma($id_operazione){
        $arrayFile = []; 
        $path = "upload/documenti_affido/";
        $files = scandir($path);
        foreach ($files as $file) {
            if ( $file != "." && $file != ".." ){
                if (strpos($file, $id_operazione.".jpeg") !== false) {
                    
                    array_push($arrayFile,$path.$file);
                }
            }
        }

        echo $arrayFile[0];
    }

    

}