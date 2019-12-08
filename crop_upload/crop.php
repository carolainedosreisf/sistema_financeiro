<?php require "../config.php";?>
<?php
session_start();
$id_user= $_POST['id'];
//echo $valid;
$valid = $_SESSION['valid'];
//$id_user = $_SESSION['id_user'];
if ( !isset($_GET['valid']) || !isset($_GET['id_user'])  ) {
	echo "<script>window.location ='crop.php?valid=$valid&id_user=$id_user'</script>";
   
}
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobileDevice()){
  //é um mobile
?>
	<style>
	@import url('https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap');
	@import url('https://fonts.googleapis.com/css?family=Oswald&display=swap');
		.modal-fora {
			display: flex;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			align-items: center;
			justify-content: center;
			background-color: rgba(0,0,0,.4);
			z-index: 10;
		}

		.modal-dentro {
			margin-left: auto;
			margin-right: auto;
			width: 400px;
			padding: 30px 15px;
			max-width: 100%;
			border: none;
			border-radius: .3125em;
			background: #fff;
			border: 1px solid #e7e7e7;
		}
		.modal-dentro h4 {
			font-family: "Roboto Slab", serif;
			padding: 0px 0px 10px 0px;
			
			font-size: 20px !important;
		}
		.modal-dentro p{
			font-size: 14px;
			text-align: justify;		
			
			font-weight: 500;
			display: inline-block;
			margin: 5px 0px;
			color: #828282;
		}
		.botoes{
			margin-top: 10px;
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Corte da imagem</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
	<div class="modal-fora mostra">
		<div class="modal-dentro">
			<h4>Dispositivo Mobile</h4>
			<p>Detectamos que você esta utilizando um dispositivo mobile,e a bibliteca de corte do nosso sistema ainda não é compatível com aparelhos mobiles, por isso iremos realizar o corte da imagem ao centro.</p>
			
				<div class="botoes">
					<a href="../edit_dados.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?>" class="btn btn-success" name="ok-corte-mob">Ok</a>
					<a href="crop.php?func=cancel_crop_mob&valid=<?php echo $valid;?>&id_user=<?php echo $id_user;?>" class="btn btn-default" name="cancel-corte-mob">Cancelar</a>
				</div>
		
			
			
		</div> 
	</div>
	<?php
	$sql_sel_valid2 = "SELECT * FROM usuarios WHERE id = '$id_user'";
	$res_sel_valid2 = mysqli_query($conexao, $sql_sel_valid2);
	while($con_sel_valid2 = mysqli_fetch_assoc($res_sel_valid2)){
		if(@$_GET['func'] == 'cancel_crop_mob'){ 
			
			if ($con_sel_valid2['nome_img'] != 'padrao.jpg'){
				echo unlink("upload_pic/".$con_sel_valid2['nome_img']);
				echo unlink("upload_pic/".$con_sel_valid2['nome_img_original']);
			}
			echo "<script>window.location = '../edit_dados.php?valid=$valid&id_user=$id_user'</script>";

		}
		
		if(isset($_FILES['image'])){
			$rand_img = rand() * rand();
			$ext = strtolower(substr($_FILES['image']['name'],-4)); //Pegando extensão do arquivo
			$new_name = "mobile_".$rand_img. $ext; 
			$dir = 'upload_pic/'; //Diretório para uploads 
			if ($con_sel_valid2['nome_img'] != 'padrao.jpg'){
				echo unlink("upload_pic/".$con_sel_valid2['nome_img']);
				echo unlink("upload_pic/".$con_sel_valid2['nome_img_original']);
			}
			move_uploaded_file($_FILES['image']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
			$sql_nome_img = "UPDATE usuarios SET nome_img = '$new_name', nome_img_original = '$new_name' WHERE id = '$id_user'";
			$res_nome_img= mysqli_query($conexao, $sql_nome_img);
			
	
		} 
	
	
	}	
   
	?>
	

<?php
}
else {
    //echo "It is desktop or computer device";
//header("Location: ../edit_dados.php?valid=$valid&id_user=$id_user");





//header("Location: crop.php?valid=$valid");


/*
* Copyright (c) 2008 http://www.webmotionuk.com / http://www.webmotionuk.co.uk
* "PHP & Jquery image upload & crop"
* Date: 2008-11-21
* Ver 1.2
* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
* ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
* IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, 
* PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
* INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, 
* STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF 
* THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*
*/
error_reporting (E_ALL ^ E_NOTICE);
session_start(); 
//session_destroy();

//echo $_SESSION['random_key'];
//echo $_SESSION['user_file_ext'];

if (!isset($_SESSION['random_key']) || strlen($_SESSION['random_key'])==0){
    $_SESSION['random_key'] = strtotime(date('Y-m-d H:i:s')); 
	$_SESSION['user_file_ext']= "";
}

$upload_dir = "upload_pic"; 				
$upload_path = $upload_dir."/";				
$large_image_prefix = "resize_"; 			
$thumb_image_prefix = "thumbnail_";		
$large_image_name = $large_image_prefix.$_SESSION['random_key'];     
$thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'];   
$max_file = "3"; 
$width_tela = "<script>document.write(screen.width);</script>";

?>
<script>
/*
var tela = window.innerWidth;
//console.log(tela + tela)
if(tela >= 500){
	document.write('<?php //$max_width = "850"?>');
	//alert('primeiro if - ');
}
if (tela < 500){
	document.write('<?php// $max_width = "300"?>');
	//alert('ultimo if - ');

}

*/

</script>

<?php

$width_tela_int= intval($width_tela);

//echo $width_tela_int ;
$max_width = "500";
					
$thumb_width = "400";						
$thumb_height = "400";		

$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
$allowed_image_ext = array_unique($allowed_image_types); 
$image_ext = "";	
foreach ($allowed_image_ext as $mime_type => $ext) {
	$image_ext.= strtoupper($ext)." ";
}


function resizeImage($image,$width,$height,$scale) {
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
	
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$image); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$image,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$image);  
			break;
    }
	
	chmod($image, 0777);
	return $image;
}
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break;
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}
function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}
function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}

$large_image_location = $upload_path.$large_image_name.$_SESSION['user_file_ext'];
$thumb_image_location = $upload_path.$thumb_image_name.$_SESSION['user_file_ext'];

if(!is_dir($upload_dir)){
	mkdir($upload_dir, 0777);
	chmod($upload_dir, 0777);
}

if (file_exists($large_image_location)){
	if(file_exists($thumb_image_location)){
		$thumb_photo_exists = "<img  style='display:none' src=\"".$upload_path.$thumb_image_name.$_SESSION['user_file_ext']."\" alt=\"Thumbnail Image\"/>";
	}else{
		$thumb_photo_exists = "";
	}
   	$large_photo_exists = "<img class='large_img' src=\"".$upload_path.$large_image_name.$_SESSION['user_file_ext']."\" alt=\"Large Image\"/>";
} else {
   	$large_photo_exists = "";
	$thumb_photo_exists = "";
}

if (isset($_POST["upload"])) { 
	$userfile_name = $_FILES['image']['name'];
	$userfile_tmp = $_FILES['image']['tmp_name'];
	$userfile_size = $_FILES['image']['size'];
	$userfile_type = $_FILES['image']['type'];
	$filename = basename($_FILES['image']['name']);
	$file_ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
	
	if((!empty($_FILES["image"])) && ($_FILES['image']['error'] == 0)) {
		
		foreach ($allowed_image_types as $mime_type => $ext) {
			if($file_ext==$ext && $userfile_type==$mime_type){
				$error = "";
				break;
			}else{
				$error = "Only <strong>".$image_ext."</strong> images accepted for upload<br />";
			}
		}
		if ($userfile_size > ($max_file*1048576)) {
			$error.= "Images must be under ".$max_file."MB in size";
		}
		
	}else{
		$error= "Select an image for upload";
	}
	if (strlen($error)==0){
		
		if (isset($_FILES['image']['name'])){
			$large_image_location = $large_image_location.".".$file_ext;
			$thumb_image_location = $thumb_image_location.".".$file_ext;
			
			$_SESSION['user_file_ext']=".".$file_ext;
			
			move_uploaded_file($userfile_tmp, $large_image_location);
			chmod($large_image_location, 0777);
			
			$width = getWidth($large_image_location);
			$height = getHeight($large_image_location);
			if ($width < $max_width  || $width > $max_width){
				$scale = $max_width/$width;
				if ($width < $min_width){
					//$scale = $min_width/$width;

				}
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}else{
				$scale = 1;
				$uploaded = resizeImage($large_image_location,$width,$height,$scale);
			}
			if (file_exists($thumb_image_location)) {
				unlink($thumb_image_location);
			}
		}
		header("location:".$_SERVER["PHP_SELF"]);
		exit();
	}
}
if (isset($_POST["upload_thumbnail"]) && strlen($large_photo_exists)>0) {
	$x1 = $_POST["x1"];
	$y1 = $_POST["y1"];
	$x2 = $_POST["x2"];
	$y2 = $_POST["y2"];
	$w = $_POST["w"];
	$h = $_POST["h"];
	$scale = $thumb_width/$w;
	$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
	
	
	
	$nome_img = $thumb_image_name.$_SESSION['user_file_ext'];
	$nome_img_original= $large_image_name.$_SESSION['user_file_ext'];

	


	$sql_sel_valid = "SELECT * FROM usuarios WHERE id = '$id_user'";
	$res_sel_valid = mysqli_query($conexao, $sql_sel_valid);
	while($con_sel_valid = mysqli_fetch_assoc($res_sel_valid)){
		if ($con_sel_valid['nome_img'] != 'padrao.jpg'){
			echo unlink("upload_pic/".$con_sel_valid['nome_img']);
			echo unlink("upload_pic/".$con_sel_valid['nome_img_original']);
		}
		
		
		$sql_nome_img = "UPDATE usuarios SET nome_img = '$nome_img', nome_img_original = '$nome_img_original' WHERE id = '$id_user'";
		$res_nome_img= mysqli_query($conexao, $sql_nome_img);
		//echo unlink("upload_pic/".$nome_img_original);
		session_destroy();

		header("Location: ../edit_dados.php?valid=$valid&id_user=$id_user");
	}
	
	
	//echo "<script>window.location = '../edit_dados.php?valid=$valid&id_user=$id_user' </script>";
	//header("Location: ../edit_dados.php?valid=$valid&id_user=$id_user");
	
	exit();
}


if ($_GET['a']=="delete" && strlen($_GET['t'])>0){
	$large_image_location = $upload_path.$large_image_prefix.$_GET['t'];
	$thumb_image_location = $upload_path.$thumb_image_prefix.$_GET['t'];
	if (file_exists($large_image_location)) {
		unlink($large_image_location);
	}
	if (file_exists($thumb_image_location)) {
		//unlink($thumb_image_location);
		
	}
	header("location:".$_SERVER["PHP_SELF"]);
	exit(); 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="generator" content="WebMotionUK" />
	<title>Corte da imagem</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	 

	<script type="text/javascript" src="js/jquery-pack.js"></script>
	<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<style>
		
	</style>
</head>
<body>
<!-- 
* Copyright (c) 2008 http://www.webmotionuk.com / http://www.webmotionuk.co.uk
* Date: 2008-11-21
* "PHP & Jquery image upload & crop"
* Ver 1.2
* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
* ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
* IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, 
* PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
* INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, 
* STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF 
* THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*
-->

<?php
if(strlen($large_photo_exists)>0){
	$current_large_image_width = getWidth($large_image_location);
	$current_large_image_height = getHeight($large_image_location);?>
<script type="text/javascript">
function preview(img, selection) { 
	var scaleX = <?php echo $thumb_width;?> / selection.width; 
	var scaleY = <?php echo $thumb_height;?> / selection.height; 
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 

$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("Selecione uma area para recortar.");
			return false;
		}else{
			return true;
		}
	});
}); 

$(window).load(function () { 
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview }); 
});

</script>
<?php }?>
<?php
if(strlen($error)>0){
	echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>";
}
if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){
	echo $large_photo_exists."&nbsp;".$thumb_photo_exists;
	
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= "";
}else{
		if(strlen($large_photo_exists)>0){?>
		
		
		<div class="conteudo_corte_img">
			<h2 class="corte_img_h2">Corte da imagem</h2>
			<img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>" class="cortar_img" id="thumbnail" alt="Create Thumbnail" />
			<div style="display:none;position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
				<img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>" style="position: relative; display:none" alt="Thumbnail Preview" />
			</div>
			<br style="clear:both;"/>
			<form name="thumbnail" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" /><br>
				<input type="submit" name="upload_thumbnail" class="btn btn-success" value="Cortar e salvar" id="save_thumb" />
			</form>
		</div>
	<script>
		
	</script>
	<?php 	}
	
	

		
	} 

?>
<script>
	var valid = "<?php print $valid?>";
	var id_user = "<?php print $id_user?>";
	if(document.querySelector('.cortar_img') == null){
		alert('Nenhuma imagem foi selecionada ou a extensão é inválida.');
		window.location = '../edit_dados.php?valid='+valid+'&id_user='+id_user;
	}
</script>
<?php }?>
<!-- Copyright (c) 2008 http://www.webmotionuk.com -->
</body>
</html>

