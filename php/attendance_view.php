<?php 
include('template/header.php');
include('template/myclass.php'); 
$student_no = $_GET['student_no'];

$student = $model->select_where('tcustomer', array('StudentID' => $student_no));
$custno  = $student->fields['CustNo'];
$birthday =  $student->fields['Birthday'];

$date1 = $student->fields['Birthday'];
$date2 = date('Y-m-d');

$ts1 = strtotime($date1);
$ts2 = strtotime($date2);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
$bday = $diff / 12  ;
$bday = round($bday, 1);


$booklist = $model->select_table('thbookexempt');  
$bl = "Normal";
foreach ($booklist as $booklists) {
   $startage = $booklists['StartAge']; 
   $endage   = $booklists['EndAge'];
   if($bday >= $startage  && $endage <= $endage ){
        $bl =  $booklists['BookListID'];
   }
}

echo $bday;
echo $bl;

$booka = $model->select_where('ebooks', array('CustNo' => $custno, 'BookCategory' => 'a', 'Status' => 'Current'));
$bookm = $model->select_where('ebooks', array('CustNo' => $custno, 'BookCategory' => 'm', 'Status' => 'Current'));
$books = $model->select_where('ebooks', array('CustNo' => $custno, 'BookCategory' => 's', 'Status' => 'Current'));

$atta = $model->select_where('eattdtl', array('CustNo' => $custno));


function status_attendance($status){
    $stat_desc = $model->select_where('tastatus', array('ID' => $status));
    $desc = $stat_desc->fields['Description'];
    return $desc;    
}

$success= "";

if(isset($_GET['success'])){
  $success = '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>Well done!</strong> You successfully Updated his/her new Schedule.
            </div>';
}


?>
<div id="content" class="span10">
            <!-- content starts -->
            

            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="BrowseStudentlistreg.php?RegType=Admitted">Student File</a><span class="divider">/</span>
                    </li>
                    <li>
                        <a>Atterdance</a>
                    </li>

                </ul>
            </div>
            

            



            <?php echo $success; ?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>Attendance - <?php  echo $student->fields['SurName'].', '.$student->fields['FirstName'].' '.$student->fields['MiddleName'] ?></h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>


                    <div class="box-content">
                        <!--<a class="btn btn-success" href="Updatetleveladd.php">Add Level</a>-->
                       
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Date</th>
                                    <th>Session No:</th>
                                    <th>Time From:</th>
                                    <th>Time To:</th>
                                    <th>Status:</th>
                              </tr>

                          </thead>   
                          <tbody>

                            <?php foreach($atta as $att): ?>
                            <tr>
                                <?php if($att['MakeUpDate'] ==""): ?>
                                <td><?php echo $att['Date'];  ?></td>
                                
                                <?php else: ?>
                                
                                <td><?php echo $att['MakeUpDate'];?> (Make - Up Class)</td>
                                
                                <?php endif; ?>

                                <td><?php echo $att['SessionNo'];  ?></td>
                                <td><?php echo $att['TimeFrom'];  ?></td>
                                <td><?php echo $att['TimeTo'];  ?></td>
                                <td>
                                <?php 
                                 $attend = $model->select_where('tastatus',array('ID' => $att['StatusID'] ));
                                 $desc = $attend->fields['Description']; 
                                 
                                 
                                 if($desc == "Absent" || $desc == "MakeUp"):
                                      echo $desc. ' <a class="btn btn-info" href="'.base_url("page/controller/make_up.php?cust_no=".$att['CustNo']."&sched_code=".$att['SchedCode']."&date_recent=".$att['Date']).'">Make Up class</a>';
                                 else:
                                    echo "Un-Used";
                                 endif; 
                              

                                ?>
                                </td>
                                
                                
                            </tr>
                            <?php endforeach; ?>
                            
                          </tbody>
                      </table>             
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->









<?php 
include('template/footer.php'); 
?>