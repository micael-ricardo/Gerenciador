<?php

function reais($numero)
{
    return "R$ " . number_format($numero, 2, ",", ".");
}

function formatar_cpf_cnpj($numero_documento)
{
   $numero_documento = preg_replace('/[^0-9]/', '', $numero_documento);

   if (strlen($numero_documento) === 11) {
      return substr($numero_documento, 0, 3) . '.' .
             substr($numero_documento, 3, 3) . '.' .
             substr($numero_documento, 6, 3) . '-' . 
             substr($numero_documento, -2);
   } else if (strlen($numero_documento) === 14) {
      return substr($numero_documento, 0, 2) . '.' .
             substr($numero_documento, 2, 3) . '.' .
             substr($numero_documento, 5, 3) . '/' .
             substr($numero_documento, 8, 4) . '-' . 
             substr($numero_documento, -2);
   } else {
       return $numero_documento;
   }
}

function formatar_telefone($numero_telefone)
{
    $numero_telefone = preg_replace('/[^0-9]/', '', $numero_telefone);
    if (strlen($numero_telefone) == 11) {
        return '(' . substr($numero_telefone, 0, 2) . ') ' .
               substr($numero_telefone, 2, 1) . ' ' .
               substr($numero_telefone, 3, 4) . '-' .
               substr($numero_telefone, 7, 4);
    } elseif (strlen($numero_telefone) == 10) {
        return '(' . substr($numero_telefone, 0, 2) . ') ' .
               substr($numero_telefone, 2, 4) . '-' .
               substr($numero_telefone, 6, 4);
    } else {
        return $numero_telefone;
    }
}


function formatar_cep($numero_cep)
{
   $numero_cep = preg_replace('/[^0-9]/', '', $numero_cep);

   return substr($numero_cep, 0, 2) . '.' .
          substr($numero_cep, 2, 3) . '-' .
          substr($numero_cep, 5, 3);
}

function formatar_data($data) {
    $timestamp = strtotime($data);
    return date('d/m/Y H:i', $timestamp);
}