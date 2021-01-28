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

// $('.tab a').on('click', function (e) {
  
//   e.preventDefault();
  
//   $(this).parent().addClass('active');
//   $(this).parent().siblings().removeClass('active');
  
//   target = $(this).attr('href');

//   $('.tab-content > div').not(target).hide();
  
//   $(target).fadeIn(600);
  
// });



var hash = window.location.hash;

if (hash == '#login') {
  signInTab();
}else if(hash == '#signup') {
  signUpTab();
}else if(hash == '#forget') {
  forget();
}else{
  signInTab();
}


  function signUpTab() {
      $("#signInTab").removeClass("active-tab");
      $("#signUpTab").addClass("active-tab");
      $("#signInForm").css('display', 'none');
      $("#signUpForm").css('display', 'block');
       $(".forget_tab").css('display', 'none');
  }

  function signInTab() {
      $("#signInTab").addClass("active-tab");
      $("#signUpTab").removeClass("active-tab");
      $("#signInForm").css('display', 'block');
      $("#signUpForm").css('display', 'none');
       $(".forget_tab").css('display', 'none');

  }

  function forget() {
      $(".forget_tab").css('display', 'block');
      // $(".account-header-div").css('width', '500px');
      // $(".account-header-div").css('min-height', '100px');
      $("#signInTab").removeClass("active-tab");
      $("#signUpTab").removeClass("active-tab");
      $("#signInTab").css('display', 'none');
      $("#signUpTab").css('display', 'none');
      $("#signInForm").css('display', 'none');
      $("#signUpForm").css('display', 'none');


  }

    $("#signup").click(signUpTab);
    $("#login").click(signInTab);
    // $("#signUpMenuu").click(signUpTab);
    $("#forget").click(forget);
    $("#backtologin").click(signInTab);