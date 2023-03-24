<?php 

function RemoveMascara($valor) {
 
  $valor = preg_replace('/[^0-9]/', '', $valor);
   return $valor;

}