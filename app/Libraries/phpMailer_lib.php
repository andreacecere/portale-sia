<?php 

namespace App\Libraries;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

Class PHPMailer_Lib{
   
    public function load(){
        require_once APPPATH.'ThirdParty/PHPMailer.php';
        require_once APPPATH.'ThirdParty/Exception.php';
        require_once APPPATH.'ThirdParty/SMTP.php';

        $mail = new PHPMailer(); 
        return $mail; 
    }

}