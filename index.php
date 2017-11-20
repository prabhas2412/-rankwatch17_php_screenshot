
<h1><p><marquee behavior=scroll direction="left" scrollamount="10"><font color="red">Screenshot What is Displayed on browser!</font></p></marquee></h1>

    <form method="get">
	
	<input type="text" name="url" placeholder="Give URL Without http"> <br> <br>
	<input type="submit" name="Submit">

	</form>

<?php
if(isset($_GET['Submit']))
{
	
	$url=$_GET['url'];

$siteURL = "http://".$url; //website url storing in variable $siteURL

//calling Google PageSpeed Insights API
$GooglePgSpd = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$siteURL&screenshot=true");


$GooglePgSpd = json_decode($GooglePgSpd, true); //decoding of json data


$ScreenData = $GooglePgSpd['screenshot']['data'];

$ScreenData = str_replace(array('_','-'),array('/','+'),$ScreenData); 


$ImgName =str_replace('.','',$url);
      $ImgUrl ="data:image/jpeg;base64,".$ScreenData;
      $ImgExt ="jpg";

      $ImgName = str_replace (" ","",$ImgName) ;
	  
      @$Img = file_get_contents ($ImgUrl) ;
      if($Img)
		  
      {
              file_put_contents("Images/".$ImgName.".".$ImgExt,$Img) ;
			  //saved image name will be of website name
              echo "Image Saved in the folder Images with extension jpg";
	  }
	
}


?>


