
<script>
    $(document).ready(function () {
        imgPos();
        
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
<div class="rightSide">
    <h2> Add Album</h2>
    <hr class="hr-gradient"/>
    <div id="sucessmsg">
        <?php
        echo $this->session->flashdata('message');
        echo validation_errors();
        if (isset($error)) {
            echo $error;
        }
        ?>
    </div>



    <div id="newAlbum">
        <a class="ad" href="#" style="position: relative; top: 50px; left: 0px;" >Create new album </a>
        <div id="error">

        </div>
        <div class="frm" style="width:150px; height:90px; float: left; display:none; z-index:105; " >
            <?php echo form_open('album/addalbum'); ?>
            <input type="text" class="input-text-small" name="album_name" placeholder="Album Name" required />
            <input type="submit" class="submit-button-small" name="submit" value="Create" />        
            <input type="button" class="submit-button-small" id="albumCancel" name="Close" value="cancel"/>
            <?php echo form_close(); ?>
        </div>
    </div>

    <?php
    if ($query) {
        foreach ($query as $data) {
            $aid = $data->id;


            $result = $this->dbalbum->get_media_image($aid);
            if ($result) {
                foreach ($result as $abc) {
                    ?> 


                    <div id="photodiv" class="action">

                        <a href="<?php echo base_url().'album/photos/'. $data->id ?>">
                        <div class="imageContainer">
                            <span>
                                <img src="<?php echo base_url(); ?>content/uploads/images/<?php echo $abc->media_type; ?>" id="galleryimage" />
                            </span>
                        </div>
                        </a>
                        <div id="imagetitle">
                            <?php echo anchor('album/photos/' . $data->id, $data->album_name); ?> 
                        </div>
                        
                        <div id="imagetitle">
                            <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
                        </div>

                    </div> 


                    <?php
                }
            } else {
                ?>     
                <div id="photodiv" class="action"> 

                    <h4 style="text-align: center" >Please add photo to album <?php echo $data->album_name; ?></h4>
                    <div id="imagetitle">
                        <?php echo anchor('album/photos/' . $data->id, $data->album_name); ?> 
                    </div>
                    <div id="imagetitle">
                    <span class="del_category" id="<?php echo $data->id; ?>"><i class="fa fa-trash-o"></i></span>
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


</div>
<div class="clear"></div>
</div>
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