<script type="text/javascript">
$(window).scroll(function()
{
  var totalHeight = $(document).height();
  var a ='700';
  var Pos = totalHeight -a;
  var top = window.pageYOffset;
  if(top >= Pos)
  {
      
      $('#loading').show();
       $.ajax({
        url: "<?php echo base_url().'index.php/view/map'?>",
        success: function(msg)
        {   
            $("#mapDivFull").css("display","block");
            $("#mapDivFull").html(msg);
        },
        complete: function(){
        $('#loading').hide();
      }
        });
  }
  
});
</script>
<style>
    #mapDivFull
    {
        display: none;
        width: 100%;
        padding-top: 20px;
        padding-bottom: 20px;
        min-height: 400px;
    }
    #loading
{
    display: none;
    z-index: 9999;
    text-align: center;
    padding-top: 100px;
}
</style>

<div id="mapDivFull">
    <div id="loading"> <img width="30" src="<?php echo base_url().'content/uploads/basicImages/loading.gif' ; ?>" alt="loading.."/><br><b>Loading...</b></div>
</div>
<div class="clearfix"></div>