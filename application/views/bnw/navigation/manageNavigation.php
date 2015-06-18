<div id="body">
    <p style="color: red;">
        <?php if (isset($token_error)) {
            echo $token_error;
        } ?>
    </p>
    <p style="color: green;">
<?php if (isset($token_sucess)) {
    echo $token_sucess;
} ?>
    </p>
    
    <p id="sucessmsg">
    <?php if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    } ?>
    </p>
    <h5>List of Navigation</h5>
    <hr class="hr-gradient"/>
    
    <?php
    if (!empty($query)) {
        ?>
        <?php
        $this->load->helper('managenav_helper');

        fetch_menu(query(0));
        ?>
    <?php
    } else {
        echo '<h3>Sorry navigation items are not available</h3>';
    }
    ?>



</div>
<div class="clear"></div>
</div>
<div id="fadeDivs"></div>
<script>
   
    $(document).ready(function () {
        $(document).on("click", "#fadeDiv", function(){
            $("#editBoxNav").hide();
            $(this).hide();
        });
        
        $(document).on("click", ".editNavName", function () {
            var selectedValue = $("#NavNameId").val();
            var navname = $("#navigation_name").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/dashboard/updatenavigation'; ?>",
                data: {
                    'id': selectedValue,
                    'navName': navname
                },
                success: function (msg)
                {
                    $("#editBoxNav").hide();
                    $("#fadeDivs").hide();
                    $("#msges").html("Navigation Updated");
                    //refresh latest data.
                    var selectBox = document.getElementById("selectBox");
                    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                    var dataString = 'menu_id_next=' + selectedValue;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'index.php/dashboard/manageNavigation'; ?>",
                        data: dataString,
                        success: function (msg)
                        {
                            $("#cssmenu").html(msg);
                        }
                    });
                }


            });
        });

        $(document).on("click", ".editNavs", function (e) {
            var id = $(this).attr("id");
            var name = $(this).parent().prev("#navName").html();
            var p = $("#editBoxNav").width();
            var hp = $("#editBoxNav").height();
            var w = $(window).width();
            var h = $(window).height();
            var topp = $(window).scrollTop();

            var b = w - p;
            var lr = b / 2;
            var tp = (h - hp) / 2;
            var toppos = topp + tp;
            $("#fadeDivs").width($(document).width());
            $("#fadeDivs").height($(document).height());
            $("#fadeDivs").show();
            $('.editBoxNav').css("left", lr);
            $('.editBoxNav').css("top", toppos - 200);
            $('.editBoxNav').show();
            $("#navigation_name").val(name);
            $("#NavNameId").val(id);

            $("#editBoxNav").show();
            e.preventDefault();
        });
        $(document).on("click", ".deleteNav", function () {
            var id = $(this).attr("id");
            var url = '<?php echo base_url().'index.php/dashboard/deletenavigation' ?>';
            var hideid = $(this);
            senddata({id:id,url:url,thiss:hideid,nav:"yes"});
            e.preventDefault();
        });
        $(".upNav").one("click", function () {
            
        var id = $(this).attr("id");
                $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/dashboard/up'; ?>",
                data: {
                    'id': id
                },
                success: function (msg)
                {
                    //refresh latest data.
                    var selectBox = document.getElementById("selectBox");
                    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                    var dataString = 'menu_id_next=' + selectedValue;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'index.php/dashboard/manageNavigation'; ?>",
                        data: dataString,
                        success: function (msg)
                        {
                            $("#cssmenu").html(msg);
                        }
                    });
                }


            });
        return false;    
        });
        $(".downNav").one("click", function () {
            var id = $(this).attr("id");
                $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/dashboard/down'; ?>",
                data: {
                    'id': id
                },
                success: function (msg)
                {
                    //refresh latest data.
                    var selectBox = document.getElementById("selectBox");
                    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                    var dataString = 'menu_id_next=' + selectedValue;
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'index.php/dashboard/manageNavigation'; ?>",
                        data: dataString,
                        success: function (msg)
                        {
                            $("#cssmenu").html(msg);
                        }
                    });
                }


            });
        });
        
        
    });
</script>

<div id="editBoxNav" class="editBoxNav">
    <div>
        <div style="background: #ddd;padding: 3%;"><h3>Edit Navigation</h3></div>
        <div style="padding: 4%;">
            <div> Enter Navigation Name :</div>
            <div style="margin: 3% 0"><input type="text" value="" id='navigation_name' style="width: 100%;" /></div>
            <input type="hidden" value="" id="NavNameId">
            <input type="button" value="Update" class="editNavName" />
        </div>

        
    </div>
</div>

<style>
    .editBoxNav{position: absolute;display: none;border: 1px solid #eee;height: 150px;width: 300px;background: #fff;z-index: 9999}
    #fadeDivs{position: absolute;background: rgba(0,0,0,0.9);z-index: 999;top: 0;left: 0;}
</style>
