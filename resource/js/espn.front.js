var espnnews = {

	getNews: function(cat)
	{	
		var pNode = $("#PLUGIN_Espn");
		var pgUrl = $("#pg_espn_pluginurl").val();
		var sUrl = $('#pg_espn_ajaxurl').val();
		var sTpl = $('#pg_espn_template').val();
		
		var prev_on = $('.pg_espn_nav').find('.on');
		prev_on.attr('class', 'off');

		$('#pg_espn_tab_'+cat).attr('class', 'on');
		$('#pg_espn_tab_'+cat).blur();

		$('.pg_espn_contentnews').remove();

		var isLoading = $('#pg_espn_ajaxloader1').is(':visible');
		if(isLoading) return false;

		$('.pg_espn_content_wrap').append('<div id="pg_espn_ajaxloader1"><img src="'+pgUrl+'/images/ajax-loader.gif" /></div>');

		var mData = { url : sUrl, ctgry : cat  }
		PLUGIN.post(pNode, mData , 'custom' , 'json' , PLUGIN_Espn_front.ajaxCallBackJson);
	
	},

	ajaxCallBackJson: function(result)
	{
		var news = result.news;
		var limit = $('#pg_espn_list_limit').val();
		var str = "";
		var pgUrl = $("#pg_espn_pluginurl").val();
		$('#pg_espn_ajaxloader1').remove();
		$('.pg_espn_content_wrap').append('<ul class="pg_espn_contentnews">');
		
		$.each(news, function(key, val){

                    str += '<li>';
                    str += '<span style="cursor:pointer;">';
                    str += '<img src="'+pgUrl+'/images/pg_tree_p.gif" alt="Plus Sign" onclick="PLUGIN_Espn_front.plus(this);"/>';
                    str += '<img src="'+pgUrl+'/images/pg_tree_m.gif" alt="Minus Sign" style="display:none" onclick="PLUGIN_Espn_front.minus(this);" />';
                    str += '</span>';
                    str += '<div class="pg_content">';
                    str += '<p class="pg_title"><a href="' + val.link + '" target="_blank">' + val.title + '</a></p>';
                    str += '<span class="pg_content_date espn_datepost">'+val.date+'</span>';
                    str += '<p class="pg_toggle_content" style="display:none;">	';
                    str += val.description+'...<a href="'+val.link+'" target="_blank" class="pg_more">more</a>'
                    str += '</p></div></li>';

                   
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

jQuery.noConflict();
jQuery(document).ready(function($){

});