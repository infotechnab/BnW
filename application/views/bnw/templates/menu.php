<style>
    .fa{font-size: 14px;}
</style>
<div id="bodyWrapper" style="float:left;width: 100%;background-color: #000;">
<div class="leftSide">
            <div class="menuItems">
                <ul class="menu">
                    <li class="mainMenuItem dashboard"> <a href="#"><i class="fa fa-tachometer"></i> &nbsp;
 Dashboard</a>
                        <ul class="subMenu">                            
                            <li><?php echo anchor('bnw', 'Home') ?></li>
                            <li><?php echo anchor('dashboard/addmenu', 'Add Menu') ?></li>
                            <li><?php echo anchor('dashboard/navigation', 'Navigation') ?></li>
                            <li><?php echo anchor('dashboard/category', 'Categories') ?></li>
                        </ul>
                    </li>
                    
                    <li class="mainMenuItem events"><a href="#"><i class="fa fa-newspaper-o"></i>&nbsp;
 Events / News</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('events/allevents', 'All Event / News') ?></li>
                            <li><?php echo anchor('events/addevent', 'Add New Event / News') ?></li>
                        </ul>
                    </li>
                    <li class="mainMenuItem posts"><a href="#"><i class="fa fa-folder-o"></i> &nbsp; Posts</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('offers/posts', 'All Posts') ?></li>
                            <li><?php echo anchor('offers/addpost', 'Add New Post') ?></li>
                        </ul>
                    </li>
                    <li class="mainMenuItem pages"><a href="#"> <i class="fa fa-file-o"></i> &nbsp;
 Pages</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('page/pages', 'All Pages') ?></li>
                            <li><?php echo anchor('page/addpage', 'Add New') ?></li>                            
                        </ul>
                    </li>
                    <li class="mainMenuItem users"><a href="#"><i class="fa fa-users"></i>&nbsp;
 Users</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('user/adduser', 'Add New') ?></li>
                            <li><?php echo anchor('user/users', 'All Users') ?></li>
                            <li><?php echo anchor('user/profile', 'My Profile') ?></li>
                            <li><?php echo anchor('user/login_attempts_list', 'attempt lists') ?></li>
                        </ul>
                    </li>
                   <li class="mainMenuItem media"><a href="#"><i class="fa fa-file-video-o"></i>&nbsp;
 Media</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('media/medias', 'Library') ?></li>
                            <li><?php echo anchor('media/addmedia', 'Add New') ?></li>                           
                        </ul>
                    </li>
<!--                    <li class="mainMenuItem social-share"><a href="#"><i class="fa fa-share-square"></i>&nbsp;
 Social Share</a>
                        <ul class="subMenu">
                            <li><?php //echo anchor('social_share', 'Accounts') ?></li>
                            
                        </ul>
                    </li>-->
                    <li class="mainMenuItem settings"><a href="#"><i class="fa fa-cogs"></i> &nbsp; Settings</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('setting/header', 'Header') ?></li>
<!--                            <li><?php //echo anchor('setting/sidebar', 'Sidebar') ?></li>-->
                            <li><?php echo anchor('setting/miscsetting', 'Miscellaneous Setting') ?></li>
                            <li><?php echo anchor('gadgets', 'Gadgets') ?></li> 
                            
                            <li><?php echo anchor('setting/setup', 'SEO Setup') ?></li>
                        </ul>
                    </li>
                    
                   
                    <li class="mainMenuItem albums"><a href="#"> <i class="fa fa-picture-o"></i>&nbsp; Album</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('album/addalbum', 'Add New') ?></li>
                            
                        </ul>
                    </li>
                    
                    <li class="mainMenuItem sliders"><a href="#"><i class="fa fa-sliders"></i>&nbsp;
 Slider</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('sliders/addslider', 'Add New') ?></li>
                            <li><?php echo anchor('sliders/slider', 'View All Slider') ?></li>
                        </ul>
                    </li>       
                    
                    <li class="mainMenuItem subscribes"><a href="#"><i class="fa fa-check-circle-o"></i> &nbsp; Subscriber</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('subscribers/viewSubscriber', 'Newsletter subscriber') ?></li>
                            <li><?php echo anchor('subscribers/viewContact', 'Contact List') ?></li>
                        </ul>
                    </li>
                    <li class="mainMenuItem contacts"><a href="#"><i class="fa fa-envelope"></i> &nbsp; Contact Form</a>
                        <ul class="subMenu">
                            <li><?php echo anchor('contact/updateContact', 'Contact Form') ?></li>
                            
                        </ul>
                    </li>
                   
               </ul>   
                
            </div>
    <div id="bnwcredit">
        <p>&COPY; Copy right to B&W......</p><p> Powered by BnW CMS v 1.11</p>
    </div>
    
    
        </div>

        
        <!left side is cleared and closed here>
        