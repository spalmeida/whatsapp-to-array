<?php

$arquivo = file_get_contents('MINHA_CONVERSA_EXPORTADA.txt');

function rip_tags($string) {
    // ----- remove HTML TAGs -----
    $string = preg_replace ('/<[^>]*>/', ' ', $string); 

    // ----- remove control characters -----
    $string = str_replace("\r", '', $string);    // --- replace with empty space
    $string = str_replace("\n", ' ', $string);   // --- replace with space
    $string = str_replace("\t", ' ', $string);   // --- replace with space

    // ----- remove multiple spaces -----
    $string = trim(preg_replace('/ {2,}/', ' ', $string));

    return $string;

}
$explode = explode(" - ", rip_tags($arquivo));

function ValidaData($dat){
    $data = explode('/',$dat); // fatia a string $dat em pedados, usando / como referência
    if (isset($data[0]) and isset($data[1]) and isset($data[2])) {
       $d = $data[0];
       $m = $data[1];
       $y = date('Y', strtotime($data[2]));

    // verifica se a data é válida!
    // 1 = true (válida)
    // 0 = false (inválida)
       $res = checkdate(
        $m,$d,$y);
       if ($res == 1){
           $info =  true;
       }
   }else{
    $info = false;
}

return $info;
}

$infos = array();

foreach ($explode as $value) {

    if (ValidaData(substr($value, -14))) {
        $nome = explode(':', substr($value,  0,14));
        $text = explode(':', substr($value,  0,-14));

        if (isset($text[1])) {
           if ($text[1] != " ") {
               $infos[] = array(
            'date' => substr($value,  -14),
            'user' => $nome[0],
            'text' => $text[1]
        );
           }
        }else{
            continue;
        }

   }

}

echo '<pre>';
print_r($infos);
echo '</pre>';
