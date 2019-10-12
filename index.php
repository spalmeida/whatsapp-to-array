<?php

 /**
  * @author Samuel Prado Almeida
  * @link 	https://github.com/worldvisual
  * @license MIT
  *
  * Script desenvolvido para filtrar os dados do arquivo de texto
  * exportado de alguma conversa do whatsapp, aqui você pode retornar
  * os dados tanto como array como json e usar da forma que achar melhor
  * os parametros de retorno são:
  *
  * @param date = Horário que amensagem foi enviada
  * @param from = nome ou número de telefone de quem enviou a mensagem
  * @param text = conteúdo da mensagem
  */

class Whatsapp{

	public function filterChat($file, $type = 'array'){
 /*
 |--------------------------------------------------------------------------
 | $fileDir = Diretorio do arquivo de texto exportado pelo whatssapp
 |--------------------------------------------------------------------------
 */
 $fileDir 	= file_get_contents(realpath($file));
 $explode 	= explode(" - ", self::ripTags($fileDir));
 $array 		= array();

 foreach ($explode as $value) {

 	if (self::validDate(substr($value, -14))) {
 /*
 |--------------------------------------------------------------------------
 | $from = nome o usuário
 |--------------------------------------------------------------------------
 */
 $from = explode(':', substr($value,  0,-14));

 /*
 |--------------------------------------------------------------------------
 | $text = conteúdo da mensagem
 |--------------------------------------------------------------------------
 */
 $text = explode(':', substr($value,  0,-14));

 if (isset($text[1])) {
 	if ($text[1] != " ") {
 		$array[] = array(
 			'date' => substr($value,  -14),
 			'from' => $from[0],
 			'text' => $text[1]
 		);
 	}
 }else{
 	continue;
 }

}

}

if($type == 'array'){
	$return = $array;
}else if($type == 'json'){
	$return = json_encode($array);
}

return $return;

}

 /*
 |--------------------------------------------------------------------------
 | ripTags = Função para remover todas as tags html
 |--------------------------------------------------------------------------
 */
 public function ripTags($string) {

 	$string = preg_replace ('/<[^>]*>/', ' ', $string);
 	$string = str_replace("\r", '', $string);
 	$string = str_replace("\n", ' ', $string);
 	$string = str_replace("\t", ' ', $string);
 	$string = trim(preg_replace('/ {2,}/', ' ', $string));

 	return $string;
 }

 /*
 |--------------------------------------------------------------------------
 | validDate = Função para verificar parametro é uma data
 | a data segue esse formato - (d/m/y H:i)
 |--------------------------------------------------------------------------
 */
 public function validDate($dat){

 	$data = explode('/',$dat);
 	if (isset($data[0]) and isset($data[1]) and isset($data[2])) {
 		$d = $data[0];
 		$m = $data[1];
 		$y = date('Y', strtotime($data[2]));

 		$res = checkdate($m,$d,$y);
 		if ($res == 1){
 			$return =  true;
 		}
 	}else{
 		$return = false;
 	}

 	return $return;
 }

}

$whats = new Whatsapp;

echo '<pre>';
print_r($whats->filterChat('MEU_ARQUIVO.txt'));
echo '</pre>';
