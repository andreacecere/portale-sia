<?php

namespace App\Models;

use CodeIgniter\Model;

class MagazzinoModel extends Model
{
    protected $table = 'tb_magazzino';


    public function getSede($descrizione){
        $builder = $this->db->table('tb_magazzino')->select('*')->where('descrizione',$descrizione);
        return  $builder->get()->getResultArray();
    }

    public function getSedi()
    {
        $builder = $this->db->table('tb_magazzino')->select('tb_magazzino.magazzino_id,tb_magazzino.descrizione as descrizioneMagazzino, indirizzo,cap,localita,frazione,telefono,email,riferimento,telefono_riferimento,tb_azienda.descrizione as descrizioneAzienda,azienda_id,concat(cognome," ",nome) as magazziniere');
        $builder->join('tb_azienda', 'tb_magazzino.fk_azienda_id = tb_azienda.azienda_ID');
        $builder->join('v_lista_risorse', 'v_lista_risorse.anagrafica_id = tb_magazzino.riferimento', 'left');
        return  $builder->get()->getResultArray();
    }

    public function getDettaglioSede($id)
    {
        $builder = $this->db->table('tb_magazzino')->select('magazzino_id,tb_magazzino.descrizione as descrizioneMagazzino, indirizzo,cap,localita,frazione,telefono,email,riferimento,telefono_riferimento,tb_azienda.descrizione as descrizioneAzienda,azienda_id');
        $builder->join('tb_azienda', 'tb_magazzino.fk_azienda_id = tb_azienda.azienda_ID');
        $builder->where('magazzino_id = ', $id);
        return  $builder->get()->getResultArray();
    }

    public function aggiornaInformazioniMagazzino($magazzino_id, $sede_magazzino, $indirizzo_magazzino, $cap_magazzino, $localita_magazzino, $frazione_magazzino, $telefono_magazzino, $email_magazzino, $magazziniere, $telefono_magazziniere)
    {
        $data = [
            'descrizione' => $sede_magazzino,
            'indirizzo'  => $indirizzo_magazzino,
            'cap'  => $cap_magazzino,
            'localita' => $localita_magazzino,
            'frazione' => $frazione_magazzino,
            'telefono' => $telefono_magazzino,
            'email' => $email_magazzino,
            'riferimento' => $magazziniere,
            'telefono_riferimento' => $telefono_magazziniere,
        ];
        $builder = $this->db->table('tb_magazzino');
        $builder->where('magazzino_id', $magazzino_id);
        $builder->update($data);
        if ($this->db->affectedRows() >= 0) {
            return true;
        } else {
            echo "Errore - " . $this->db->error();
            return false;
        }
    }

    public function aggiungiNuovaSede($sede_magazzino, $indirizzo_magazzino, $cap_magazzino, $localita_magazzino, $frazione_magazzino, $telefono_magazzino, $email_magazzino)
    {

        if ($this->verificaEsistenzaSede($sede_magazzino)) {
            $data = [
                'descrizione' => $sede_magazzino,
                'indirizzo'  => $indirizzo_magazzino,
                'cap'  => $cap_magazzino,
                'localita' => $localita_magazzino,
                'frazione' => $frazione_magazzino,
                'telefono' => $telefono_magazzino,
                'email' => $email_magazzino,
                'fk_azienda_id' => 1
            ];

            $builder = $this->db->table('tb_magazzino');
            $builder->insert($data);
            if ($this->db->affectedRows() >= 0) {
                return true;
            } else {
                echo "Errore - " . $this->db->error();
                return false;
            }
        } else {
            echo "Attenzione: risulta già presente una sede con questo nome ";
            return false;
        }
    }

    public function verificaEsistenzaSede($sede_magazzino)
    {
        $builder = $this->db->table('tb_magazzino');
        $builder->where('descrizione = ', $sede_magazzino);
        if ($builder->countAllResults() == 0) {
            return true;
        } else {
            return false;
        }
    }
}
