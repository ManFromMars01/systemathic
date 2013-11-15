<?php
    include('myclass.php'); 
	$itemcode = $_POST['itemcode'];
	$cat      = $_POST['cat'];
	$dateend  = $_POST['dateend'];
	$bookcount = $_POST['bookcount'];
	$levelid   = $_POST['levelid'];
	$custno    = $_POST['custno'];
	$bl        = $_POST['booklist'];     

	$customer_det = $model->select_where2('tcustomer', array('CustNo' => $custno));
	$toupdate = array('DateReturned' => $dateend, 'Status' => 'Returned'  );
	$where    = array('ItemNo' => $itemcode, 'CustNo' =>$custno, 'LevelID' => $levelid, 'BookCount' => $bookcount, 'BookCategory' => $cat  );
	$model->update_tbl('ebooks',$toupdate,$where,1);


	$nb1 = "";
	$nb2 = "";
	$nb3 = "";
	$Prerequisite = "1";
    $Prerequisite2 = "1";
    $Prerequisite3 = "1";

$books = $model->select_where2('ebooks', array('CustNo' => $custno, 'LevelID' => $levelid, 'ItemNo' => $itemcode, 'BookCategory' => $cat, 'BookCount' => $bookcount ));




if($cat == 'a'){
    $catname = "Abacus";
    $category = 'Aba';
    $nextbook = $model->select_where2('titems',array('ItemNo' => $itemcode)); 

    $nb1 = $nextbook->fields['AbaNxtBook1'];
    $nb2 = $nextbook->fields['AbaNxtBook2'];
    $nb3 = $nextbook->fields['AbaNxtBook3'];
    $nc1 = $nextbook->fields['AbaNext1Cat'];
    $nc2 = $nextbook->fields['AbaNext2Cat'];
    $nc3 = $nextbook->fields['AbaNext3Cat'];
    
    
    if($bl != "Normal" ){
	    $countexempt = $model->select_count2('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl ));
	    $countexempt2 = $model->select_count2('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl ));
	    $countexempt3 = $model->select_count2('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl ));
	    if($countexempt >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc1 == 'a'){ $catnextnext = 'Aba';  } if($nc1 == 'm'){ $catnextnext = "Men" ;  } if($nc1 == 's'){ $catnextnext = 'Supp';  }  
	            $nextnext = $model->select_where2('titems',array('ItemNo' => $nb1));
	            $nb1= $nextnext->fields[$catnextnext.'NxtBook1'];
	            $nc1= $nextnext->fields[$catnextnext.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }

	    if($countexempt2 >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc2 == 'a'){ $catnextnext2 = 'Aba';  } if($nc2 == 'm'){ $catnextnext2 = "Men" ;  } if($nc2 == 's'){ $catnextnext2 = 'Supp';  }  
	            $nextnext2 = $model->select_where2('titems',array('ItemNo' => $nb2));
	            $nb2= $nextnext2->fields[$catnextnext2.'NxtBook1'];
	            $nc2= $nextnext2->fields[$catnextnext2.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }

	    if($countexempt3 >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc3 == 'a'){ $catnextnext3 = 'Aba';  } if($nc3 == 'm'){ $catnextnext3 = "Men" ;  } if($nc3 == 's'){ $catnextnext3 = 'Supp';  }  
	            $nextnext3 = $model->select_where2('titems',array('ItemNo' => $nb1));
	            $nb3= $nextnext3->fields[$catnextnext3.'NxtBook1'];
	            $nc3= $nextnext3->fields[$catnextnext3.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }
	}



    
    
    $nextbookdesc1 =  $model->select_where2('titems',array('ItemNo'=> $nb1));
    $nextbookdesc2 =  $model->select_where2('titems',array('ItemNo'=> $nb2));
    $nextbookdesc3 =  $model->select_where2('titems',array('ItemNo'=> $nb3));
    

    $checkPre1   = $nextbookdesc1->fields['AbaPreBook1'] ;
    $checkPre2   = $nextbookdesc2->fields['AbaPreBook1'] ;
    $checkPre3   = $nextbookdesc3->fields['AbaPreBook1'] ;

    if($checkPre1 != ""){  $checkPre1   = $nextbookdesc1->fields['AbaPreBook1'] ; $checkPrecat1   = $nextbookdesc1->fields['PreAbaNext1Cat']; 
        $mywhere  =array('ItemNo' => $checkPre1, 'BookCategory' => $checkPrecat1, 'Status' => 'Returned' );
        $checkmyebook =  $model->select_count2('ebooks',$mywhere);  
        $Prerequisite = $checkmyebook;   
    }
    if($checkPre2 != ""){  $checkPre2   = $nextbookdesc2->fields['AbaPreBook1']; $checkPrecat2   = $nextbookdesc2->fields['PreAbaNext1Cat']; 
        $mywhere2  =array('ItemNo' => $checkPre2, 'BookCategory' => $checkPrecat2, 'Status' => 'Returned' );
        $checkmyebook2 =  $model->select_count2('ebooks',$mywhere2);  
        $Prerequisite2 = $checkmyebook2; 
    } 
    if($checkPre3 != ""){  $checkPre3   = $nextbookdesc3->fields['AbaPreBook1']; $checkPrecat3   = $nextbookdesc3->fields['PreAbaNext1Cat']; 
        $mywhere3  =array('ItemNo' => $checkPre3, 'BookCategory' => $checkPrecat3, 'Status' => 'Returned' );
        $checkmyebook3 =  $model->select_count2('ebooks',$mywhere3);  
        $Prerequisite3 = $checkmyebook3; 
    }

    if($nc1 == 'a'){ $nb1desc =$nextbookdesc1->fields['AbaDesc']; }
    if($nc2 == 'a'){ $nb2desc =$nextbookdesc2->fields['AbaDesc']; }
    if($nc3 == 'a'){ $nb3desc =$nextbookdesc3->fields['AbaDesc']; }

    if($nc1 == 'm'){ $nb1desc =$nextbookdesc1->fields['MenDesc']; }
    if($nc2 == 'm'){ $nb2desc =$nextbookdesc2->fields['MenDesc']; }
    if($nc3 == 'm'){ $nb3desc =$nextbookdesc3->fields['MenDesc']; }

    if($nc1 == 's'){ $nb1desc =$nextbookdesc1->fields['SuppDesc']; }
    if($nc2 == 's'){ $nb2desc =$nextbookdesc2->fields['SuppDesc']; }
    if($nc3 == 's'){ $nb3desc =$nextbookdesc3->fields['SuppDesc']; }
    


}
if($cat == 'm'){
    $catname = "Mental";
    $category = 'Men';
    $nextbook = $model->select_where2('titems',array('ItemNo' => $itemcode));
    $nb1 = $nextbook->fields['MenNxtBook1'];
    $nb2 = $nextbook->fields['MenNxtBook2'];
    $nb3 = $nextbook->fields['MenNxtBook3'];
    $nc1 = $nextbook->fields['MenNext1Cat'];
    $nc2 = $nextbook->fields['MenNext2Cat'];
    $nc3 = $nextbook->fields['MenNext3Cat'];




    if($bl != "Normal" ){
	    $countexempt = $model->select_count2('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl ));
	    $countexempt2 = $model->select_count2('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl ));
	    $countexempt3 = $model->select_count2('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl ));
	    if($countexempt >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc1 == 'a'){ $catnextnext = 'Aba';  } if($nc1 == 'm'){ $catnextnext = "Men" ;  } if($nc1 == 's'){ $catnextnext = 'Supp';  }  
	            $nextnext = $model->select_where2('titems',array('ItemNo' => $nb1));
	            $nb1= $nextnext->fields[$catnextnext.'NxtBook1'];
	            $nc1= $nextnext->fields[$catnextnext.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }

	    if($countexempt2 >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc2 == 'a'){ $catnextnext2 = 'Aba';  } if($nc2 == 'm'){ $catnextnext2 = "Men" ;  } if($nc2 == 's'){ $catnextnext2 = 'Supp';  }  
	            $nextnext2 = $model->select_where2('titems',array('ItemNo' => $nb2));
	            $nb2= $nextnext2->fields[$catnextnext2.'NxtBook1'];
	            $nc2= $nextnext2->fields[$catnextnext2.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }

	    if($countexempt3 >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc3 == 'a'){ $catnextnext3 = 'Aba';  } if($nc3 == 'm'){ $catnextnext3 = "Men" ;  } if($nc3 == 's'){ $catnextnext3 = 'Supp';  }  
	            $nextnext3 = $model->select_where2('titems',array('ItemNo' => $nb1));
	            $nb3= $nextnext3->fields[$catnextnext3.'NxtBook1'];
	            $nc3= $nextnext3->fields[$catnextnext3.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }
	}


    $nextbookdesc1 =  $model->select_where2('titems',array('ItemNo'=> $nb1));
    $nextbookdesc2 =  $model->select_where2('titems',array('ItemNo'=> $nb2));
    $nextbookdesc3 =  $model->select_where2('titems',array('ItemNo'=> $nb3));

    $checkPre1   = $nextbookdesc1->fields['MenPreBook1'] ;
    $checkPre2   = $nextbookdesc2->fields['MenPreBook1'] ;
    $checkPre3   = $nextbookdesc3->fields['MenPreBook1'] ;

    if( $checkPre1 != ""){  $checkPre1   = $nextbookdesc1->fields['MenPreBook1'] ; $checkPrecat1   = $nextbookdesc1->fields['PreMenNext1Cat']; 
        $mywhere  =array('ItemNo' => $checkPre1, 'BookCategory' => $checkPrecat1, 'Status' => 'Returned' );
        $checkmyebook =  $model->select_count2('ebooks',$mywhere);  
        $Prerequisite = $checkmyebook;   
    }
    if( $checkPre2 != ""){  $checkPre2   = $nextbookdesc2->fields['MenPreBook1']; $checkPrecat2   = $nextbookdesc2->fields['PreMenNext1Cat']; 
        $mywhere2  =array('ItemNo' => $checkPre2, 'BookCategory' => $checkPrecat2, 'Status' => 'Returned' );
        $checkmyebook2 =  $model->select_count2('ebooks',$mywhere2);  
        $Prerequisite2 = $checkmyebook2; 
    } 
    if($checkPre3 != ""){  $checkPre3   = $nextbookdesc3->fields['MenPreBook1']; $checkPrecat3   = $nextbookdesc3->fields['PreMenNext1Cat']; 
        $mywhere3  =array('ItemNo' => $checkPre3, 'BookCategory' => $checkPrecat3, 'Status' => 'Returned' );
        $checkmyebook3 =  $model->select_count2('ebooks',$mywhere3);  
        $Prerequisite3 = $checkmyebook3; 
    }

    
    if($nc1 == 'a'){ $nb1desc =$nextbookdesc1->fields['AbaDesc']; }
    if($nc2 == 'a'){ $nb2desc =$nextbookdesc2->fields['AbaDesc']; }
    if($nc3 == 'a'){ $nb3desc =$nextbookdesc3->fields['AbaDesc']; }

    if($nc1 == 'm'){ $nb1desc =$nextbookdesc1->fields['MenDesc']; }
    if($nc2 == 'm'){ $nb2desc =$nextbookdesc2->fields['MenDesc']; }
    if($nc3 == 'm'){ $nb3desc =$nextbookdesc3->fields['MenDesc']; }

    if($nc1 == 's'){ $nb1desc =$nextbookdesc1->fields['SuppDesc']; }
    if($nc2 == 's'){ $nb2desc =$nextbookdesc2->fields['SuppDesc']; }
    if($nc3 == 's'){ $nb3desc =$nextbookdesc3->fields['SuppDesc']; }




}
if($cat == 's'){
    $catname = "Supplementary";
    $category = 'Supp';
    $nextbook = $model->select_where2('titems',array('ItemNo' => $itemcode));
    $nb1 = $nextbook->fields['SuppNxtBook1'];
    $nb2 = $nextbook->fields['SuppNxtBook2'];
    $nb3 = $nextbook->fields['SuppNxtBook3'];
    $nc1 = $nextbook->fields['SuppNext1Cat'];
    $nc2 = $nextbook->fields['SuppNext2Cat'];
    $nc3 = $nextbook->fields['SuppNext3Cat'];


    if($bl != "Normal" ){
	    $countexempt = $model->select_count2('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl ));
	    $countexempt2 = $model->select_count2('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl ));
	    $countexempt3 = $model->select_count2('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl ));
	    if($countexempt >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc1 == 'a'){ $catnextnext = 'Aba';  } if($nc1 == 'm'){ $catnextnext = "Men" ;  } if($nc1 == 's'){ $catnextnext = 'Supp';  }  
	            $nextnext = $model->select_where2('titems',array('ItemNo' => $nb1));
	            $nb1= $nextnext->fields[$catnextnext.'NxtBook1'];
	            $nc1= $nextnext->fields[$catnextnext.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }

	    if($countexempt2 >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc2 == 'a'){ $catnextnext2 = 'Aba';  } if($nc2 == 'm'){ $catnextnext2 = "Men" ;  } if($nc2 == 's'){ $catnextnext2 = 'Supp';  }  
	            $nextnext2 = $model->select_where2('titems',array('ItemNo' => $nb2));
	            $nb2= $nextnext2->fields[$catnextnext2.'NxtBook1'];
	            $nc2= $nextnext2->fields[$catnextnext2.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }

	    if($countexempt3 >= 1){
	        for($x = 0; $x<=50; $x++){
	            if($nc3 == 'a'){ $catnextnext3 = 'Aba';  } if($nc3 == 'm'){ $catnextnext3 = "Men" ;  } if($nc3 == 's'){ $catnextnext3 = 'Supp';  }  
	            $nextnext3 = $model->select_where2('titems',array('ItemNo' => $nb1));
	            $nb3= $nextnext3->fields[$catnextnext3.'NxtBook1'];
	            $nc3= $nextnext3->fields[$catnextnext3.'Next1Cat'];
	            $countexempts = $model->select_count2('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl )); 
	            if($countexempts == 0){
	                break;
	            }
	        }
	    }
	}    

    $nextbookdesc1 =  $model->select_where2('titems',array('ItemNo'=> $nb1));
    $nextbookdesc2 =  $model->select_where2('titems',array('ItemNo'=> $nb2));
    $nextbookdesc3 =  $model->select_where2('titems',array('ItemNo'=> $nb3));

    $checkPre1   = $nextbookdesc1->fields['SuppPreBook1'] ;
    $checkPre2   = $nextbookdesc2->fields['SuppPreBook1'] ;
    $checkPre3   = $nextbookdesc3->fields['SuppPreBook1'] ;

    if($checkPre1 != ""){  $checkPre1   = $nextbookdesc1->fields['SuppPreBook1'] ; $checkPrecat1   = $nextbookdesc1->fields['PreSuppNext1Cat']; 
        $mywhere  =array('ItemNo' => $checkPre1, 'BookCategory' => $checkPrecat1, 'Status' => 'Returned' );
        $checkmyebook =  $model->select_count2('ebooks',$mywhere);  
        $Prerequisite = $checkmyebook;   
    }
    if($checkPre2 != ""){  $checkPre2   = $nextbookdesc2->fields['SuppPreBook1']; $checkPrecat2   = $nextbookdesc2->fields['PreSuppNext1Cat']; 
        $mywhere2  =array('ItemNo' => $checkPre2, 'BookCategory' => $checkPrecat2, 'Status' => 'Returned' );
        $checkmyebook2 =  $model->select_count2('ebooks',$mywhere2);  
        $Prerequisite2 = $checkmyebook2; 
    } 
    if($checkPre3 != ""){  $checkPre3   = $nextbookdesc3->fields['SuppPreBook1']; $checkPrecat3   = $nextbookdesc3->fields['PreSuppNext1Cat']; 
        $mywhere3  =array('ItemNo' => $checkPre3, 'BookCategory' => $checkPrecat3, 'Status' => 'Returned' );
        $checkmyebook3 =  $model->select_count2('ebooks',$mywhere3);  
        $Prerequisite3 = $checkmyebook3; 
    }

    if($nc1 == 'a'){ $nb1desc =$nextbookdesc1->fields['AbaDesc']; }
    if($nc2 == 'a'){ $nb2desc =$nextbookdesc2->fields['AbaDesc']; }
    if($nc3 == 'a'){ $nb3desc =$nextbookdesc3->fields['AbaDesc']; }

    if($nc1 == 'm'){ $nb1desc =$nextbookdesc1->fields['MenDesc']; }
    if($nc2 == 'm'){ $nb2desc =$nextbookdesc2->fields['MenDesc']; }
    if($nc3 == 'm'){ $nb3desc =$nextbookdesc3->fields['MenDesc']; }

    if($nc1 == 's'){ $nb1desc =$nextbookdesc1->fields['SuppDesc']; }
    if($nc2 == 's'){ $nb2desc =$nextbookdesc2->fields['SuppDesc']; }
    if($nc3 == 's'){ $nb3desc =$nextbookdesc3->fields['SuppDesc']; }


    
}


$checkrepeat = $model->select_where2('titems', array('ItemNo' => $itemcode));
$repeat = $checkrepeat->fields[$category.'RptCnt1'];






   if($Prerequisite == '1'):
			
	   if($nb1 != "" && $repeat == $books->fields['BookCount']  ):
	      	$toinsert = array('CustNo' => $custno, 'LevelID' => $levelid, 'ItemType' => '1',  'CountryID' => $customer_det->fields['CountryID'], 'BranchID' => $customer_det->fields['BranchID'],  'ItemNo' => $nb1, 'Description' => $nb1desc, 'Qty' => '1', 'DateIssue' => date('Y-m-d'), 'BookCount' => '1', 'Iskit' =>'', 'BookCategory' => $nc1, 'Status' => 'Current' );
	   		$model->insert_tbl('ebooks',$toinsert,1);

	   elseif($nb1 == "" && $repeat == $books->fields['BookCount']):
	   		

	   else:
	   	$nb1     =  $itemcode; 
	    $nb1desc = $checkrepeat->fields[$category.'Desc'];
	    $nc1 = $cat;
	    $newbookcount = $books->fields['BookCount'] + 1;     
	    $toinsert = array('CustNo' => $custno, 'LevelID' => $levelid, 'ItemType' => '1',  'CountryID' => $customer_det->fields['CountryID'], 'BranchID' => $customer_det->fields['BranchID'],  'ItemNo' => $nb1, 'Description' => $nb1desc, 'Qty' => '1', 'DateIssue' => date('Y-m-d'), 'BookCount' => $newbookcount, 'Iskit' =>'', 'BookCategory' => $nc1, 'Status' => 'Current');
	   	$model->insert_tbl('ebooks',$toinsert,1);
	   endif;
	else:
		
	endif;   
   
   	if($Prerequisite2 == '1'): 
	   if($nb2 != ""):   
	   		$toinsert = array('CustNo' => $custno, 'LevelID' => $levelid, 'ItemType' => '1',   'CountryID' => $customer_det->fields['CountryID'], 'BranchID' => $customer_det->fields['BranchID'],  'ItemNo' => $nb2, 'Description' => $nb2desc, 'Qty' => '1', 'DateIssue' => date('Y-m-d'), 'BookCount' => '1', 'Iskit' =>'', 'BookCategory' => $nc2, 'Status' => 'Current' );
	   		$model->insert_tbl('ebooks',$toinsert,1);		
	   endif;
	endif;   

	if($Prerequisite3 == '1'):
	   if($nb3 != ""):   
	   		$toinsert = array('CustNo' => $custno, 'LevelID' => $levelid, 'ItemType' => '1',   'CountryID' => $customer_det->fields['CountryID'], 'BranchID' => $customer_det->fields['BranchID'],  'ItemNo' => $nb3, 'Description' => $nb3desc, 'Qty' => '1', 'DateIssue' => date('Y-m-d'), 'BookCount' => '1', 'Iskit' =>'', 'BookCategory' => $nc3, 'Status' => 'Current' );
	   		$model->insert_tbl('ebooks',$toinsert,1);
	   endif;
	endif;   	


  $mystatus =  array('status' => $nb1);
  echo json_encode($mystatus);

?>