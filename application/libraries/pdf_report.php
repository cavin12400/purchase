<?php
defined('BASEPATH') OR exit('No direct access');

/**
* 
*/
require_once dirname(__file__).'/tcpdf.php';
class Pdf_report extends TCPDF
{
	
	function __construct()
	{
		parent::__construct();
	}
}


 ?>