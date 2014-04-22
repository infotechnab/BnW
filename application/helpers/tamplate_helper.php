<?php 

    function tamplate_function()
    {
         $navigation_site=array('Choose Template', 'Header','Sidebar','Body','Footer');

        return $navigation_site;
    }

    function recent_post()
    {
        $recentPost[]=array('noOfPost' => 'text','titleBold' => 'checkbox','titleUnderline' => 'checkbox','titleColor' => 'color');
        return $recentPost;
       
    }
