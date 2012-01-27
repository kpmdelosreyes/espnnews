$(document).ready(function(){
	var height = $("#pg_espn").parent().height();
	var test = $(".pg_espn_content_wrap").parent().parent().height();
    var realHeight = test - 50;
    
	$(".pg_espn_content_wrap").css("height", realHeight);
	$(".pg_espn_content_wrap").css("overflow-x", "hidden");
	$(".pg_espn_content_wrap").css("overflow-y","auto");
	
	//$(".on, .off").css("width" , "80px");
});


var frontPageDisplay = {

	getNews: function(cat)
	{	
		
		var prev_on = $('.pg_espn_nav').find('.on');
		prev_on.attr('class', 'off');

		$('#pg_espn_tab_'+cat).attr('class', 'on');
		$('#pg_espn_tab_'+cat).blur();

		$('.pg_espn_contentnews').remove();

		var isLoading = $('#pg_espn_ajaxloader1').is(':visible');
		if(isLoading) return false;
		var test = $(".pg_espn_content_wrap").parent().parent().height();
		var realHeight = test - 50;
		$('.pg_espn_content_wrap').append('<div id="pg_espn_ajaxloader1"><img src="../_sdk/img/espnnews/ajax-loader.gif" /></div>');

		$.ajax({
			url: usbuilder.getUrl("apiContentFront"),
			type: "POST",
			data : {ctgry : cat}
		}).done(function(data) { 	
			frontPageDisplay.ajaxCallBackJson(data.Data);
        });

	
	},

	ajaxCallBackJson: function(result)
	{
		var news = result.news;
		var limit = $('#pg_espn_list_limit').val();
		var str = "";
		
		$('#pg_espn_ajaxloader1').remove();
		$('.pg_espn_content_wrap').append('<ul class="pg_espn_contentnews">');
		
		$.each(news, function(key, val){

                    str += '<li>';
                    str += '<span style="cursor:pointer;">';
                    str += '<img src="../_sdk/img/espnnews/pg_tree_p.gif" alt="Plus Sign" onclick="frontPageDisplay.plus(this);"/>';
                    str += '<img src="../_sdk/img/espnnews/pg_tree_m.gif" alt="Minus Sign" style="display:none" onclick="frontPageDisplay.minus(this);" />';
                    str += '</span>';
                    str += '<div class="pg_content">';
                    str += '<p class="pg_title"><a href="' + val.link + '" target="_blank">' + val.title + '</a></p>';
                    str += '<span class="pg_content_date espn_datepost">'+val.date+'</span>';
                    str += '<p class="pg_toggle_content" style="display:none;">	';
                    str += val.description+'...'
                    str += '</p></div><p class="pg_more"><a href="'+val.link+'" target="_blank" class="link01">more</a></p></li>';

                   
                if(limit == key+1) return false;
		});
			
		$('.pg_espn_contentnews').append(str);
	},
	
	plus : function(obj)
	{
		$(obj).hide();
		$(obj).next().show();
		$(obj).parent().next().find('.pg_toggle_content').show();
		
	},
	
	minus : function(obj)
	{
		$(obj).hide();
		$(obj).prev().show();
		$(obj).parent().next().find('.pg_toggle_content').hide();
	}

};




