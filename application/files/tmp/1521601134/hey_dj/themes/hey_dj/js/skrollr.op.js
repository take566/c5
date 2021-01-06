$(document).ready(function() {
		var s = skrollr.init({
			edgeStrategy: 'set',
			easing: {
				WTF: Math.random,
				inverted: function(p) {
					return 1-p;
				}
			},
			skrollrBody:'skrollr-body'
		});
		$(window).load(function() {
			setTimeout(function () {
				s.refresh();
			}, 1000);
		});
	   var topBtn = $('.scroll-top');
	   if(s.isMobile()) {
			$("a[href^=#]").click(function() {
				s.smoothScrollingDuration = 1000;
		   		s.smoothScrolling = true;
		   		var targetOffset = s.relativeToAbsolute(document.getElementById($(this).attr("href").replace(/^#/, "")), "top", "top");
				s.animateTo(targetOffset);
				//s.animateTo($($(this).attr("href")).offset().top);
				return false;
			});
		} else {
			topBtn.hide();
			$(window).scroll(function () {
				if ($(this).scrollTop() > 500) {
					topBtn.fadeIn();
				} else {
					topBtn.fadeOut();
				}
			});

			// #で始まるアンカーをクリックした場合に処理
			$('a[href^=#]').click(function() {
			  // スクロールの速度
			  var speed = 800; // ミリ秒
			  // アンカーの値取得
			  var href= $(this).attr("href");
			  // 移動先を取得
			  var target = $(href == "#" || href == "" ? 'html' : href);
			  // 移動先を数値で取得
			  var position = target.offset().top;
			  // スムーススクロール
			  $('body,html').animate({scrollTop:position}, speed, 'linear');
			  return false;
			});
		}
	});