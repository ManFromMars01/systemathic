<?php
include('Conninfo.php');
include('template/myclass.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
 
$sql = "SELECT *  FROM  tlevel WHERE  tlevel.ID = '" . $_GET['Level'] . "'" ;
$mylevel = $objConn1->Execute($sql);
$ourlevel =$mylevel->fields["Description"];

$books = $model->select_where('titems',array('IsBook' => 'Yes', 'IsAbacus' => 'Yes' ));
$books2 = $model->select_where('titems',array('IsBook' => 'Yes', 'IsMental' => 'Yes' ));
$books3 = $model->select_where('titems',array('IsBook' => 'Yes', 'IsSupp' => 'Yes' ));
$items4 = $model->select_where('titems',array('IsBook' => 'No'));
$option1 .= "<option></option>";
$option1 .= "<optgroup label='Abacus Books'>"; 
foreach($books as $book):
	$option1 .= "<option value='".$book['ItemNo']."a'>".$book['ItemNo']." ".$book['AbaDesc']."</option>";		     
endforeach;
$option1 .= "</optgroup>";

$option2 .= "<optgroup label='Mental Books'>";
foreach($books2 as $book):
	$option2 .= "<option value='".$book['ItemNo']."m'>".$book['ItemNo']." ".$book['MenDesc']."</option>";		     
endforeach;
$option2 .= "</optgroup>";	

$option3 .="<optgroup label='Supplementary Books'>";
foreach($books3 as $book):
	$option3 .= "<option value='".$book['ItemNo']."s'>".$book['ItemNo']." ".$book['SuppDesc']."</option>";		     
endforeach;
$option3 .= "</optgroup>";	

$option4 .="<optgroup label='Other Items'>";
foreach($items4 as $book):
	$option3 .= "<option value='".$book['ItemNo']."o'> ".$book['ItemNo']." ".$book['Description']."</option>";		     
endforeach;
$option4 .= "</optgroup>";	


$optionall =  $option1.$option2.$option3.$option4;  

$TemplateText = Replace($TemplateText, "@optionall@", $optionall);
$TemplateText = Replace($TemplateText, "@ourlevel@", $ourlevel);

?>    