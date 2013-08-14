<?php 
$con = mysqli_connect('localhost', 'root','','alternativedb');

if(isset($_GET['id']))
{
$id=$_GET['id'];

mysqli_query($con,"delete from gallery where eid ='$id'");
}
?>


