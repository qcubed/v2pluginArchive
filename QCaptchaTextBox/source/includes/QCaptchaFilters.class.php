<?php

  class QCaptchaFilters{
  	
    function noise (&$image, $runs = 30)
    {
    	
	  $w = imagesx($image);
	  $h = imagesy($image);
  
      for ($n = 0; $n < $runs; $n++)
      {

        for ($i = 1; $i <= $h; $i++)
        {

          $randcolor = imagecolorallocate($image,
                                          mt_rand(0, 255),
                                          mt_rand(0, 255),
                                          mt_rand(0, 255));

          imagesetpixel($image,
                        mt_rand(1, $w),
                        mt_rand(1, $h),
                        $randcolor);

        }

      }  
  
    } //noise
    
    function signs (&$image, $font, $rgb = array(175,175,175) , $cells = 3)
    {
   	
	  $w = imagesx($image);
	  $h = imagesy($image);

   	  for ($i = 0; $i < $cells; $i++)
   	  {
   	  	   	  	
   	  	$centerX     = mt_rand(1, $w);
   	  	$centerY     = mt_rand(1, $h);
   	  	$amount      = mt_rand(1, 15);
        $stringcolor = imagecolorallocate($image, $rgb[0], $rgb[1], $rgb[2]);
   	  	
   	  	for ($n = 0; $n < $amount; $n++)
   	  	{

          $signs = range('A', 'Z');
          $sign  = $signs[mt_rand(0, count($signs) - 1)];

   	  	  imagettftext($image, 25, 
   	  	               mt_rand(-15, 15), 
   	  	               $centerX + mt_rand(-50, 50),
   	  	               $centerY + mt_rand(-50, 50),
   	  	               $stringcolor, $font, $sign);
   	  	
   	  	}
   	  	
   	  }
   	
    } //signs
    
    function blur (&$image, $radius = 3)
    {

	  $radius  = round(max(0, min($radius, 50)) * 2);

	  $w       = imagesx($image);
	  $h       = imagesy($image);
	  
	  $imgBlur = imagecreate($w, $h);

	  for ($i = 0; $i < $radius; $i++)
	  {

		imagecopy     ($imgBlur, $image,   0, 0, 1, 1, $w - 1, $h - 1);
		imagecopymerge($imgBlur, $image,   1, 1, 0, 0, $w,     $h,     50.0000);
		imagecopymerge($imgBlur, $image,   0, 1, 1, 0, $w - 1, $h,     33.3333);
		imagecopymerge($imgBlur, $image,   1, 0, 0, 1, $w,     $h - 1, 25.0000);
		imagecopymerge($imgBlur, $image,   0, 0, 1, 0, $w - 1, $h,     33.3333);
		imagecopymerge($imgBlur, $image,   1, 0, 0, 0, $w,     $h,     25.0000);
		imagecopymerge($imgBlur, $image,   0, 0, 0, 1, $w,     $h - 1, 20.0000);
		imagecopymerge($imgBlur, $image,   0, 1, 0, 0, $w,     $h,     16.6667);
		imagecopymerge($imgBlur, $image,   0, 0, 0, 0, $w,     $h,     50.0000);
		imagecopy     ($image  , $imgBlur, 0, 0, 0, 0, $w,     $h);

	  }
	  
	  imagedestroy($imgBlur);
	  
    } //blur

  } //class: filters

?>