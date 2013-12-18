  <?php 
  session_start();
  include('../class/model.php'); // dont use $model variable 
  include('../class/systemathic.php'); // dont use $default variable
  
  $AbaNxtBook1 = "";
  $AbaNxtBook2 = "";
  $AbaNxtBook3 = "";

  $AbaNxt1Cat  = "";
  $AbaNxt2Cat  = "";
  $AbaNxt3Cat  = "";
  $AbaPrev1Cat  = "";
  $AbaPrev2Cat  = "";
  $AbaPrev3Cat  = "";

  $AbaPrvBook1 = "";
  $AbaPrvBook2 = "";
  $AbaPrvBook3 = "";

  $AbaPreBook1 = "";
  $AbaPreBook2 = "";
  $AbaPreBook3 = "";

  $AbaPreCat1 = "";
  $AbaPreCat2 = "";
  $AbaPreCat3 = "";


  $MenNxtBook1 = "";
  $MenNxtBook2 = "";
  $MenNxtBook3 = "";
  $MenNxt1Cat  = "";
  $MenNxt2Cat  = "";
  $MenNxt3Cat  = "";
  $MenPrev1Cat  = "";
  $MenPrev2Cat  = "";
  $MenPrev3Cat  = "";

  $MenPrvBook1 = "";
  $MenPrvBook2 = "";
  $MenPrvBook3 = "";

  $MenPreBook1 = "";
  $MenPreBook2 = "";
  $MenPreBook3 = "";

  $MenPreCat1 = "";
  $MenPreCat2 = "";
  $MenPreCat3 = "";

  $SuppNxtBook1 = "";
  $SuppNxtBook2 = "";
  $SuppNxtBook3 = "";

  $SuppPrvBook1 = "";
  $SuppPrvBook2 = "";
  $SuppPrvBook3 = "";

  $SuppPreBook1 = "";
  $SuppPreBook2 = "";
  $SuppPreBook3 = "";

  $SuppPreCat1 = "";
  $SuppPreCat2 = "";
  $SuppPreCat3 = "";

  $SuppNxt1Cat  = "";
  $SuppNxt2Cat  = "";
  $SuppNxt3Cat  = "";
  $SuppPrev1Cat  = "";
  $SuppPrev2Cat  = "";
  $SuppPrev3Cat  = "";


  if(isset($_POST["txttitemsAbaNxtBook1"])){
    $AbaNxtBook1 = substr_replace($_POST["txttitemsAbaNxtBook1"],"",-1);
    $AbaNxt1Cat =  substr($_POST['txttitemsAbaNxtBook1'],-1,1);
  }

  if(isset($_POST["txttitemsAbaNxtBook2"])){
    $AbaNxtBook2 = substr_replace($_POST["txttitemsAbaNxtBook2"],"",-1);
    $AbaNxt2Cat =  substr($_POST['txttitemsAbaNxtBook2'],-1,1);
  }

  if(isset($_POST["txttitemsAbaNxtBook3"])){
    $AbaNxtBook3 = substr_replace($_POST["txttitemsAbaNxtBook3"],"",-1);
    $AbaNxt3Cat =  substr($_POST['txttitemsAbaNxtBook3'],-1,1);
  }

  if(isset($_POST["txttitemsAbaPrvBook1"])){
    $AbaPrvBook1 = substr_replace($_POST["txttitemsAbaPrvBook1"],"",-1);
    $AbaPrev1Cat =  substr($_POST['txttitemsAbaPrvBook1'],-1,1);
  }

  if(isset($_POST["txttitemsAbaPrvBook2"])){
    $AbaPrvBook2 = substr_replace($_POST["txttitemsAbaPrvBook2"],"",-1);
    $AbaPrev2Cat =  substr($_POST['txttitemsAbaPrvBook2'],-1,1);
  }

  if(isset($_POST["txttitemsAbaPrvBook3"])){
    $AbaPrvBook3 = substr_replace($_POST["txttitemsAbaPrvBook3"],"",-1);
    $AbaPrev3Cat =  substr($_POST['txttitemsAbaPrvBook3'],-1,1);
  }

  if(isset($_POST["txttitemsMenNxtBook1"])){
    $MenNxtBook1 = substr_replace($_POST["txttitemsMenNxtBook1"],"",-1);
    $MenNxt1Cat =  substr($_POST['txttitemsMenNxtBook1'],-1,1);
  }

  if(isset($_POST["txttitemsMenNxtBook2"])){
    $MenNxtBook2 = substr_replace($_POST["txttitemsMenNxtBook2"],"",-1);
    $MenNxt2Cat =  substr($_POST['txttitemsMenNxtBook2'],-1,1);
  }

  if(isset($_POST["txttitemsMenNxtBook3"])){
    $MenNxtBook3 = substr_replace($_POST["txttitemsMenNxtBook3"],"",-1);
    $MenNxt3Cat =  substr($_POST['txttitemsMenNxtBook3'],-1,1);
  }

  if(isset($_POST["txttitemsMenPrvBook1"])){
    $MenPrvBook1 = substr_replace($_POST["txttitemsMenPrvBook1"],"",-1);
    $MenPrev1Cat =  substr($_POST['txttitemsMenPrvBook1'],-1,1);
  }

  if(isset($_POST["txttitemsMenPrvBook2"])){
    $MenPrvBook2 = substr_replace($_POST["txttitemsMenPrvBook2"],"",-1);
    $MenPrev2Cat =  substr($_POST['txttitemsMenPrvBook2'],-1,1);
  }

  if(isset($_POST["txttitemsMenPrvBook3"])){
    $MenPrvBook3 = substr_replace($_POST["txttitemsMenPrvBook3"],"",-1);
    $MenPrev3Cat =  substr($_POST['txttitemsMenPrvBook3'],-1,1);
  }


  if(isset($_POST["txttitemsSuppNxtBook1"])){
    $SuppNxtBook1 = substr_replace($_POST["txttitemsSuppNxtBook1"],"",-1);
    $SuppNxt1Cat =  substr($_POST['txttitemsSuppNxtBook1'],-1,1);
  }

  if(isset($_POST["txttitemsSuppNxtBook2"])){
    $SuppNxtBook2 = substr_replace($_POST["txttitemsSuppNxtBook2"],"",-1);
    $SuppNxt2Cat =  substr($_POST['txttitemsSuppNxtBook2'],-1,1);
  }

  if(isset($_POST["txttitemsSuppNxtBook3"])){
    $SuppNxtBook3 = substr_replace($_POST["txttitemsSuppNxtBook3"],"",-1);
    $SuppNxt3Cat =  substr($_POST['txttitemsSuppNxtBook3'],-1,1);
  }

  if(isset($_POST["txttitemsSuppPrvBook1"])){
    $SuppPrvBook1 = substr_replace($_POST["txttitemsSuppPrvBook1"],"",-1);
    $SuppPrev1Cat =  substr($_POST['txttitemsSuppPrvBook1'],-1,1);
  }

  if(isset($_POST["txttitemsSuppPrvBook2"])){
    $SuppPrvBook2 = substr_replace($_POST["txttitemsSuppPrvBook2"],"",-1);
    $SuppPrev2Cat =  substr($_POST['txttitemsSuppPrvBook2'],-1,1);
  }

  if(isset($_POST["txttitemsSuppPrvBook3"])){
    $SuppPrvBook3 = substr_replace($_POST["txttitemsSuppPrvBook3"],"",-1);
    $SuppPrev3Cat =  substr($_POST['txttitemsSuppPrvBook3'],-1,1);
  }



  if(isset($_POST["txttitemsAbaPreBook1"])){
    $AbaPreBook1 = substr_replace($_POST["txttitemsAbaPreBook1"],"",-1);
    $AbaPreCat1 =  substr($_POST['txttitemsAbaPreBook1'],-1,1);
  }

  if(isset($_POST["txttitemsAbaPreBook2"])){
    $AbaPreBook2 = substr_replace($_POST["txttitemsAbaPreBook2"],"",-1);
    $AbaPreCat2 =  substr($_POST['txttitemsAbaPreBook2'],-1,1);
  }

  if(isset($_POST["txttitemsAbaPreBook3"])){
    $AbaPreBook3 = substr_replace($_POST["txttitemsAbaPreBook3"],"",-1);
    $AbaPreCat3 =  substr($_POST['txttitemsAbaPreBook3'],-1,1);
  }

  if(isset($_POST["txttitemsMenPreBook1"])){
    $MenPreBook1 = substr_replace($_POST["txttitemsMenPreBook1"],"",-1);
    $MenPreCat1 =  substr($_POST['txttitemsMenPreBook1'],-1,1);
  }

  if(isset($_POST["txttitemsMenPreBook2"])){
    $MenPreBook2 = substr_replace($_POST["txttitemsMenPreBook2"],"",-1);
    $MenPreCat2 =  substr($_POST['txttitemsMenPreBook2'],-1,1);
  }

  if(isset($_POST["txttitemsMenPreBook3"])){
    $MenPreBook3 = substr_replace($_POST["txttitemsMenPreBook3"],"",-1);
    $MenPreCat3 =  substr($_POST['txttitemsMenPreBook3'],-1,1);
  }

  if(isset($_POST["txttitemsSuppPreBook1"])){
    $SuppPreBook1 = substr_replace($_POST["txttitemsSuppPreBook1"],"",-1);
    $SuppPreCat1 =  substr($_POST['txttitemsSuppPreBook1'],-1,1);
  }

  if(isset($_POST["txttitemsSuppPreBook2"])){
    $SuppPreBook2 = substr_replace($_POST["txttitemsSuppPreBook2"],"",-1);
    $SuppPreCat2 =  substr($_POST['txttitemsSuppPreBook2'],-1,1);
  }

  if(isset($_POST["txttitemsSuppPreBook3"])){
    $SuppPreBook3 = substr_replace($_POST["txttitemsSuppPreBook3"],"",-1);
    $SuppPreCat3 =  substr($_POST['txttitemsSuppPreBook3'],-1,1);
  }



  $toupdate = array(
  "Description" => $_POST["txttitemsDescription"],
  "IsAbacus" => $_POST["txttitemsIsAbacus"],
  "IsMental" => $_POST["txttitemsIsMental"],
  "IsSupp" => $_POST["txttitemsIsSupp"],
  "AbaDesc" => $_POST["txttitemsAbaDesc"],
  "MenDesc" => $_POST["txttitemsMenDesc"],
  "SuppDesc" => $_POST["txttitemsSuppDesc"],
  "AbaNxtBook1" => $AbaNxtBook1,
  "AbaNxtBook2" => $AbaNxtBook2,
  "AbaNxtBook3" => $AbaNxtBook3,
  "AbaPrvBook1" => $AbaPrvBook1,
  "AbaPrvBook2" => $AbaPrvBook2,
  "AbaPrvBook3" => $AbaPrvBook3,
  "AbaPreBook1" => $AbaPreBook1,
  "AbaPreBook2" => $AbaPreBook2,
  "AbaPreBook3" => $AbaPreBook3,
  "AbaRptCnt1" => $_POST["txttitemsAbaRptCnt1"],
  //"AbaRptCnt2" => $_POST["txttitemsAbaRptCnt2"],
  //"AbaRptCnt3" => $_POST["txttitemsAbaRptCnt3"],
  "AbaDigitStart" => $_POST["txttitemsAbaDigitStart"],
  "AbaDigitEnd" => $_POST["txttitemsAbaDigitEnd"],
  "AbaNumStart" => $_POST["txttitemsAbaNumStart"],
  "AbaNumEnd" => $_POST["txttitemsAbaNumEnd"],
  "AbaBookGrade" => $_POST["txttitemsAbaBookGrade"],
  "MenNxtBook1" => $MenNxtBook1,
  "MenNxtBook2" => $MenNxtBook2,
  "MenNxtBook3" => $MenNxtBook3,
  "MenPrvBook1" => $MenPrvBook1,
  "MenPrvBook2" => $MenPrvBook2,
  "MenPrvBook3" => $MenPrvBook3,
  "MenPreBook1" => $MenPreBook1,
  "MenPreBook2" => $MenPreBook2,
  "MenPreBook3" => $MenPreBook3,
  "MenRptCnt1" =>  $_POST["txttitemsMenRptCnt1"], 
  //"MenRptCnt2" => $_POST["txttitemsMenRptCnt2"], 
  //"MenRptCnt3" => $_POST["txttitemsMenRptCnt3"],
  "MenDigitStart" => $_POST["txttitemsMenDigitStart"],
  "MenDigitEnd" => $_POST["txttitemsMenDigitEnd"],
  "MenNumStart" => $_POST["txttitemsMenNumStart"],
  "MenNumEnd" => $_POST["txttitemsMenNumEnd"],
  "MenBookGrade" => $_POST["txttitemsMenBookGrade"],
  "SuppNxtBook1" => $SuppNxtBook1,
  "SuppNxtBook2" => $SuppNxtBook2,
  "SuppNxtBook3" => $SuppNxtBook3,
  "SuppPrvBook1" => $SuppPrvBook1,
  "SuppPrvBook2" => $SuppPrvBook2,
  "SuppPrvBook3" => $SuppPrvBook3,
  "SuppPreBook1" => $SuppPreBook1,
  "SuppPreBook2" => $SuppPreBook2,
  "SuppPreBook3" => $SuppPreBook3,
  "SuppRptCnt1" => $_POST["txttitemsSuppRptCnt1"],
  //"SuppRptCnt2" => $_POST["txttitemsSuppRptCnt2"],
  //"SuppRptCnt3" => $_POST["txttitemsSuppRptCnt3"],
  "SuppDigitStart" => $_POST["txttitemsSuppDigitStart"],
  "SuppDigitEnd" => $_POST["txttitemsSuppDigitEnd"],
  "SuppNumStart" => $_POST["txttitemsSuppNumStart"],
  "SuppNumEnd" => $_POST["txttitemsSuppNumEnd"],
  "SuppBookGrade" => $_POST["txttitemsSuppBookGrade"],
  //"SubCatID" => $_POST["txttitemsSubCatID"],
  "AbaNext1Cat" => $AbaNxt1Cat,
  "AbaNext2Cat" => $AbaNxt2Cat,
  "AbaNext3Cat" => $AbaNxt3Cat,
  "AbaPrev1Cat" => $AbaPrev1Cat,
  "AbaPrev2Cat" => $AbaPrev2Cat,
  "AbaPrev3Cat" => $AbaPrev3Cat,
  "MenNext1Cat" => $MenNxt1Cat,
  "MenNext2Cat" => $MenNxt2Cat,
  "MenNext3Cat" => $MenNxt3Cat,
  "MenPrev1Cat" => $MenPrev1Cat,
  "MenPrev2Cat" => $MenPrev2Cat,
  "MenPrev3Cat" => $MenPrev3Cat,
  "SuppNext1Cat" => $SuppNxt1Cat,
  "SuppNext2Cat" => $SuppNxt2Cat,
  "SuppNext3Cat" => $SuppNxt3Cat,
  "SuppPrev1Cat" => $SuppPrev1Cat,
  "SuppPrev2Cat" => $SuppPrev2Cat,
  "SuppPrev3Cat" => $SuppPrev3Cat,
  "PreSuppNext1Cat" => $SuppPreCat1,
  "PreSuppNext2Cat" => $SuppPreCat2,
  "PreSuppNext3Cat" => $SuppPreCat3,
  "PreAbaNext1Cat" => $AbaPreCat1,
  "PreAbaNext2Cat" => $AbaPreCat2,
  "PreAbaNext3Cat" => $AbaPreCat3,
  "PreMenNext1Cat" => $MenPreCat1,
  "PreMenNext2Cat" => $MenPreCat2,
  "PreMenNext3Cat" => $MenPreCat3,
  );

  $toupdate2 = array(
    'CountryID' => "TW",
    'BranchID'  => "TW001",
    'IssuUntCost' =>  $_POST['txttitemsIssuUntCost'],// magkakano  nagastos 
    'PurUntCost'  =>  $_POST['txttitemsPurUntCost'],  // price for branch
    'StdCost'     =>  $_POST['txttitemsStdCost'],   // price for customer
    'QtyOnHand'   =>  $_POST['txttitemsQtyOnHand'] 
  );


  $model->update_tbl('titems',$toupdate,array('Sku' => $_POST["sku"]));
  $model->update_tbl('thitems',$toupdate2,array('Sku' => $_POST["sku"], 'BranchID' => 'TW001'));
  $success = "Update Successfullys";
  
  $myStatus  = array('mystatus2' => $success);
  echo json_encode($myStatus);   

  ?>