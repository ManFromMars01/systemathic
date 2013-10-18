 <?php
    include('ConnInfo.php');

    $objConn1 = &ADONewConnection($Driver1);
    $objConn1->debug = $DebugMode;
    $objConn1->PConnect($Server1,$User1,$Password1,$db1);
    
    $selectcustomer = "SELECT *  FROM tcustomer  WHERE tcustomer.CustNo = 1 ";
    $selectcustomer = $objConn1->Execute($selectcustomer);

    foreach ($selectcustomer as $customerd) {
        $fname = $customerd['FirstName'];
    }
    /**End LEvel**/

    $TemplateText = Replace($TemplateText, "@fname@", $fname);
    

 ?>   