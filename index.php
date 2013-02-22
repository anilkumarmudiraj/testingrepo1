<html>
<head>
<title>
<style>
.linkpost
{
position:relative;
top:200px;
left:500px;
width:500px;
height:100px;
background-color:rgba(204, 204, 204, 0.18);
padding:20px;
border-style:solid;
border-width:2px;
border-radius:10px;
font-family:Calibri;
}
.linkimage
{
position:relative;
border-style:solid 
border-radius:10px;
width:100px;
height:100px;
}
.linktitle
{
position:relative;
top:-100px;
left:116px;
width:400px;
height:20px;
font-size:17px;
font-weight:bold;
overflow:hidden;
}
.linkurl
{
position:relative;
top:-96px;
left:116px;
width:400px;
height:15px;
font-size:13px;
font-style:italic;
overflow:hidden;
}
.linkdes
{
position:relative;
top:-89px;
left:116px;
width:385px;
height:60px;
overflow:hidden;
text-align:justify;
}
</style>
</head>
<body>
<?php
$url = 'http://www.android.com';

//description
$disdes = get_meta_tags($url);

//InnerHTML of Title
function DOMinnerHTML($element) 
{ 
    $innerHTML = ""; 
    $children = $element->childNodes; 
    foreach ($children as $child) 
    { 
        $tmp_dom = new DOMDocument(); 
        $tmp_dom->appendChild($tmp_dom->importNode($child, true)); 
        $innerHTML.=trim($tmp_dom->saveHTML()); 
    } 
    return $innerHTML; 
} 
	
	//To read HTML page
	$html = file_get_contents($url);
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
	
	
	//To Display Title
	$distitle = $doc->getElementsByTagName('title');
	
	//To display Images
    $disimg = $doc->getElementsByTagName('img');
	
	function disImage()
	{
		global $disimg,$url;
		$tmp='altimg.png';
		$turl = '';
		foreach ($disimg as $tag) {
		$turl = $tag ->getAttribute('src');
			if(strstr($turl,'http')){
			$tmp = $turl;
			}
			else{
			$tmp = ''.$url.'/'.$turl;
			}
			break;
		}
		return $tmp;
	}
?>

<!--for Display-->
<div class="linkpost">
<div class="linkimage"><?php  echo '<a href="'.$url.'" target="_blank"><img  height="100px" width="100px" alt="NYC" src="'.disImage().'"></a>'; ?></div>
<div class="linktitle"><?php foreach ($distitle as $tag) { echo '<a href="'.$url.'" target="_blank">'.DOMinnerHTML($tag).'</a>'; break;} ?></div>
<div class="linkurl"><?php echo $url; ?></div>
<div class="linkdes"><?php echo $disdes['description'];  ?></div>
</div>

</body></html>
