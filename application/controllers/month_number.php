<?php

class Month_number extends CI_Controller 
{

   public function __construct()
   {
       parent::__construct();
   }

  public function get_month_number($month_letter)
  {
     $Month_number="";

    if($month_letter=="january"){
    $number="01" ; }
    else if($month_letter=="february"){
    $number="02" ; }
    else if($month_letter=="march"){
    $number="03" ; }
    else if($month_letter=="april"){
    $number="04" ; }
    else if($month_letter=="may"){
    $number="05" ; }
    else if($month_letter=="june"){
    $number="06" ; }
    else if($month_letter=="july"){
    $number="07" ; }
    else if($month_letter=="august"){
    $number="08" ; }
    else if($month_letter=="september"){
    $number="09" ; }
    else if($month_letter=="october"){
    $number="10" ; }
    else if($month_letter=="november"){
    $number="11" ; }
    else if($month_letter=="december"){
    $number="12" ; }

    return $number ;
  }
 

}//end controller class



?>