<section id="full-div-body-rooms">
    <div class="container" >

        <div class="col-sm-12">
            <h2 class="lined-heading-services">
                <span>Rooms</span>
            </h2>
        </div>  

      <div class="pricing-table pricing-three-column row">
        <div class="plan col-sm-4 col-lg-4">
          <div class="plan-name-green">
            <h2>Super Deluxe Room</h2>
            <span>$50.00 / Day</span>
          </div>
            
          <ul>
              <li class="plan-feature"><img src="<?php echo base_url().'content/uploads/basicImages/room.png' ?>" alt="" style="width:100%" /></li>
            <li class="plan-feature">Air-conditioned Room</li>
            <li class="plan-feature">32" LED T.V.</li>
            <li class="plan-feature">Free WiFi Access</li>
            
            <li class="plan-feature"><a href="<?php echo base_url().'index.php/view/reserve'; ?>" class="btn btn-primary btn-plan-select btn-green"><i class="icon-white icon-ok"></i> Select</a></li>
          </ul>
        </div>
        <div style="z-index:55;" class="plan col-sm-4 col-lg-4" id="active-room">
          <div class="plan-name-red">
            <h2>Suite Room</h2>
            <span>$95.00 / Day </span>
          </div>
          <ul>
               <li class="plan-feature"><img src="<?php echo base_url().'content/uploads/basicImages/room.png' ?>" alt="" style="width:100%" /></li>
            <li class="plan-feature">Air-conditioned Room</li>
            <li class="plan-feature">32" LED T.V.</li>
            <li class="plan-feature">Free WiFi Access</li>
            <li class="plan-feature">Bath-Tub</li>
            <li class="plan-feature"><a href="<?php echo base_url().'index.php/view/reserve'; ?>" class="btn btn-primary btn-plan-select btn-red"><i class="icon-white icon-ok"></i> Select</a></li>
          </ul>
        </div>
        <div class="plan col-sm-4 col-lg-4">
          <div class="plan-name-blue">
            <h2>Deluxe Room</h2>
            <span>$40.00 / Day</span>
          </div>
          <ul>
               <li class="plan-feature"><img src="<?php echo base_url().'content/uploads/basicImages/room.png' ?>" alt="" style="width:100%" /></li>
            <li class="plan-feature">Air-conditioned Room</li>
            <li class="plan-feature">32" LED T.V.</li>
            <li class="plan-feature">Free WiFi Access</li>
            <li class="plan-feature"><a href="<?php echo base_url().'index.php/view/reserve'; ?>" class="btn btn-primary btn-plan-select btn-blue"><i class="icon-white icon-ok"></i> Select</a></li>
          </ul>
        </div>
    </div>

       

        

        

    </div>

</section>
<style>
    #active-room
    {
        background-color: #fff;
        margin-top: -25px;
    }
.pricing-table .plan {
  margin-left:0px;
  border-radius: 5px;
  text-align: center;
  background-color: #f3f3f3;
  -moz-box-shadow: 0 0 6px 2px #b0b2ab;
  -webkit-box-shadow: 0 0 6px 2px #b0b2ab;
  box-shadow: 0 0 6px 2px #b0b2ab;
}
 
 .plan:hover {
  background-color: #fff;
  -moz-box-shadow: 0 0 12px 3px #b0b2ab;
  -webkit-box-shadow: 0 0 12px 3px #b0b2ab;
  box-shadow: 0 0 12px 3px #b0b2ab;
}
 
 .plan {
  padding: 20px;
  margin-left:0px;
  background-color: #5e5f59;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
a.btn-red
{
    background-color: #770000;
}
a.btn-green{
    background-color: #01410a;
}
a.btn-blue
{
    background-color: #010a4e;
}
  
.plan-name-green {
  padding: 20px;
  color: #fff;
  background-color: #01410a;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-red {
  padding: 20px;
  color: #fff;
  background-color: #770000;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
 }
  
.plan-name-blue {
  padding: 20px;
  color: #fff;
  background-color: #010a4e;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
  } 
  
.pricing-table-bronze  {
  padding: 20px;
  color: #fff;
  background-color: #f89406;
  -moz-border-radius: 5px 5px 0 0;
  -webkit-border-radius: 5px 5px 0 0;
  border-radius: 5px 5px 0 0;
}
  
.pricing-table .plan .plan-name span {
  font-size: 20px;
}
 
.pricing-table .plan ul {
  list-style: none;
  margin: 0;
  -moz-border-radius: 0 0 5px 5px;
  -webkit-border-radius: 0 0 5px 5px;
  border-radius: 0 0 5px 5px;
}
 
.pricing-table .plan ul li.plan-feature {
  padding: 15px 10px;
  border-top: 1px solid #c5c8c0;
}
 
.pricing-three-column {
  margin: 0 auto;
  width: 100%;
}
 
.pricing-variable-height .plan {
  float: none;
  margin-left: 2%;
  vertical-align: bottom;
  display: inline-block;
  zoom:1;
  *display:inline;
}
 
.plan-mouseover .plan-name {
  background-color: #4e9a06 !important;
}
 
.btn-plan-select {
  padding: 8px 25px;
  font-size: 18px;
}
</style>