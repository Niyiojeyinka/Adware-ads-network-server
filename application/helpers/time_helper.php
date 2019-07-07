
<?php


/***
 * Name:       Citedlink
 * Package:     time_helper.php
 * About:       time helper
 * Copyright:  (C) 2017,
 * Author:     Ojeyinka Philip Olaniyi
 * License:    closed /propietry
 ***/


function get_time_date()
{
//$tim = getDate();

//$_tme = $tim["hours"].":".$tim["minutes"]." ".date("d/m/Y",time()) ;



  $_tme = ' '.date('H').' '.date('i').' '.date('s').' '.date('d').' '.date('F').' '.date('y');
return $_tme;


}