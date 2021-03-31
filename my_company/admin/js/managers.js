// JavaScript Document
var table = null;
  

var editor = new $.fn.dataTable.Editor( {
    ajax:  './connect/edit_managers.php',
    table: '#myTable',
	idSrc:  0,
    fields: [
		//{ label: 'Project',  name: 0, type : 'select', options: project_ray,   },
        { label: 'First Name',  name: 1  },
		{ label: 'Last Name',  name: 2, },
		{ label: 'Email Address',  name: 3  },
		{ label: 'Phone',  name: 4  },
		{ label: 'Default Password',  name: 5  },
		
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
   "ajax": "./connect/get_data.php?table=managers",
   "bSortCellsTop" : true,
    dom: '<B<"datatable_dom_pull_left"f><"pull-right"l>r<t>lip>',
	'lengthMenu': [[60, 100, 200, -1], [60, 100, 200, 'All']],
    columns: [
        { data: null, sortable: false,  render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1;}},
		{ data: 1 },
		{ data: 2 },
		{ data: 3 },
		{ data: 4 },
		
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
			 $(this).html('<select><option value=""></option><option value="0">Unpaid</option><option value="1">Paid</option></select>')
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
	  
	  	
		if(action == 'create'){
		
			validate_data(this.field(5), 6, 'Password');
				
			if(this.inError()){
				return false;
				}
		}
		
		if(action == 'edit'){
		
			var cname = this.field(5);
			if(!cname.isMultiValue()){
				if(cname.val() && cname.val().trim().length > 0){
					cname.error('You can not update manager\'s password. They can always recover password on their own'+ name)
				}
			}
				
			if(this.inError()){
				return false;
				}
		}
		
		
		if(action != 'remove'){
		
			validate_data(this.field(1), 2, 'First Name');
			validate_data(this.field(2), 2, 'Last Name');
			validate_data(this.field(3), 7, 'Email');
				
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
		 if(cname.val().trim().length < nb){
			cname.error('Please provide a valid '+ name)
			}
	}	
	

}