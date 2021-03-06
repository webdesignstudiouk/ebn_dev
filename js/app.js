jQuery(function($) {
	$(document).ready(function() {
		var url = document.location.toString();
		var arr = url.split("/");
		var plus = url.split("+");
		// if (url.match('#')) {
		// 	if($('.nav-tabs a[href=#' + plus[0].split('#')[1] + ']').length) {
        //         $('.nav-tabs a[href=#' + plus[0].split('#')[1] + ']').tab('show');
        //         var activeTab = null;
        //         $('a[data-toggle="tab"]').on('shown', function (e) {
        //             activeTab = e.target;
        //             $('#dynamicBreadcrumb').html(activeTab.split('#')[1].replace(/([A-Z])/g, ' $1').replace(/^./, function (str) {
        //                 return str.toUpperCase();
        //             }));
        //         });
		//
        //         $('#dynamicBreadcrumb').html(url.split('#')[1].replace(/([A-Z])/g, ' $1').replace(/^./, function (str) {
        //             return str.toUpperCase();
        //         }));
        //     }
		// }

		// Add active tab to dynamic breadcrumb
		$('.nav-tabs a').on('shown.bs.tab', function(e) {
			var a = e.target.hash;
			$('#dynamicBreadcrumb').html(a.split('#')[1].replace(/([A-Z])/g, ' $1').replace(/^./, function(str) {
				return str.toUpperCase();
			}));
		});

		// Add active tab to dynamic breadcrumb
		$('.navbar-nav a').on('shown.bs.tab', function(e) {
			var a = e.target.hash;
			$('#dynamicBreadcrumb2').html(a.split('#')[1].replace(/([A-Z])/g, ' $1').replace(/^./, function(str) {
				return str.toUpperCase();
			}));
		});


		$('#closChat_button').click(function(){
			$('body').removeClass('chat-open');
		})


		function getParameterByName(name, url) {
			if (!url) {
				url = window.location.href;
			}
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		}

		function setGetParameter(paramName, paramValue) {
			var url = window.location.href.replace(window.location.hash, '');
			if (url.indexOf(paramName + "=") >= 0) {
				var prefix = url.substring(0, url.indexOf(paramName));
				var suffix = url.substring(url.indexOf(paramName));
				suffix = suffix.substring(suffix.indexOf("=") + 1);
				suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
				url = prefix + paramName + "=" + paramValue + suffix;
			}else {
				if (url.indexOf("?") < 0)
				url += "?" + paramName + "=" + paramValue;
				else
				url += "&" + paramName + "=" + paramValue;
			}
			url += window.location.hash;
			window.location.href = url;
		}

		var tabFromUrl = getParameterByName('tab');
		if (tabFromUrl != null) {
			var tab = '#' + tabFromUrl;
			$('.nav-tabs a[href='+tab+']').tab('show');
			$('#dynamicBreadcrumb').html(tab.split('#')[1].replace(/([A-Z])/g, ' $1').replace(/^./, function(str) {
				return str.toUpperCase();
			}));
			console.log(tab);
		}

		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			var a = e.target.hash;
			setGetParameter('tab', a.split('#')[1]);
		});

        $("table").floatThead({
            scrollingTop:50,
            zIndex:1
        });

        // $('select[name="deleted_reason"]').on('change', function(e) {
        //    if($(this).val() == 'Other'){
        //        $('.js-delete-reason').show();
        //        $('textarea[name="deleted_reason_2"]').prop('required', true);
		 //   }else{
        //        $('.js-delete-reason').hide();
        //        $('textarea[name="deleted_reason_2"]').prop('required', false);
		 //   }
        // });

		$(document).on('click', '.js-trigger-loa_won', function(){
		    $('.js-filter-Won').show();
		    $('.js-filter-Open').hide();
		    $('.js-filter-Lost').hide();
		});

		$(document).on('click', '.js-trigger-loa_open', function(){
		    $('.js-filter-Open').show();
		    $('.js-filter-Won').hide();
		    $('.js-filter-Lost').hide();
		});

		$(document).on('click', '.js-trigger-loa_lost', function(){
            $('.js-filter-Lost').show();
            $('.js-filter-Open').hide();
            $('.js-filter-Won').hide();
        });

		$(document).on('click', '.js-trigger-all', function(){
			$('.js-filter-Lost').show();
		    $('.js-filter-Open').show();
		    $('.js-filter-Won').show();
		});
	});
});
