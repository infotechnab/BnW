        
<div class="rightSide">
    <h2>Dashboard >> Home</h2> 
    <hr class="hr-gradient"/>
    <style>
        .wells{width: 15%;float: left;margin: 1%;min-height: 60px; background: #eee;padding: 1%;}
        .counts{font-size: 30px;font-weight: bold;}
        .count-title{font-weight: bold;padding: 1%;}
    </style>
    <div>
        <div class="wells"><div class="counts"><?php echo $page; ?></div><div class="count-title">PAGE</div></div>
        <div class="wells"><div class="counts"><?php echo $post; ?></div><div class="count-title">POST</div></div>
        <div class="wells"><div class="counts"><?php echo $events; ?></div><div class="count-title">EVENTS</div></div>
        <div class="wells"><div class="counts"><?php echo $news; ?></div><div class="count-title">NEWS</div></div>
    </div>


