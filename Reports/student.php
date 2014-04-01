<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('../Library/PHPJasperXML/tcpdf/tcpdf.php');
include_once("../Library/PHPJasperXML/PHPJasperXML.inc.php");
include "../Config/DbSettings.php";

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->load_xml_file("student.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file

?>
