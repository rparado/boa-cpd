(function($) {

	'use strict';

	$(function() {
		$('.wp1').waypoint(function() {
			$('.wp1').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp2').waypoint(function(){
			$('.wp2').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp3').waypoint(function() {
			$('.wp3').addClass('animated fadeInUp')
		}, {
			offset: '75%'
		});

		$('.wp4').waypoint(function(){
			$('.wp4').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp5').waypoint(function(){
			$('.wp5').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp6').waypoint(function(){
			$('.wp6').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp7').waypoint(function(){
			$('.wp7').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp8').waypoint(function(){
			$('.wp8').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp9').waypoint(function(){
			$('.wp9').addClass('animated fadeIn');
		}, {
			offset: '75%'
		});

		$('.wp10').waypoint(function() {
			$('.wp10').addClass('animated fadeIn')
		}, {
			offset: '75%'
		});
		
		// Adding Font Awsome spinner, hidden by default
		$('img.ajax-loader').after('<i class="fa fa-refresh fa-spin ajax-loader-cusom" style="visibility: hidden"></i>');

		// Show new spinner on Send button click
		$('.wpcf7-submit').on('click', function () {
			$('.ajax-loader-cusom').css({ visibility: 'visible' });
		});

		// Hide new spinner on result
		$('div.wpcf7').on('wpcf7:invalid wpcf7:spam wpcf7:mailsent wpcf7:mailfailed', function () {
			$('.ajax-loader-cusom').css({ visibility: 'hidden' });
		});
		
		
		if($( ".date:contains('July')")) {
			$('#products-table tbody').prepend('<tr><td colspan="8" class="blue-color">July</td</tr>');
		}
		if($( ".date:contains('August')")) {
			$('#products-table tbody tr td.date:contains("August")').first().parent('tr').before('<tr><td colspan="8" class="blue-color">August</td</tr>');
		}
		
		if($( ".date:contains('September')")) {
			$('#products-table tbody tr td.date:contains("September")').first().parent('tr').before('<tr><td colspan="8" class="blue-color">September</td</tr>');
		}
		if($( ".date:contains('October')")) {
			$('#products-table tbody tr td.date:contains("October")').first().parent('tr').before('<tr><td colspan="8" class="blue-color">October</td</tr>');
		}
		if($( ".date:contains('November')")) {
			$('#products-table tbody tr td.date:contains("November")').first().parent('tr').before('<tr><td colspan="8" class="blue-color">November</td</tr>');
		}
		if($( ".date:contains('December')")) {
			$('#products-table tbody tr td.date:contains("December")').first().parent('tr').before('<tr><td colspan="8" class="blue-color">December</td</tr>');
		}
		
		//$('.selectpicker').selectpicker();
		
		$('.thematic').change(function() {
			$('.hideShowTr').hide();
			$('tr.' + $(this).val()).show();
			if( $('.thematic').val() === 'All' ){
				$('.hideShowTr').show();
			}
		});
		
		$('.date-select').change(function() {
			$('.hideShowTr').hide();    
			$('tr.' +$(this).val()).show();
			
			if( $('.date-select').val() === 'All' ){
				$('.hideShowTr').show();
			}
			//$("tr:not(:#"+$(this).val()+")").hide(); 
		});
		
		var $window = $(window), $document = $(document),
			transitionSupported = typeof document.body.style.transitionProperty === "string",
			scrollTime = 1;

		$(document).on("click", ".register-now", function(e) {
			var target, avail, scroll, deltaScroll;
	    
			if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
				target = $(this.hash);
				target = target.length ? target : $("[id=" + this.hash.slice(1) + "]");

				if (target.length) {
					avail = $document.height() - $window.height();

					if (avail > 0) {
						scroll = target.offset().top;
	          
						if (scroll > avail) {
							scroll = avail;
						}
					} else {
						scroll = 0;
					}

					deltaScroll = $window.scrollTop() - scroll;
					if (!deltaScroll) {
						return; 
					}

					e.preventDefault();
					
					if (transitionSupported) {
						$("html").css({
							"margin-top": deltaScroll + "px",
							"transition": scrollTime + "s ease-in-out"
						}).data("transitioning", scroll);
					} else {
						$("html, body").stop(true, true)
						.animate({
							scrollTop: scroll + "px"
						}, scrollTime * 1000);
						
						return;
					}
				}
			}
		});

		if (transitionSupported) {
			$("html").on("transitionend webkitTransitionEnd msTransitionEnd oTransitionEnd", function(e) {
				var $this = $(this),
					scroll = $this.data("transitioning");
				
				if (e.target === e.currentTarget && scroll) {
					$this.removeAttr("style").removeData("transitioning");
					
					$("html, body").scrollTop(scroll);
				}
			});
		}
		
	});
})(jQuery);
