<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\PHPMailer_Lib;

class UserModel extends Model
{
    // tabella di riferimento
    protected $table = 'tb_utente';
    protected $primaryKey = 'utente_id';

    // tb fields 
    //[utente_id]
    //[username]
    //[password]
    //[fk_tipo_utente_id]
    //[fk_anagrafica_id]
    //[attivo]
    //[ultimo_accesso]
    //[data_creazione]
    //[visibile]

    protected $allowedFields = ['username', 'password', 'fk_tipo_utente_id', 'fk_anagrafica_id', 'attivo', 'ultimo_accesso', 'data_creazione', 'data_aggiornamento', 'visibile'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    // metodo richiamato prima dell'inserimento
    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        $data['data']['data_creazione'] = date('Y-m-d H:i:s');

        return $data;
    }

    // metodo richiamato prima dell'update
    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);
        $data['data']['data_aggiornamento'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    public function generaPassword($email_decode,$nominativo_decode,$password){
        $builder = $this->db->table('v_utenti')->where('CONCAT(nome," ",cognome)',$nominativo_decode)->where('email',$email_decode);
        $row = $builder->get()->getResultArray();
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $builder = $this->db->table('tb_utente');
        $builder->where('utente_id', $row[0]['utente_id']);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - Non riesco ad aggiornare la password per l'utente ";
        }
        //echo password_hash("123456789", PASSWORD_DEFAULT);
    }

    public function login($username,$password){
        $arrayUser = array(); 
        $builder = $this->db->table('v_utenti')->where('username',$username);
        $row = $builder->get()->getResultArray();
        if ( count($row) > 0 ){
            if ( password_verify($password, $row[0]['password']) ){
                $data = [
                    'ultimo_accesso' => date('Y-m-d H:i:s')
                ];
                $builder = $this->db->table('tb_utente');
                $builder->where('utente_id', $row[0]['utente_id']);
                $builder->update($data);
                $arrayUser['utente_id'] = $row[0]['utente_id'];
                $arrayUser['username'] = $row[0]['username'];
                $arrayUser['ruolo_dsc'] = str_replace(" ","_",$row[0]['ruolo']);
                return $arrayUser;
            }
            else{
                return false; 
            }
        }
        else{
            return false; 
        }
    }

    public function getUsers()
    {
        $builder = $this->db->table('v_utenti');
        return  $builder->get()->getResultArray();
    }

    public function getDettaglioUser($utente_id)
    {
        if ( strpos($utente_id,"@") !== false ){
            //$builder = $this->db->table('v_utenti')->where('email = ', $utente_id)->where('cognome','rossi')->where('nome','mario');    
            $builder = $this->db->table('v_utenti')->where('email = ', $utente_id);    
        }
        else
            $builder = $this->db->table('v_utenti')->where('utente_id = ', $utente_id);
        return  $builder->get()->getResultArray();
    }

    


    public function getRuoli()
    {
        $builder = $this->db->table('tb_ruolo_utente');
        return  $builder->get()->getResultArray();
    }


    public function insertAnagraficaUtente($anagrafica_id, $username, $commessa, $ruolo, $password)
    {
        /* 1) Aggiorno il valore della commessa in tb_anagrafica */
        $data = [
            'fk_commessa_id' => $commessa,
            'data_aggiornamento_commessa' => date('Y-m-d H:i:s')
        ];
        $builder = $this->db->table('tb_anagrafica');
        $builder->where('anagrafica_id', $anagrafica_id);
        $builder->update($data);
        /* 2) Verifico se esiste l'utente in tb_utente se esiste prelevo il valore del suo id , altrimenti procedo ad inserire  */
        if ($this->verificaEsistenzaUtente($anagrafica_id)) {
            //Utente non trovato devo inserirlo
            if ($this->aggiungiNuovoUtente($username, $password, $ruolo, $anagrafica_id)) {
                //Utente inserito procedo a inserire la commessa anche in tb_commessa_utente
                $id_utente = $this->ottieniIDUtente($anagrafica_id);
                if ($this->aggiungiNuovaCommessaUtente($commessa, $id_utente)) {
                    return true;
                }
            }
            return true;
        } else {
            //Utente trovato verifico se l'utente e la commessa sono già presenti, se lo sono aggiorno la data di update altrimenti inserisco
            $id_utente = $this->ottieniIDUtente($anagrafica_id);
            $data = [
                //'commessa_utente_id' => rand(), //mi serve per andare avanti negli insert
                'fk_commessa_id' => $commessa,
                'fk_utente_id' => $id_utente,
                'data_creazione' => date('Y-m-d H:i:s'),
                'attivo' => 1
            ];
            $builder = $this->db->table('tb_commessa_utente');
            $builder->insert($data);
            return true;
        }
    }

    public function verificaEsistenzaUtente($anagrafica_id)
    {
        $builder = $this->db->table('tb_utente');
        $builder->where('fk_anagrafica_id = ', $anagrafica_id);
        if ($builder->countAllResults() == 0) {
            //L'utente non è presente all'interno della tabella
            return true;
        } else {
            //L'utente risulta presente nella tabella
            return false;
        }
    }

    public function aggiungiNuovoUtente($username, $password, $ruolo, $anagrafica_id)
    {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            //'utente_id' => rand(), //mi serve per andare avanti negli insert
            'username' => $username,
            'password' => $hashPassword,
            'fk_tipo_utente_id' => $ruolo,
            'fk_anagrafica_id' => $anagrafica_id,
            'attivo' => 1,
            'data_creazione' => date('Y-m-d H:i:s')
        ];
        $builder = $this->db->table('tb_utente');
        $builder->insert($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            echo "Errore - Non riesco ad inserire l'utente ";
            return false;
        }
    }

    public function aggiornaPassword($password,$user_id){
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $builder = $this->db->table('tb_utente');
        $builder->where('utente_id', $user_id);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            return "Errore - Non riesco ad aggiornare la password per l'utente ";
        }
    }

    public function aggiungiNuovaCommessaUtente($fk_commessa_id, $fk_utente_id)
    {
        $data = [
            //'commessa_utente_id' => rand(),
            'fk_commessa_id ' => $fk_commessa_id,
            'fk_utente_id' => $fk_utente_id,
            'data_creazione' => date('Y-m-d H:i:s'),
            'attivo' => 1
        ];
        $builder = $this->db->table('tb_commessa_utente');
        $builder->insert($data);
    }


    public function ottieniIDUtente($anagrafica_id)
    {
        $builder = $this->db->table('tb_utente');
        $builder->where('fk_anagrafica_id = ', $anagrafica_id);
        foreach ($builder->get()->getResultArray() as $row) {
            $utente_id = $row['utente_id'];
        }
        return $utente_id;
    }

    public function verificaAssociazioneUtenteCommessa($fk_commessa_id, $fk_utente_id)
    {
        $builder = $this->db->table('tb_commessa_utente');
        $builder->where('fk_commessa_id = ', $fk_commessa_id);
        $builder->where('fk_utente_id = ', $fk_utente_id);
        if ($builder->countAllResults() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAnagrafica($utente_id)
    {
        if (empty($utente_id)) {
            $builder = $this->db->query("SELECT anagrafica_id , CONCAT(cognome,' ',nome) as nominativo FROM tb_anagrafica WHERE not exists ( select * from tb_utente WHERE tb_anagrafica.anagrafica_id = tb_utente.fk_anagrafica_id ) ORDER BY nominativo");
            return  $builder->getResult();
        } else {
            $builder = $this->db->table('tb_anagrafica')->select("*")->where('anagrafica_id = ', $utente_id);
            return  $builder->get()->getResultArray();
        }
    }

    public function getInfoUtente($destinatario){
        $builder = $this->db->table('tb_anagrafica')->select('*')->where('CONCAT(nome," ",cognome) = ',$destinatario);
        return  $builder->get()->getResultArray();
    }

    public function getListaAnagrafica($utente_id)
    {
        if (empty($utente_id)) {
            //$builder = $this->db->query("SELECT anagrafica_id , CONCAT(cognome,' ',nome) as nominativo FROM tb_anagrafica WHERE not exists ( select * from tb_utente WHERE tb_anagrafica.anagrafica_id = tb_utente.fk_anagrafica_id ) ORDER BY nominativo");
            $builder = $this->db->table('v_lista_risorse')->select("*")->orderBy('CONCAT(cognome," ",nome)');
            return  $builder->get()->getResultArray();
        } else {
            if ( is_string($utente_id) ){
                // echo "OK";
                $builder = $this->db->table('v_lista_risorse')->select("*")->where('CONCAT(nome," ",cognome) = ', $utente_id)->orWhere('anagrafica_id = ',$utente_id);
            }
                //$builder = $this->db->table('v_lista_risorse')->select("*")->where('CONCAT(nome," ",cognome) =','mauro' );
            else{
                // echo "OK"; 
                $builder = $this->db->table('v_lista_risorse')->select("*")->where('anagrafica_id = ', $utente_id);
            }
            return  $builder->get()->getResultArray();
        }
    }


    public function modificaUtente($utente_id, $password, $stato, $nome, $cognome, $azienda, $commessa, $email, $ruolo)
    {
        $builder = $this->db->table('tb_utente')->select("fk_anagrafica_id")->where('utente_id = ', $utente_id);
        foreach ($builder->get()->getResultArray() as $row) {
            $fk_anagrafica_id = $row['fk_anagrafica_id'];
        }
        $username = $nome . "." . $cognome;
        $data_creazione = date('Y-m-d H:i:s');
        $this->db->transStart();
        /* Aggiorno prima la tabella tb_anagrafica */
        $this->db->query("UPDATE tb_anagrafica SET nome = '{$nome}' , cognome = '{$cognome}', email = '{$email}' , fk_commessa_id = {$commessa} WHERE anagrafica_id = {$fk_anagrafica_id} ");
        /* Aggiorno la tabella tb_commessa_utente */
        $this->db->query("INSERT INTO tb_commessa_utente (fk_commessa_id,fk_utente_id,data_creazione,attivo) VALUES ({$commessa},{$utente_id},'{$data_creazione}',{$stato}) ");
        /* aggiorno la tabella tb_utente */
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->db->query("UPDATE tb_utente SET data_aggiornamento = '{$data_creazione}', password = '{$password}',  username = '{$username}', fk_tipo_utente_id = {$ruolo}, attivo = {$stato} WHERE utente_id = $utente_id ");
        } else {
            $this->db->query("UPDATE tb_utente SET data_aggiornamento = '{$data_creazione}', username = '{$username}', fk_tipo_utente_id = {$ruolo}, attivo = {$stato} WHERE utente_id = $utente_id");
        }
        $this->db->transComplete();

        if ($this->db->transStatus() === FALSE) {
            return "Errore  " . $this->db->error();
        } else {
            return true;
        }
    }

    public function getResponsabiliCommessa(){
        //$builder = $this->db->query("SELECT anagrafica_id,CONCAT(nome, \" \", cognome) as nominativo_responsabile FROM tb_anagrafica WHERE NOT EXISTS ( SELECT * FROM tb_commessa_responsabile WHERE tb_anagrafica.anagrafica_id = tb_commessa_responsabile.fk_anagrafica_id ) ");
        $builder = $this->db->query("SELECT anagrafica_id,CONCAT(nome,\" \", cognome) as nominativo_responsabile FROM tb_anagrafica LEFT JOIN tb_commessa_responsabile on tb_anagrafica.anagrafica_id = tb_commessa_responsabile.fk_anagrafica_id "); 
        return  $builder->getResultArray(); 
    }

    public function getResponsabileCommessa($id_utente,$commessa_id_attuale,$commessa_id_spostamento){
     
        //echo "ID_UTENTE: ".$id_utente."<br>";

        $builder = $this->db->table('v_lista_responsabili_commesse')->select("*")->where('commessa_id = ', $commessa_id_attuale);
        $row = $builder->get()->getResultArray();
        if ( !empty($row) ){
            //verifico la commessa di destinazione
            ////print_r($row);
            $anagrafica_id_commessa_attuale = $row[0]['anagrafica_id'];
            echo "<br>";
            $builder = $this->db->table('v_lista_responsabili_commesse')->select("*")->where('commessa_id = ', $commessa_id_spostamento);
            $row_commessa = $builder->get()->getResultArray();
            $anagrafica_id_commessa_spostamento = $row_commessa[0]['anagrafica_id'];
            //print_r($row_commessa);

            if ( $id_utente == $anagrafica_id_commessa_attuale && $id_utente == $anagrafica_id_commessa_spostamento ){
                //echo "OK, non invio le email";
                return true; 
            }
            else{
                //echo "Procedo ad inviare l'email";
            }

            

        }
        exit;


        $builder = $this->db->table('tb_anagrafica')->select("anagrafica_id,CONCAT(nome,\" \",cognome) as nominativo,email,fk_commessa_id,tb_commessa.descrizione as descrizione_commessa")->join('tb_commessa','tb_anagrafica.fk_commessa_id = tb_commessa.commessa_id')->where('anagrafica_id = ', $anagrafica_id);
        
        //if ($builder->countAll() > 0) {
            
            $row = $builder->get()->getResultArray();
            ////print_r($row);
            if ( isset($row[0]['fk_commessa_id']) ){
                echo "ID utente: ".$id_utente."<br>"; 
                $fk_commessa_attuale_id = $row[0]['fk_commessa_id'];
                echo "Commessa attuale id: ".$fk_commessa_attuale_id."<br>"; 
            }


        //}

        $builder = $this->db->table('v_lista_responsabili_commesse')->select("*")->where('anagrafica_id = ', $anagrafica_id);

        //$builder = $this->db->query("SELECT anagrafica_id,CONCAT(nome, \" \", cognome) as nominativo_responsabile FROM tb_anagrafica WHERE NOT EXISTS ( SELECT * FROM tb_commessa_responsabile WHERE tb_anagrafica.anagrafica_id = tb_commessa_responsabile.fk_anagrafica_id ) ");
        // $builder = $this->db->query("SELECT anagrafica_id,CONCAT(nome,\" \", cognome) as nominativo_responsabile FROM tb_anagrafica LEFT JOIN tb_commessa_responsabile on tb_anagrafica.anagrafica_id = tb_commessa_responsabile.fk_anagrafica_id ")->where('tb_commessa_responsabile.fk_commessa_id = '.$idcommessa); 
        // return  $builder->getResultArray(); 
    }

    public function getCountRisorse(){
        $builder = $this->db->table('v_lista_risorse')->selectCount('anagrafica_id');
        $row = $builder->get()->getResultArray();
        return $row;        
    }

    public function getCountDocumentiDaCaricare(){
        $builder = $this->db->table('tb_affidamento')->selectCount('affidamento_modulo')->where('affidamento_modulo',0);
        $row = $builder->get()->getResultArray();
        return $row;        
    }

    public function getCountDocumentiCaricati(){
        $builder = $this->db->table('tb_affidamento')->selectCount('affidamento_modulo')->where('affidamento_modulo',1);
        $row = $builder->get()->getResultArray();
        return $row;        
    }

    public function getAllMansioni(){
        $builder = $this->db->table('tb_mansioni')->select("*");
        $row = $builder->get()->getResultArray();
        return $row; 
    }

    public function getInfoRisorsa($risorsa_anagrafica_id){
        $builder = $this->db->table('v_associazione_dipendente_commessa_responsabile')->select("*")->where('anagrafica_id',$risorsa_anagrafica_id);
        $row = $builder->get()->getResultArray();
        return $row; 
    }

    public function infoCommessaDestinazione($commessa_destinazione_id){
        $builder = $this->db->table('v_associazione_commessa_magazzino_responsabile')->select("*")->where('commessa_id',$commessa_destinazione_id);
        $row = $builder->get()->getResultArray();
        return $row; 
    }

    public function inviaEmail($email_destinatario,$nominativo){
        $mail = new PHPMailer_Lib(); 
        $email = $mail->load();
        $email->SMTPDebug = 3; 
		$email->Host = "smtp.easyservizi.it";
		$email->Port = 587; 
		$email->SMTPSecure = 'tls';
        $email->SMTPAuth = false;
        $email->CharSet = "UTF-8";
        $email->Encoding = 'base64';

		$email->setFrom("noreply@easyservizi.it", "noreply@easyservizi.it");
        $email->addAddress($email_destinatario, $email_destinatario);
        
        // $messaggio = "<h3 style='font-color:#0060A6>Recupera la tua password ora</h3>"; 
        // $messaggio .= "Salve ".strtoupper($nominativo).".<br>In breve potrai accedere nuovamente al portale Easy.<br>";
        // $messaggio .= "Segui questo semplice procedimento: <br><br>"; 
        // $messaggio .= "<a href='#'>CREA NUOVA PASSWORD</a>";

        $email->Subject = 'Recupero credenziali';
        $email->msgHTML("<h3 style='color:#0060A6'>
        Recupera la tua password ora</h3>Salve ".strtoupper($nominativo).".<br>
        In breve potrai accedere nuovamente al portale Easy.<br>
        Segui questo semplice procedimento: <br><br>
        <a href='".base_url()."//generaPassword/".base64_encode($email_destinatario)."/".base64_encode($nominativo)."' style='color:#0060A6;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>CREA NUOVA PASSWORD</a>");
        $email->AltBody = 'HTML messaging not supported';

		if(!$email->Send()){
             echo "Mailer Error: " . $email->ErrorInfo;
             return false; 
        }
        else{
            return true;
        }
		
    }





}
