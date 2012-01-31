$(document).ready(function(){
	/* User Input height */
	var height = $("#pg_espn").parent().height();
	var test = $(".pg_espn_content_wrap").parent().parent().height();
    var realHeight = test - 50;
    
	$(".pg_espn_content_wrap").css("height", realHeight);
	$(".pg_espn_content_wrap").css("overflow-x", "hidden");
	$(".pg_espn_content_wrap").css("overflow-y","auto");
	
	
	$(".plus").click(function(){
		$(this).hide().next().show();
		$(this).parent().next().find('.pg_toggle_content').show();
		
	});
	
	$(".minus").click(function(){
		$(this).hide().prev().show();
		$(this).parent().next().find('.pg_toggle_content').hide();
		
	});
	
});


var frontPageDisplay = {
		tab1: function()
		{
			
			$("#pg_espn_tab2, #pg_espn_tab3").removeClass("on");
			$("#pg_espn_tab2, #pg_espn_tab3").addClass("off");
			$("#pg_espn_tab1").addClass("on");
			$("#espn_tab1").show();
			$("#espn_tab2, #espn_tab3").hide();
		},
		
		tab2: function()
		{
			$("#pg_espn_tab1, #pg_espn_tab3").removeClass("on");
			$("#pg_espn_tab1, #pg_espn_tab3").addClass("off");
			$("#pg_espn_tab2").addClass("on");
			$("#espn_tab1, #espn_tab3").hide();
			$("#espn_tab2").show();
			
		},
		
		tab3: function()
		{
			$("#pg_espn_tab1, #pg_espn_tab2").removeClass("on");
			$("#pg_espn_tab1, #pg_espn_tab2").addClass("off");
			$("#pg_espn_tab3").addClass("on");
			$("#espn_tab1, #espn_tab2").hide();
			$("#espn_tab3").show();
		}
}

/*
	
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






*/