<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\RoleUser;

class Users extends BaseController
{

	protected $role_user; 

	public function __construct(){
		$this->role_user = new RoleUser(); 
	}

	public function index()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			$model = new UserModel();
			$esitoUser = $model->login($username,$password);
			if ( is_bool($esitoUser) ){
				session()->setFlashdata('errore_credenziali', 'Attenzione, username e/o password errate');
			}
			else{
				$this->setUserSession($esitoUser);
				return redirect()->to('dashboard');
			}
		}

		echo view('templates/headers/login_header');
		echo view('login2', $data);
		echo view('templates/footers/login_footer');
	}

	public function generaPassword($email,$nominativo){
		$data = [];
		$model = new UserModel();
		$email_decode = base64_decode($email); 
		$nominativo_decode = base64_decode($nominativo);
		if ( filter_var($email_decode,FILTER_VALIDATE_EMAIL) ){
			$key = "ok_parametri";
			$messaggio = "";
		}
		else{
			$key = "errore_parametri";
			$messaggio = "Attenzione, si è verificato un problema durante la lettura dei parametri";
			
		}
		$data = [
			'key' => $key, 
			'messaggio' => $messaggio,
		];
		if ( $this->request->getMethod() == 'post' ){
			$password = $this->request->getPost('password'); 
			$esito_cambio_password = $model->generaPassword($email_decode,$nominativo_decode,$password);
			if ( $esito_cambio_password ){
				return redirect()->to('/');
			}
			else{
				$key = "errore_parametri";
				$messaggio = $esito_cambio_password;
			}
		}

		echo view('generaPassword', $data);
		
	}


	private function setUserSession($user)
	{
		$data = [
			'id' => $user['utente_id'],
			'username' => $user['username'],
			'ruolo_dsc' => $user['ruolo_dsc'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function recuperoCredenziali(){
		$userModel = new UserModel(); 
		
		$data = []; 

		if ( $this->request->getMethod() == 'post' ){
			$email = $this->request->getPost('email'); 
			$recupero_informazioni = $userModel->getDettaglioUser(trim($email));
			if ( empty($recupero_informazioni) ){
				$key = "errore_email";
				$messaggio = "Attenzione, non esiste alcun record per l'email inserita";
				return redirect()->back()->with($key, $messaggio);
			}
			$email_destinatario = $recupero_informazioni[0]['email']; 
			$nominativo = $recupero_informazioni[0]['nome']." ".$recupero_informazioni[0]['cognome'];
			$invio_email = $userModel->inviaEmail($email_destinatario,$nominativo);
			if ( $invio_email ){
				$key = "ok_email";
				$messaggio = "L'email è stata inviata";
				return redirect()->back()->with($key, $messaggio);
			}
			// echo "<pre>"; 
			// print_r($recupero_informazioni); 
			// echo "</pre>";


		}


		echo view('templates/headers/login_header');
		echo view('recuperoCredenziali', $data);
		echo view('templates/footers/login_footer');
	}

	// public function reimpostaPassword()
	// {
	// 	$data = [];

	// 	helper(['form']);

	// 	echo view('templates/headers/login_header');
	// 	echo view('reimposta_password');
	// 	echo view('templates/footers/login_footer');
	// }


	public function cambioPassword(){

		
		$data = []; 

		$userModel = new UserModel(); 
		
		if ( $this->request->getMethod() == 'post' ){
			$password = $this->request->getPost('password'); 
			$user_id = session()->get('id'); 

			$esito = $userModel->aggiornaPassword($password,$user_id); 

			if ( is_bool($esito) ){
				$key = "cambio_avvenuto";
				$messaggio = "La password è stata modificata";
			}
			else{
				$key = "cambio_non_avvenuto";
				$messaggio = "La password non è stata modificata";
			}
			return redirect()->back()->with($key, $messaggio);
		}


        echo view('templates/headers/assegnaItem_header');
		//echo view('templates/sidebar/sidebar');
		$this->role_user->sidebar_ruoli($data);
		echo view('cambia_password');
		echo view('templates/footers/assegnaItem_footer');
	}



	

	public function logout()
	{
		session()->destroy();
		return  redirect()->to('/');
	}
}
