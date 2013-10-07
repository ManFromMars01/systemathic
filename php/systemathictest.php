<?PHP
session_start();
include_once('systemathicappdata.php');
include_once('utils.php');
include_once('ConnInfo.php');
//

$objConn = &ADONewConnection($Driver1);
$objConn->debug = $DebugMode;
$objConn->PConnect($Server1,$User1,$Password1,$db1);
//
$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
$bolFailed = false;
$phpversion = phpversion();
if (getGet("info") == "php"):
    phpinfo();
    exit;
endif;
print <<<END_OF_PRINT_BLOCK
<html>
<title>Clarion/PHP Configuration Test Page for systemathic</title>
<body>
<h1>Clarion/PHP Configuration Test Page for systemathic</h1>
This series of tests will help you verify that your 
installation and application settings are adequate
to execute <b>systemathic</b><br>
Please remember to remove this script from your production server!<br>
<hr>
Clarion/PHP version: <code>2.1</code><br>
PHP version: <code>$phpversion</code><br>
ADOdb version: <code>$ADODB_vers</code><br>
<hr>
<h2>Connection object</h2>
The first test will be to test the connection object<BR>
END_OF_PRINT_BLOCK;
$bolfailed = false;
if ($objConn):
    print "There is a valid Connection object!<br>\n";
    $Params = preg_split("/\|/","$Driver1|$Server1|$User1|$Password1|$db1");
    print "The data driver is   : <code>" . $Params[0] . "</code><br>\n";
    print "The data server is   : <code>" . $Params[1] . "</code><br>\n";   
    print "The user is          : <code>" . $Params[2] . "</code><br>\n";   
    print "The password is      : <code>" . $Params[3] . "</code><br>\n";   
    print "The database is      : <code>" . $Params[4] . "</code><br>\n";
    unset($Params);
else:
print <<<END_OF_PRINT_BLOCK
There is no valid Connection object!<br>
Failure! Some possible causes to review:<br>
<dl>
  <dt style="FONT-WEIGHT: bold">Missing AppData.php file
  <dd>Did you deploy your AppData file to the server?
  <dt style="FONT-WEIGHT: bold">Application name 
  <dd>The support files created are application name specific, did you change the 
  application name?
</dl>
END_OF_PRINT_BLOCK;
exit;
endif;
print "<H2>Database Tables</H2>";
print "Creating Table Schema information<br>\n";
$objRS = $objConn->MetaTables();
if ($objRS):
print "Found the following tables:<br>\n";
$i = 0;
while ($i < count($objRS)):
 print "<code>" . $objRS[$i] . "</code><br>";
 $i++;
endwhile;
unset($objRS);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
// test the sql statements
print "<h2>Testing Browse Procedure SQL Statements</h2>";
print "<table border=1 width=80%><tr><td>";
print "<table border=0 width=100%>";
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseRoom</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT troom.CountryID, troom.BranchID, troom.ID, troom.Description, troom.TotalSeat FROM troom");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT troom.CountryID, troom.BranchID, troom.ID, troom.Description, troom.TotalSeat FROM troom",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseExamFile</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT eexamfile.CountryID, eexamfile.BranchID, eexamfile.Date, eexamfile.TimeFrom, eexamfile.TimeTo, eexamfile.OpenDate, eexamfile.CloseDate, eexamfile.SubmitDate, eexamfile.MenFee FROM eexamfile");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT eexamfile.CountryID, eexamfile.BranchID, eexamfile.Date, eexamfile.TimeFrom, eexamfile.TimeTo, eexamfile.OpenDate, eexamfile.CloseDate, eexamfile.SubmitDate, eexamfile.MenFee FROM eexamfile",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseRoyalty</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT troyalty.CountryID, troyalty.BranchID, troyalty.ID, troyalty.Description, troyalty.Percent, troyalty.PctToMaster, troyalty.Source, troyalty.Recipient FROM troyalty");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT troyalty.CountryID, troyalty.BranchID, troyalty.ID, troyalty.Description, troyalty.Percent, troyalty.PctToMaster, troyalty.Source, troyalty.Recipient FROM troyalty",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseStudent</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tcustomer.CountryID, tcustomer.BranchID, tcustomer.CustNo, tcustomer.StudentID, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, tcustomer.LSurname, tcustomer.LFirstName FROM tcustomer");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tcustomer.CountryID, tcustomer.BranchID, tcustomer.CustNo, tcustomer.StudentID, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, tcustomer.LSurname, tcustomer.LFirstName FROM tcustomer",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseSchedList</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tclasssched.CountryID, tclasssched.BranchID, tclasssched.Day, tclasssched.TimeFrom, tclasssched.TimeTo, tclasssched.LevelID, tclasssched.TeacherCnt, tclasssched.TeacherID1, tclasssched.TeacherID2 FROM tclasssched");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tclasssched.CountryID, tclasssched.BranchID, tclasssched.Day, tclasssched.TimeFrom, tclasssched.TimeTo, tclasssched.LevelID, tclasssched.TeacherCnt, tclasssched.TeacherID1, tclasssched.TeacherID2 FROM tclasssched",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>Browsetcountry</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tcountry.ID, tcountry.Description, tcountry.Phone, tcountry.Email, tcountry.Contact, tcountry.Master FROM tcountry");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tcountry.ID, tcountry.Description, tcountry.Phone, tcountry.Email, tcountry.Contact, tcountry.Master FROM tcountry",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseCategory</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tcategory.CountryID, tcategory.BranchID, tcategory.ID, tcategory.Description FROM tcategory");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tcategory.CountryID, tcategory.BranchID, tcategory.ID, tcategory.Description FROM tcategory",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseAssessment</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tassessment.CountryID, tassessment.BranchID, tassessment.ID, tassessment.Description FROM tassessment");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tassessment.CountryID, tassessment.BranchID, tassessment.ID, tassessment.Description FROM tassessment",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseUnitMeas</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tunitmeas.CountryID, tunitmeas.BranchID, tunitmeas.ID, tunitmeas.Description FROM tunitmeas");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tunitmeas.CountryID, tunitmeas.BranchID, tunitmeas.ID, tunitmeas.Description FROM tunitmeas",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseTax</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT ttaxtab.CountryID, ttaxtab.BranchID, ttaxtab.TaxID, ttaxtab.Description, ttaxtab.Rate, ttaxtab.Dept, ttaxtab.Account, ttaxtab.CurrTaxAmt, ttaxtab.MTDTaxAmt FROM ttaxtab");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT ttaxtab.CountryID, ttaxtab.BranchID, ttaxtab.TaxID, ttaxtab.Description, ttaxtab.Rate, ttaxtab.Dept, ttaxtab.Account, ttaxtab.CurrTaxAmt, ttaxtab.MTDTaxAmt FROM ttaxtab",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseDiscount</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tdiscount.CountryID, tdiscount.BranchID, tdiscount.Code, tdiscount.Description, tdiscount.Discount FROM tdiscount");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tdiscount.CountryID, tdiscount.BranchID, tdiscount.Code, tdiscount.Description, tdiscount.Discount FROM tdiscount",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseManufacturer</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tmanufacturer.CountryID, tmanufacturer.BranchID, tmanufacturer.ID, tmanufacturer.Description FROM tmanufacturer");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tmanufacturer.CountryID, tmanufacturer.BranchID, tmanufacturer.ID, tmanufacturer.Description FROM tmanufacturer",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseTeacher</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tteacher.CountryID, tteacher.BranchID, tteacher.ID, tteacher.Name, tteacher.DateStart, tteacher.PhoneNo, tteacher.MobileNo, tteacher.Email FROM tteacher");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tteacher.CountryID, tteacher.BranchID, tteacher.ID, tteacher.Name, tteacher.DateStart, tteacher.PhoneNo, tteacher.MobileNo, tteacher.Email FROM tteacher",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseLocation</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tlocation.CountryID, tlocation.BranchID, tlocation.ID, tlocation.Description FROM tlocation");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tlocation.CountryID, tlocation.BranchID, tlocation.ID, tlocation.Description FROM tlocation",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseDept</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tdepartment.CountryID, tdepartment.BranchID, tdepartment.ID, tdepartment.Description FROM tdepartment");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tdepartment.CountryID, tdepartment.BranchID, tdepartment.ID, tdepartment.Description FROM tdepartment",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>Browsetbranch</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tbranch.CountryID, tbranch.BranchID, tbranch.Description, tbranch.Phone, tbranch.Email, tbranch.Contact, tbranch.HQOperation, tbranch.HQCenterOperation FROM tbranch");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tbranch.CountryID, tbranch.BranchID, tbranch.Description, tbranch.Phone, tbranch.Email, tbranch.Contact, tbranch.HQOperation, tbranch.HQCenterOperation FROM tbranch",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseItems</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT titems.CountryID, titems.BranchID, titems.ItemNo, titems.Description, titems.IsBook, titems.IsMultiCat, titems.IsAbacus, titems.IsMental, titems.IsSupp FROM titems");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT titems.CountryID, titems.BranchID, titems.ItemNo, titems.Description, titems.IsBook, titems.IsMultiCat, titems.IsAbacus, titems.IsMental, titems.IsSupp FROM titems",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseLevel</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tlevel.CountryID, tlevel.BranchID, tlevel.ID, tlevel.Description FROM tlevel");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tlevel.CountryID, tlevel.BranchID, tlevel.ID, tlevel.Description FROM tlevel",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseTier</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT ttier.CountryID, ttier.BranchID, ttier.ID, ttier.Description FROM ttier");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT ttier.CountryID, ttier.BranchID, ttier.ID, ttier.Description FROM ttier",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseSubCateg</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tsubcateg.CountryID, tsubcateg.BranchID, tsubcateg.CatID, tsubcateg.SubCatID, tsubcateg.Description FROM tsubcateg");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tsubcateg.CountryID, tsubcateg.BranchID, tsubcateg.CatID, tsubcateg.SubCatID, tsubcateg.Description FROM tsubcateg",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseAttendanceStatus</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tastatus.CountryID, tastatus.BranchID, tastatus.ID, tastatus.Description FROM tastatus");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tastatus.CountryID, tastatus.BranchID, tastatus.ID, tastatus.Description FROM tastatus",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseSeminar</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tseminar.CountryID, tseminar.BranchID, tseminar.ID, tseminar.Description FROM tseminar");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tseminar.CountryID, tseminar.BranchID, tseminar.ID, tseminar.Description FROM tseminar",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseCurrency</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tcurrency.CountryID, tcurrency.BranchID, tcurrency.ID, tcurrency.Description, tcurrency.Rate, tcurrency.Symbol FROM tcurrency");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tcurrency.CountryID, tcurrency.BranchID, tcurrency.ID, tcurrency.Description, tcurrency.Rate, tcurrency.Symbol FROM tcurrency",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseOnline</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT eonline.CountryID, eonline.BranchID, eonline.CustNo, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, eonline.Date, eonline.Password FROM eonline  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eonline.CountryID AND  tcustomer.BranchID = eonline.BranchID AND  tcustomer.CustNo = eonline.CustNo");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT eonline.CountryID, eonline.BranchID, eonline.CustNo, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, eonline.Date, eonline.Password FROM eonline  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eonline.CountryID AND  tcustomer.BranchID = eonline.BranchID AND  tcustomer.CustNo = eonline.CustNo",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseReferral</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT treferral.CountryID, treferral.BranchID, treferral.ID, treferral.Description FROM treferral");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT treferral.CountryID, treferral.BranchID, treferral.ID, treferral.Description FROM treferral",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "<tr>\n";
print "<td bgcolor=#C0C0C0>Procedure</td><td bgcolor=#E1E1E1>BrowseVendor</td><tr>\n";
$sqlStr = str_replace(",",", ","SELECT tvendor.CountryID, tvendor.BranchID, tvendor.ID, tvendor.Name, tvendor.Address1, tvendor.Address2, tvendor.City, tvendor.Zip, tvendor.Fax FROM tvendor");
print "<td>Statement</td><td width=80%><code>" . $sqlStr . "</code></td><tr>\n";
$sqlStr = "";
$objRS = $objConn->SelectLimit("SELECT tvendor.CountryID, tvendor.BranchID, tvendor.ID, tvendor.Name, tvendor.Address1, tvendor.Address2, tvendor.City, tvendor.Zip, tvendor.Fax FROM tvendor",1);
if ($objRS):
    print "<tr><td>Result</td><td bgcolor=#80FF80><code>Success!</code></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";    
    unset($objRS);
else:
    print "<td>Result</td><td bgcolor=#FF8080><code>Failed!</code></td><tr>\n"; 
    print "<td colspan=2><strong>" . $objConn->ErrorMsg() . "</strong></td><tr>\n";
    print "<tr><td colspan=2>&nbsp;</td><tr>\n";        
endif;
print "</td></tr></table></table>\n";
else:
 print "<td>Failed!</td><td>\n";
 print $objConn->ErrorMsg();
print "</td></tr></table></table>\n"; 
 exit;
endif;
unset($objConn);
print <<<END_OF_PRINT_BLOCK
</body>
</html>
END_OF_PRINT_BLOCK;
?>
