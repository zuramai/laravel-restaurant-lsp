function updateBreadcrumb(elem){
	var breadcrumb = '';
	if($(elem).parent().parent().hasClass('submenu')){
 		if($(elem).parent().parent().parent().parent().hasClass('submenu')){
 			$('#breadcrumb').children('h4').html($(elem).html());
 			breadcrumb = '<li class="breadcrumb-item active"><a href="javascript:void(0);">Lexa</a></li>'+' '+'<li class="breadcrumb-item"><a href="javascript:void(0);">'+$(elem).parent().parent().parent().children('a').html()+'</a></li><li class="breadcrumb-item active">'+$(elem).html()+'</li>';
 		}
 		else if($(elem).parent().parent().parent().hasClass('has-submenu')){
 			$('#breadcrumb').children('h4').html($(elem).html());
 			breadcrumb = '<li class="breadcrumb-item active"><a href="javascript:void(0);">Lexa</a></li>'+' '+'<li class="breadcrumb-item active">'+$(elem).parent().parent().parent().children('a').clone().find("i").remove().end().html()+'</li><li class="breadcrumb-item active">'+$(elem).html()+'</li>';
 		}
 	}
 	else{
 		if($(elem).parent().hasClass('has-submenu')){
	 		$('#breadcrumb').children('h4').html($(elem).children('span').html());
	 		breadcrumb = '<li class="breadcrumb-item active">Welcome to Lexa Dashboard</li>';
 		}else{
 			$('#breadcrumb').children('h4').html($(elem).html());
 			breadcrumb = '<li class="breadcrumb-item active"><a href="javascript:void(0);">Lexa</a></li>'+' '+'<li class="breadcrumb-item active">'+$(elem).parent().parent().parent().parent().parent().children('a').clone().find("i").remove().end().html()+'</li><li class="breadcrumb-item active">'+$(elem).html()+'</li>';
 		}
 	}
 	if(breadcrumb)
 		$('.breadcrumb').html(breadcrumb);
}

$(document).on('click', '.navigation-menu li a', function(e) {
 	e.preventDefault();
 	$this = $(this);
	
 	var page = $(this).attr('href');

 	if($(this).attr('target') == '_blank')
		window.open(page,'_blank');

 	if(page == 'javascript:void(0);')
		return false;

	$(".has-submenu, .has-submenu, .has-submenu .submenu li").removeClass('active');
	
	window.location.hash = page;
	
	var pageUrl = window.location.hash.substr(1);
	
    if ($this.attr('href') == pageUrl) { 
        $this.parent().addClass("active"); // add active to li of the current link
        $this.parent().parent().parent().addClass("active"); // add active class to an anchor
        $this.parent().parent().parent().parent().parent().addClass("active"); // add active class to an anchor
    }
	
	$.ajax({
	    url: 'ajax/'+page,
	    type: "GET",
	    cache:false,
	    dataType: 'html',
	    success: function(data) {
	        $("#result").html(data).delay("slow").fadeIn();
	        updateBreadcrumb($this);
				$(window).scrollTop(0);
	    }
	});
});

$(document).ready(function(){
	var path = window.location.hash.substr(1);
	if(path)
		$('.navigation-menu li:has(a[href="' + path + '"])').children('a').trigger('click');
	else
		$('.navigation-menu li:has(a[href="index.html"])').children('a').trigger('click');
});