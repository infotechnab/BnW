<?php 

    function tamplate_function()
    {
         $navigation_site=array('Header','Sidebar','Body','Footer');

        return $navigation_site;
    }

    function recent_post()
    {
        $recentPost[]=array('noOfPost' => 'text','viewMore' => 'checkbox');
        return $recentPost;
       
    }
