<?php

namespace App\Controllers;

use App\Libraries\PHPMailer_Lib;
use App\Models\AffidamentoModel;
use App\Models\ArticoloModel;
use App\Models\CommesseModel;
use App\Models\UserModel; 
use App\Libraries\RoleUser;

class Richieste extends BaseController
{
    protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}
    

    public function index(){

        
        $articolo = new ArticoloModel(); 

        $user_id = session()->get('id');
        $data['listaMovimento'] = $articolo->richieste_movimento($user_id); 
        
        
        echo view('templates/headers/assegnaItem_header');
        // echo view('templates/sidebar/sidebar',$data);
        $this->role_user->sidebar_ruoli($data);
        $permesso_visualizzazione = $this->role_user->mostra_view($this->request->uri->getSegments(0)[0],session()->get('ruolo_dsc')); 
		if ( $permesso_visualizzazione )
            echo view('risorse/controlloRichieste', $data);
		else
			echo view('accesso_negato');
		
		echo view('templates/footers/footer');
    }

    public function getRichiestePending($user_id){

        $articolo = new ArticoloModel(); 
        $valore = $articolo->getRichiestePending($user_id); 
        echo count($valore);
    }

    public function confermaSpostamento($id){
        $articolo = new ArticoloModel(); 
        $valore = $articolo->confermaSpostamento($id); 
    }

    public function confermaRifiuto($id){
        $articolo = new ArticoloModel(); 
        $valore = $articolo->confermaRifiuto($id); 
        
    }


}