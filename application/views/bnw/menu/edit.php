<?php if(isset($query)){
            foreach ($query as $data){
           $id = $data->id;
           $title = $data->title;
           $parmalink = $data->parmalink;
           $listing = $data->listing;
           $order = $data->order;
           $link = $data->link;
                 
            }
        }
    ?>
<h2>Edit Menu id <?php echo $id; ?></h2>
  <?php echo validation_errors(); ?>
 
  <p id="sucessmsg">
  <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}?>
    </p>
  <?php echo form_open_multipart('bnw/updatemenu');?>
  
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
 <p>Title:<br />
      <input type="text" name="title" value="<?php echo $title; ?>" /> </p> 
 <p>Pramalink : <br/>
       <input type="text" name="parmalink" value="<?php echo $parmalink; ?>" /> </p>
 <p> Listing : <br/>
      <input type="text" name="listing" value="<?php echo $listing; ?>" /> </p>
 <p> Order : <br/>
       <input type="txt" name="order" value="<?php echo $order; ?>" /> </p>
 <p> Link : <br/>
      <input type="text" name="link" value="<?php echo $link; ?>" /> </p>
  
 
    <input type="submit" value="Submit" />
  <?php echo form_close();?>