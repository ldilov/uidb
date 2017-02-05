$('.form').find('input, textarea').on('click keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');
	  if (e.type == 'click'){
		  label.addClass('active highlight');
	  }
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

$('.tab a').on('click blur focus', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

function showDiv(elem){
	   if (document.getElementById('hideName').style.display === 'none'){
			document.getElementById('target').style.display = "none";
			document.getElementById('hideName').style.display = "block";
			document.getElementById('hideProgram').style.display = "block";
			document.getElementById('hideSchool').style.display = "block";
			document.getElementById('hideSkype').style.display = "block";
	   } else {
		  document.getElementById('target').style.display = "block";
		  document.getElementById('hideName').style.display = "none";
		  document.getElementById('hideProgram').style.display = "none";
		  document.getElementById('hideSchool').style.display = "none";
		  document.getElementById('hideSkype').style.display = "none";
	   }
   
}
