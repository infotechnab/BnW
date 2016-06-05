<?php
$data['template'] = $this->load->view('menuview/template_meta_data');
$gadgetDisplay = template_function();
$this->load->helper('tamplate_helper');
$recentPostGadget = recent_post();
?>
<script>
//This is to toggle for new gadgets
$(document).ready(function() {
      $('.modal-content').css("display","none");
  $(".onlyNumerics").keydown(function (event) {
    var num = event.keyCode;
    if ((num > 95 && num < 106) || (num > 36 && num < 41) || num == 9) {
      return;
    }
    if (event.shiftKey || event.ctrlKey || event.altKey) {
      event.preventDefault();
    } else if (num != 46 && num != 8) {
      if (isNaN(parseInt(String.fromCharCode(event.which)))) {
        event.preventDefault();
      }
    }
  });
  $('#arrow').html("˅");
  $('#title').click(function() {
    $(this).toggleClass('active');
    if ($(this).hasClass('active'))
    $('#title #arrow').html("˄");
    else
    $('#title #arrow').html("˅");
    $('#description').slideToggle("fast");
  });

  $('#arrow1').html("˅");
  $('#title1').click(function() {
    $(this).toggleClass('active');
    if ($(this).hasClass('active'))
    $('#title1 #arrow1').html("˄");
    else
    $('#title1 #arrow1').html("˅");
    $('.modal-content').slideToggle("fast");
  });

});

</script>
<style>
.btn-block{
  width:100%;
}
.modal-dialog {
    margin: 30px auto;
    width: 100%;
}
#arrow1 {
  background: #000 none repeat scroll 0 0;
    border-radius: 10px;
    color: white;
    float: right;
    height: 20px;
    margin-left: 444px;
    margin-right: 5px;
    margin-top: -23px;
    padding: 3px 3px 7px;
    position: relative;
    right: 40px;
    text-align: center;
    width: 20px;
}




</style>

<div class=" col-md-10 col-sm-10 col-lg-10 col-xs-10 rightside">

  <!-- rightside open -->
  <div class="row">
  <!-- ********************************** LEFT SIDE GADEGETS **********************************************8 -->
 <div class="col-md-5 col-lg-5">
  <div id="forLeftPage"><h2>Gadgets</h2></div>
  <div id="main"> <!-- main open -->

    <div id="nav_location"> <!-- nav_location open -->
      <ul>
        <li class="list-item">Header</li>
        <ul class='header_gadgets'  id='option_gadget'>

          <?php
          foreach ($gaget as $datas) {

            if ($datas->display == "Header") {
              $setting = $datas->setting;
              parse_str($setting);
              // echo $post;
              //echo $titleBold;
              //echo $titleUnderline;
              //echo $titleColor;
              ?>
              <li class="action">
                <div id='single_gadget_edit'>
                  <div class='whole'>
                    <div class='name'>
                      <?php echo $datas->name; ?>
                    </div>              <!-- close name div-->
                    <div id='option'>
                      <div id='delete_option'>

                        <span class="del_category" id="<?php echo $datas->gadget_id; ?>"><i class="fa fa-trash-o"></i></span>
                      </div> <!--delete_option div close-->
                    </div> <!--option div close-->
                  </div> <!--close whole div-->

                  <div>
                    <div id="edit_recentPost_toggle">

                      <?php if ($datas->defaultGadget == 'recent post') { ?>
                        <div id="recentPostEdit">
                          <div id="description_for_gadget">
                            <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                            <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                            <input type="hidden" value="recent post" name="recentPost_gadget">
                            <input type='hidden' value='header' name='display'>
                            <table id="table" border="0">

                              <?php
                              //   var_dump($a);
                              foreach ($recentPostGadget as $element) {
                                ?>
                                <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php
                                if (!empty($post)) {
                                  echo $post;
                                }
                                ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
                                <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php
                                if (!empty($titleBold)) {
                                  echo 'checked';
                                }
                                ?>></td></tr>
                                <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php
                                if (!empty($titleUnderline)) {
                                  echo 'checked';
                                }
                                ?>></td></tr>
                                <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php
                                if (!empty($titleColor)) {
                                  echo $titleColor;
                                }
                                ?>'></td></tr>
                                <?php
                              }
                              ?>
                            </table>
                          </div>
                          <div>


                            <input type="submit" value="Update Gadget" id="btn" name="submit">
                            <?php echo form_close(); ?>
                          </div>

                        </div> <!-- recentPostEdit div close -->
                      </div>
                    </div>
                    <?php
                  } else if ($datas->defaultGadget !== 'recent post') {
                    ?>

                    <div id="textEdit">
                      <?php echo form_open('gadgets/textBoxUpdate'); ?>
                      <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                      <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                      <input type='hidden' value='header' name='display'>
                      <div>



                        <input type="submit" value="Update Gadget" id="btn" name="submit">
                        <?php echo form_close(); ?>
                      </div>
                    </div>

                    <?php }
                    ?>

                    <div>

                    </div>
                  </div>
                </li>
                <?php
              }
            }
            ?>
          </ul>

          <li class="list-item">Sidebar<div class="arrow"></div></li>
          <ul  id='option_gadget' class='sidebar_gadgets'>

            <?php
            foreach ($gaget as $datas) {

              if ($datas->display == "Sidebar") {
                $setting = $datas->setting;
                parse_str($setting);
                // echo $post;
                //echo $titleBold;
                //echo $titleUnderline;
                //echo $titleColor;
                ?>
                <li class="action">
                  <div id='single_gadget_edit'>
                    <div class='whole'>
                      <div class='name'>
                        <?php echo $datas->name; ?>
                      </div>              <!-- close name div-->
                      <div id='option'>
                        <div id='delete_option'>
                          <span class="del_category" id="<?php echo $datas->gadget_id; ?>"><i class="fa fa-trash-o"></i></span>
                        </div> <!--delete_option div close-->
                      </div> <!--option div close-->
                    </div> <!--close whole div-->

                    <div>
                      <div id="edit_recentPost_toggle">

                        <?php if ($datas->defaultGadget == 'recent post') { ?>
                          <div id="recentPostEdit">
                            <div id="description_for_gadget">
                              <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                              <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                              <input type="hidden" value="recent post" name="recentPost_gadget">
                              <input type='hidden' value='sidebar' name='display'>
                              <table id="table" border="0">

                                <?php
                                //   var_dump($a);
                                foreach ($recentPostGadget as $element) {
                                  ?>
                                  <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php
                                  if (!empty($post)) {
                                    echo $post;
                                  }
                                  ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
                                  <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php
                                  if (!empty($titleBold)) {
                                    echo 'checked';
                                  }
                                  ?>></td></tr>
                                  <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php
                                  if (!empty($titleUnderline)) {
                                    echo 'checked';
                                  }
                                  ?>></td></tr>
                                  <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php
                                  if (!empty($titleColor)) {
                                    echo $titleColor;
                                  }
                                  ?>'></td></tr>
                                  <?php
                                }
                                ?>
                              </table>
                            </div>
                            <div>



                              <input type="submit" value="Update Gadget" id="btn" name="submit">
                              <?php echo form_close(); ?>
                            </div>

                          </div> <!-- recentPostEdit div close -->
                        </div>
                      </div>
                      <?php
                    } else if ($datas->defaultGadget !== 'recent post') {
                      ?>

                      <div id="textEdit">
                        <?php echo form_open('gadgets/textBoxUpdate'); ?>
                        <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                        <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                        <input type='hidden' value='sidebar' name='display'>
                        <div>



                          <input type="submit" value="Update Gadget" id="btn" name="submit">
                          <?php echo form_close(); ?>
                        </div>
                      </div>

                      <?php }
                      ?>

                      <div>

                      </div>
                    </div>
                  </li>
                  <?php
                }
              }
              ?>
            </ul>

            <li class="list-item">Body<div class="arrow"></div></li>
            <ul  id='option_gadget' class='body_gadgets'>

              <?php
              foreach ($gaget as $datas) {

                if ($datas->display == "Body") {
                  $setting = $datas->setting;
                  parse_str($setting);
                  // echo $post;
                  //echo $titleBold;
                  //echo $titleUnderline;
                  //echo $titleColor;
                  ?>
                  <li class="action">
                    <div id='single_gadget_edit'>
                      <div class='whole'>
                        <div class='name'>
                          <?php echo $datas->name; ?>
                        </div>              <!-- close name div-->
                        <div id='option'>
                          <div id='delete_option'>
                            <span class="del_category" id="<?php echo $datas->gadget_id; ?>"><i class="fa fa-trash-o"></i></span>
                          </div> <!--delete_option div close-->
                        </div> <!--option div close-->
                      </div> <!--close whole div-->

                      <div>
                        <div id="edit_recentPost_toggle">

                          <?php if ($datas->defaultGadget == 'recent post') { ?>
                            <div id="recentPostEdit">
                              <div id="description_for_gadget">
                                <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                                <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                                <input type="hidden" value="recent post" name="recentPost_gadget">
                                <input type='hidden' value='body' name='display'>
                                <table id="table" border="0">

                                  <?php
                                  //   var_dump($a);
                                  foreach ($recentPostGadget as $element) {
                                    ?>
                                    <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php
                                    if (!empty($post)) {
                                      echo $post;
                                    }
                                    ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
                                    <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php
                                    if (!empty($titleBold)) {
                                      echo 'checked';
                                    }
                                    ?>></td></tr>
                                    <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php
                                    if (!empty($titleUnderline)) {
                                      echo 'checked';
                                    }
                                    ?>></td></tr>
                                    <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php
                                    if (!empty($titleColor)) {
                                      echo $titleColor;
                                    }
                                    ?>'></td></tr>
                                    <?php
                                  }
                                  ?>
                                </table>
                              </div>
                              <div>



                                <input type="submit" value="Update Gadget" id="btn" name="submit">
                                <?php echo form_close(); ?>
                              </div>

                            </div> <!-- recentPostEdit div close -->
                          </div>
                        </div>
                        <?php
                      } else if ($datas->defaultGadget !== 'recent post') {
                        ?>

                        <div id="textEdit">
                          <?php echo form_open('gadgets/textBoxUpdate'); ?>
                          <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                          <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                          <input type='hidden' value='body' name='display'>
                          <div>


                            <input type="submit" value="Update Gadget" id="btn" name="submit">
                            <?php echo form_close(); ?>
                          </div>
                        </div>

                        <?php }
                        ?>

                        <div>

                        </div>
                      </div>
                    </li>
                    <?php
                  }
                }
                ?>
              </ul>

              <li class="list-item">Footer<div class="arrow"></div></li>
              <ul  id='option_gadget' class='footer_gadgets'>

                <?php
                foreach ($gaget as $datas) {

                  if ($datas->display == "Footer") {
                    $setting = $datas->setting;
                    parse_str($setting);
                    // echo $post;
                    //echo $titleBold;
                    //echo $titleUnderline;
                    //echo $titleColor;
                    ?>
                    <li class="action">
                      <div id='single_gadget_edit'>
                        <div class='whole'>
                          <div class='name'>
                            <?php echo $datas->name; ?>
                          </div>              <!-- close name div-->
                          <div id='option'>
                            <div id='delete_option'>
                              <span class="del_category" id="<?php echo $datas->gadget_id; ?>"><i class="fa fa-trash-o"></i></span>
                            </div> <!--delete_option div close-->
                          </div> <!--option div close-->
                        </div> <!--close whole div-->

                        <div>
                          <div id="edit_recentPost_toggle">

                            <?php if ($datas->defaultGadget == 'recent post') { ?>
                              <div id="recentPostEdit">
                                <div id="description_for_gadget">
                                  <?php echo form_open('gadgets/defaultGadgetUpdate'); ?>
                                  <input type="text" id="inputtype" placeholder="Title" name="name_gadget" value="<?php echo $datas->name; ?>" required>
                                  <input type="hidden" value="recent post" name="recentPost_gadget">
                                  <input type='hidden' value='footer' name='display'>
                                  <table id="table" border="0">

                                    <?php
                                    //   var_dump($a);
                                    foreach ($recentPostGadget as $element) {
                                      ?>
                                      <tr><td>No. of Post:</td><td><input type="<?php echo $element['noOfPost']; ?>" name='noOfPost' class='onlyNumerics' size='5' value='<?php
                                      if (!empty($post)) {
                                        echo $post;
                                      }
                                      ?>' required><div style='font-size:12px; float:right;'> Enter Only numbers.</div></td></tr>
                                      <tr><td>Title Bold:</td><td><input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b' <?php
                                      if (!empty($titleBold)) {
                                        echo 'checked';
                                      }
                                      ?>></td></tr>
                                      <tr><td>Title Underline:</td><td><input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u' <?php
                                      if (!empty($titleUnderline)) {
                                        echo 'checked';
                                      }
                                      ?>></td></tr>
                                      <tr><td>Title Color:</td><td><input type="<?php echo $element['titleColor']; ?>" name='titleColor' value='<?php
                                      if (!empty($titleColor)) {
                                        echo $titleColor;
                                      }
                                      ?>'></td></tr>
                                      <?php
                                    }
                                    ?>
                                  </table>
                                </div>
                                <div>



                                  <input type="submit" value="Update Gadget" id="btn" name="submit">
                                  <?php echo form_close(); ?>
                                </div>

                              </div> <!-- recentPostEdit div close -->
                            </div>
                          </div>
                          <?php
                        } else if ($datas->defaultGadget !== 'recent post') {
                          ?>

                          <div id="textEdit">
                            <?php echo form_open('gadgets/textBoxUpdate'); ?>

                            <input type="hidden" value="<?php echo $datas->gadget_id; ?>" name="gadget_id" />
                            <input type="text" value="<?php echo $datas->name; ?>" id='inputtype' name="name_gadget">
                            <textarea id='txtarea' name="type"><?php echo $datas->type; ?></textarea>
                            <input type='hidden' value='footer' name='display'>
                            <div>


                              <input type="submit" value="Update Gadget" id="btn" name="submit">
                              <?php echo form_close(); ?>
                            </div>
                          </div>

                          <?php }
                          ?>

                          <div>

                          </div>
                        </div>
                      </li>
                      <?php
                    }
                  }
                  ?>
                </ul>
              </ul>
            </div>
          </div>
        </div> <!-- nav_location close -->
        <!-- ****************************  RIGHT SIDE GADGETS*****************************************  -->
        <div class="col-md-7 col-lg-7">
            <?php
            $this->load->helper('tamplate_helper');
            ?>
            <div id="gadget_collection"> <!-- gadget_collections open -->
            <div class="row">
            <div class="col-md-12 col-lg-12">

                     <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"></button>
                         <h4>list of all pages</h4>
                        </div>
                        <div class="modal-body">
                         <?php echo form_open_multipart('dashboard/addPageForNavigation', array('id' => 'search', 'name'=>'search'));?>
                         <ul class="blocks">

                          <?php
                          if(isset($listOfPage)){
                            foreach ($listOfPage as $pagedata){
                              ?>

                              <li><input type="checkbox" name="<?php echo $str = htmlentities(preg_replace('/\s+/', '', $pagedata->page_name)); ?>" value="<?php echo htmlentities($pagedata->page_name); ?>"/><?php echo $pagedata->page_name; ?></li>
                              <?php
                            }
                          }
                          ?>
                        </ul>



                      </div>
                      <div class="modal-footer">
                        <select name="departments" id="departments">
                       <option value ="0">Select Menu</option>
                       <?php foreach($listOfMenu as $menu) { ?>
                        <option value ="<?php echo $menu->id; ?>"><?php echo $menu->menu_name; ?></option>
                       <?php } ?>
                       </select>

                   <select  name="jobs" id="jobs" class="jobs">
                      <option>Make Parent</option>
                  </select>
                    <input type="submit" value="Add">

                      <?php echo form_close();?>
                      </div>
                    </div>
                  </div>


                <div id="title" style="cursor: pointer;">Click to add new text box
                  <div id="arrow"></div>
                </div>

                <div id="description">
                  <?php echo form_open('gadgets/addText'); ?>
                  <input type="text" id="inputtype" placeholder="Title" name="name_gadget" required="required">
                  <input type="hidden" name="textBox" value="textBox">
                  <textarea id="txtarea" placeholder="Description" name="type_gadget" ></textarea>

                  <div id='gadget_action'>
                    Choose Template:<br>
                    <select name="wheretodisplay">
                      <?php
                      foreach ($gadgetDisplay as $temp) {
                        echo "<option value=" . $temp . ">" . $temp . "</option>";
                      }
                      ?>
                    </select>
                    <input type="submit" value="Add Gadget" id="btn" name="submit">
                    <?php echo form_close(); ?>
                  </div>
                </div>

              </div>
            </div>
              <!-- Default gadget -->



              <div class="col-md-12 col-lg-12">

                 <div class="modal-dialog">
                 <button class="btn btn-default" id="title1" style="width:100%">
                   <p style="font-size:20px;"><span>click to Add Recent Post </span>  <span  id="arrow1"></span>
                   </p>
                 </button>
                 <div class="modal-content">
                      <div class="modal-body">
                         <?php echo form_open('gadgets/defaultGadget'); ?>

                          <label>title
                         <input type="text" id="inputtype"  placeholder="Title" name="name_gadget" required>
                         <input type="hidden" value="recent post" name="recentPost_gadget">
                         </label>
                         <br>


                           <?php
                           foreach ($recentPostGadget as $element) {
                             ?>

                              <label> No. of Post :
                               <input type="<?php echo $element['noOfPost']; ?> " name='noOfPost' class='onlyNumerics' size='5' required>
                                </label>
                                <br>
                               <label> Title Bold:
                                <input type="<?php echo $element['titleBold']; ?>" name='titleBold' value='b'>
                            </label>
                            <br>

                               <label>  Title Underline:
                               <input type="<?php echo $element['titleUnderline']; ?>" name='titleUnderline' value='u'></label>
                               <br>
                                       <label> Title Color:
                                 <input type="<?php echo $element['titleColor']; ?>" name='titleColor' value=''>
                                 </label>






                             <?php } ?>

                                 <select class="form-control" name="wheretodisplay">
                                   <?php
                                   foreach ($gadgetDisplay as $temp) {
                                     echo "<option value=" . $temp . ">" . $temp . "</option>";
                                   }
                                   ?>
                                 </select>
                                   <br>

                                 <input type="submit" class="btn btn-default btn-lg btn-block" style="width:100%;" value="Add Gadget" id="btn" name="submit">


                         </div>

                         <!-- Default gadget - upto here-->
                       </div>

                 <div class="modal-footer">

                 </div>
             </div>


              </div>
            </div>
            </div>
          <!-- </div>ROW IS CLOSED  -->
          </div>
          <script>
          $(document).ready(function(){
            $(document).on("click", ".del_category", function(){
              var id = $(this).attr("id");
              var url = '<?php echo base_url().'index.php/gadgets/delete' ?>';
              var hideid = $(this);
              senddata({id:id,url:url,thiss:hideid});

            });
          });
          </script>

      </div>
    </body>
    </html>
