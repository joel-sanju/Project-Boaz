// JavaScript Document
var table = null;
  

var editor = new $.fn.dataTable.Editor( {
    ajax:  './connect/edit_users.php',
    table: '#myTable',
	idSrc:  0,
    fields: [
		//{ label: 'Project',  name: 0, type : 'select', options: project_ray,   },
        { label: 'FullName',  name:  1 },
		{ label: 'Email',  name: 2  },
		{ label: 'Phone',  name: 3  },
		{ label: 'Password',  name: 4, default: '123456'  },
		
    ],
	formOpttions: {
		inline: {
			//onBlur: 'submit'
			}
		}
} );


  
table = $('#myTable').DataTable( {
	"processing": true,
	"serverSide": true,
   "ajax": "./connect/get_data.php?table=users",
   rowId: 0,
   "bSortCellsTop" : true,
    dom: '<B<"datatable_dom_pull_left"f><"pull-right"l>r<t>lip>',
	'lengthMenu': [[60, 100, 200, -1], [60, 100, 200, 'All']],
    columns: [
        { data: null, sortable: false,  render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1;}},
		{ data: 1 },
		{ data: 2 },
		{ data: 3 },
		{ data: 4, className: 'has_file', 'visible': true, render: function(data, type, row){  return '<button class="'+ (!((row[4] == '' || row[4] == null))? 'not_empty' : '') +'" type="button" onClick="render_file_modal(\'' +row[0] + '\',\'' +row[4] + '\')">files</button>'; }},
        // etc
    ], 
	"order" : [[1, "asc"]],
    select: true,
	select: {
		style: 'os',
		selector: 'td:first-child'
		},  
    buttons: [
		{ extend: 'create', editor: editor, formButtons: ['Submit'] },
        { extend: 'edit',   editor: editor },
		{ extend: 'remove', editor: editor },
		{
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'csv',
					'excel',
					'pdf'
                ]
            },
		
		{ extend: 'colvis', collectionLayout: 'fixed three-column' },
    ]
} );




$('#myTable thead tr:eq(1) th').each( function (i) {
        
		 if($(this).hasClass('sch')){
			 $(this).html('<input type="text" placeholder="search"/>')
			 $('input', this).on('keyup change', function(){
				if ( table.column(i).search() !== this.value ) {
					
					
					table
						.column(i)
						.search( this.value )
						.draw();
				}
			} );
		 }
		 else if($(this).hasClass('sch_sel')){
			  $('select', this).on('change', function(){
				if ( table.column(i).search() !== this.value ) {
					
					
					table
						.column(i)
						.search( this.value )
						.draw();
				}
			} );
		 }
});



editor.on('preSubmit', function(e, data, action){
	  
	  	
		if(action != 'remove'){
		
			validate_data(this.field(1), 3, 'FullName');
			validate_data(this.field(2), 6, 'Email');
			validate_data(this.field(3), 0, 'Phone');
			//validate_data(this.field(6), 1, 'Owner Ocuupied');
				
			if(this.inError()){
				return false;
				}
		}
	   
	   
});
	

function  validate_data(cname, nb, name){

	if(!cname.isMultiValue()){
		if(!cname.val()){
			cname.error('You must provide a '+ name)
			}
		 if(cname.val().length < nb){
			cname.error('Please provide a valid '+ name)
			}
	}	
	

}





function  render_filename(){
	var  filename = $("#file_m_n")[0].files[0].name; 	
	var mime = filename.split('.').pop();
	var filename_wtm = filename.slice(0, -(mime.length + 1));
	$("#filename").val(filename_wtm);
}

function  render_file_modal(row_id, file){
	
	
	$("#modal_file tbody").html('');
	var fgh = true;
	if(!(file == "" || file == null)){
		try{
		var files = file.split(',,');
		for(var i = 0; i < files.length; i++){
			var file_n = files[i];
			if(file_n == "") continue;
			fgh = false;
			var f_data = file_n.split(",");
			var file_name = f_data[0];
			var real_path = f_data[1];
			var mime = real_path.split('.').pop();
			var real_path_wtm = real_path.slice(0, -(mime.length + 1));
			var fake_path =  "../uploads/"+real_path_wtm + '/' + encodeURIComponent(file_name) + '.' + mime;
			
			var trow = '<tr id="'+real_path_wtm+'"><td><a target="_blank" href="'+fake_path+'">'+file_name+'.' + mime+ '</a></td><td><button class="fa fa-times" onclick="removefile(\''+row_id+'\', \''+file_n+'\')" type="button"></button></td></tr>'
			$("#modal_file tbody").append(trow);
		}
		}catch(Exception){}
	
	}
 	
	//if(fgh)$("#modal_file tbody").html('<td colspan="2"><small>no file uploaded yet</span></td>');
	
	$("#uploadform")[0].reset();
	
	$("#modal_file  #row_id").val(row_id);
	$("#modal_file").modal("show");
	
}

function  uploadform(event){
	event.preventDefault();
	var fdata = new FormData($("#uploadform")[0]);
	var sbutton = $("#fsbutton").html();
	var row_id = $("#modal_file  #row_id").val();
	$("#fsbutton").html('<span class="fa fa-spin fa-spinner"></span>');
	
	$.ajax({
	 type: "POST",
	 url:  "./connect/file_upload.php",
	 data: fdata,
	 cache: false,
	 processData : false,
	 contentType : false,
	 success: function(data){
		 $("#fsbutton").html(sbutton);
		 if(data.substr(0, 4) == "PASS"){
			 
			var file_n = data.substr(4);
			 
			var f_data = file_n.split(",");
			var file_name = f_data[0];
			var real_path = f_data[1];
			var mime = real_path.split('.').pop();
			var real_path_wtm = real_path.slice(0, -(mime.length + 1));
			var fake_path =  "../uploads/"+real_path_wtm + '/' + encodeURIComponent(file_name) + '.' + mime;
			
			var trow = '<tr id="'+real_path_wtm+'"><td><a target="_blank" href="'+fake_path+'">'+file_name+'.' + mime+ '</a></td><td><button class="fa fa-times" onclick="removefile(\''+row_id+'\', \''+file_n+'\')" type="button"></button></td></tr>'
			$("#modal_file tbody").append(trow);
			
			$("#uploadform")[0].reset();
			
			$("#modal_file  #row_id").val(row_id);
			
			var before_data = table.cell("#" + row_id + " td.has_file").data();
			
			before_data = ",,"+file_n  + before_data;
			
			table.cell("#" + row_id + " td.has_file").data(before_data);
			 
		 }
		 else{
			 
			 myalert('<span style="color:red">'+data+'</span>');
			 
			 }
		 
	 
	 }
	});

}


function  removefile(row_id, file_n){
	
	var f_data = file_n.split(",");
	var file_name = f_data[0];
	var real_path = f_data[1];
	var mime = real_path.split('.').pop();
	var real_path_wtm = real_path.slice(0, -(mime.length + 1));
	
			
	$("#" + real_path_wtm + " td:eq(1)").html('<span class="fa fa-spin fa-spinner"></span>');
	
	$.ajax({
	 type: "POST",
	 url:  "./connect/file_upload.php",
	 data: {file_n: file_n, row_id: row_id},
	 success: function(data){
		 
		 
		 if(data == "PASS"){
			 
			 $("#" + real_path_wtm ).remove();
			
			 var before_data = table.cell("#" + row_id + " td.has_file").data();
			
			 before_data = before_data.replace(",,"+file_n, "");
			 before_data = before_data.replace(file_n, "");
			
			 table.cell("#" + row_id + " td.has_file").data(before_data);
			 
		 }
		 else{
			 $("#" + real_path_wtm + " td:eq(1)").html('<button class="fa fa-times" onclick="removefile(\''+row_id+'\', \''+file_n+'\')" type="button"></button>');
			 myalert('<span style="color:red">'+data+'</span>');
			 
			 }
		 
	 
	 }
	});

}
