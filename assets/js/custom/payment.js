const lead_id = TRIFED.getUrlParameters().id;
$(function () {
	$('.date').datepicker();
	fetchPrograms();
	add_installments();
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
					title: 'Payments List',
					exportOptions: {
						columns: [0, 1, 2,3,4]
					}
				},
				

				
			  ],
			  
            "ajax":{
                     "url": conf.getProgramsList.url,
                     "dataType": "json",
                     "type": "GET",
                     "headers": {
		                "Authorization": 'Bearer ' + auth.token
		            },
		            "data": function(d, settings){
				         var api = new $.fn.dataTable.Api(settings);
				         
				         d.page = api.page()+1;
				         
				      },
		            "dataSrc": function(json) {
		            		json.draw = json.data.draw;
							json.recordsTotal = json.data.recordsTotal;
							json.recordsFiltered = json.data.recordsFiltered;			
	       					return json.data.data;
	       						
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
							"orderable": false,
							"render": function(data, type, row) {
									return row.title;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.base_price;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.gst;
							}
							 
						},
						{ 
							"orderable": false,
							"render": function(data, type, row) {
									return row.added_by;
							}
							 
						},
						
						{
							"orderable": false,
							"render": function(data, type, row) {
								var html='';
								html +='<a href="programs.php?id='+row.id+'" class="ti-pencil"></a>  | ';
								return html;
									
							}
						},

						
		               
		                
		            ]

      });




	$("#formID").submit(function(e) {
	    e.preventDefault();
	}).validate({
	    rules: {
            
            
        },
        messages: {
            
		},
	    submitHandler: function(form) { 
	       
			//const data=$('#formID').serializeArray();
			
    		
			var url = conf.addPaymentDetails.url;
			var method = conf.addPaymentDetails.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		//if (edit_id != undefined && edit_id != '') 
			//{
				//data.append('form_id', edit_id );
				
			//}
			data.append('lead_id', lead_id );
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Payments Added Successfully ');
					setTimeout(function() { window.location = 'payments-list.php'}, 500);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});


fetchPrograms = (id = 0) => {
	var url = conf.getPrograms.url;
	var method = conf.getPrograms.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			var html='<option value="">Select Programs</option>';
			response.data.forEach((row)=>{
				html +='<option value="'+row.id+'">'+row.title+'</option>';
			});
			$('#program_id').html(html);
		}
	});
}
function add_installments(){
	
	var random_id=Date.now();
	var data = { 
		random_id:random_id,

	};
	var template = $("#installment_template").html();
  var text = Mustache.render(template, data);

  $("#installment_dates_container").append(text);
  $('#installment_date_'+random_id).datepicker(
  {
  	dateFormat: 'dd-mm-yy',
	  	changeMonth: true,
        changeYear: true,
  }
  	);
  inc_installment();
}
function inc_installment(){
	var installment_no=0;
	
	$(".installment_no").each(function() {
   	++installment_no;
		$(this).val(installment_no)
	});
}
function remove_installments(random_id){
	$('#installment_'+random_id).remove();
	inc_installment();
}
$(document).on('keyup','.installment_amount',function(){
	var total_amount=0;
	$('.installment_amount').each(function(){
		total_amount +=parseInt($(this).val());
	});
	$('#installment_total').val(total_amount)
});
$('.fee').on('keyup',function(){
	setPaymentInfo();
});
setPaymentInfo=()=>{
	var gross_payable=$('#gross_payable').val();
	var exemption=$('#exemption').val();
	var base_fee=$('#base_fee').val();
	var gst_applicable=parseFloat($('#gst_applicable').val());
	var net_base_fee=$('#net_base_fee').val();
	if(gross_payable!='' && exemption!='')
	{
		base_fee=parseFloat(gross_payable) - parseFloat(exemption);
		$('#base_fee').val(base_fee);
		$('#net_base_fee').val(base_fee);
	}
	if(gst_applicable > 0){
		net_base_fee=base_fee + (gst_applicable * (base_fee/100));
		$('#net_base_fee').val(net_base_fee);
	}
}
getProgramInfo=()=>{
	let program_id=$('#program_id').val();
	var url=conf.getProgramsById.url(program_id);
	var method=conf.getProgramsById.method;
	data={program_id};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#gross_payable').val(response.data.total_price);
			setPaymentInfo();
		}
	});
}