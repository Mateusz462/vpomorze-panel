<html lang="pl" class="mdl-js"><head itemscope="" itemtype="http://schema.org/WebSite">

		<script id="facebook-jssdk" src="https://connect.facebook.net/pl_PL/sdk/xfbml.customerchat.js"></script><script async="" src="https://www.google-analytics.com/analytics.js"></script><script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/releases/eKRIyK-9MtX6JxeZcNZIkfUq/recaptcha__pl.js" crossorigin="anonymous" integrity="sha384-DsxmRXEby1kvp4pIPzeN0KujoPvvALjDdC3FW4FXQ7QbiKKPTBC1lLJDiLrvY0fi"></script><script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="UTF-8" src="https://cookie-script.com/s/8f39b274fb106e99733345300b6af92c.js"></script>
		<script type="text/javascript">
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		})
		</script>
		<style>
			.loader {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url('images/rolling.gif') 50% 50% no-repeat rgb(249,249,249);
			}

			.ui-draggable, .ui-droppable {
				background-position: top;
			}

			.demo-list-action {
				width: 300px;
			}
		</style>

		<meta charset="utf-8">
		<title itemprop="name">Strona Główna - Panel vZTM</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link rel="canonical" href="https://www.vztm.pl/" itemprop="url">
		<script type="application/ld+json">
			{
				"@context": "http://schema.org",
				"@type": "Organization",
				"name": "Wirtualny Zarząd Transportu Miejskiego",
				"url": "https://www.vztm.pl/",
				"sameAs": [
					"https://www.facebook.com/wirtualnyzarzadtransportumiejskiego",
					"https://www.instagram.com/vztm_insta/",
					"https://www.youtube.com/c/wirtualnyzarzadtransportumiejskiego"
				]
			}
		</script>

		<script type="text/javascript">
			const site_address = 'https://panel.vztm.pl';
			const WS_ADDRESS = 'https://ws.vztm.pl';
		</script>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-deep_purple.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="icon" sizes="192x192" href="https://panel.vztm.pl/images/icon.png" type="image/png">
		<script defer="" src="https://code.getmdl.io/1.3.0/material.min.js"></script>

		<link rel="stylesheet" href="https://panel.vztm.pl/css/animate.css">

		<link rel="stylesheet" type="text/css" href="https://panel.vztm.pl/css/dialog-polyfill.css">
		<script src="https://panel.vztm.pl/js/dialog-polyfill.js"></script>

		<script type="text/javascript" src="https://panel.vztm.pl/inc/highslide/highslide.js"></script>
		<link rel="stylesheet" type="text/css" href="https://panel.vztm.pl/inc/highslide/highslide.css">	
		<!--<script type="text/javascript" src="https://panel.vztm.pl/js/shoutbox.js"></script>	-->
		<script type="text/javascript" src="https://panel.vztm.pl/js/vztm-functions.js?v=1.13.7"></script>
		<script type="text/javascript" src="https://panel.vztm.pl/js/vztm.js?v=1.13.7" defer=""></script>
		<script type="text/javascript" src="https://panel.vztm.pl/js/vztm-main.js?v=1.13.7" defer=""></script>
		<script type="text/javascript" src="https://panel.vztm.pl/js/vztm-announcements.js?v=1.13.7" defer=""></script>
		<script type="text/javascript" src="https://panel.vztm.pl/js/js.cookie.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/socket.io-client@3/dist/socket.io.js"></script>
		<script type="text/javascript" src="https://panel.vztm.pl/js/lodash.min.js" defer=""></script>
		<script type="text/javascript" src="https://panel.vztm.pl/js/axios.min.js" defer=""></script>

		<script src="https://panel.vztm.pl/js/quill.min.js"></script>
		<link href="https://panel.vztm.pl/css/quill.snow.css" rel="stylesheet">

		<script src="https://www.google.com/recaptcha/api.js"></script>

		<script type="text/javascript" src="https://panel.vztm.pl/js/gdpr.js"></script>
		<script>

			if (Cookies.get('gdpr') === undefined) {
				Cookies.set('gdpr', '0');
			}
			else {
				var gdpr_state = Cookies.get('gdpr');
				if (gdpr_state === '1') {
					$(document).ready(function() {
						gdpr_on();
					});
				}
				else {
					$(document).ready(function() {
						gdpr_off();
					});
				}
			}
		</script>
		
		<link rel="stylesheet" href="https://panel.vztm.pl/css/getmdl-select.min.css">
		<script defer="" src="https://panel.vztm.pl/js/getmdl-select.min.js"></script>

		<link rel="stylesheet" href="https://panel.vztm.pl/css/style.css?v=1.13.7" type="text/css">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})
			(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-59823032-2', 'auto');
			ga('send', 'pageview');
		</script>

		<style type="text/css">.highslide img {cursor: url(inc/highslide/graphics/zoomin.cur), pointer !important;}</style><style type="text/css" data-fbcssmodules="css:fb.css.base css:fb.css.dialog css:fb.css.iframewidget css:fb.css.customer_chat_plugin_iframe">.fb_hidden{position:absolute;top:-10000px;z-index:10001}.fb_reposition{overflow:hidden;position:relative}.fb_invisible{display:none}.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:"lucida grande", tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}.fb_reset>div{overflow:hidden}@keyframes fb_transform{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}.fb_animate{animation:fb_transform .3s forwards}
			.fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}.fb_dialog_advanced{border-radius:8px;padding:10px}.fb_dialog_content{background:#fff;color:#373737}.fb_dialog_close_icon{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px}.fb_dialog_mobile .fb_dialog_close_icon{left:5px;right:auto;top:5px}.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}.fb_dialog_close_icon:hover{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent}.fb_dialog_close_icon:active{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent}.fb_dialog_iframe{line-height:0}.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #365899;color:#fff;font-size:14px;font-weight:bold;margin:0}.fb_dialog_content .dialog_title>span{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}body.fb_hidden{height:100%;left:0;margin:0;overflow:visible;position:absolute;top:-10000px;transform:none;width:100%}.fb_dialog.fb_dialog_mobile.loading{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}.fb_dialog.fb_dialog_mobile.loading.centered{background:none;height:auto;min-height:initial;min-width:initial;width:auto}.fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner{width:100%}.fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content{background:none}.loading.centered #fb_dialog_loader_close{clear:both;color:#fff;display:block;font-size:18px;padding-top:20px}#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .4);bottom:0;left:0;min-height:100%;position:absolute;right:0;top:0;width:100%;z-index:10000}#fb-root #fb_dialog_ipad_overlay.hidden{display:none}.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}.fb_dialog_mobile .fb_dialog_iframe{position:sticky;top:0}.fb_dialog_content .dialog_header{background:linear-gradient(from(#738aba), to(#2c4987));border-bottom:1px solid;border-color:#043b87;box-shadow:white 0 1px 1px -1px inset;color:#fff;font:bold 14px Helvetica, sans-serif;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}.fb_dialog_content .dialog_header table{height:43px;width:100%}.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px}.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px}.fb_dialog_content .touchable_button{background:linear-gradient(from(#4267B2), to(#2a4887));background-clip:padding-box;border:1px solid #29487d;border-radius:3px;display:inline-block;line-height:18px;margin-top:3px;max-width:85px;padding:4px 12px;position:relative}.fb_dialog_content .dialog_header .touchable_button input{background:none;border:none;color:#fff;font:bold 12px Helvetica, sans-serif;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}.fb_dialog_content .dialog_content{background:url(https://static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #4a4a4a;border-bottom:0;border-top:0;height:150px}.fb_dialog_content .dialog_footer{background:#f5f6f7;border:1px solid #4a4a4a;border-top-color:#ccc;height:40px}#fb_dialog_loader_close{float:left}.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}#fb_dialog_loader_spinner{animation:rotateSpinner 1.2s linear infinite;background-color:transparent;background-image:url(https://static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);background-position:50% 50%;background-repeat:no-repeat;height:24px;width:24px}@keyframes rotateSpinner{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
			.fb_iframe_widget{display:inline-block;position:relative}.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}.fb_iframe_widget iframe{position:absolute}.fb_iframe_widget_fluid_desktop,.fb_iframe_widget_fluid_desktop span,.fb_iframe_widget_fluid_desktop iframe{max-width:100%}.fb_iframe_widget_fluid_desktop iframe{min-width:220px;position:relative}.fb_iframe_widget_lift{z-index:1}.fb_iframe_widget_fluid{display:inline}.fb_iframe_widget_fluid span{width:100%}
			.fb_mpn_mobile_landing_page_slide_out{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_out_from_left{animation-duration:200ms;animation-name:fb_mpn_landing_page_slide_out_from_left;transition-timing-function:ease-in}.fb_mpn_mobile_landing_page_slide_up{animation-duration:500ms;animation-name:fb_mpn_landing_page_slide_up;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_in{animation-duration:300ms;animation-name:fb_mpn_bounce_in;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out{animation-duration:300ms;animation-name:fb_mpn_bounce_out;transition-timing-function:ease-in}.fb_mpn_mobile_bounce_out_v2{animation-duration:300ms;animation-name:fb_mpn_fade_out;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_v2{animation-duration:300ms;animation-name:fb_bounce_in_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_in_from_left{animation-duration:300ms;animation-name:fb_bounce_in_from_left;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_v2{animation-duration:300ms;animation-name:fb_bounce_out_v2;transition-timing-function:ease-in}.fb_customer_chat_bounce_out_from_left{animation-duration:300ms;animation-name:fb_bounce_out_from_left;transition-timing-function:ease-in}.fb_customer_chat_bubble_animated_no_badge{box-shadow:0 3px 12px rgba(0, 0, 0, .15);transition:box-shadow 150ms linear}.fb_customer_chat_bubble_animated_no_badge:hover{box-shadow:0 5px 24px rgba(0, 0, 0, .3)}.fb_customer_chat_bubble_animated_with_badge{box-shadow:-5px 4px 14px rgba(0, 0, 0, .15);transition:box-shadow 150ms linear}.fb_customer_chat_bubble_animated_with_badge:hover{box-shadow:-5px 8px 24px rgba(0, 0, 0, .2)}.fb_invisible_flow{display:inherit;height:0;overflow-x:hidden;width:0}.fb_new_ui_mobile_overlay_active{overflow:hidden}@keyframes fb_mpn_landing_page_slide_in{0%{border-radius:50%;margin:0 24px;width:60px}40%{border-radius:18px}100%{margin:0 12px;width:100% - 24px}}@keyframes fb_mpn_landing_page_slide_in_from_left{0%{border-radius:50%;left:12px;margin:0 24px;width:60px}40%{border-radius:18px}100%{left:12px;margin:0 12px;width:100% - 24px}}@keyframes fb_mpn_landing_page_slide_out{0%{margin:0 12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;margin:0 24px;width:60px}}@keyframes fb_mpn_landing_page_slide_out_from_left{0%{left:12px;width:100% - 24px}60%{border-radius:18px}100%{border-radius:50%;left:12px;width:60px}}@keyframes fb_mpn_landing_page_slide_up{0%{bottom:0;opacity:0}100%{bottom:24px;opacity:1}}@keyframes fb_mpn_bounce_in{0%{opacity:.5;top:100%}100%{opacity:1;top:0}}@keyframes fb_mpn_fade_out{0%{bottom:30px;opacity:1}100%{bottom:0;opacity:0}}@keyframes fb_mpn_bounce_out{0%{opacity:1;top:0}100%{opacity:.5;top:100%}}@keyframes fb_bounce_in_v2{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}50%{transform:scale(1.03, 1.03);transform-origin:bottom right}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}}@keyframes fb_bounce_in_from_left{0%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}50%{transform:scale(1.03, 1.03);transform-origin:bottom left}100%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}}@keyframes fb_bounce_out_v2{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom right}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom right}}@keyframes fb_bounce_out_from_left{0%{opacity:1;transform:scale(1, 1);transform-origin:bottom left}100%{opacity:0;transform:scale(0, 0);transform-origin:bottom left}}@keyframes fb_bounce_out_v2_mobile_chat_started{0%{opacity:1;top:0}100%{opacity:0;top:20px}}@keyframes fb_customer_chat_bubble_bounce_in_animation{0%{bottom:6pt;opacity:0;transform:scale(0, 0);transform-origin:center}70%{bottom:18pt;opacity:1;transform:scale(1.2, 1.2)}100%{transform:scale(1, 1)}}@keyframes slideInFromBottom{0%{opacity:.1;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}@keyframes slideInFromBottomDelay{0%{opacity:0;transform:translateY(100%)}97%{opacity:0;transform:translateY(100%)}100%{opacity:1;transform:translateY(0)}}
		</style>
	</head>
	<body>
		<div id="fb-root" class=" fb_reset"><div style="position: absolute; top: -10000px; width: 0px; height: 0px;"><div></div></div></div>

		<script>
			window.fbAsyncInit = function() {
				FB.init({
					xfbml: true,
					version: 'v3.3',
					appId: '108087233179454'
				});
			};

			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/pl_PL/sdk/xfbml.customerchat.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>

		<div class="loader" style="display: none;"></div>

				<div class="mdl-layout__container has-scrolling-header"><div class="mdl-layout mdl-js-layout has-drawer is-upgraded is-small-screen" data-upgraded=",MaterialLayout">
		  <header class="mdl-layout__header mdl-layout__header--scroll">
			<div class="mdl-layout__header-row">
			  <span class="mdl-layout-title"><img style="margin-right: 10px;" src="https://panel.vztm.pl/images/logo.png" height="35" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">Panel zarządzania </span>
			  <div class="mdl-layout-spacer"></div>
			  <nav class="mdl-navigation">
					<a href="przewodnik" style="color: #FFF;"><button class="mdl-button mdl-js-button mdl-button--icon" data-upgraded=",MaterialButton"><i class="material-icons">help</i></button></a>
					<button id="gdpr_toggle" class="mdl-button mdl-js-button mdl-button--icon" data-upgraded=",MaterialButton"><i class="material-icons">explicit</i></button>
					<button class="mdl-button mdl-js-button" disabled="" data-upgraded=",MaterialButton"><font color="white">Witaj Daniel!</font></button>
					<a href="wiadomosci"><button style="color: white;" class="mdl-button mdl-js-button" data-upgraded=",MaterialButton"><i class="material-icons">local_post_office</i></button></a>
				<a class="mdl-navigation__link" href="https://panel.vztm.pl/logout.php"><button class="mdl-button mdl-js-button" data-upgraded=",MaterialButton"><font color="white">Wyloguj się</font></button></a>
			  </nav>
			</div>
		  </header>
		  <div class="mdl-layout__drawer" aria-hidden="true">
			<span class="mdl-layout-title"><img style="margin-top: 10px;" src="https://panel.vztm.pl/images/logoczarne.png" height="35" oncontextmenu="return false" ondragstart="return false" onselectstart="return false"><br>Menu zadań</span>
			<nav class="mdl-navigation">
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/strona-glowna"><i class="material-icons">explore</i> Start</a>
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/raporty"><i class="material-icons">assignment</i> Raporty</a>
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/grafik"><i class="material-icons">perm_contact_calendar</i> Grafik</a>
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/pracownicy"><i class="material-icons">group</i> Pracownicy</a>			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/tabor"><i class="material-icons">directions_bus</i> Tabor</a>			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/wnioski"><i class="material-icons">class</i> Wnioski</a>
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/zgloszenia"><i class="material-icons">report_problem</i> Zgłoszenia</a>
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/pobieralnia"><i class="material-icons">get_app</i> Pobieralnia</a>
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/ustawienia-profilu"><i class="material-icons">settings</i> Ustawienia profilu</a>
			  <a class="mdl-navigation__link" href="https://panel.vztm.pl/patron"><i class="material-icons">card_giftcard</i> Zostań patronem!</a>
			</nav>
		  </div>
		  <div aria-expanded="false" role="button" tabindex="0" class="mdl-layout__drawer-button"><i class="material-icons"></i></div><main class="mdl-layout__content">
			<div class="page-content">
			<div class="wrapper">
			<style>
				.demo-list-action {
				  width: 300px;
				}
			</style>
<style>
.mainpage-avatar {
			background: url(https://panel.vztm.pl/images/bus.svg) #05A985 no-repeat center;
	}
</style>

<div class="mdl-grid">
	<div class="mdl-cell mdl-cell--12-col box">
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect mdl-js-ripple-effect--ignore-events is-upgraded" data-upgraded=",MaterialTabs,MaterialRipple">

					<div class="mdl-tabs__tab-bar">
				<a href="#info-panel" class="mdl-tabs__tab is-active">Informacje<span class="mdl-tabs__ripple-container mdl-js-ripple-effect" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></a>
				<a href="#you-panel" class="mdl-tabs__tab">O tobie<span class="mdl-tabs__ripple-container mdl-js-ripple-effect" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></a>
				<a href="#ranks-panel" class="mdl-tabs__tab">Ranking<span class="mdl-tabs__ripple-container mdl-js-ripple-effect" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></a>
				 <a href="#manager-panel" class="mdl-tabs__tab">Menedżer firmy<span class="mdl-tabs__ripple-container mdl-js-ripple-effect" data-upgraded=",MaterialRipple"><span class="mdl-ripple"></span></span></a>							</div>

			
			<div class="mdl-tabs__panel is-active" id="info-panel">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
										<div class="mainpage-topbar">
					<div class="mainpage-user-info">
						<div class="mainpage-avatar mdl-shadow--4dp"></div>
						<div class="mainpage-info">
							<h4><span class="gdpr"><span class="name">Daniel Baran</span></span></h4>
							<h6><span class="gdpr"><span class="name">deny3011</span></span> [SA-100]</h6>
							<h6>Specjalista ds. Kadrowo-Administracyjnych
</h6>
						</div>
					</div>
											<div class="mainpage-active-users users-loaded">
							<div class="active-users-view--loader">
								<div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active is-upgraded" data-upgraded=",MaterialSpinner"><div class="mdl-spinner__layer mdl-spinner__layer-1"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div><div class="mdl-spinner__layer mdl-spinner__layer-2"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div><div class="mdl-spinner__layer mdl-spinner__layer-3"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div><div class="mdl-spinner__layer mdl-spinner__layer-4"><div class="mdl-spinner__circle-clipper mdl-spinner__left"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__gap-patch"><div class="mdl-spinner__circle"></div></div><div class="mdl-spinner__circle-clipper mdl-spinner__right"><div class="mdl-spinner__circle"></div></div></div></div>
							</div>
							<div class="active-users-view--users">
								<div class="active-users-view--users--title">
									<span style="text-transform: uppercase; color: #ABABAB; letter-spacing: .2em; font-weight: 200; font-size: .5em;">Użytkownicy online:</span>
								</div>
								<div class="online-users"><span class="mdl-chip animate__animated animate__bounceIn" data-user="222"><span class="mdl-chip__text">deny3011 [SA-100]</span></span><span class="mdl-chip animate__animated animate__bounceIn mdl-chip--contact" data-user="1308"><img class="mdl-chip__contact" src="https://panel.vztm.pl/files/avatars/9f7cf81da04a9afb-32.jpg"><span class="mdl-chip__text">Ajejek [TK-121]</span></span><span class="mdl-chip animate__animated animate__bounceIn mdl-chip--contact" data-user="1391"><img class="mdl-chip__contact" src="https://panel.vztm.pl/files/avatars/989ef64ee3bf6da5-32.jpg"><span class="mdl-chip__text">Krysto320 [TE-113]</span></span><span class="mdl-chip animate__animated animate__bounceIn" data-user="1408"><span class="mdl-chip__text">Michcio5312 [TT-110]</span></span></div>
							</div>
						</div>
									</div>
								</div>
					<div class="mdl-cell mdl-cell--3-col">
						<h4>Szybkie linki</h4>
												<ul class="demo-list-icon mdl-list">
							              	<li class="mdl-list__item needs">
                	<span class="mdl-list__item-primary-content">Zasady pracy na służbie</span>
                	<a class="mdl-list__item-secondary-action" target="_blank" href="https://panel.vztm.pl/files/zasady-pracy-na-sluzbie-vztm.pdf"><i class="material-icons">forward</i></a>
                </li>
							              	<li class="mdl-list__item needs">
                	<span class="mdl-list__item-primary-content">Zasady rozliczania raportów</span>
                	<a class="mdl-list__item-secondary-action" target="_blank" href="https://panel.vztm.pl/files/zasady-rozliczania-raportow-vztm.pdf"><i class="material-icons">forward</i></a>
                </li>
							              	<li class="mdl-list__item needs">
                	<span class="mdl-list__item-primary-content">Regulamin shoutbox'a</span>
                	<a class="mdl-list__item-secondary-action" target="_blank" href="https://panel.vztm.pl/files/regulamin-shoutboxa-vztm.pdf"><i class="material-icons">forward</i></a>
                </li>
							              	<li class="mdl-list__item needs">
                	<span class="mdl-list__item-primary-content">Pytania i odpowiedzi</span>
                	<a class="mdl-list__item-secondary-action" target="_blank" href="https://www.vztm.pl/faq"><i class="material-icons">forward</i></a>
                </li>
							              	<li class="mdl-list__item needs">
                	<span class="mdl-list__item-primary-content">Wykaz brygad</span>
                	<a class="mdl-list__item-secondary-action" target="_blank" href="https://docs.google.com/spreadsheets/d/e/2PACX-1vRTwX40CntDxPo3uqkhLWfIGHhUhh_UjLIGOecnkGcB25CnMeBpPAHSLqH7FTrlyYk7Y9YZcDYNGNQg/pubhtml?fbclid=IwAR0dlZcJYDzqkqLWcqMppA1A4scONuaTrv6lJ6bBsAandn2BfvBenXSglo0#"><i class="material-icons">forward</i></a>
                </li>
													</ul>
					</div>

					<div class="mdl-cell mdl-cell--6-col">
						<h4>Shoutbox</h4>
						<div class="mdl-grid mdl-grid--no-spacing">
              <div style="width: 100%; height: 220px; overflow-y: scroll;" id="scroll" class="mdl-cell mdl-cell--12-col scroll">
              	<div id="shoutbox-messages" class="mdl-grid mdl-grid--no-spacing"><div id="sb-message-9488" class="mdl-cell mdl-cell--12-col sb-message-1407 sb-message" data-message-id="9488" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #000; "><s>TTomasz</s>:</b> hej</div><div id="sb-message-9487" class="mdl-cell mdl-cell--12-col sb-message-1407 sb-message" data-message-id="9487" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #000; "><s>TTomasz</s>:</b> dobry</div><div id="sb-message-9486" class="mdl-cell mdl-cell--12-col sb-message-1182 sb-message" data-message-id="9486" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-135] MartinPoGodzinach:</b> witam</div><div id="sb-message-9485" class="mdl-cell mdl-cell--12-col sb-message-1408 sb-message" data-message-id="9485" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #000; ">[TT-110] Michcio5312:</b> Witam</div><div id="sb-message-9484" class="mdl-cell mdl-cell--12-col sb-message-1182 sb-message" data-message-id="9484" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-135] MartinPoGodzinach:</b> nikomu nie działa</div><div id="sb-message-9483" class="mdl-cell mdl-cell--12-col sb-message-1363 sb-message" data-message-id="9483" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-111] Patryk_K.K:</b> czy tylko mi nie działają zapowiedzi w conecto i sygnał odjazdu w sterowniku ? </div><div id="sb-message-9482" class="mdl-cell mdl-cell--12-col sb-message-743 sb-message" data-message-id="9482" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-126] domk320:</b> Domyślnie była to 22:00. Ale teraz jest o północy. Pierwotna godzina ma zostać przywrócona, ale nikt nie wie kiedy</div><div id="sb-message-9481" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9481" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> *ale</div><div id="sb-message-9480" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9480" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> Informacje o tym jaki masz pojazd dostajesz bodajże o godzinie 22.00 dzień przed służbą (Nie jestem pewien, ae chyba tak)</div><div id="sb-message-9479" class="mdl-cell mdl-cell--12-col sb-message-1399 sb-message" data-message-id="9479" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #000; "><s>Daniel_11</s>:</b> ej w dniu służby dostane informacje jaki pojazd będe miał przydzielony ?</div><div id="sb-message-9478" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9478" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> *zastanawiałem</div><div id="sb-message-9477" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9477" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> Okej, tak sam się wcześniej zastanawiałęm i już rozumiem :)</div><div id="sb-message-9476" class="mdl-cell mdl-cell--12-col sb-message-1244 sb-message" data-message-id="9476" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-105] kubba92:</b> Jest dokładnie odwrotnie. Masz z góry ustaloną brygadę, więc jest jasno określone w którą stronę na danej brygadzie jedziesz </div><div id="sb-message-9475" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9475" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> Jeżeli zaczynam na przystanku podmianowym to obojętne w którym kierunku to jest na danej linii?</div><div id="sb-message-9474" class="mdl-cell mdl-cell--12-col sb-message-1209 sb-message" data-message-id="9474" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-101] Kryst123:</b> chyba 905 to przerwa</div><div id="sb-message-9473" class="mdl-cell mdl-cell--12-col sb-message-1209 sb-message" data-message-id="9473" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-101] Kryst123:</b> wybierz z belki nie pamietam kodow </div><div id="sb-message-9472" class="mdl-cell mdl-cell--12-col sb-message-1358 sb-message" data-message-id="9472" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-118] Adamus:</b> mam pytanko jak napić te wszystkie specjalne kody na wyświetlacz [23:27] np przerwa</div><div id="sb-message-9471" class="mdl-cell mdl-cell--12-col sb-message-1337 sb-message" data-message-id="9471" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-125] Kwadracik3:</b> Ja posiadam jedną z nich</div><div id="sb-message-9470" class="mdl-cell mdl-cell--12-col sb-message-1337 sb-message" data-message-id="9470" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-125] Kwadracik3:</b> Już chyba z 2/3 wersje wyszły</div><div id="sb-message-9469" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9469" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> Jutro jakoś sobie ten allist ułoże</div><div id="sb-message-9468" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9468" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> OK, dziękuje, jak na razie działa bez zarzutu, wielkie dzięki :)</div><div id="sb-message-9467" class="mdl-cell mdl-cell--12-col sb-message-743 sb-message" data-message-id="9467" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-126] domk320:</b> Autobusy</div><div id="sb-message-9466" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9466" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> Ale samochody tylko? czy autobusy też?</div><div id="sb-message-9465" class="mdl-cell mdl-cell--12-col sb-message-743 sb-message" data-message-id="9465" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-126] domk320:</b> Wyłącz całkowicie AI w ustawieniach</div><div id="sb-message-9464" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9464" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> *spadają</div><div id="sb-message-9463" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9463" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> i co 10 sekund fps mi spaają do 10</div><div id="sb-message-9462" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9462" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> Mhm, tylko że teraz po pobraniu tego repozytorium to po wczytaniu mapy, cały czas mam loading AI, czy to jade autobusem czy to stoje i tak cały czas</div><div id="sb-message-9461" class="mdl-cell mdl-cell--12-col sb-message-743 sb-message" data-message-id="9461" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-126] domk320:</b> Ktoś robił firmowy ailist, ale on ma błedy i bardzo znacząco ścina grę</div><div id="sb-message-9460" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9460" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> nie umiem ustawić żeby autobusy mi z repozytorium jezdzily</div><div id="sb-message-9459" class="mdl-cell mdl-cell--12-col sb-message-1391 sb-message" data-message-id="9459" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-113] Krysto320:</b> Mam problem z alistem</div><div id="sb-message-9458" class="mdl-cell mdl-cell--12-col sb-message-1209 sb-message" data-message-id="9458" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-101] Kryst123:</b> Bry</div><div id="sb-message-9457" class="mdl-cell mdl-cell--12-col sb-message-5 sb-message" data-message-id="9457" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #F06292; ">[AP-000] Artystek:</b> Szczęść Boże </div><div id="sb-message-9456" class="mdl-cell mdl-cell--12-col sb-message-1386 sb-message" data-message-id="9456" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-109] wojciech.lica:</b> Dzięki</div><div id="sb-message-9455" class="mdl-cell mdl-cell--12-col sb-message-1375 sb-message" data-message-id="9455" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #000; "><s>JustKinks</s>:</b> 2. Pierwsza połówka pierwszych dzwi musi byc zamknieta </div><div id="sb-message-9454" class="mdl-cell mdl-cell--12-col sb-message-1375 sb-message" data-message-id="9454" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #000; "><s>JustKinks</s>:</b> 1 jak masz w grfiku zmiane to musisz chyba ze masz anulowana </div><div id="sb-message-9453" class="mdl-cell mdl-cell--12-col sb-message-1386 sb-message" data-message-id="9453" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-109] wojciech.lica:</b> Cześć dzień dobry mam 2 pytania pierwsze to czy jak zmieniłem dzień wykonywania służb z piątku na wtorek to czy będę musiał wykonać służbę z  grafiku w piątek? A drugie pytanie to czy już można otwierać 1 drzwi?</div><div id="sb-message-9452" class="mdl-cell mdl-cell--12-col sb-message-3 sb-message" data-message-id="9452" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #c62828; ">[P-000] Przemexes:</b> Modyfikacja na znaczek? Przecież wszystko jest w repozytorium... Proszę przeczytać ReadMe.</div><div id="sb-message-9451" class="mdl-cell mdl-cell--12-col sb-message-1387 sb-message" data-message-id="9451" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #5775C4; ">[TE-102] Fabka45:</b> dołączam się do pytania modyfikacje na znaczek mam a nie działa</div><div id="sb-message-9450" class="mdl-cell mdl-cell--12-col sb-message-1209 sb-message" data-message-id="9450" style="padding: 5px; border-bottom: 0.2px solid lightgrey;"><b style="color: #0f3bac; ">[TK-101] Kryst123:</b> hehe</div><div id="sb-message-9449" class="mdl-cell mdl-cell--12-col sb-message-3 sb-message" data-message-id="9449" style="padding: 5px; "><b style="color: #c62828; ">[P-000] Przemexes:</b> tak się rzuciliście na Conecto, że aż wywaliło haha</div></div>
              </div>
            	<div id="mode" style="" class="mdl-cell mdl-cell--12-col"><form method="post" id="shoutbox-form"><div style="width: 100%;" class="mdl-textfield mdl-js-textfield"><input class="mdl-textfield__input" name="sbmessage" autocomplete="off" maxlength="1024" type="text" id="sbTextBox"><label class="mdl-textfield__label" for="sbTextBox">Wpisz wiadomość...</label></div><input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1"></form></div>
            </div>
          </div>

					<div class="mdl-cell mdl-cell--3-col">
						<h4>Facebook</h4>
						<div style="width: 100%;" class="fb-group fb_iframe_widget" data-href="https://www.facebook.com/groups/vztm.pracownicy" data-width="" data-show-social-context="false" data-show-metadata="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=108087233179454&amp;container_width=393&amp;href=https%3A%2F%2Fwww.facebook.com%2Fgroups%2Fvztm.pracownicy&amp;locale=pl_PL&amp;sdk=joey&amp;show_metadata=false&amp;show_social_context=false&amp;width="><span style="vertical-align: bottom; width: 393px; height: 302px;"><iframe name="f3f5f48e09dfafc" width="1000px" height="1000px" data-testid="fb:group Facebook Social Plugin" title="fb:group Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v3.3/plugins/group.php?app_id=108087233179454&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df16e53e71abb%26domain%3Dpanel.vztm.pl%26origin%3Dhttps%253A%252F%252Fpanel.vztm.pl%252Ff1029685a80ea%26relation%3Dparent.parent&amp;container_width=393&amp;href=https%3A%2F%2Fwww.facebook.com%2Fgroups%2Fvztm.pracownicy&amp;locale=pl_PL&amp;sdk=joey&amp;show_metadata=false&amp;show_social_context=false&amp;width=" style="border: none; visibility: visible; width: 393px; height: 302px;" class=""></iframe></span></div>
					</div>

					<div class="mdl-cell mdl-cell--9-col">
						<h4>Ogłoszenia</h4>
						<div class="mdl-grid">
														<div class="mdl-cell mdl-cell--4-col ann-box mdl-shadow--2dp " data-id="33" data-action="view-ann">
									<div class="ann-box-content">
										<p>27.06.2021</p>
										<h5>KONKURS NA NAJLEPSZY WAKACYJNY SCREEN!</h5>
									</div>
									<div class="ann-labels">
										
													<span class="mdl-chip" style="background: #e4d35e; ">
														<span class="mdl-chip__text">Konkurs</span>
													</span>

												
													<span class="mdl-chip" style="background: #dedede; ">
														<span class="mdl-chip__text">Inne</span>
													</span>

												
									</div>
									<button style="width: 100%; margin-top: 16px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Zobacz<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
								</div>
															<div class="mdl-cell mdl-cell--4-col ann-box mdl-shadow--2dp " data-id="32" data-action="view-ann">
									<div class="ann-box-content">
										<p>23.06.2021</p>
										<h5>KONKURS NA STANOWISKO DYSPOZYTOR IREX</h5>
									</div>
									<div class="ann-labels">
										
													<span class="mdl-chip" style="background: #e4d35e; ">
														<span class="mdl-chip__text">Konkurs</span>
													</span>

												
									</div>
									<button style="width: 100%; margin-top: 16px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Zobacz<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
								</div>
															<div class="mdl-cell mdl-cell--4-col ann-box mdl-shadow--2dp " data-id="20" data-action="view-ann">
									<div class="ann-box-content">
										<p>21.03.2021</p>
										<h5>ROZPORZĄDZENIE DYREKTORA DS. PRZEWOZÓW vZTM WS. ZASAD FUNKCJONOWANIA INFORMACJI PASAŻERSKIEJ</h5>
									</div>
									<div class="ann-labels">
										
													<span class="mdl-chip" style="background: #e54b4b; ">
														<span class="mdl-chip__text">Rozporządzenie</span>
													</span>

												
									</div>
									<button style="width: 100%; margin-top: 16px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Zobacz<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
								</div>
															<div class="mdl-cell mdl-cell--4-col ann-box mdl-shadow--2dp " data-id="3" data-action="view-ann">
									<div class="ann-box-content">
										<p>24.01.2021</p>
										<h5>ROZPORZĄDZENIE PREZESA vZTM WS. ZRZUTÓW EKRANU</h5>
									</div>
									<div class="ann-labels">
										
													<span class="mdl-chip" style="background: #e54b4b; ">
														<span class="mdl-chip__text">Rozporządzenie</span>
													</span>

												
									</div>
									<button style="width: 100%; margin-top: 16px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Zobacz<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
								</div>
															<div class="mdl-cell mdl-cell--4-col ann-box mdl-shadow--2dp " data-id="2" data-action="view-ann">
									<div class="ann-box-content">
										<p>24.01.2021</p>
										<h5>ROZPORZĄDZENIE PREZESA vZTM WS. ZAWIESZEŃ PRACOWNIKÓW</h5>
									</div>
									<div class="ann-labels">
										
													<span class="mdl-chip" style="background: #e54b4b; ">
														<span class="mdl-chip__text">Rozporządzenie</span>
													</span>

												
									</div>
									<button style="width: 100%; margin-top: 16px;" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-upgraded=",MaterialButton,MaterialRipple">Zobacz<span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
								</div>
													</div>
					</div>

					<dialog class="mdl-dialog" id="ann-dialog">
						<div class="mdl-dialog__content"></div>
						<div class="mdl-dialog__actions">
							<button type="button" class="mdl-button close">Zamknij</button>
						</div>
					</dialog>

					<div class="mdl-cell mdl-cell--3-col">
						<h4>Discord</h4>
						<iframe src="https://discordapp.com/widget?id=482278748301819904&amp;theme=dark&amp;username=[SA-100] deny3011" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
					</div>

				</div>
			</div>

			<div class="mdl-tabs__panel" id="you-panel">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col">
						<div class="mdl-cell mdl-cell--12-col">
											<div class="mainpage-topbar">
					<div class="mainpage-user-info">
						<div class="mainpage-avatar mdl-shadow--4dp"></div>
						<div class="mainpage-info">
							<h4><span class="gdpr"><span class="name">Daniel Baran</span></span></h4>
							<h6><span class="gdpr"><span class="name">deny3011</span></span> [SA-100]</h6>
							<h6>Specjalista ds. Kadrowo-Administracyjnych
</h6>
						</div>
					</div>
									</div>
									</div>
						<div class="mdl-cell mdl-cell--12-col">
														<h4>Informacje</h4>
							<p>
								<b>Adres email:</b> deny3011@wp.pl<br>
								<b>Oddział:</b> IREX<br>
								<b>Data dołączenia:</b> 29.10.2018<br>
								<b>Data rozpoczęcia pracy:</b> 01.11.2018<br>
								<b>Kod pracownika:</b> SA-100<br>
								<b>Wykonane służby:</b> 85<br>
								<b>Przejechana odległość: </b>1318 km<br>
								<b>Zdobyte punkty:</b> 1235.75<br>
																<b>Etat:</b> NNGP<br>
								</p><div class="workrange-days">
									
										<div class="mainpage-day mainpage-day-no">PO</div>

										
										<div class="mainpage-day mainpage-day-no">WT</div>

										
										<div class="mainpage-day mainpage-day-no">ŚR</div>

										
										<div class="mainpage-day mainpage-day-no">CZ</div>

										
										<div class="mainpage-day mainpage-day-no">PT</div>

										
										<div class="mainpage-day mainpage-day-no">SO</div>

										
										<div class="mainpage-day mainpage-day-no">ND</div>

																		</div>
							<p></p>

							<h4>Najbliższe urlopy</h4>
															<p>Brak najbliższych urlopów</p>
							
						</div>
					</div>
					<div class="mdl-cell mdl-cell--4-col">
						<h4>Ostatnie wnioski</h4>
						<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" data-upgraded=",MaterialDataTable">
							<thead>
								<tr>
									<th>Nr</th>
									<th class="mdl-data-table__cell--non-numeric">Wniosek o</th>
									<th class="mdl-data-table__cell--non-numeric">Data</th>
									<th class="mdl-data-table__cell--non-numeric">Status</th>
								</tr>
							</thead>
							<tbody>
								
										<tr>
											<td>13233</td>
											<td class="mdl-data-table__cell--non-numeric">KZW</td>
											<td class="mdl-data-table__cell--non-numeric">11.06.2021</td>
											<td class="mdl-data-table__cell--non-numeric"><b style="color: #4CAF50;">Przyjęty</b></td>
										</tr>
									
										<tr>
											<td>13069</td>
											<td class="mdl-data-table__cell--non-numeric">KZW</td>
											<td class="mdl-data-table__cell--non-numeric">30.05.2021</td>
											<td class="mdl-data-table__cell--non-numeric"><b style="color: #4CAF50;">Przyjęty</b></td>
										</tr>
									
										<tr>
											<td>12997</td>
											<td class="mdl-data-table__cell--non-numeric">KZW</td>
											<td class="mdl-data-table__cell--non-numeric">27.05.2021</td>
											<td class="mdl-data-table__cell--non-numeric"><b style="color: #4CAF50;">Przyjęty</b></td>
										</tr>
									
									<tr>
										<td class="mdl-data-table__cell--non-numeric" colspan="5"><a href="/wnioski">Zobacz więcej wniosków</a></td>
									</tr>

															</tbody>
						</table>

						<h4>Ostatnie raporty</h4>
						<table style="width:100%;" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" data-upgraded=",MaterialDataTable">
							<thead>
								<tr>
									<th>Nr</th>
									<th class="mdl-data-table__cell--non-numeric">Służba</th>
									<th class="mdl-data-table__cell--non-numeric">Data</th>
									<th class="mdl-data-table__cell--non-numeric">Status</th>
								</tr>
							</thead>
							<tbody>
															<tr>
									<td>21310</td>
									<td class="mdl-data-table__cell--non-numeric">S-57/3-1</td>
									<td class="mdl-data-table__cell--non-numeric">12.06.2021</td>
									<td class="mdl-data-table__cell--non-numeric"><b style="color: #4CAF50;"> Zaliczony</b></td>
								</tr>
															<tr>
									<td>21091</td>
									<td class="mdl-data-table__cell--non-numeric">P-700/1-2</td>
									<td class="mdl-data-table__cell--non-numeric">31.05.2021</td>
									<td class="mdl-data-table__cell--non-numeric"><b style="color: #4CAF50;"> Zaliczony</b></td>
								</tr>
															<tr>
									<td>20752</td>
									<td class="mdl-data-table__cell--non-numeric">P-156/1-1</td>
									<td class="mdl-data-table__cell--non-numeric">10.05.2021</td>
									<td class="mdl-data-table__cell--non-numeric"><b style="color: #4CAF50;"> Zaliczony</b></td>
								</tr>
															<tr>
									<td class="mdl-data-table__cell--non-numeric" colspan="5"><a href="/raporty">Zobacz więcej raportów</a></td>
								</tr>
														</tbody>
						</table>
					</div>

					<div class="mdl-cell mdl-cell-3-col">
						<h4>Twój pojazd</h4>
														<style>
									.vehicle-card-square.mdl-card {
										width: 370px;
										height: 320px;
									}
									.vehicle-card-square > .mdl-card__title {
										font-weight: bold;
										background: url('buses/screenshots/79.jpg') center / cover;
									}
								</style>

								<div class="vehicle-card-square mdl-card mdl-shadow--2dp">

									<div class="mdl-card__title mdl-card--expand"></div>

									<div class="mdl-card__supporting-text">
										<h2 style="margin-bottom: 10px;" class="mdl-card__title-text">Solaris Urbino 18 Euro 6  #5004</h2>
										<b>Pulpit:</b> Actia<br>
										<b>Skrzynia:</b> Voith<br>
										<b>Rejestracja:</b> WGM SH00<br>
										<b>Przegląd:</b> 27.10.2021<br>
									</div>

								</div>

											</div>
				</div>
			</div>

			<div class="mdl-tabs__panel" id="ranks-panel">
				<div class="mdl-grid">
					
								<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
									<h4>TOP 10 punktów</h4>
									<table style="width: 100%;" class="ranking-tbl mdl-data-table mdl-js-data-table mdl-shadow--2dp" data-unit="pkt" data-type="points" data-upgraded=",MaterialDataTable">
										<thead>
											<tr>
												<th>Miejsce</th>
												<th class="mdl-data-table__cell--non-numeric">Uzytkownik</th>
												<th>Punkty</th>
											</tr>
										</thead>
										<tbody>
											
										<tr class="ranking-place-1"><td>1</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #6DBAA1" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">kubba92</span></span> [TK-105]</span></div></td><td>8752 pkt</td></tr><tr class="ranking-place-2"><td>2</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0080C5 url(https://panel.vztm.pl/files/avatars/f24c48beacc45526-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">domk320</span></span> [TK-126]</span></div></td><td>7347 pkt</td></tr><tr class="ranking-place-3"><td>3</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #8987BC url(https://panel.vztm.pl/files/avatars/7cbb9eba49bb1c85-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Krystian581</span></span> [TK-117]</span></div></td><td>5277 pkt</td></tr><tr><td>4</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #3F51B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">widmo1</span></span> [TK-107]</span></div></td><td>4428.5 pkt</td></tr><tr><td>5</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0080C5 url(https://panel.vztm.pl/files/avatars/0ca0e474f9490eda-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">daniels</span></span> [K-100]</span></div></td><td>3932.5 pkt</td></tr><tr><td>6</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #3F51B5 url(https://panel.vztm.pl/files/avatars/95789689d650d446-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">TheMateusz7833</span></span> [TK-125]</span></div></td><td>3322 pkt</td></tr><tr><td>7</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0080C5 url(https://panel.vztm.pl/files/avatars/cc21f737683348b5-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Domi2004</span></span> [SP-100]</span></div></td><td>3199 pkt</td></tr><tr><td>8</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0080C5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">gazeło697</span></span> [TK-122]</span></div></td><td>3089 pkt</td></tr><tr><td>9</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #006CC6" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">JNW</span></span> [TK-141]</span></div></td><td>3070.5 pkt</td></tr><tr><td>10</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5 url(https://panel.vztm.pl/files/avatars/2dc6fc30e05219d0-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Dominoautobus3013</span></span> [TK-115]</span></div></td><td>2943.5 pkt</td></tr><td class="mdl-data-table__cell--non-numeric" colspan="3" style="text-align: center;">...</td><tr><td>28</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #05A985" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">deny3011</span></span> [SA-100]</span></div></td><td>1235.75 pkt</td></tr></tbody>
									</table>
								</div>
						
								<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
									<h4>TOP 10 wykonanych służb</h4>
									<table style="width: 100%;" class="ranking-tbl mdl-data-table mdl-js-data-table mdl-shadow--2dp" data-unit="" data-type="courses" data-upgraded=",MaterialDataTable">
										<thead>
											<tr>
												<th>Miejsce</th>
												<th class="mdl-data-table__cell--non-numeric">Uzytkownik</th>
												<th>Służby</th>
											</tr>
										</thead>
										<tbody>
											
										<tr class="ranking-place-1"><td>1</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0080C5 url(https://panel.vztm.pl/files/avatars/bf9bcf2e5a9dae10-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">pawlos06</span></span> [TK-113]</span></div></td><td>534 </td></tr><tr class="ranking-place-2"><td>2</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #05A985 url(https://panel.vztm.pl/files/avatars/509567f2409ada6c-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Pawel</span></span> [TK-111]</span></div></td><td>452 </td></tr><tr class="ranking-place-3"><td>3</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #05A985" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">widmo1</span></span> [TK-107]</span></div></td><td>352 </td></tr><tr><td>4</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #006CC6 url(https://panel.vztm.pl/files/avatars/2dc6fc30e05219d0-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Dominoautobus3013</span></span> [TK-115]</span></div></td><td>312 </td></tr><tr><td>5</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">michalm</span></span> [DP-103]</span></div></td><td>277 </td></tr><tr><td>6</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">wojtekets2</span></span> [TK-104]</span></div></td><td>242 </td></tr><tr><td>7</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5 url(https://panel.vztm.pl/files/avatars/7cbb9eba49bb1c85-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Krystian581</span></span> [TK-117]</span></div></td><td>223 </td></tr><tr><td>8</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #3F51B5 url(https://panel.vztm.pl/files/avatars/cc21f737683348b5-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Domi2004</span></span> [SP-100]</span></div></td><td>201 </td></tr><tr><td>9</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">Mat_517</span></span> [TK-129]</span></div></td><td>194 </td></tr><tr><td>10</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #05A985 url(https://panel.vztm.pl/files/avatars/e9e83dd0320be7a2-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">WhoNext</span></span> [DG-100]</span></div></td><td>185 </td></tr><td class="mdl-data-table__cell--non-numeric" colspan="3" style="text-align: center;">...</td><tr><td>26</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #009E9D" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">deny3011</span></span> [SA-100]</span></div></td><td>85 </td></tr></tbody>
									</table>
								</div>
						
								<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
									<h4>TOP 10 przejechanych kilometrów</h4>
									<table style="width: 100%;" class="ranking-tbl mdl-data-table mdl-js-data-table mdl-shadow--2dp" data-unit="km" data-type="kilometers" data-upgraded=",MaterialDataTable">
										<thead>
											<tr>
												<th>Miejsce</th>
												<th class="mdl-data-table__cell--non-numeric">Uzytkownik</th>
												<th>Odległość</th>
											</tr>
										</thead>
										<tbody>
											
										<tr class="ranking-place-1"><td>1</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0080C5 url(https://panel.vztm.pl/files/avatars/f24c48beacc45526-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">domk320</span></span> [TK-126]</span></div></td><td>13966.81 km</td></tr><tr class="ranking-place-2"><td>2</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #6DBAA1" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">widmo1</span></span> [TK-107]</span></div></td><td>10842.57 km</td></tr><tr class="ranking-place-3"><td>3</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #8987BC url(https://panel.vztm.pl/files/avatars/7cbb9eba49bb1c85-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Krystian581</span></span> [TK-117]</span></div></td><td>7377.46 km</td></tr><tr><td>4</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #3F51B5 url(https://panel.vztm.pl/files/avatars/bf9bcf2e5a9dae10-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">pawlos06</span></span> [TK-113]</span></div></td><td>6667 km</td></tr><tr><td>5</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5 url(https://panel.vztm.pl/files/avatars/509567f2409ada6c-32.jpg) center/contain no-repeat;" class="avatar avatar--s-32"></div><span><span class="gdpr"><span class="name">Pawel</span></span> [TK-111]</span></div></td><td>6556 km</td></tr><tr><td>6</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #009E9D" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">AndrzejPL</span></span> [TK-102]</span></div></td><td>5468.37 km</td></tr><tr><td>7</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">Kapi461</span></span> [TK-134]</span></div></td><td>4945.04 km</td></tr><tr><td>8</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #3F51B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">JNW</span></span> [TK-141]</span></div></td><td>4876.9 km</td></tr><tr><td>9</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">michalm</span></span> [DP-103]</span></div></td><td>4787.98 km</td></tr><tr><td>10</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #0091B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">kubba92</span></span> [TK-105]</span></div></td><td>4630.51 km</td></tr><td class="mdl-data-table__cell--non-numeric" colspan="3" style="text-align: center;">...</td><tr><td>33</td><td class="mdl-data-table__cell--non-numeric"><div class="avatar-username--container"><div style="background: #3F51B5" class="avatar--no-set avatar--s-32"><div style="background: url(https://panel.vztm.pl/images/bus.svg) center/contain no-repeat;" class="avatar avatar--s-32"></div></div><span><span class="gdpr"><span class="name">deny3011</span></span> [SA-100]</span></div></td><td>1318 km</td></tr></tbody>
									</table>
								</div>
										</div>
			</div>

							<div class="mdl-tabs__panel" id="manager-panel">
				<h4>Menedżer firmy</h4>
					<div class="mdl-grid">
						
						<div class="mdl-cell mdl-cell--3-col mainpage-manager-element mdl-shadow--2dp">
							<a href="/przewoznik">
								<span class="mainpage-manager-icon">
									<i class="material-icons mdl-list__item-icon">directions_bus</i>
								</span>
								<div class="mainpage-manager-name">
									Przewoźnik								</div>
							</a>
						</div>

						
						<div class="mdl-cell mdl-cell--3-col mainpage-manager-element mdl-shadow--2dp">
							<a href="/sluzby">
								<span class="mainpage-manager-icon">
									<i class="material-icons mdl-list__item-icon">work</i>
								</span>
								<div class="mainpage-manager-name">
									Służby								</div>
							</a>
						</div>

						
						<div class="mdl-cell mdl-cell--3-col mainpage-manager-element mdl-shadow--2dp">
							<a href="/linie">
								<span class="mainpage-manager-icon">
									<i class="material-icons mdl-list__item-icon">assignment</i>
								</span>
								<div class="mainpage-manager-name">
									Linie i postoje rezerw								</div>
							</a>
						</div>

						
											</div>
				</div>
			
			
		</div>
	</div>
</div>


		<div id="snackbar" class="mdl-js-snackbar mdl-snackbar" data-upgraded=",MaterialSnackbar">
			<div class="mdl-snackbar__text"></div>
			<button class="mdl-snackbar__action" type="button" aria-hidden="true"></button>
		</div>
		<script src="https://panel.vztm.pl/js/vztm-snackbar.js"></script>
		<dialog id="popupMessage" class="mdl-dialog">
			<h4 class="mdl-dialog__title">Chrono - Boże Ciało 2021</h4>
			<div class="mdl-dialog__content">
				<p>02.06.2021 22:25</p>
				<p>W panelu pojawiło się do pobrania Chrono na dzień jutrzejszy! Prosimy o pobranie.</p>
			</div>
			<div class="mdl-dialog__actions">
				<button type="button" class="mdl-button close">Zamknij</button>
			</div>
		</dialog>
		<script>
			var popup = document.querySelector('#popupMessage');
			popup.querySelector('.close').addEventListener('click', function() {
				popup.close();
			});
		</script>
		
			


</div></div></main><div class="mdl-layout__obfuscator"></div></div></div><input type="hidden" id="hippowiz-ass-injected" value="true"><input type="hidden" id="hvmessage-toextension-listener" value="none"><div class="highslide-container" style="padding: 0px; border: none; margin: 0px; position: absolute; left: 0px; top: 0px; width: 100%; z-index: 1001; direction: ltr;"><a class="highslide-loading" title="Naciśnij, aby wyjść" href="javascript:;" style="position: absolute; top: -9999px; opacity: 0.75; z-index: 1;">Ładowanie obrazu...</a><div style="display: none;"></div><table cellspacing="0" style="padding: 0px; border: none; margin: 0px; visibility: hidden; position: absolute; border-collapse: collapse; width: 0px;"><tbody style="padding: 0px; border: none; margin: 0px;"><tr style="padding: 0px; border: none; margin: 0px; height: auto;"><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) 0px 0px; height: 20px; width: 20px;"></td><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) 0px -40px; height: 20px; width: 20px;"></td><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) -20px 0px; height: 20px; width: 20px;"></td></tr><tr style="padding: 0px; border: none; margin: 0px; height: auto;"><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) 0px -80px; height: 20px; width: 20px;"></td><td class="drop-shadow highslide-outline" style="padding: 0px; border: none; margin: 0px; position: relative;"></td><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) -20px -80px; height: 20px; width: 20px;"></td></tr><tr style="padding: 0px; border: none; margin: 0px; height: auto;"><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) 0px -20px; height: 20px; width: 20px;"></td><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) 0px -60px; height: 20px; width: 20px;"></td><td style="padding: 0px; border: none; margin: 0px; line-height: 0; font-size: 0px; background: url(&quot;https://panel.vztm.pl/inc/highslide/graphics/outlines/drop-shadow.png&quot;) -20px -20px; height: 20px; width: 20px;"></td></tr></tbody></table></div></body></html>