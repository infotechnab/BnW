
<script>
    $(document).ready(function () {
        $(".ad").click(function () {
            $(".frm").show();
            $(".ad").hide();
        });
    });
    $("#albumCancel").click(function () {
        $(".frm").hide();

        $("#error").hide();
        $(".ad").show();
    });
</script>
<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            // $("#myModal").css("display","block");
            $(".modal").css("display", "block"); 
        });
         $("#closeme").click(function(){
            // $("#myModal").css("display","block");
            $(".modal").css("display", "none"); 
        });
    });
</script>

<style>

.modal{


  top:150px;
}
.fade{

  opacity: 1;
}
</style>
<div class=" col-md-10 col-sm-9 col-lg-10 col-xs-8 rightside">
        <h2> Add Album</h2>
        <hr class="hr-gradient"/>

       
<div id="sucessmsg">
  <?php if($this->session->flashdata('message'))
            {
            echo "<div class='alert alert-default fade in '>".$this->session->flashdata('message')."</div>"; 

            }?>
    <?php $validation_errors= validation_errors();
    if(isset($validation_errors)){
     echo "<div class='error'>".$validation_errors."</div>"; 

    }
  if(isset($error))
  {
         echo "<div class='error'>".$error."</div>"; 
       }
  ?>
</div>
      <!-- Modal -->
      <button type="button" class="btn btn-default btn-lg btn-block" id="myBtn" data-toggle="modal" data-target="#myModal"><p style="font-size:16px;">create new Album</p></button>
      <hr>
  <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
             <?php echo form_open('album/addalbum'); ?>
             <label>Album name</label>
             <input type="text" class="form-control" name="album_name" placeholder="Album Name" required />
             <br>
             <input type="submit" class="btn btn-default btn-lg btn-block" name="submit" value="Create" />        

             <?php echo form_close(); ?>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default btn-lg "  id="closeme">Close</button>
      </div>
  </div>

</div>
</div>


<?php
if ($query) {
     echo "<div class='row'>";
    foreach ($query as $data) {
        $aid = $data->id;


        $result = $this->dbalbum->get_media_image($aid);
        if ($result) {
            foreach ($result as $abc) {
                ?> 


                <div class="col-md-3 col-lg-3">
                    <a href="<?php echo base_url().'album/photos/'. $data->id ?>">
                        <span>
                            <img height="200" width="200" src="<?php echo base_url(); ?>content/uploads/images/<?php echo $abc->media_type; ?>" id="galleryimage" />
                        </span>

                    </a>
                    <?php echo anchor('album/photos/' . $data->id, $data->album_name); ?> 
                    <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>

                </div>
            <?php
        }
    } else {
        ?>     
        <div id="photodiv" class="action col-md-3 col-lg-3 col-sm-3 col-xs-3"> 

            <div class="well text-center" style="overflow:auto;">
             <a href="#" class="del_category" id="<?php echo $data->id; ?>"><i style="font-size:22px" class="fa fa-trash-o"></i></a>
            <h6>Please add photo to album </h6>
             <p style="font-size:19px;">  <?php echo anchor('album/photos/' . $data->id, $data->album_name); ?> </p>
               </div>

        </div> 



        <?php
    }
}
?> 



<?php
}

if ($this->session->userdata('logged_in'))

    ?>

  <script>
    $(document).ready(function () {
        $(document).on("click", ".del_category", function () {
            var id = $(this).attr("id");
            var url = '<?php echo base_url() . 'index.php/album/delete_album' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid});
        });
    });
</script>


</div>

</div>
</div>
