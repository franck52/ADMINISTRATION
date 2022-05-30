<?php
/*---------------------------------------------------------------*/
/*
    Titre : Cryptage et décryptage md5                                                                                   
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=481
    Auteur           : freemh                                                                                             
    Date édition     : 06 Jan 2009                                                                                        
    Date mise à jour : 17 Oct 2019                                                                                       
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/

    class Crypter{

       var $key;

       /*--------------------------------
         le constructeur de la classe.
         --------------------------------*/
       function __construct($clave){
          $this->key = $clave;
       }

       function setKey($clave){
          $this->key = $clave;
       }
       
       function keyED($txt) { 
          $encrypt_key = md5($this->key); 
          $ctr=0; 
          $tmp = ""; 
          for ($i=0;$i<strlen($txt);$i++) { 
             if ($ctr==strlen($encrypt_key)) $ctr=0; 
             $tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1); 
             $ctr++; 
          } 
          return $tmp; 
       } 
       
       function encrypt($txt){ 
          srand((double)microtime()*1000000); 
          $encrypt_key = md5(rand(0,32000)); 
          $ctr=0; 
          $tmp = ""; 
          for ($i=0;$i<strlen($txt);$i++){ 
             if ($ctr==strlen($encrypt_key)) $ctr=0; 
             $tmp.= substr($encrypt_key,$ctr,1) . 
                 (substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1)); 
             $ctr++; 
          } 
          return base64_encode($this->keyED($tmp)); 
       } 

       function decrypt($txt) { 
          $txt = $this->keyED(base64_decode($txt)); 
          $tmp = ""; 
          for ($i=0;$i<strlen($txt);$i++){ 
             $md5 = substr($txt,$i,1); 
             $i++; 
             $tmp.= (substr($txt,$i,1) ^ $md5); 
          } 
          return $tmp; 
       } 

    }
?>