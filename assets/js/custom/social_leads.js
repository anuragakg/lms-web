const edit_id = TRIFED.getUrlParameters().id;
var payment_add = TRIFED.checkPermissions("payment_add");
$(function () {
	

 	var auth = TRIFED.getLocalStorageItem();
 	let listElement='#list';
	var oTable =$(listElement).DataTable({
          "processing": true,
          "serverSide": true,
          "order": [[0, "DESC"]],
		  "dom": 'lBfrtip',
		   oLanguage: {
				sProcessing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
			},
				
			"buttons": [

				{
					extend: 'excel',
					text: '<i class="fa fa-file-excel-o"></i> Export to Excel',
					titleAttr: 'EXCEL',
					title: 'Social leads List',
					exportOptions: {
						columns: [0, 1, 2,3,4]
					}
				},
				

				
			  ],
			  aLengthMenu:[10,25,50,100,250,500,1000,5000,10000],
            "ajax":{
                     "url": conf.getSocialMediaLeads.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				         d.main_code = $('#main_code').val();
				         d.parent_code = $('#parent_code').val();
				         
				      },
		            "dataSrc": function(json) {
		            		json.draw = json.data.draw;
							json.recordsTotal = json.data.recordsTotal;
							json.recordsFiltered = json.data.recordsFiltered;			
	       					return json.data.data.data;
	       						
	    			}
                   },
		            "columns": [
		                { 
		                	"render": function(data, type, full, meta) {
						        var PageInfo = $(listElement).DataTable().page.info();
						        return PageInfo.start+1+meta.row;
						        
						    }
						},
						{ 
							"orderable": true,
							"render": function(data, type, row) {
									return row.name;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.email;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.phone;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.source;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.ad_name;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.main_code;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.parent_code;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.created_time;
							}
							 
						},

						
						{
							"orderable": false,
							"render": function(data, type, row) {
								var html='';
								if(payment_add){
									if(row.is_payment_setup==null || row.is_payment_setup==0){
										html +='<a href="payment.php?id='+row.id+'" class="btn btn-primary">Setup Payment Info</a>  | ';		
									}else{
										html +='Payment Info Added ';		
									}
									
								}
								
								return html;
									
							}
						},

						
		               
		                
		            ]

      });

	$('#search-btn').click(function () {
		    oTable.ajax.reload();
		});		
});


