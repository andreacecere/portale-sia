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

class Cronjobs extends BaseController
{

    public function cronEmail(){
        $email = new EmailModel(); 
        $consegna = $email->consegnaEmail(); 
    }

}