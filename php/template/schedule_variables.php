 <?php
 session_start();
include_once('../systemathicappdata.php');
include_once('../ConnInfo.php');
include_once('../utils.php');

    $objConn1 = &ADONewConnection($Driver1);
    $objConn1->debug = $DebugMode;
    $objConn1->PConnect($Server1,$User1,$Password1,$db1);
    
    /**Begin LEvel**/
    
    if (isset($_POST['day_name'])){
       
        $selectclass = "SELECT *  FROM tclasssched  WHERE  tclasssched.BranchID='".$_SESSION['UserValue2']."' AND tclasssched.LevelID ='".$_POST['level_id']."' AND tclasssched.Day ='".$_POST['day_name']."' ";
        $selectclass = $objConn1->Execute($selectclass);
        foreach ($selectclass as $selectclasses):
             $option .= "<option value='".$selectclasses['SchedCode']."'>".$selectclasses['TimeFrom']." - ".$selectclasses['TimeTo']." </option>";
        endforeach;
        
        /**End LEvel**/

        $myresult = array('option' => $option);
        echo json_encode($myresult);
    }


    if(isset($_POST['sched_code'])){
        $selectclass = "SELECT *  FROM tclasssched  WHERE  tclasssched.SchedCode='".$_POST['sched_code']."'";
        $selectclass = $objConn1->Execute($selectclass);
        foreach($selectclass as $selectclasses):
            $teacher1 = $selectclasses['TeacherName1'];
            $teacher_name2 = $selectclasses['TeacherName2'];
            $teacher_name3 = $selectclasses['TeacherName3'];
            $teacher_id1 = $selectclasses['TeacherID1'];
            $teacher_id2 = $selectclasses['TeacherID2'];
            $teacher_id3 = $selectclasses['TeacherID3'];
            $roomid        = $selectclasses['RoomID']; 
            $timefrom      = $selectclasses['TimeFrom'];
            $timeto        = $selectclasses['TimeTo'];     
        endforeach;

        $myresult = array('teacher1' => $teacher1, 'roomid' => $roomid, 'timefrom' => $timefrom,  'timeto' => $timeto, 'teacherid1' => $teacher_id1, 'tcname' => $teacher1 );   
        echo json_encode($myresult); 

    }


    if(isset($_POST['day_name2'])){
        $selectclass = "SELECT *  FROM tclasssched  WHERE  tclasssched.BranchID='".$_SESSION['UserValue2']."' AND tclasssched.LevelID ='".$_POST['level_id']."' AND tclasssched.Day ='".$_POST['day_name2']."' ";
        $selectclass = $objConn1->Execute($selectclass);
        foreach ($selectclass as $selectclasses):
             $option .= "<option value='".$selectclasses['SchedCode']."'>".$selectclasses['TimeFrom']." - ".$selectclasses['TimeTo']." </option>";
        endforeach;
        
        /**End LEvel**/

        $myresult = array('option' => $option);
        echo json_encode($myresult); 
    }


    
 ?>  