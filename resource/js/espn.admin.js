var PLUGIN_Espn_vars = {
    sel_curr_value : "",
    submit : false
};

var adminPageSetup = {

		saveSetting : function()
		{
			if(oValidator.formName.getMessage('espnnews_save'))
			{
				this.setCatOrder();
				document.espnnews_save.submit();
			}
			else{
				sdk_message.show('Field(s) with asterisk(*) are mandatory.', 'warning');
			}
			
		},
		
       

        moveUp : function(no)
        {
	        var sel_src = $('#pg_espn_cat_sel_' + no).val();
	        var sel_tgt = $('#pg_espn_cat_sel_' + (no-1)).val();
	
	        var data = {
	                'num' : no,
	                's_src' : sel_src,
	                's_tgt' : sel_tgt,
	                'method' : 'up'
        };

	        adminPageSetup.swap(data);
        },
	
		moveDown : function(no)
		{
	            var sel_src = $('#pg_espn_cat_sel_' + no).val();
	            var sel_tgt = $('#pg_espn_cat_sel_' + (no+1)).val();
	
	            var data = {
	                    'num' : no,
	                    's_src' : sel_src,
	                    's_tgt' : sel_tgt,
	                    'method' : 'down'
	            };
	
	            adminPageSetup.swap(data);
		},
		
		swap : function(data)
		{
	            var src = data['method'] == "up" ? data['num']-1 : data['num']+1;
	            $('#pg_espn_cat_sel_' + data['num']).val(data['s_tgt']);
	            $('#pg_espn_cat_sel_' + src).val(data['s_src']);
		},
		
		selectChange : function(curr_num, curr_val)
		{
	            var tabnum = $('#pg_espn_tab_td ul').children().size();
	            var tgt = "";
	
	            for(i = 0; i < tabnum; i++) {
	                    var sel_val = $('#pg_espn_cat_sel_' + (i+1)).val();
	
	                    if(curr_num != (i+1) && sel_val == curr_val) {
	                            $('#pg_espn_cat_sel_' + (i+1)).val(PLUGIN_Espn_vars.sel_curr_value);
	                    }
	            }
		},

		
		catOrder : function(meth)
		{
	            var curr_opt = $('#show_html_value option:selected');
	            var curr  = curr_opt.val();
	
	            if(meth == 'down') curr_opt.insertAfter(curr_opt.next());
	            else curr_opt.insertBefore(curr_opt.prev());
	
		},
		
		setCatOrder : function()
		{
	            var opt = $('#show_html_value option');
	
	            $.each(opt, function(k, v){
	                    var val = $(v).val();
	
	                    if(k > 2) return false;
	                    else $('#pg_espn_cat_sel_' + (k+1)).val(val);
	            });
		},
		
		reset : function()
		{
	            var opts = adminPageSetup.optStr();
	
	            $('#show_html_value').children().remove();
	            $('#show_html_value').append(opts);
	            $("input[name='pg_espn_display_limit']").val(5);
	            $("input[name='plugin_select_image']:eq(0)").attr('checked', true);
	
		},
		
		optStr : function()
		{
	            
	            var str = '<option value="News" class="category_opt">News</option>';
	            str += '<option value="NFL" class="category_opt">NFL</option>';
	            str += '<option value="NBA" class="category_opt">NBA</option>';
	            str += '<option value="MLB" class="category_opt">MLB</option>';
	            str += '<option value="NHL" class="category_opt">NHL</option>';
	            str += '<option value="Motorsports" class="category_opt">Motorsports</option>';
	            str += '<option value="Soccer" class="category_opt">Soccer</option>';
	            str += '<option value="ESPNU" class="category_opt">ESPNU</option>';
	            str += '<option value="College Basketball" class="category_opt">College Basketball</option>';
	            str += '<option value="College Football" class="category_opt">College Football</option>';
	            str += '<option value="Action Sports" class="category_opt">Action Sports</option>';
	            str += '<option value="Poker" class="category_opt">Poker</option>';
	           
	           return str;
		}
};

$(document).ready(function(){
        

    $('.pg_espn_cat_sel').click(function(){
            PLUGIN_Espn_vars.sel_curr_value = $(this).val();
    });

});


