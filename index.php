<?php
error_reporting(0);
$kullaniciAdi= $_POST["user"];
//$kullaniciAdi= "sahinbey_";
$href = 'https://www.instagram.com/';
$json = file_get_contents($href . $kullaniciAdi . '/?__a=1');
$data = json_decode($json, true);

$ppHD=$data['graphql']['user']['profile_pic_url_hd'];
$username=$data['graphql']['user']['username'];
$fullname=$data['graphql']['user']['full_name'];
$bio=$data['graphql']['user']['biography'];
$url=$data['graphql']['user']['external_url'];
$mail=$data['graphql']['user']['business_email'];
$takipci=$data['graphql']['user']['edge_followed_by']['count'];
$takip=$data['graphql']['user']['edge_follow']['count'];
$media=$data['graphql']['user']['edge_owner_to_timeline_media']['count'];
?>
<!DOCTYPE html>
<html lang="TR" >
<head>
  <meta charset="UTF-8">
  <title>İnstagram Profil Resmi İndirme</title>
  <link rel="shortcut icon" href="favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="instapp.css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">İnsta PP İndirme</a>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link" href="#">İnsta PP İndir</a></li>
				<li class="nav-item"><a class="nav-link" href="https://bilisimarsivi.com/insanaliz/">İnsta Analiz</a></li>
				<li class="nav-item"><a class="nav-link" href="https://bilisimarsivi.com/">Ana Sayfa</a></li>
				<li class="nav-item"><a class="nav-link" href="https://www.linkedin.com/in/muhammetalisahin/">Linkedin</a></li>
            </ul>
        </div>
    </nav>
<header>
	<br><br><br>
	<div class="container">
	<div class="header">
	<form action="index.php" method="post">
		<input type="text" placeholder="Kullanıcı Adı" name="user">
		<input type="submit" value="Ara">
	</form>
	
	</div>
	
		<div class="profile">
			<?php
			echo '<div class="profile-image"><img  src="'.$ppHD.'"></div>';
			?>
			
			<div class="profile-user-settings">
			<?php
			if($kullaniciAdi==null||$username==null){}else{
			echo '<h1 class="profile-user-name">'.$username.'</h1><a href="'.$ppHD.'"><button class="btn profile-edit-btn">Profil Resmini İndir</button></a>';
			echo'</div><div class="profile-stats"><ul><li><span class="profile-stat-count"> '.$media.' </span> Gönderi</li><li><span class="profile-stat-count"> '.$takipci.' </span> Takipçi</li><li><span class="profile-stat-count"> '.$takip.' </span> Takip</li></ul></div>';}
			?>
			<div class="profile-bio">
				<p><span class="profile-real-name"><?php if($fullname==null){}else{echo $fullname.' : ';}?></span><?php if($bio==null){}else{echo $bio;}?></p>
				<?php if($url==null){
				}else{
					echo '<p><span class="profile-real-name">Web: </span>';
					echo '<a href="';
					echo $url;
					echo '">';
					echo$url;
					echo'</a></p>';
				}
				if($mail==null){
				}else{
					echo '<p><span class="profile-real-name">Web: </span>';
					echo '<a href="mailto:';
					echo $mail;
					echo '">';
					echo$mail;
					echo'</a></p>';}?>
			</div>
		</div>
	</div>
	<?php if($kullaniciAdi==null){echo '<center><h1 style="color:red; font-weight:bold; font-size:30px;">KULLANICI ADI GİRİNİZ</h1></center>';}
		  if($username==null){echo '<center><h1 style="color:red; font-weight:bold; text-aling:center; font-size:30px;">BÖYLE BİR KULLANICI BULUNMUYOR</h1></center>';}?>
</header>

<main>
	<div class="container">
	<hr width="100%" color="#0000F8" size="4"/>
		<div class="gallery">

		<?php
		$gizli=$data['graphql']['user']['is_private'];
            if($gizli=='1'){
				echo'<h1 class="profile-user-name" style="text-align:center; padding-top:30px;">Bu gizli bir profil</h1>';
				echo'</div>';
			}else{
				if($media<12){
					for($sayi = 0; $sayi < $media; $sayi++) {
						$slayt=$data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['edge_sidecar_to_children'];
						$video=$data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['is_video'];
						
						echo'<div class="gallery-item" tabindex="0">';
						echo '<a href="';
						echo $href . 'p/' . $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['shortcode'];
						echo'" style="color:white;">';
						echo ' <img src="';
						echo $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['display_url'];
						echo'" class="gallery-image">';
						if($video==1){echo '<div class="gallery-item-type"><i class="fas fa-video" aria-hidden="true"></i></div>';}
						if($slayt==null){}else{echo '<div class="gallery-item-type"><i class="fas fa-clone" aria-hidden="true"></i></div>';}
						echo'<div class="gallery-item-info"><ul><li class="gallery-item-likes"><i class="fas fa-heart" aria-hidden="true"></i> ';
						echo $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['edge_liked_by']['count'];
						echo'</li><li class="gallery-item-comments"><i class="fas fa-comment" aria-hidden="true"></i> ';
						echo $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['edge_media_to_comment']['count'];
						echo'</li></ul></div></a></div>';
					 }
					 echo'</div><p style="text-align:center; font-weight:bold;">Üzgünüm İnstagramın sağlayabildiğimiz veriler sadece son 12 gönderi için</p>';
				}else{
					for($sayi = 0; $sayi < 12; $sayi++) {
						$slayt=$data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['edge_sidecar_to_children'];
						$video=$data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['is_video'];
						
						echo'<div class="gallery-item" tabindex="0">';
						echo '<a href="';
						echo $href . 'p/' . $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['shortcode'];
						echo'" style="color:white;">';
						echo ' <img src="';
						echo $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['display_url'];
						echo'" class="gallery-image" alt="">';
						if($video==1){echo '<div class="gallery-item-type"><i class="fas fa-video" aria-hidden="true"></i></div>';}
						if($slayt==null){}else{echo '<div class="gallery-item-type"><i class="fas fa-clone" aria-hidden="true"></i></div>';}
						echo'<div class="gallery-item-info"><ul><li class="gallery-item-likes"><i class="fas fa-heart" aria-hidden="true"></i> ';
						echo $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['edge_liked_by']['count'];
						echo'</li><li class="gallery-item-comments"><i class="fas fa-comment" aria-hidden="true"></i> ';
						echo $data['graphql']['user']['edge_owner_to_timeline_media']['edges'][$sayi]['node']['edge_media_to_comment']['count'];
						echo'</li></ul></div></a></div>';
					 }
					 echo'</div><p style="text-align:center; font-weight:bold;">Üzgünüm İnstagramdan sağlayabildiğimiz veriler sadece son 12 gönderi için</p>';
				}
			}
        ?>
		
		<hr width="100%" color="#0000F8" size="4">
		<p style="text-align:center; font-weight:bold;">Backend By <a href="https://www.linkedin.com/in/muhammetalisahin/">Muhammet Ali ŞAHİN</a> ~ clic for <a href="https://codepen.io/GeorgePark/full/VXrwOP/">Frontend design</a></p>
	</div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
