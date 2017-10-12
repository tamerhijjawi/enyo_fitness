jQuery(function($) {'use strict';

	function scroll_to(id){
    	$('html,body').animate({scrollTop: $("#" + id).offset().top},'slow');
	}

	$("#get_quote").click(function() {
	   	scroll_to('accounts');
	});

	$("#run_model").click(function() {	
     	//gets table
		var table = document.getElementById('table_variables');
		//gets rows of table
		var row_length = table.rows.length;

		var input_id = ["type","loc","load","loc1","loc2","dLoad1","dLoad2"];
		//loops through rows
		var variables = {};
		for (var i = 1; i < row_length; i++){
		   	//gets cells of current row
		   	var cells = table.rows.item(i).cells;
		   	//gets amount of cells of current row
		   	var cell_length = cells.length;
		   	//create array for cell inputs
		   	var inputs = {};
			//loops through each cell in current row
			for(var j = 0; j < cell_length; j++){
				//get your cell info here
				var cell_val = cells.item(j).innerHTML;
				inputs[input_id[j]] = cell_val;
				//inputs.push({'input_id[j]': cell_val});
			}
			variables[i] = inputs;
		}
		var variables_json = JSON.stringify(variables);
		var url = "data:text/json;charset=utf-8," + encodeURIComponent(variables_json);
		window.open(url, '_blank');
		window.focus();
		$.ajax({
			url: 'model-results.php',
			dataType: 'json',
			type: 'post',
			data: {variables_json},
			success: function(data){
				if(data.success) {
					alert('The result is ' + data.result);
				}
			}
		});
    });

	//Responsive Nav
	$('li.dropdown').find('.fa-angle-down').each(function(){
		$(this).on('click', function(){
			if( $(window).width() < 768 ) {
				$(this).parent().next().slideToggle();
			}
			return false;
		});
	});

	//Initiat WOW JS
	new WOW().init();

	//Animate Home Page
	$(window).load(function(){
	$('.main-slider').addClass('animate-in');
	});

	//Form
	$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  		var $this = $(this),
      	label = $this.prev('label');

	  	if (e.type === 'keyup') {
			if ($this.val() === '') {
	          label.removeClass('active highlight');
	        } else {
	          label.addClass('active highlight');
	        }
    	} else if (e.type === 'blur') {
    		if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    	} else if (e.type === 'focus') {
      
	      	if( $this.val() === '' ) {
	    		label.removeClass('highlight'); 
			} 
	      	else if( $this.val() !== '' ) {
			    label.addClass('highlight');
			}
    	}

	});

	$(function(){
		$('.add_support_input').click(function(){
			update_supports();
			var last_child_id = $('#supports_form').children().last().attr('id');
			if (last_child_id == undefined){
				i = 1;
			}else{
				var i = parseFloat(last_child_id.charAt(last_child_id.length - 1)) + 1;
			}
		    var new_support = "<div class = 'form-group' id = 'support_" + i + "'>"
									+"<label class='control-label col-sm-2'>Location (m):</label>"
									+"<div class='col-sm-1'>"
		      						+	"<input id = 'support_location" + i + "' type='text' class='form-control'>"
		    						+"</div>"
		    						+"<div class='col-sm-2'>"
						            +    "<select id='support_type" + i + "' class='form-control'>"
									+		"<option>Pinned</option>"
									+		"<option>Fixed</option>"
									+		"<option>Roller</option>"
									+    "</select>"
									+"</div>"
		                            +"<input type='button' class='btn btn-danger' onclick='remove(this)' value='Delete'/>"
								+"</div>";
			$('#supports_form').append(new_support);						
		});

		$('.add_point_load_input').click(function(){
			update_point_loads();
			var last_child_id = $('#point_load_form').children().last().attr('id');
			if (last_child_id == undefined){
				i = 1;
			}else{
				var i = parseFloat(last_child_id.charAt(last_child_id.length - 1)) + 1;
			}
		    var new_point_load = "<div class = 'form-group' id = 'point_load_" + i + "'>"
			        				+"<label class='control-label col-sm-2'>Location (m):</label>"
		    						+"<div class='col-sm-1'>"
		      						+	"<input type='text' class='form-control' id ='p_location" + i + "'>"
		    						+"</div>"
		    						+"<label class='control-label col-sm-2'>Load (kN):</label>"
		    						+"<div class='col-sm-1'>"
		      						+	"<input type='text' class='form-control' id ='p_load" + i + "'>"
		    						+"</div>"
		    						+"<input type='button' class='btn btn-danger' onclick='remove(this)' value='Delete'/>"
								+"</div>";
			$('#point_load_form').append(new_point_load);						
		});

		$('.add_distributed_load_input').click(function(){
			update_distributed_loads();
			var last_child_id = $('#distributed_load_form').children().last().attr('id');
			if (last_child_id == undefined){
				i = 1;
			}else{
				var i = parseFloat(last_child_id.charAt(last_child_id.length - 1)) + 1;
			}
		    var new_distributed_load = "<div class = 'form-group' id = 'distributed_load_" + i + "'>"
					        				+"<label class='control-label col-sm-2'>Start Location (m):</label>"
				    						+"<div class='col-sm-1 center-block'>"
				      						+	"<input type='text' class='form-control' id='dl_location_start" + i + "'>"
				    						+"</div>"
				    						+"<label class='control-label col-sm-2'>End Location (m):</label>"
				    						+"<div class='col-sm-1'>"
				      						+	"<input type='text' class='form-control' id='dl_location_end" + i + "'>"
				    						+"</div>"
				    						+"<label class='control-label col-sm-1'>Start Load (kN):</label>"
				    						+"<div class='col-sm-1'>"
				      						+	"<input type='text' class='form-control' id='dl_load_start" + i + "'>"
				    						+"</div>"
				    						+"<label class='control-label col-sm-1'>End Load (kN):</label>"
				    						+"<div class='col-sm-1'>"
				      						+	"<input type='text' class='form-control' id='dl_load_end" + i + "'>"
				    						+"</div>"
											+"<input type='button' class='btn btn-danger' onclick='remove(this)' value='Delete'/>"
										+"</div>";
			$('#distributed_load_form').append(new_distributed_load);						
		});

		$('.add_moment_load_input').click(function(){
			update_moment_loads();
			var last_child_id = $('#moment_load_form').children().last().attr('id');
			if (last_child_id == undefined){
				i = 1;
			}else{
				var i = parseFloat(last_child_id.charAt(last_child_id.length - 1)) + 1;
			}
		    var new_moment_load = "<div class = 'form-group' id = 'moment_load_" + i + "'>"
			        				+"<label class='control-label col-sm-2'>Location (m):</label>"
		    						+"<div class='col-sm-1'>"
		      						+	"<input type='text' class='form-control' id ='m_location" + i + "'>"
		    						+"</div>"
		    						+"<label class='control-label col-sm-2'>Load (kN):</label>"
		    						+"<div class='col-sm-1'>"
		      						+	"<input type='text' class='form-control' id ='m_load" + i + "'>"
		    						+"</div>"
		    						+"<input type='button' class='btn btn-danger' onclick='remove(this)' value='Delete'/>"
								+"</div>";
			$('#moment_load_form').append(new_moment_load);						
		});

	});

});

function update_summary(type, location, load, start_location, end_location, start_load, end_load, id){
	type = type || '';
	beam_length = beam_length || '';
	location = location || ' ';
	load = load || '';
	start_location = start_location || '';
	end_location = end_location || '';
	start_load = start_load || '';
	end_load = end_load || '';
	var table = document.getElementById("table_variables");
	var row_exists = document.getElementById(id + '_s');
	if(row_exists !== null){
		row_exists.innerHTML = "<tr id='" + id + "_s'>"
		+"<td>" + type + "</td>"
	    +"<td>" + location + "</td>"
	    +"<td>" + load + "</td>"
	    +"<td>" + start_location + "</td>"
	    +"<td>" + end_location + "</td>"
	    +"<td>" + start_load + "</td>"
	    +"<td>" + end_load + "</td>"
	    +"</tr>";
	} else{
		var row = "<tr id='" + id + "_s'>"
		+"<td>" + type + "</td>"
	    +"<td>" + location + "</td>"
	    +"<td>" + load + "</td>"
	    +"<td>" + start_location + "</td>"
	    +"<td>" + end_location + "</td>"
	    +"<td>" + start_load + "</td>"
	    +"<td>" + end_load + "</td>"
	    +"</tr>";
	   	$('#table_variables').append(row);
	}
};

function delete_summary(id){
	var table = document.getElementById("table_variables");
	var delete_row = document.getElementById(id + '_s');
	if(delete_row !== null){
		table.deleteRow(delete_row.rowIndex);
	} else{

	}
};

function update_beam_length(beam_length){
	var type = "Beam Length";
	update_summary(type, undefined, undefined, '0', beam_length, undefined, undefined, 'beam_length');
};

function update_supports(){
	var supports = document.querySelectorAll("#supports_form > div");
	var supports_child;
	var supports_child_id;
	var number;
	var location;
	var type;
	var id;

	for (var i = 0; i < supports.length; i++) {
		supports_child = supports[i];
		supports_child_id = supports_child.id;
		number = parseFloat(supports_child_id.charAt(supports_child_id.length - 1));
		location = document.getElementById('support_location' + number).value;
		type = 'Support-' + document.getElementById('support_type' + number).value;
		id = supports_child.id;
		update_summary(type, location, undefined, undefined, undefined, undefined, undefined, id);
	}
};

function update_point_loads(){
	var point_loads = document.querySelectorAll("#point_load_form > div");
	var point_loads_child;
	var point_loads_child_id;
	var number;
	var location;
	var load;
	var type = 'Point Load';

	for (var i = 0; i < point_loads.length; i++) {
		point_loads_child = point_loads[i];
		point_loads_child_id = point_loads_child.id;
		number = parseFloat(point_loads_child_id.charAt(point_loads_child_id.length - 1));
		location = document.getElementById('p_location' + number).value;
		load = document.getElementById('p_load' + number).value;
		update_summary(type, location, load, undefined, undefined, undefined, undefined, point_loads_child_id);
	}
};

function update_distributed_loads(){
	var distributed_loads = document.querySelectorAll("#distributed_load_form > div");
	var distributed_loads_child;
	var distributed_loads_child_id;
	var number;
	var start_location;
	var start_load;
	var end_location;
	var end_load;
	var type = 'dt. Load';

	for (var i = 0; i < distributed_loads.length; i++) {
		distributed_loads_child = distributed_loads[i];
		distributed_loads_child_id = distributed_loads_child.id;
		number = parseFloat(distributed_loads_child_id.charAt(distributed_loads_child_id.length - 1));
		start_location = document.getElementById('dl_location_start' + number).value;
		start_load = document.getElementById('dl_load_start' + number).value;
		end_location = document.getElementById('dl_location_end' + number).value;
		end_load = document.getElementById('dl_load_end' + number).value;
		update_summary(type, undefined, undefined, start_location, end_location, start_load, end_load, distributed_loads_child_id);
	}
};

function update_moment_loads(){
	var moment_loads = document.querySelectorAll("#moment_load_form > div");
	var moment_loads_child;
	var moment_loads_child_id;
	var number;
	var location;
	var load;
	var type = 'Moment Load';

	for (var i = 0; i < moment_loads.length; i++) {
		moment_loads_child = moment_loads[i];
		moment_loads_child_id = moment_loads_child.id;
		number = parseFloat(moment_loads_child_id.charAt(moment_loads_child_id.length - 1));
		location = document.getElementById('m_location' + number).value;
		load = document.getElementById('m_load' + number).value;
		update_summary(type, location, load, undefined, undefined, undefined, undefined, moment_loads_child_id);
	}
};

function remove(element) {
  var parent = element.parentNode;
  parent.remove();
  delete_summary(parent.id);
};

