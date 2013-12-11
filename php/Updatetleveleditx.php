<?PHP
include('template/myclass.php');
$update = array('Description' => $_POST['txttlevelDescription'], 'LevelCode' => $_POST['txttlevelLevelCode'], 'Color_Code' => $_POST['txttlevelColor_Code'] );
$model->update_tbl('tlevel',$update,array('ID' => $_POST['ID3']),0);
$status = array('statusme' => "Successfully Updated");
echo json_encode($status);
?>
