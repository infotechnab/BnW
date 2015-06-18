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

function custom_echo_ed($x)
{
   if(strlen($x)<=30)
  {
    echo $x;
  }
  else
  {
    $truncated = substr($x,0,strpos($x,' ',30));

echo $truncated;
  }
  
  

}