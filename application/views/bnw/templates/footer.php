<?php if(isset($meta))
{
     foreach ($meta as $data)
     {
         $title[] = $data->value;
     }
}
?>   
<br/>
<br/>
<hr>
<div id="footer_left">
<p>Copyright &copy; <?php echo $title[1]; ?> 2013</p>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
<div id="footer_right">
    <img src="<?php echo base_url()."/content/images/bnw.png"; ?>"/>
</div>
<div class="clear"/>
</div>

</body>
</html>