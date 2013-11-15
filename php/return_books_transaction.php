<?php 
include('template/header.php');
include('template/myclass.php'); 


$custno  = $_GET['CustomerNo'];
$levelid = $_GET['LevelId'];
$itemno  = $_GET['ItemNo'];
$catid   = $_GET['Catid'];
$bl   = $_GET['Bl'];
$bookrepeat  = $_GET['Repeat'];
$nb1 = "";
$nb2 = "";
$nb3 = "";
$Prerequisite = "1";
$Prerequisite2 = "1";
$Prerequisite3 = "1";

$books = $model->select_where('ebooks', array('CustNo' => $custno, 'LevelID' => $levelid, 'ItemNo' => $itemno, 'BookCategory' => $catid, 'BookCount' => $bookrepeat ));




if($catid == 'a'){
    $catname = "Abacus";
    $category = 'Aba';
    $nextbook = $model->select_where('titems',array('ItemNo' => $itemno)); 

    $nb1 = $nextbook->fields['AbaNxtBook1'];
    $nb2 = $nextbook->fields['AbaNxtBook2'];
    $nb3 = $nextbook->fields['AbaNxtBook3'];
    $nc1 = $nextbook->fields['AbaNext1Cat'];
    $nc2 = $nextbook->fields['AbaNext2Cat'];
    $nc3 = $nextbook->fields['AbaNext3Cat'];
    
    
    
    $countexempt = $model->select_count('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl ));
    $countexempt2 = $model->select_count('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl ));
    $countexempt3 = $model->select_count('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl ));
    if($countexempt >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc1 == 'a'){ $catnextnext = 'Aba';  } if($nc1 == 'm'){ $catnextnext = "Men" ;  } if($nc1 == 's'){ $catnextnext = 'Supp';  }  
            $nextnext = $model->select_where('titems',array('ItemNo' => $nb1));
            $nb1= $nextnext->fields[$catnextnext.'NxtBook1'];
            $nc1= $nextnext->fields[$catnextnext.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }

    if($countexempt2 >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc2 == 'a'){ $catnextnext2 = 'Aba';  } if($nc2 == 'm'){ $catnextnext2 = "Men" ;  } if($nc2 == 's'){ $catnextnext2 = 'Supp';  }  
            $nextnext2 = $model->select_where('titems',array('ItemNo' => $nb2));
            $nb2= $nextnext2->fields[$catnextnext2.'NxtBook1'];
            $nc2= $nextnext2->fields[$catnextnext2.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }

    if($countexempt3 >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc3 == 'a'){ $catnextnext3 = 'Aba';  } if($nc3 == 'm'){ $catnextnext3 = "Men" ;  } if($nc3 == 's'){ $catnextnext3 = 'Supp';  }  
            $nextnext3 = $model->select_where('titems',array('ItemNo' => $nb1));
            $nb3= $nextnext3->fields[$catnextnext3.'NxtBook1'];
            $nc3= $nextnext3->fields[$catnextnext3.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }



    
    
    $nextbookdesc1 =  $model->select_where('titems',array('ItemNo'=> $nb1));
    $nextbookdesc2 =  $model->select_where('titems',array('ItemNo'=> $nb2));
    $nextbookdesc3 =  $model->select_where('titems',array('ItemNo'=> $nb3));
    

    $checkPre1   = $nextbookdesc1->fields['AbaPreBook1'] ;
    $checkPre2   = $nextbookdesc2->fields['AbaPreBook1'] ;
    $checkPre3   = $nextbookdesc3->fields['AbaPreBook1'] ;

    if($checkPre1 != ""){  $checkPre1   = $nextbookdesc1->fields['AbaPreBook1'] ; $checkPrecat1   = $nextbookdesc1->fields['PreAbaNext1Cat']; 
        $mywhere  =array('ItemNo' => $checkPre1, 'BookCategory' => $checkPrecat1, 'Status' => 'Returned' );
        $checkmyebook =  $model->select_count('ebooks',$mywhere);  
        $Prerequisite = $checkmyebook;   
    }
    if($checkPre2 != ""){  $checkPre2   = $nextbookdesc2->fields['AbaPreBook1']; $checkPrecat2   = $nextbookdesc2->fields['PreAbaNext1Cat']; 
        $mywhere2  =array('ItemNo' => $checkPre2, 'BookCategory' => $checkPrecat2, 'Status' => 'Returned' );
        $checkmyebook2 =  $model->select_count('ebooks',$mywhere2);  
        $Prerequisite2 = $checkmyebook2; 
    } 
    if($checkPre3 != ""){  $checkPre3   = $nextbookdesc3->fields['AbaPreBook1']; $checkPrecat3   = $nextbookdesc3->fields['PreAbaNext1Cat']; 
        $mywhere3  =array('ItemNo' => $checkPre3, 'BookCategory' => $checkPrecat3, 'Status' => 'Returned' );
        $checkmyebook3 =  $model->select_count('ebooks',$mywhere3);  
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
if($catid == 'm'){
    $catname = "Mental";
    $category = 'Men';
    $nextbook = $model->select_where('titems',array('ItemNo' => $itemno));
    $nb1 = $nextbook->fields['MenNxtBook1'];
    $nb2 = $nextbook->fields['MenNxtBook2'];
    $nb3 = $nextbook->fields['MenNxtBook3'];
    $nc1 = $nextbook->fields['MenNext1Cat'];
    $nc2 = $nextbook->fields['MenNext2Cat'];
    $nc3 = $nextbook->fields['MenNext3Cat'];





    $countexempt = $model->select_count('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl ));
    $countexempt2 = $model->select_count('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl ));
    $countexempt3 = $model->select_count('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl ));
    if($countexempt >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc1 == 'a'){ $catnextnext = 'Aba';  } if($nc1 == 'm'){ $catnextnext = "Men" ;  } if($nc1 == 's'){ $catnextnext = 'Supp';  }  
            $nextnext = $model->select_where('titems',array('ItemNo' => $nb1));
            $nb1= $nextnext->fields[$catnextnext.'NxtBook1'];
            $nc1= $nextnext->fields[$catnextnext.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }

    if($countexempt2 >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc2 == 'a'){ $catnextnext2 = 'Aba';  } if($nc2 == 'm'){ $catnextnext2 = "Men" ;  } if($nc2 == 's'){ $catnextnext2 = 'Supp';  }  
            $nextnext2 = $model->select_where('titems',array('ItemNo' => $nb2));
            $nb2= $nextnext2->fields[$catnextnext2.'NxtBook1'];
            $nc2= $nextnext2->fields[$catnextnext2.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }

    if($countexempt3 >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc3 == 'a'){ $catnextnext3 = 'Aba';  } if($nc3 == 'm'){ $catnextnext3 = "Men" ;  } if($nc3 == 's'){ $catnextnext3 = 'Supp';  }  
            $nextnext3 = $model->select_where('titems',array('ItemNo' => $nb1));
            $nb3= $nextnext3->fields[$catnextnext3.'NxtBook1'];
            $nc3= $nextnext3->fields[$catnextnext3.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }


    $nextbookdesc1 =  $model->select_where('titems',array('ItemNo'=> $nb1));
    $nextbookdesc2 =  $model->select_where('titems',array('ItemNo'=> $nb2));
    $nextbookdesc3 =  $model->select_where('titems',array('ItemNo'=> $nb3));

    $checkPre1   = $nextbookdesc1->fields['MenPreBook1'] ;
    $checkPre2   = $nextbookdesc2->fields['MenPreBook1'] ;
    $checkPre3   = $nextbookdesc3->fields['MenPreBook1'] ;

    if( $checkPre1 != ""){  $checkPre1   = $nextbookdesc1->fields['MenPreBook1'] ; $checkPrecat1   = $nextbookdesc1->fields['PreMenNext1Cat']; 
        $mywhere  =array('ItemNo' => $checkPre1, 'BookCategory' => $checkPrecat1, 'Status' => 'Returned' );
        $checkmyebook =  $model->select_count('ebooks',$mywhere);  
        $Prerequisite = $checkmyebook;   
    }
    if( $checkPre2 != ""){  $checkPre2   = $nextbookdesc2->fields['MenPreBook1']; $checkPrecat2   = $nextbookdesc2->fields['PreMenNext1Cat']; 
        $mywhere2  =array('ItemNo' => $checkPre2, 'BookCategory' => $checkPrecat2, 'Status' => 'Returned' );
        $checkmyebook2 =  $model->select_count('ebooks',$mywhere2);  
        $Prerequisite2 = $checkmyebook2; 
    } 
    if($checkPre3 != ""){  $checkPre3   = $nextbookdesc3->fields['MenPreBook1']; $checkPrecat3   = $nextbookdesc3->fields['PreMenNext1Cat']; 
        $mywhere3  =array('ItemNo' => $checkPre3, 'BookCategory' => $checkPrecat3, 'Status' => 'Returned' );
        $checkmyebook3 =  $model->select_count('ebooks',$mywhere3);  
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
if($catid == 's'){
    $catname = "Supplementary";
    $category = 'Supp';
    $nextbook = $model->select_where('titems',array('ItemNo' => $itemno));
    $nb1 = $nextbook->fields['SuppNxtBook1'];
    $nb2 = $nextbook->fields['SuppNxtBook2'];
    $nb3 = $nextbook->fields['SuppNxtBook3'];
    $nc1 = $nextbook->fields['SuppNext1Cat'];
    $nc2 = $nextbook->fields['SuppNext2Cat'];
    $nc3 = $nextbook->fields['SuppNext3Cat'];



    $countexempt = $model->select_count('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl ));
    $countexempt2 = $model->select_count('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl ));
    $countexempt3 = $model->select_count('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl ));
    if($countexempt >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc1 == 'a'){ $catnextnext = 'Aba';  } if($nc1 == 'm'){ $catnextnext = "Men" ;  } if($nc1 == 's'){ $catnextnext = 'Supp';  }  
            $nextnext = $model->select_where('titems',array('ItemNo' => $nb1));
            $nb1= $nextnext->fields[$catnextnext.'NxtBook1'];
            $nc1= $nextnext->fields[$catnextnext.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb1, 'BookCat' => $nc1, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }

    if($countexempt2 >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc2 == 'a'){ $catnextnext2 = 'Aba';  } if($nc2 == 'm'){ $catnextnext2 = "Men" ;  } if($nc2 == 's'){ $catnextnext2 = 'Supp';  }  
            $nextnext2 = $model->select_where('titems',array('ItemNo' => $nb2));
            $nb2= $nextnext2->fields[$catnextnext2.'NxtBook1'];
            $nc2= $nextnext2->fields[$catnextnext2.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb2, 'BookCat' => $nc2, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }

    if($countexempt3 >= 1){
        for($x = 0; $x<=50; $x++){
            if($nc3 == 'a'){ $catnextnext3 = 'Aba';  } if($nc3 == 'm'){ $catnextnext3 = "Men" ;  } if($nc3 == 's'){ $catnextnext3 = 'Supp';  }  
            $nextnext3 = $model->select_where('titems',array('ItemNo' => $nb1));
            $nb3= $nextnext3->fields[$catnextnext3.'NxtBook1'];
            $nc3= $nextnext3->fields[$catnextnext3.'Next1Cat'];
            $countexempts = $model->select_count('tdbookexempt',array('BookCode' =>$nb3, 'BookCat' => $nc3, 'BookListID' => $bl )); 
            if($countexempts == 0){
                break;
            }
        }
    }


    $nextbookdesc1 =  $model->select_where('titems',array('ItemNo'=> $nb1));
    $nextbookdesc2 =  $model->select_where('titems',array('ItemNo'=> $nb2));
    $nextbookdesc3 =  $model->select_where('titems',array('ItemNo'=> $nb3));

    $checkPre1   = $nextbookdesc1->fields['SuppPreBook1'] ;
    $checkPre2   = $nextbookdesc2->fields['SuppPreBook1'] ;
    $checkPre3   = $nextbookdesc3->fields['SuppPreBook1'] ;

    if($checkPre1 != ""){  $checkPre1   = $nextbookdesc1->fields['SuppPreBook1'] ; $checkPrecat1   = $nextbookdesc1->fields['PreSuppNext1Cat']; 
        $mywhere  =array('ItemNo' => $checkPre1, 'BookCategory' => $checkPrecat1, 'Status' => 'Returned' );
        $checkmyebook =  $model->select_count('ebooks',$mywhere);  
        $Prerequisite = $checkmyebook;   
    }
    if($checkPre2 != ""){  $checkPre2   = $nextbookdesc2->fields['SuppPreBook1']; $checkPrecat2   = $nextbookdesc2->fields['PreSuppNext1Cat']; 
        $mywhere2  =array('ItemNo' => $checkPre2, 'BookCategory' => $checkPrecat2, 'Status' => 'Returned' );
        $checkmyebook2 =  $model->select_count('ebooks',$mywhere2);  
        $Prerequisite2 = $checkmyebook2; 
    } 
    if($checkPre3 != ""){  $checkPre3   = $nextbookdesc3->fields['SuppPreBook1']; $checkPrecat3   = $nextbookdesc3->fields['PreSuppNext1Cat']; 
        $mywhere3  =array('ItemNo' => $checkPre3, 'BookCategory' => $checkPrecat3, 'Status' => 'Returned' );
        $checkmyebook3 =  $model->select_count('ebooks',$mywhere3);  
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


$checkrepeat = $model->select_where('titems', array('ItemNo' => $itemno));
$repeat = $checkrepeat->fields[$category.'RptCnt1'];
echo $checkPre1;
?>
<div id="content" class="span10">
            <!-- content starts -->
            

            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">BookList</a>
                    </li>
                </ul>
            </div>
            

             <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well">
                        <h2><i class="icon-info-sign"></i> Return Book</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form id="form71">
                        <div class="control-group">
                                <label class="control-label" for="focusedInput">Item Code:</label>
                                <div class="controls">
                                  <input type="text" name="itemcode" value="<?php echo $itemno; ?>" readonly>
                                  <input type="hidden" name="custno" value="<?php echo $custno; ?>" >
                                </div>
                            </div>
                         <div class="control-group">
                                <label class="control-label" for="focusedInput">Description:</label>
                                <div class="controls">
                                   <textarea><?php echo $books->fields['Description'] ?></textarea>
                                </div>
                            </div>  

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Category:</label>
                                <div class="controls">
                                  <input type="text" value="<?php echo $catname; ?>" readonly>
                                  <input type="hidden" name="cat" value="<?php echo $catid; ?>">
                                  <input type="hidden" name="booklist" value="<?php echo $_GET['Bl'] ?>">
                                </div>
                            </div> 

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Date Start:</label>
                                <div class="controls">
                                  <input type="text" value="<?php echo $books->fields['DateIssue'];?>" readonly>
                                </div>
                            </div> 

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Date End:</label>
                                <div class="controls">
                                  <input type="text" name="dateend" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <input type="text" name="bookcount" value="<?php echo $books->fields['BookCount'];?>">
                            <input type="text" name="levelid" value="<?php echo $levelid; ?>">  
                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="returnbook">Save changes</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                            </form>   

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>Next Books</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable">
                          <thead>
                              <tr>
                                    <th>Book ID</th>
                                    <th>Description</th>
                                    <th>Category</th>
                              </tr>

                          </thead>   
                          <tbody>

                            
                            <?php if($Prerequisite == '1'): ?>
                                    <?php if($nb1 != "" && $repeat == $books->fields['BookCount']): ?>  
                                    <tr>
                                        <td><?php echo $nb1; ?></td>
                                        <td><?php echo $nb1desc; ?></td>
                                        <td><?php if($nc1 == 'a'){ echo 'Abacus';  } if($nc1 == 'm'){ echo 'Mental' ;  } if($nc1 == 's'){ echo 'Supplementary';  } ?></td> 
                                    </tr>
                                <?php elseif($nb1 == "" && $repeat == $books->fields['BookCount']): ?>
                                     <p>No nextbook available</p>   
                                    <?php else: 
                                     $nb1     =  $itemno; 
                                     $nb1desc = $checkrepeat->fields[$category.'Desc'];
                                     $nc1 = $catname;     
                                    ?>

                                    <tr>
                                        <td><?php echo $nb1; ?></td>
                                        <td><?php echo $nb1desc; ?></td>
                                        <td><?php echo $catname; ?></td> 
                                    </tr>      
                                   <?php endif;  ?>

                            <?php else: ?>
                               <p>Can't Continue To NextBook Need to finishs <?php echo $checkPre1 ?></p>
                            <?php endif; ?>




                        <?php if($Prerequisite2 == '1'): ?>    
                            <?php if($nb2 != ""): ?>  
                            <tr>
                                <td><?php echo $nb2; ?></td>
                                <td><?php echo $nb2desc; ?></td>
                                <td><?php if($nc2 == 'a'){ echo 'Abacus';  } if($nc2 == 'm'){ echo 'Mental' ;  } if($nc2 == 's'){ echo 'Supplementary';  } ?></td>
                            </tr>
                            <?php endif; ?>
                        <?php else: ?>
                               <p>Can't Continue To NextBook Need to finish <?php echo $checkPre2 ?></p>   
                        <?php endif; ?>    
                        

                        <?php if($Prerequisite3 == '1'): ?>    
                            <?php if($nb3 != ""): ?>   
                            <tr>+
                                <td><?php echo $nb3; ?></td>
                                <td><?php echo $nb3desc; ?></td>
                                <td><?php if($nc3 == 'a'){ echo 'Abacus';  } if($nc3 == 'm'){ echo 'Mental' ;  } if($nc3 == 's'){ echo 'Supplementary';  } ?></td>
                            </tr>
                            <?php endif; ?>
                        <?php else: ?>
                               <p>Can't Continue To NextBook Need to finish <?php echo $checkPre3 ?></p>   
                        <?php endif; ?>     

                            
                        	
                            
                           
                          </tbody>
                      </table>           
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->




<script>

$('#returnbook').click(function(){
    $.ajax({
        url: 'template/returnbook_actions.php',
        type: 'post',
        data: $('#form71').serialize(),
        dataType: 'json',
        success: function (j){
            console.log(j);
            $('.modal-body').html(j.status);
           $("#myModal").modal('show');

        }
    })

});
</script>



<?php 
include('template/footer.php'); 
?>