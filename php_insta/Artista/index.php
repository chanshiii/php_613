<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/base.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");</script>
    <script src="js/libs/imagesLoaded.pkgd.min.js"></script>
		<script src="js/libs/pixi.min.js"></script>
		<script src="js/libs/pixi-filters.min.js"></script>
		<script src="js/libs/TweenMax.min.js"></script>
		<script src="js/rgbKineticSlider.js"></script>
<title>HOME</title>
</head>
<!-- Head[Start] -->
<header>
    <?php include("index_menu.php"); ?>
</header>
<!-- Head[End] -->
  
<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<!-- <form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid" />
PW:<input type="password" name="lpw" />
<input type="submit" value="LOGIN" />
</form> -->

		<!--script src="//tympanus.net/codrops/adpacks/analytics.js"></script-->
	</head>
	<body class="demo-1 loading">
		<main>
			<div class="content">
				<div id="rgbKineticSlider" class="rgbKineticSlider"></div>
				<nav>
			        <a href="#" class="main-nav prev" data-nav="previous">Prev <span></span></a>
              <!-- <a href="./user.php" class="user_button">ユーザー登録</a>
              <a href="./login.php" dclass="login_button">ログイン画面へ</a> -->
			        <a href="#" class="main-nav next" data-nav="next">Next <span></span></a>
        </nav>
			</div>
		</main>
		<script>
            // images setup
			const images = [
			    "../img/pexels-john-paul-duhan-6322920.jpg",
			    "../img/pexels-anastasia-shuraeva-4100769.jpg",
			    "../img/pexels-ketut-subiyanto-4963367 (1).jpg",
			];
            
            // content setup
			const texts = [
			    ["Love"],
			    ["Mars"],
			    ["Venus"],
			]
      

			rgbKineticSlider = new rgbKineticSlider({

			    slideImages: images, // array of images > must be 1920 x 1080
			    itemsTitles: texts, // array of titles / subtitles

			    backgroundDisplacementSprite: 'img/map-9.jpg', // slide displacement image 
			    cursorDisplacementSprite: 'img/displace-circle.png', // cursor displacement image

			    cursorImgEffect : true, // enable cursor effect
			    cursorTextEffect : false, // enable cursor text effect
			    cursorScaleIntensity : 0.65, // cursor effect intensity
			    cursorMomentum : 0.14, // lower is slower

			    swipe: true, // enable swipe
			    swipeDistance : window.innerWidth * 0.4, // swipe distance - ex : 580
			    swipeScaleIntensity: 2, // scale intensity during swipping

			    slideTransitionDuration : 1, // transition duration
			    transitionScaleIntensity : 30, // scale intensity during transition
			    transitionScaleAmplitude : 160, // scale amplitude during transition

			    nav: true, // enable navigation
			    navElement: '.main-nav', // set nav class
			    
			    imagesRgbEffect : false, // enable img rgb effect
			    imagesRgbIntensity : 0.9, // set img rgb intensity
			    navImagesRgbIntensity : 80, // set img rgb intensity for regular nav 

			    textsDisplay : true, // show title
			    textsSubTitleDisplay : true, // show subtitles
			    textsTiltEffect : true, // enable text tilt
			    googleFonts : ['Playfair Display:700', 'Roboto:400'], // select google font to use
			    buttonMode : false, // enable button mode for title
			    textsRgbEffect : true, // enable text rgb effect
			    textsRgbIntensity : 0.03, // set text rgb intensity
			    navTextsRgbIntensity : 15, // set text rgb intensity for regular nav

			    textTitleColor : 'white', // title color
			    textTitleSize : 125, // title size
			    mobileTextTitleSize : 125, // title size
			    textTitleLetterspacing : 3, // title letterspacing

			    textSubTitleColor : 'white', // subtitle color ex : 0x000000
			    textSubTitleSize : 21, // subtitle size
			    mobileTextSubTitleSize : 21, // mobile subtitle size
			    textSubTitleLetterspacing : 2, // subtitle letter spacing
			    textSubTitleOffsetTop : 90, // subtitle offset top
			    mobileTextSubTitleOffsetTop : 90, // mobile subtitle offset top
			});
		</script>



</body>
</html>

