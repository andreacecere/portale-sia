<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\CommesseModel;
use App\Models\AziendeModel;
use App\Models\FornitoriModel;
use App\Models\ArticoloModel;
use App\Models\MagazzinoModel;
use App\Models\DispositiviModel; 
use App\Models\EmailModel; 

#require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use CodeIgniter\HTTP\Request;


class Test extends BaseController
{


    


    public function index(){
        // $date = new \DateTime('2006-12-12');
        // $date->modify('+1 day');
        // echo $date->format('Y-m-d');
        $inputFileName = 'helloWorld.xlsx';
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($inputFileName);
        $data = $spreadsheet->getActiveSheet()->toArray();
        // print_r($data);
        // echo "<br>";
        for ($i=0; $i<count($data); $i++) {
            $name = $data[$i][0];
            $email = $data[$i][1];
            echo $name." ".$email."<br>";
        }
        // foreach($data as $row){
        //     echo "Valore A: ".$row[0]."<br>"; 
        //     echo "Valore B: ".$row[1]."<br>";
        // }
    }

    public function test(){
        $dispositivo = new DispositiviModel(); 
        $esito = $dispositivo->test(); 
        print_r($esito);
    }

    public function cron(){
        $email = new EmailModel(); 
        $consegna = $email->consegnaEmail(); 
    }

    public function excel(){

    }


}