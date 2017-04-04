<?php

/**
* Class for save the php file and open the dialog download
**/
class Arquivo
{
	
	function __construct(){}//$this->fileName = $fileName;

	/**
	Save the php file
	@fileName php file name
	@text php file class content
	**/
	public function escrever($fileName,$text)
	{
		$fp = fopen($fileName,"a");
		$escreve = fwrite($fp, $text);

		// Open the download dialog
		header("Content-Type: application/save");
		header("Content-Length:".filesize($fileName));
		header('Content-Disposition: attachment;filename="'.$fileName.'"');
		header("Content-Transfer-Enconding: binary");
		header('Expires: 0');
		header('Pragma: no-cache');
		echo($text);

		//Close file
		fpassthru($fp);
		fclose($fp);
	}
}
?>