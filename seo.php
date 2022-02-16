<?php
error_reporting(0);
function getMoz($domain){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://www.scrolltotop.com/MozRank-Domain-Authority-Checker.php");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, "url_form=$domain");
$exec = curl_exec($curl);
curl_close($curl);
preg_match_all('/<\/td><td>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td><td>(.*?)<\/td><\/tr>/', $exec, $mpd);
return "Moz Rank           : ".$mpd[4][0]."\nPage Authority     : ".$mpd[3][0]."\nDomain Authority   : ".$mpd[2][0]."\nBacklinks          : ".$mpd[5][0]."\n";
}
function getAlexa($domain){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://data.alexa.com/data?cli=10&dat=snbamz&url=$domain");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$exec = curl_exec($curl);
curl_close($curl);
preg_match_all("/<POPULARITY URL=\"(.*?)\" TEXT=\"(.*?)\"/", $exec, $rank);
preg_match_all("/<COUNTRY CODE=\"(.*?)\" NAME=\"(.*?)\" RANK=\"(.*?)\"/", $exec, $country);
$getAlexx = "Global Rank        : ".$rank[2][0]."\nLocal Rank         : ".$country[3][0]."\nCountry            : ".$country[2][0]."\nCountry Code       : ".$country[1][0]."\n"; 
$getKosong = "Global Rank        -: \nLocal Rank         : -\nCountry            : -\nCountry Code       : -\n"; 
if(preg_match("/<POPULARITY/i", $exec)){
  return $getAlexx;
}else{
  return $getKosong;
}
}
function trafficCheck($domain){
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "http://www.statshow.com/www/$domain");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$exec = curl_exec($curl);
curl_close($curl);
preg_match_all("/<div id=\"box_1\" class=\"box_on\">(.*?)<span class=\"red_bold\">(.*?)<\/span><br \/>(.*?)<span class=\"red_bold\">(.*?)<\/span>/", $exec, $daily);
preg_match_all("/<div id=\"box_2\" class=\"box_off\">(.*?)<span class=\"red_bold\">(.*?)<\/span><br \/>(.*?)<span class=\"red_bold\">(.*?)<\/span>/", $exec, $monthly);
preg_match_all("/<div id=\"box_3\" class=\"box_off\">(.*?)<span class=\"red_bold\">(.*?)<\/span><br \/>(.*?)<span class=\"red_bold\">(.*?)<\/span>/", $exec, $yearly);
return "Daily Page Views   : ".$daily[2][0]."\nDaily Visitors     : ".$daily[4][0]."\nMonthly Page Views : ".$monthly[2][0]."\nMonthly Visitors   : ".$monthly[4][0]."\nYearly Page Views  : ".$yearly[2][0]."\nYearly Visitors    : ".$yearly[4][0]."\n"; 
}
$banner = "
Code By Kelelawar Cyber Team
   _____ _______ ___________       
  /_______________________ /
        \/        \/      n";
echo $banner."\n";
echo "DOMAIN LIST: ";
$url = trim(fgets(STDIN));
$kontorus = file_get_contents($url);
$urls = explode("\n", $kontorus);
 echo "+================================+\n";
 echo "         MASS SEO TOOLS           \n";
 echo "+================================+\n";
foreach ($urls as $domain) {
 echo "Domain             : ".$domain."\n";
 echo getAlexa($domain);
 echo getMoz($domain);
 echo trafficCheck($domain);
 echo "+================================+\n";
}
