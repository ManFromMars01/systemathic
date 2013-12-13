<?php 


function base_url($addurl = ""){
  $base_url = 'http://localhost/Final/php/'.$addurl;
  return $base_url;
}

function controller($addurl = ""){
  $base_url = 'http://localhost/Final/php/page/controller/'.$addurl.".php";
  return $base_url;
}


function not_login(){
  if($_SESSION['AuthStatus'] != "Authorized"){
    header("Location: ".base_url()."login.php");
  }
}

function box_header($title ="Title"){
$var = '<div class="box-header well" data-original-title="">
            <h2><i class="icon-tasks"></i> '.$title.'</h2>
            <div class="box-icon">
              <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
              <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
            </div>
          </div>';

return $var;
}

function datatable(){
  echo 'class="table table-striped table-bordered bootstrap-datatable datatable"';
}

function tablestyle(){
  echo 'class="table table-striped table-bordered"';
}

function notyme_suc($message = "Save Successfully"){
  echo 'noty({"text":"'.$message.'","layout":"top","type":"success"});';
}

function notyme_danger($message = "Save Successfully"){
  echo 'noty({"text":"'.$message.'","layout":"top","type":"danger"});';
}

function success($msg = '<strong>Well Done!!</strong> Save Successfully'){

  return '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              '.$msg.'
        </div>';
}


function selected($fields,$val){
  if($fields == $val){
    echo "SELECTED";
  }
}

function resize($width, $height){
  /* Get original image x y*/
  list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
  /* calculate new image size with ratio */
  $ratio = max($width/$w, $height/$h);
  $h = ceil($height / $ratio);
  $x = ($w - $width / $ratio) / 2;
  $w = ceil($width / $ratio);
  /* new file name */
  $path = 'uploads/'.$width.'x'.$height.'_'.$_FILES['image']['name'];
  /* read binary data from image file */
  $imgString = file_get_contents($_FILES['image']['tmp_name']);
  /* create image from string */
  $image = imagecreatefromstring($imgString);
  $tmp = imagecreatetruecolor($width, $height);
  imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $width, $height,
    $w, $h);
  /* Save image */
  switch ($_FILES['image']['type']) {
    case 'image/jpeg':
      imagejpeg($tmp, $path, 100);
      break;
    case 'image/png':
      imagepng($tmp, $path, 0);
      break;
    case 'image/gif':
      imagegif($tmp, $path);
      break;
    default:
      exit;
      break;
  }
  return $path;
  /* cleanup memory */
  imagedestroy($image);
  imagedestroy($tmp);
}


function update_link($label,$link){
    echo '<a href="'.$link.'" class="btn btn-info">'.$label.'</a>';
}

function add_link($label,$link){
    echo '<a href="'.$link.'" class="btn btn-success">'.$label.'</a>';
}

function delete_link($label,$link){
    $return = <<<EOS
      <a onclick="return confirm('Are You Sure to Remove this?')" href="$link" class="btn btn-danger">$label</a>
EOS;
echo $return;
}

function successif($message="<strong>Well Done!!</strong> Save Successfully"){
  if(isset($_GET['status'])){
    if($_GET['status'] == "success"){
      echo success($message);
    }
  }
}




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

  public function hide_if($roleid){
   foreach($roleid as $roleids):
      if($roleids == $_SESSION['roleid']){
        echo "style='display:none;'";
      } 
    endforeach;
  }

}


$default = new  Systemathic;

?>