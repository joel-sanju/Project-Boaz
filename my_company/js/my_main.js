///My main functions
	
	var global_ii=d = '';
	var global_ch = '';



function slide_up(ch, hd){

	$("#start_slide").slideUp();
	$("#second_slide").slideDown();
    
	$("#second_slide h1").html(hd);
	$("#second_slide #user_type").val(ch);
	
	
}	

function change_login_mode(nk){
	
	if(nk == 1){
		$("#login_section_n1").fadeOut(700, function(){$("#login_section_n0").show();});
			
	}
	else{
		$("#login_section_n0").fadeOut(700, function(){$("#login_section_n1").show();});

	}
	
}	




function submit_reg_form(event){
	event.preventDefault();
	var password = $("#m_password").val().trim();
	var password_2 = $("#m_password_2").val().trim();
	
	//check if does not password match 
	if(password != password_2){
        mytooltip('m_password_2', 'Password not match');
		return;
	}
	
	
	var fdata = new FormData($("#reg_form")[0]);
	
	
var sbutton = $("#sbutton").html(); //grab the initial content
$("#errmsg").html('');

$("#sbutton").html('<span class="fa fa-spin fa-spinner fa-2x"></span> please wait...');
   
   $.ajax({
	 type: "POST",
	 url:   "./connect/signing.php",
	 data: fdata,
	 cache: false,
	 processData : false,
	 contentType : false,
	 success: function(data){ console.log(data);
		     if(data === 'PASS'){
				 $("#reg_form")[0].reset(); 
				 
				 $("#sbutton").html('<div class="fa fa-check fa-2x"> You have successfully sign up. You can now <a style="color:blue !important" href="./">login</a></div>');
				      
			 }
			  else{
				$("#sbutton").html(sbutton);
                $("#errmsg").html('<span class="text-danger">' +data + '</span>');
				var elmnt = document.getElementById("errmsg");
                 elmnt.scrollIntoView();
				
			  }
		    },
		  });
	
}


function sign_in_form(event){
	event.preventDefault();
	
	var email = $("#m_email").val().trim();
    var password = $("#m_password").val().trim();

   if(password.length < 6) return;	

    //if(!(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/.test(email))) return;
	
	
    var fdata = new FormData($("#log_form")[0]);
	
	
var sbutton = $("#sbutton").html(); //grab the initial content
$("#errmsg").html('');

$("#sbutton").html('<span class="fa fa-spin fa-spinner fa-2x"></span> please wait...');
   
   $.ajax({
	 type: "POST",
	 url:   "./connect/signing.php",
	 data: fdata,
	 cache: false,
	 processData : false,
	 contentType : false,
	 success: function(data){ console.log(data);
		     if(data === 'PASSO'){
				 $("#sbutton").html('<span style="font-size:16px; color:#092; font-weight: bold" class="text-success"> Signing in ......</span>');
                 $("form").trigger('reset');
				 window.location.replace('home');
			 }
			 if(data === 'PASSM'){
				 $("#sbutton").html('<span style="font-size:16px; color:#092; font-weight: bold" class="text-success"> Signing in ......</span>');
                 $("form").trigger('reset');
				 window.location.replace('admin');
			 }
			 else if(data === 'ALT'){
				 $("#sbutton").html('<div>Log in as: <button id="submit_aider" type="submit" style="display:none"></button><div><button type="button" onclick="alt_login(\'unit_owner\')" class="btn btn-primary btn-lg btn-block fa fa-sign-in" style="border-radius:10px; width:45%;">Unit Owner</button><button type="button" class="btn btn-primary btn-lg btn-block fa fa-sign-in" style="border-radius:10px; width:45%;" onclick="alt_login(\'manager\')"> Manager</button></div></div>');
			 }
			  else{
				$("#sbutton").html(sbutton);
                $("#errmsg").html('<span class="text-danger">' +data + '</span>');
				var elmnt = document.getElementById("errmsg");
                 //elmnt.scrollIntoView();
				
			  }
		    },
		  });
	
}



function  forgot_p_form(event){
	
	
	event.preventDefault();
	
	var email = $("#m_email_p").val().trim();

    if(!(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/.test(email))) return;
	
	var fdata = new FormData($("#forgot_p_form")[0]);
	
	var sbutton = $("#sbutton_p").html(); //grab the initial content
	$("#errmsg_p").html('');
	
	$("#sbutton_p").html('<span class="fa fa-spin fa-spinner fa-2x"></span> please wait...');
	   
	   $.ajax({
		 type: "POST",
		 url:   "./connect/signing.php",
		 data: fdata,
		 cache: false,
		 processData : false,
		 contentType : false,
		 success: function(data){ console.log(data);
				 if(data === 'PASS'){
					 $("#sbutton_p").html('<span style="font-size:16px; color:#092; font-weight: bold; background-color:#FFF; padding:10px" class="text-success">  An reset link has been sent to your email. Please check your email folders and follow the link to reset your password</span>');
					 $("form").trigger('reset');
					 
				 }
				 else if(data == 'ALT'){
				 $("#sbutton_p").html('<div>Submit as: <button id="submit_aider2" type="submit" style="display:none"></button><div><button type="button" onclick="alt_fpasswd(\'unit_owner\')" class="btn btn-primary btn-lg btn-block fa fa-sign-in" style="border-radius:10px; width:45%;">Unit Owner</button><button type="button" class="btn btn-primary btn-lg btn-block fa fa-sign-in" style="border-radius:10px; width:45%;" onclick="alt_fpasswd(\'manager\')"> Manager</button></div></div>');
			      }
				  else{
					$("#sbutton_p").html(sbutton);
					$("#errmsg_p").html('<span class="text-danger">' +data + '</span>');
					//var elmnt = document.getElementById("errmsg");
					 //elmnt.scrollIntoView();
					
				  }
				},
			  });
	
	
	
}


function password_change_form(event){
		
	event.preventDefault() //Prevent default form submission, we are using ajax to submit user details
	
	var token = $('#token').val();
	var pword1 = $('#pword1').val().trim();
	var pword2 = $('#pword2').val().trim();
	
	if(pwdmatch_2() == 0){  //check if password match with the pwdmatch() function
			 return;
			}
			
	
	var fdata = new FormData($("#password_reset_form")[0]);
	
	var sbutton = $("#sbutton").html(); //grab the initial content
	$("#errmsg").html('');
	
	$("#sbutton").html('<span class="fa fa-spin fa-spinner fa-2x"></span> please wait...');
	
	


	
	//Ajax request to post registration details
	$.ajax({
	 type: "POST",
	 url:   "",
	 data: fdata,
	 cache: false,
	 processData : false,
	 contentType : false,
	 success: function(data){ //console.log(data);
	     
		  if(data == 'PASS'){//registration was successful
			$('#errmsg').html('<div style="padding:20px; background-color:#FFF; color:#0C0; padding:10px">Password changed successfully.  <a href="./login.php" style="color:#090">Proceed to login</a> </div>'); 
			$("form").trigger('reset');
			 $("#sbutton").remove();
			  }
		  else { //registration not successful
		     $("#errmsg").html(data);
			  $("#sbutton").html(sbutton);
			  }
	 }
   });
		
}


function pwdmatch_2(){
   
   //function to check if password match or contain username

  var ptest = (document.getElementById("pword1").value).trim();
  var ptest2 = (document.getElementById("pword2").value).trim();
  var username = (document.getElementById("username").value).trim();
  
  if(username == '') username = 'abcd123';
  
             if(ptest.length < 6){mytooltip("pword1", "Passsword is too short"); return 0; }
		   
		      if(ptest != ptest2 ){mytooltip("pword2", "Passsword not match");  return 0; }
			  if(ptest.indexOf(username) !== -1  || username.indexOf(ptest) !== -1){mytooltip("pword1", "password look unsecure. It should be different from your name"); return 0; }
       return 1;
	
	}

 



function myalert(messagez){
 $.magnificPopup.close();

setTimeout(function(){
$.magnificPopup.open({
  items: {
    src: '<div style="width:100%; text-align:center" class="white-popup"><div style="width:auto; max-width:500px; display:inline-block; background-color:#EEE; text-align:left; padding:20px; color: #000">' + messagez + '</div></div>', // can be a HTML string, jQuery object, or CSS selector
    type: 'inline'
  }
}); }, 500);
	}



function mydommie(messagez){

$.magnificPopup.close();
setTimeout(function(){
$.magnificPopup.open({
  items: {
    src: '<div style="width:100%; text-align:center" class="white-popup"><div style="width:auto; max-width:500px; display:inline-block; background-color:transparent; text-align:center; "><span class="fa fa-2x fa-spin fa-spinner"></span>' + messagez + '</div></div>', // can be a HTML string, jQuery object, or CSS selector
    type: 'inline'
  }
}); }, 50);
	}



function mytooltip(kz, message){
		
       var valuez = '<div class="tooltip_' + kz + '" style=" position:relative; border: thin dotted #FFC; width:auto; padding: 5px; border-radius: 4px;" role="tooltip"><div style="position:absolute;width:0;height:0;border-color:transparent;border-style:solid; top:0;left:50%; margin-bottom: 10px; margin-left:-5px;border-width:5px 5px 5px 5px;border-top-color:#F50"></div><div style="background-color: transparent; color:#F00; font-size:12px; font-family:\'Times New Roman\', Times, serif; text-align:left">' + message + '</div></div>';
       $("#" + kz).after(valuez);
		//$("#" + kz).tooltip('show');
     		$("#" + kz).focus(); 
			
					setTimeout(function(){$(".tooltip_" + kz).remove(); },10000);
		
		}



function isValidEmail(e) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(e);
    }

    function isValidInput(caller, isEmail) {
        var valid = false;

        if ($(caller).val() != "")
            valid = true;

        if (isEmail) {
            if (caller.val().indexOf('+') < 0 && isValidEmail(caller.val()))
                valid = true;
            else
                valid = false;
        }

        if (!valid) {
            $(caller).css('border', '1px solid red').addClass('shakeEffect');
            setTimeout(function () {
                $(caller).removeClass('shakeEffect')
            }, 400);
            return false;
        } else {
            $(caller).css('border', '');
            return true;
        }
    }
	
	
	

$(document).ready(function(){

	
		
		if($('.slick_main').length){
			
		$('.slick_main').slick({
		  slidesToShow: 1,
		  touchMove: true,
		  infinite: true,
		  speed :  1000,
		  autoplay: true,
		  autoplaySpeed: 3500,
		  prevArrow: '<span class="prev_arrow fa fa-chevron-left"></span>',
		  nextArrow: '<span class="next_arrow fa fa-chevron-right"></span>',
		  //fade:  true,
		  responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				//dots: true
			  }
			},
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		  ]
			 
		  });
		}
		
		if($(".vote_option").length){
			$(".vote_option").on('click', function(){
				
				 if(voting_state_n == 3){
				
			   			if(voting_max_count == 1){
								$('.vote_option').removeClass('active');
								$('.vote_option').find('input').prop('checked', false);
								
								$(this).addClass('active');
								$(this).find('input').prop('checked', true);
								$("#sbutton button").prop('disabled', false);
								return;
						}
						if( $(this).find('input').prop('checked')){
							$(this).removeClass('active');
							$(this).find('input').prop('checked', false);
						}
						else{
						
			   				if($(".vote_option.active").length >= voting_max_count){
								myalert('Maximum choice is ' + voting_max_count +'.  Please unselect other option in order to select this option.')
								return;
							}
							$(this).addClass('active');
							$(this).find('input').prop('checked', true);
							$("#sbutton button").prop('disabled', false);
					
					}
				}
				
			})
			
			
		}
	
});


function  alt_login(utype){
	$("#sign_in").val(utype); 
	$("#submit_aider")[0].click();
	
}

function  alt_fpasswd(utype){
	$("#forgot_password").val(utype);
	$("#submit_aider2")[0].click();
	
}




function update_password(event){
		
	event.preventDefault() 
	var fdata = new FormData($("#update_password")[0]);
	fdata.append('ch', 'password');
	mydommie("processing");
	$("#modal_password").modal('hide');
	$.ajax({
	 type: "POST",
	 url:   "",
	 data: fdata,
	 cache: false,
	 processData : false,
	 contentType : false,
	 success: function(data){ //console.log(data);
	 	  if(data.substr(0, 4) == 'PASS'){//registration was successful
			myalert('<span style="color:#0C0;" class="fa fa-check"> Password changes successfully</span>');
			$("#update_password")[0].reset();
			}
		  else { //registration not successful
		     myalert('<span style="color:#C00;" class="">'+data+'</span>');
			 setTimeout(function(){$("#modal_password").modal('show')}, 1500); 
			 }
	 }
   });
		
}


function update_profile(event){
		
	event.preventDefault() 
	var fdata = new FormData($("#update_profile")[0]);
	fdata.append('ch', 'update_profile');
	mydommie("processing");
	$("#modal_profile").modal('hide');
	$.ajax({
	 type: "POST",
	 url:   "",
	 data: fdata,
	 cache: false,
	 processData : false,
	 contentType : false,
	 success: function(data){ //console.log(data);
	 	  if(data.substr(0, 4) == 'PASS'){//registration was successful
				$("#fname_vx").html($("#fname_x").val());
				$("#email_vx").html($("#email_x").val());
				$("#phone_vx").html($("#phone_x").val());
				$("#lname_vx").html($("#lname_x").val());
				$.magnificPopup.close();
			 }
		  else { //registration not successful
		     
			 myalert('<span style="color:#C00;" class="">'+data+'</span>');
			 
			 }
	 }
   });
		
}



