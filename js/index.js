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

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});


$(document).ready(function(){
  var i=1;
  $("#add_row").click(function(){
    $('#variable_'+i).html("<td><input type='text' name='type" + (i+1) + "' class='form-control'/></td><td><input type='text' name='location_" + i + "' class='form-control'/></td><td><input type='text' name='load_" + i + "' class='form-control'/></td><td><input type='text' name='start_location_" + i + "' class='form-control'/></td><td><input type='text' name='end_location_" + i + "' class='form-control'/></td><td><input type='text' name='start_load_" + i + "' class='form-control'/></td><td><input type='text' name='end_load_" + i + "' class='form-control'/></td><td class='vert-align'><a href=''> </a></td>");
    $('#tab_logic').append('<tr id="variable_'+(i+1)+'"></tr>');
    i++; 
  });

  $("#delete_row").click(function(){
    if(i>1){
      $("#variable_"+(i-1)).html('');
      i--;
    }
  });
});