<?php 

namespace App\Models;
use App\Libraries\PHPMailer_Lib;

use CodeIgniter\Model;

class EmailModel extends Model
{

    protected $table = 'tb_avvisi_email';
    protected $primaryKey = 'id_avviso';

    protected $allowedFields = ['fk_anagrafica_richiedente_id','valore_richiesta_id','comunicazione','tipologia_email','data_invio_email'];


    public function consegnaEmail(){
        $query = $this->db->query("SELECT * FROM tb_avvisi_email WHERE data_invio_email is null"); 
        $row = $query->getResultArray();
        for($i=0; $i<count($row); $i++){
            $valore_richiesta_id = $row[$i]['valore_richiesta_id']; 
            $tipologia_email = $row[$i]['tipologia_email'];
            $query = $this->db->query("SELECT v_richieste_movimento.movimento_data_richiesta,movimento_data_inizio_servizio,movimento_stato,nominativo_spostamento,magazzino_provenienza_dsc,magazzino_destinazione_dsc,commessa_provenienza,commessa_destinazione,articolo_seriale,descrizione,email,comunicazione,tipologia_email,richiesta_id,nominativo_responsabile_commessa,movimento_tipo
                                        FROM v_richieste_movimento INNER JOIN tb_avvisi_email ON v_richieste_movimento.richiesta_id = tb_avvisi_email.valore_richiesta_id
                                        WHERE data_invio_email is null AND richiesta_id = ".$valore_richiesta_id." AND "); 
            $row_dati = $query->getResultArray();
            $email_destinatario = $row_dati[0]['email']; 
            $comunicazione = $row_dati[0]['comunicazione']; 
            $nominativo_responsabile_commessa = $row_dati[0]['nominativo_responsabile_commessa']; 
            $tipologia_movimento = $row_dati[0]['movimento_tipo'];
            $data_inizio_servizio = $row_dati[0]['movimento_data_inizio_servizio'];
            $nominativo_spostamento = $row_dati[0]['nominativo_spostamento']; 
            $magazzino_sede_provenienza = $row_dati[0]['magazzino_provenienza_dsc']; 
            $magazzino_sede_destinazione = $row_dati[0]['magazzino_destinazione_dsc']; 
            $commessa_provenienza = $row_dati[0]['commessa_provenienza']; 
            $commessa_destinazione = $row_dati[0]['commessa_destinazione']; 
            $array_articolo = []; 
            $array_descrizione = [];
            // echo $email_destinatario."\n";
            // echo $comunicazione."\n"; 
            // echo $tipologia_movimento."\n"; 
            // echo $nominativo_responsabile_commessa."\n\n\n";
            for($j=0; $j<count($row_dati); $j++){
                array_push($array_articolo,$row_dati[$i]['articolo_seriale']); 
                array_push($array_descrizione,$row_dati[$i]['descrizione']); 
            }
            //echo $row[$i]['valore_richiesta_id']."\n";
        }

        $this->email($email_destinatario,$comunicazione,$nominativo_responsabile_commessa,$tipologia_movimento,$data_inizio_servizio,$nominativo_spostamento,$magazzino_sede_provenienza,$magazzino_sede_destinazione,$commessa_provenienza,$commessa_destinazione,$array_articolo,$array_descrizione);

        
    }

    public function consegnaEmail_old(){

        $query = $this->db->query("SELECT * FROM tb_avvisi_email"); 
        $row = $query->getResultArray();
        for($i=0; $i<count($row); $i++){
            $query = $this->db->query('SELECT v_richieste_movimento.movimento_data_richiesta,movimento_data_inizio_servizio,movimento_stato,nominativo_spostamento,magazzino_provenienza_dsc,magazzino_destinazione_dsc,commessa_provenienza,commessa_destinazione,articolo_seriale,descrizione,email,comunicazione,tipologia_email,richiesta_id,nominativo_responsabile_commessa
                                        FROM v_richieste_movimento INNER JOIN tb_avvisi_email ON v_richieste_movimento.richiesta_id = tb_avvisi_email.valore_richiesta_id
                                        WHERE data_invio_email is null AND richiesta_id = '.$row[$i]['valore_richiesta_id']); 
            $row_dati = $query->getResultArray();
            $tabella = "<table style='border-collapse: collapse;width:100%'>
                                <tr>
                                    <th style='border-bottom: 1px solid #ddd'>Data richiesta</th>
                                    <th style='border-bottom: 1px solid #ddd'>Data inizio servizio</th>
                                    <th style='border-bottom: 1px solid #ddd'>Nominativo spostamento</th>
                                    <th style='border-bottom: 1px solid #ddd'>Magazzino Da - A</th>
                                    <th style='border-bottom: 1px solid #ddd'>Commessa Da - A</th>
                                    <th style='border-bottom: 1px solid #ddd'>Seriale</th>
                                    <th style='border-bottom: 1px solid #ddd'>Stato movimento</th>
                                </tr>";
            for($j=0; $j<count($row_dati); $j++){
                $tabella .= "<tr>
                            <td style='border-bottom: 1px solid #ddd; text-align:center;'>".date('d/m/Y H:i:s',strtotime($row_dati[$j]['movimento_data_richiesta']))."</td>
                            <td style='border-bottom: 1px solid #ddd; text-align:center;'>".date('d/m/Y',strtotime($row_dati[$j]['movimento_data_inizio_servizio']))."</td>
                            <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($row_dati[$j]['nominativo_spostamento'])."</td>
                            <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($row_dati[$j]['magazzino_provenienza_dsc'])." - ".strtoupper($row_dati[$j]['magazzino_destinazione_dsc'])."</td>
                            <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($row_dati[$j]['commessa_provenienza'])." - ".strtoupper($row_dati[$j]['commessa_destinazione'])."</td>
                            <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($row_dati[$j]['articolo_seriale'])." - ".strtoupper($row_dati[$j]['descrizione'])."</td>
                            <td style='border-bottom: 1px solid #ddd; text-align:center;'>".strtoupper($row_dati[$j]['movimento_stato'])."</td>
                        </tr>";
            }
            $tabella .= "</table>";
            $data = [
                'data_invio_email' => date('Y-m-d H:i:s'),
            ];
    
            $builder = $this->db->table('tb_avvisi_email');
            $builder->where('valore_richiesta_id', $row[$i]['valore_richiesta_id']);
            $builder->update($data);
            $this->inviaEmail("mauro.spezzaferro@easyservizi.it",$tabella,$row[$i]['nominativo_responsabile_commessa'],$row[$i]['tipologia_email']); 
            //$this->inviaEmail("mauro.spezzaferro@easyservizi.it",$tabella,"test","$row_dati[$i]['tipologia_email'])"; 
        }
    }


    public function email($email_destinatario,$comunicazione,$nominativo_responsabile_commessa,$tipologia_movimento,$data_inizio_servizio,$nominativo_spostamento,$magazzino_sede_provenienza,$magazzino_sede_destinazione,$commessa_provenienza,$commessa_destinazione,$array_articolo,$array_descrizione){
        echo $email_destinatario; 

    }

    public function inviaEmail($email_destinatario,$tabella,$nominativo_responsabile_commessa,$motivazione){
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
        


        if ( $motivazione == "RICHIESTA SPOSTAMENTO" ){
            $email->Subject = 'Richiesta spostamento risorsa';
            $email->msgHTML("Salve ".strtoupper($nominativo_responsabile_commessa)."<br>questa email è stata generata dal sistema per avvisarti che la risorsa indicata in tabella sarà spostata sotto la tua area di competenza, per <u>confermare</u> o <u>rifiutare</u> puoi procedere cliccando sul seguente link <a href='http://magazzino.local/controlloRichieste'>Clicca qui</a><br><br><hr><br><br>".$tabella);
		    $email->AltBody = 'HTML messaging not supported';
        }
        elseif ( $motivazione == "CONSENTI_SPOSTAMENTO" ){
            $email->Subject = 'Consenti spostamento risorsa';
            $email->msgHTML("<p>Salve ".strtoupper($nominativo_responsabile_commessa)."<p><p>Questa email è stata generata dal sistema per avvisarti che la risorsa indicata in tabella <b>sarà spostata</b> sotto la tua area di competenza</p><hr><br>".$tabella);
            $email->AltBody = 'HTML messaging not supported';
        }
        elseif ( $motivazione == "RIFIUTO_SPOSTAMENTO" ){
            $email->Subject = 'Rifiuto spostamento risorsa';
            $email->msgHTML("<p>Salve ".strtoupper($nominativo_responsabile_commessa)."<p><p>Questa email è stata generata dal sistema per avvisarti che la risorsa indicata in tabella <b>non sarà spostata</b> sotto la tua area di competenza</p><hr><br>".$tabella);
            $email->AltBody = 'HTML messaging not supported';
        }

		if(!$email->Send()){
		 	echo "Mailer Error: " . $email->ErrorInfo;
		}
		
    }


}