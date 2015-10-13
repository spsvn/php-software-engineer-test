<?php
namespace SoftwareEngineerTest;
use PDO;
/**
 * function to simply check input
 * to prevent sql injection
 */
function validateInput($str)
{
    $str = str_replace("and","",$str);
    $str = str_replace("execute","",$str);
    $str = str_replace("update","",$str);
    $str = str_replace("count","",$str);
    $str = str_replace("chr","",$str);
    $str = str_replace("mid","",$str);
    $str = str_replace("master","",$str);
    $str = str_replace("truncate","",$str);
    $str = str_replace("char","",$str);
    $str = str_replace("declare","",$str);
    $str = str_replace("select","",$str);
    $str = str_replace("create","",$str);
    $str = str_replace("delete","",$str);
    $str = str_replace("insert","",$str);
    $str = str_replace("'","",$str);
    $str = str_replace(" ","",$str);
    $str = str_replace("or","",$str);
    $str = str_replace("=","",$str);
    $str = str_replace("%20","",$str);
   return $str;
}

// Question 1a
$DB_HOST = 'localhost';
$DB_NAME = 'test';
$DB_USER = 'test';
$DB_PASS = 'test';

// get PDO DB
try{
    $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'test', 'test', array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

//check whether get parameter or not
if(isset($_GET['occupation_name'])){
    $parameter = validateInput($_GET['occupation_name']);
}else{
    $parameter = null;
}
if( $parameter ){
    $where  = '`occupation`.occupation_name =' ."'".$parameter."'";
}else{
    $where = '1';
}
$sql = sprintf('SELECT * FROM `customer` as `customer` left join `customer_occupation` as `occupation` on
                    `customer`.customer_occupation_id = `occupation`.customer_occupation_id where %s',$where);
$dbResult = $db->query($sql);
$results = $dbResult->fetchAll(PDO::FETCH_ASSOC);
?>



<h2>Customer List</h2>

<table>
    <tr>
        <th>Customer ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Occupation</th>
    </tr>
    <?php foreach($results as $result):?>
         <tr>
             <td><?php echo $result['customer_id']?></td>
             <td><?php echo $result['first_name']?></td>
             <td><?php echo $result['last_name']?></td>
             <td><?php echo ( !is_null($result['occupation_name']) ) ? $result['occupation_name'] : 'un-employed';?></td>
         </tr>
    <?php endforeach;?>
</table>

