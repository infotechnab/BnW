<?php 

  function custom_echo($x)
{
  if(strlen($x)<=100)
  {
    echo $x;
  }
  else
  {
    $y=substr($x,0,100) . '...';
    echo $y;
  }
}