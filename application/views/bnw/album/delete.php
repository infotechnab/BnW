<div class="rightSide">
<?php 
$con = mysqli_connect('localhost', 'root','','alternativedb');

if(isset($_GET['id']))
{
$id=$_GET['id'];

mysqli_query($con,"delete from gallery where eid ='$id'");
}
?>
</div>
<div class="clear"></div>
</div>

