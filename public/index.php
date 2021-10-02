<?php
$valida = "EquipeSugoiGame2012";
require "Includes/conectdb.php";
ini_set('default_charset','UTF-8'); 

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<style>.cookieConsentContainer{z-index:999;width:350px;min-height:20px;box-sizing:border-box;padding:30px 30px 30px 30px;background:#232323;overflow:hidden;position:fixed;bottom:30px;right:30px;display:none}.cookieConsentContainer .cookieTitle a{font-family:OpenSans,arial,sans-serif;color:#fff;font-size:22px;line-height:20px;display:block}.cookieConsentContainer .cookieDesc p{margin:0;padding:0;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:13px;line-height:20px;display:block;margin-top:10px}.cookieConsentContainer .cookieDesc a{font-family:OpenSans,arial,sans-serif;color:#fff;text-decoration:underline}.cookieConsentContainer .cookieButton a{display:inline-block;font-family:OpenSans,arial,sans-serif;color:#fff;font-size:14px;font-weight:700;margin-top:14px;background:#000;box-sizing:border-box;padding:15px 24px;text-align:center;transition:background .3s}.cookieConsentContainer .cookieButton a:hover{cursor:pointer;background:#3e9b67}@media (max-width:980px){.cookieConsentContainer{bottom:0!important;left:0!important;width:100%!important}}</style>
	<title>Sugoi Game - One Piece MMORPG</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Um RPG estratégico cheio de PvP feito por fãs de One Piece." />

	<meta property="og:url" content="https://sugoigame.com.br/" />
	<meta property="og:title" content="Pirata ou Marinheiro? Crie sua própria história e viva novas aventuras!" />
	<meta property="og:site_name" content="Sugoi Game - One Piece MMORPG" />
	<meta property="og:description" content="Sugoi Game é um MMORPG estratégico gratuito cheio de PvP feito por fãs de One Piece. Jogue agora!" />
	<meta property="og:image" content="https://sugoigame.com.br/Imagens/Banners/banner.jpg" />
	<meta property="og:image:type" content="image/jpeg" />

	<link rel="manifest" href="manifest.json" />
	<link rel="shortcut icon" type="image/png" href="Imagens/favicon.png" />

	<link rel="stylesheet" type="text/css" href="CSS/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="CSS/theme.css?ver=1.0.4" />
	<link rel="stylesheet" type="text/css" href="CSS/bootstrap-select.min.css" />
	<link rel="stylesheet" type="text/css" href="CSS/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="CSS/estrutura.css?ver=2.0.14" />
	<script src="./cookies.js"></script>
	<script type="text/javascript">
		var gameTitle = document.title;

		if (window.location.hostname == 'sugoigame.com.br') {
			if ('serviceWorker' in navigator) {
				navigator.serviceWorker.register('/service-worker.js');
			}
		}
	</script>
	<script data-ad-client="ca-pub-6911680303950528" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<?php if ($_SERVER['HTTP_HOST'] == 'sugoigame.com.br') { ?>
	<script data-ad-client="ca-pub-6665062829379662" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<?php } ?>
</head>
<body>
<audio id="toque_nova_msg">
	<source src="Sons/nova_msg.ogg" type="audio/ogg" />
	<source src="Sons/nova_msg.mp3" type="audio/mpeg" />
</audio>

<div id="tudo">
	<img src="Imagens/carregando.gif" />
	<?php if ($userDetails->tripulacao): ?>
		<input type="hidden" id="ilha_atual" value="<?= $userDetails->ilha["ilha"]; ?>" />
		<input type="hidden" id="coord_x_navio" value="<?= $userDetails->tripulacao["x"]; ?>" />
		<input type="hidden" id="coord_y_navio" value="<?= $userDetails->tripulacao["y"]; ?>" />
	<?php endif; ?>
</div>

<button id="to-top" >
	<i class="glyphicon glyphicon-chevron-up"></i>
</button>

<div class="modal fade" id="modal-user-progress">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="user-progress-title"></h4>
			</div>
			<div class="modal-body">
				<p id="user-progress-description"></p>
				<p id="user-progress-rewards"></p>
			</div>
			<div class="modal-footer">
				<button id="user-progress-finish" href="link_Missoes/finaliza_user_progress.php" class="link_send btn btn-success" data-dismiss="modal">Concluir</button>
				<button id="user-progress-back" class="btn btn-primary" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-mensagens">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div id="mensagens">
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-inventario">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Inventário</h4>
			</div>
			<div id="inventario"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-dar-comida">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Escolha um personagem pra dar o item</h4>
			</div>
			<div id="dar_comida" class="modal-body"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-cartografo">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Mapa Mundi</h4>
			</div>
			<div id="mapa_cartografo"></div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-no-cartografo">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Mapa Mundi</h4>
			</div>
			<div class="modal-body">
				Você precisa de um cartógrafo na sua tripulação para poder comprar um mapa na escola de profissões.
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-daily-gift">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Calendário e Eventos</h4>
			</div>
			<div id="modal-daily-gift-content">

			</div>
		</div>
	</div>
</div>

<div id="icon_carregando">
	<div class="progress">
		<div class="progress-bar progress-bar-info progress-bar-striped active">
			<img src="Imagens/carregando.gif" />
		</div>
	</div>
</div>

<div class="modal fade" id="modal-send-message">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="fb-page" data-href="https://www.facebook.com/sugoigamebr/" data-tabs="messages"
					 data-width="360" data-height="400" data-small-header="true" data-hide-cover="true"
					 data-show-facepile="false">
					<blockquote cite="https://www.facebook.com/sugoigamebr/" class="fb-xfbml-parse-ignore"></blockquote>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="JS/jquery-2.2.2.min.js"></script>
<script type="text/javascript" src="JS/bootstrap.min.js"></script>
<script type="text/javascript" src="JS/bootbox.min.js"></script>
<script type="text/javascript" src="JS/bootstrap-select.min.js"></script>
<script type="text/javascript" src="JS/starrr.js"></script>
<script type="text/javascript" src="JS/Time.js"></script>
<script type="text/javascript" src="JS/cor_bg.js?ver=2.0.1"></script>
<script type="text/javascript" src="JS/cookie.js"></script>
<script type="text/javascript" src="JS/removecaracteres.js"></script>
<script type="text/javascript" src="JS/geral.js?ver=2.0.16"></script>
<script type="text/javascript" src="JS/header.js?ver=2.0.19"></script>
<script type="text/javascript" src="JS/animacoes.js?ver=2.0.0"></script>
<script type="text/javascript" src="JS/progressbar.min.js"></script>
<script type="text/javascript" src="JS/reconnecting-websocket.min.js"></script>
<script type="text/javascript" src="JS/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="JS/phaser.min.js"></script>
<script>var purecookieTitle="Cookies.",purecookieDesc="Este site usa cookies para garantir que você obtenha a melhor experiência.",purecookieLink='<a href="./?ses=politica" target="_blank">Politica de Privacidade</a>',purecookieButton="Aceitar";function pureFadeIn(e,o){var i=document.getElementById(e);i.style.opacity=0,i.style.display=o||"block",function e(){var o=parseFloat(i.style.opacity);(o+=.02)>1||(i.style.opacity=o,requestAnimationFrame(e))}()}function pureFadeOut(e){var o=document.getElementById(e);o.style.opacity=1,function e(){(o.style.opacity-=.02)<0?o.style.display="none":requestAnimationFrame(e)}()}function setCookie(e,o,i){var t="";if(i){var n=new Date;n.setTime(n.getTime()+24*i*60*60*1e3),t="; expires="+n.toUTCString()}document.cookie=e+"="+(o||"")+t+"; path=/"}function getCookie(e){for(var o=e+"=",i=document.cookie.split(";"),t=0;t<i.length;t++){for(var n=i[t];" "==n.charAt(0);)n=n.substring(1,n.length);if(0==n.indexOf(o))return n.substring(o.length,n.length)}return null}function eraseCookie(e){document.cookie=e+"=; Max-Age=-99999999;"}function cookieConsent(){getCookie("purecookieDismiss")||(document.body.innerHTML+='<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><a>'+purecookieTitle+'</a></div><div class="cookieDesc"><p>'+purecookieDesc+" "+purecookieLink+'</p></div><div class="cookieButton"><a onClick="purecookieDismiss();">'+purecookieButton+"</a></div></div>",pureFadeIn("cookieConsentContainer"))}function purecookieDismiss(){setCookie("purecookieDismiss","1",30),pureFadeOut("cookieConsentContainer")}window.onload=function(){cookieConsent()};</script>


<script src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9"></script>


<script type="text/javascript">
	$(function () {
		$('#form-aprender-skill').submit(function (e) {
			var img = $('#aprender-skill-input-img').val();
			if (!img.length || img == 0) {
				e.preventDefault();
				bootbox.alert('Selecione uma imagem para sua habilidade.');
			}
		});
	});

	screen.orientation.lock('landscape').catch(function () {
		// the device not support orientation
		
	});

	if (window.outerWidth <= 768) {
		var body = document.documentElement;
		if (body.requestFullscreen) {
			body.requestFullscreen();
		} else if (body.webkitrequestFullscreen) {
			body.webkitrequestFullscreen();
		} else if (body.mozrequestFullscreen) {
			body.mozrequestFullscreen();
		} else if (body.msrequestFullscreen) {
			body.msrequestFullscreen();
		}
	}
</script>
</body>
</html>