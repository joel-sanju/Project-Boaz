// JavaScript Document


//////////////////////////////////////////////////////////////////////////////////

var glob_edit_id = 0;

function update_password(event, ch){
	
	event.preventDefault();
	
	var fdata = new FormData($("#" + ch + "_form")[0]);
			
	var sbutton = $(".msbutton").html(); //grab the initial content
	
	$(".errmsg").html('');
	
	
	$(".msbutton").html('<span class="fa fa-spin fa-spinner fa-2x"></span> please wait...');
	   
	   $.ajax({
		 type: "POST",
		 url:   "./connect/admin.php",
		 data: fdata,
		 cache: false,
		 processData : false,
		 contentType : false,
		 success: function(data){ console.log(data);
		 		
				$(".msbutton").html(sbutton);
				 if(data === 'PASS'){
					 
					 $("form")[0].reset();
					 
					$(".errmsg").html('<div class="text-success fa fa-check"  style="padding:15px; background-color:#FFF; font-size:12px; border: 1px solid #0F0; width:94%; margin: 3%;  border-radius:4px;"> Updated successfully</div>');
				 }
				  else{
					$(".errmsg").html('<div class="text-danger" style="padding:15px; background-color:#FFF; font-size:12px; border: 1px solid #F00; width:93%; margin: 3%; border-radius:4px;">' +data + '</div>');
					//var elmnt = document.getElementById("errmsg");
					 //elmnt.scrollIntoView();
					
				  }
				},
			  });
	
}







$(document).ready(function() {
$(".close_mag").click(function(){ $.magnificPopup.close(); });
});


function myalert(messagez){
setTimeout(function(){
$("#modal_alert .modal-body").html(messagez);
$("#modal_alert").modal('show'); }, 300);
	}
	

function dommie(vasz, str){ 
	if(vasz == "1"){
$.magnificPopup.open({
  items: {
    src: '<div style="width:100%; text-align:center" class="white-popup"><div style="width:auto; max-width:500px; display:inline-block; font-size:40px; background-color:transparent; color: #CCC"><i class="fa fa-spinner fa-spin"></i>  ' + str + '</div></div>', // can be a HTML string, jQuery object, or CSS selector
    type: 'inline'
  },
  fixedContentPos: true,
  closeOnBgClick : false,
}); 	}

    else $.magnificPopup.close();
	}

	
function mytooltip(kz, message){
		
       var valuez = '<div id="tooltip_' + kz + '" style=" position:relative; border: thin dotted #FFC; width:auto; padding: 5px; border-radius: 4px;" role="tooltip"><div style="position:absolute;width:0;height:0;border-color:transparent;border-style:solid; top:0;left:50%; margin-bottom: 10px; margin-left:-5px;border-width:5px 5px 5px 5px;border-top-color:#F50"></div><div style="background-color: transparent; color:#F00; font-size:12px; font-family:\'Times New Roman\', Times, serif; text-align:left">' + message + '</div></div>';
       $("#" + kz).after(valuez);
		//$("#" + kz).tooltip('show');
     		$("#" + kz).focus(); 
			
					setTimeout(function(){$("#tooltip_" + kz).remove(); },10000);
		
		}




