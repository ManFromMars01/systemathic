<?php 


function currencyExchange($amount,$baseCurrency,$quoteCurrency) {
    $open = fopen("http://quote.yahoo.com/d/quotes.csv?s=$baseCurrency[0]$quoteCurrency[0]=X&f=sl1d1t1c1ohgv&e=.csv", "r");
    $exchangeRate = fread($open, 2000);
    fclose($open);
    $exchangeRate = str_replace("\"", "", $exchangeRate);
    $exchangeRate = explode(",", $exchangeRate);
    $results = ($exchangeRate[1]*$amount);
    $results = number_format ($results, 2);
    $amount = number_format ($amount);
    $timeStamp = strtotime($exchangeRate[2]);
    $timeStamp = date('F d, Y', $timeStamp);
    $timeStamp = "$timeStamp $exchangeRate[3]";


    return $results; 
}



function base_url($addurl = ""){
	$base_url = 'http://localhost/Final/php/'.$addurl;
	return $base_url;
}


function input_text($label,$name,$id){
	echo '<div class="control-group">
    	<label class="control-label">'.$label.':</label>
         	<div class="controls">
          <input class="" name="'.$name.'"  type="text" value="" id="'.$id.'" >
        </div>
    </div>';
}

function input_password($label,$name,$id){
	echo '<div class="control-group">
    	<label class="control-label">'.$label.':</label>
         	<div class="controls">
          <input class="" name="'.$name.'"  type="password" value="" id="'.$id.'" >
        </div>
    </div>';
}

function breadcrumb($pagename){

echo '<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">'.$pagename.'</a>
        </li>
    </ul>
</div>';
}

function edit_link($yourlink = "",$label){
  echo '<a class="btn btn-info" href="'.$yourlink.'"></i> '.$label.'</a>';
}


function success($msg = '<strong>Well Done!!</strong> Save Successfully'){

  return '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              '.$msg.'
        </div>';
}







Class Systemathic{

	private $base_url = 'http://localhost/Final/php/';

	public function base_url(){
		return $this->base_url;
	}

	public function template($page){
		$return = '../view/template/'.$page.'.php';
		return $return;
	}

	public function main_view($page){
		$return = '../view/'.$page.'.php';
		return $return;
	}

}


$default = new  Systemathic;

?>