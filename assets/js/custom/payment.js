const lead_id = TRIFED.getUrlParameters().id;
const form_id = TRIFED.getUrlParameters().form_id;
const action = TRIFED.getUrlParameters().action;
var base_fee=0;
var net_base_fee=0;
$(function () {
	$('.date').datepicker();
	fetchPrograms();
	if(action=='edit'){
		fetchEditDetails(form_id);	
	}else{
		add_installments();	
	}
	
	
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

    		
    		if (form_id != undefined && form_id != '') 
			{
				data.append('form_id', form_id );
				
			}
			data.append('lead_id', lead_id );
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Payments Added Successfully ');
					setTimeout(function() { window.location = 'payments-list.php'}, 1500);
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
fetchEditDetails = (form_id)=>{
	var url = conf.getPaymentInfo.url(form_id);
	var method = conf.getPaymentInfo.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response.status) {
			$('#program_id').val(response.data.program_id);
			$('#gross_payable').val(response.data.gross_payable);
			$('#exemption').val(response.data.exemption);
			$('#base_fee').val(response.data.base_fee);
			$('#net_base_fee').val(response.data.net_base_fee);
			$('#installment_total').val(response.data.installment_total);
			var installments=response.data.getInstallments;
			installments.forEach((row)=>{
				add_installments(row);	
			});
		}
	});	
}
function add_installments(row){
	
	var random_id=Date.now();
	var data = { 
		random_id:random_id,
		result:row
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
function remove_installments_db(installment_id,random_id){
	if(confirm('Do you really want to delete this? After clicking on this, this installment will be deleted permanently')){
		
		var url = conf.remove_installment.url;
		var method = conf.remove_installment.method;
		var data = {
			installment_id
		};
		TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
			if (response.status) {
				$('#installment_'+random_id).remove();
				inc_installment();	
				setTotalAmount();	
			}
		});


			
	}
}
$(document).on('keyup','.installment_amount',function(){
	setTotalAmount();	
});
$('.fee').on('keyup',function(){
	setPaymentInfo();
});

setTotalAmount=()=>{
	var total_amount=0;
	$('.installment_amount').each(function(){
		total_amount +=parseInt($(this).val());
	});
	$('#installment_total').val(total_amount)
}
setPaymentInfo=()=>{
	var gross_payable=$('#gross_payable').val();
	var exemption=$('#exemption').val();
	//var base_fee=base_fee;
	//var net_base_fee=net_base_fee;
	if(gross_payable!='' && exemption!='')
	{
		var base_fee_exempted=parseFloat(base_fee) - parseFloat(exemption);
		var net_base_fee_exempted=parseFloat(net_base_fee) - parseFloat(exemption);
		$('#base_fee').val(base_fee_exempted);

		$('#net_base_fee').val(net_base_fee_exempted);
	}
	// if(gst_applicable > 0){
	// 	net_base_fee=base_fee + (gst_applicable * (base_fee/100));
	// 	$('#net_base_fee').val(net_base_fee);
	// }
}
getProgramInfo=()=>{
	let program_id=$('#program_id').val();
	var url=conf.getProgramsById.url(program_id);
	var method=conf.getProgramsById.method;
	data={};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			base_fee=response.data.base_price;
			net_base_fee=response.data.total_price;
			$('#gross_payable').val(response.data.total_price);
			$('#base_fee').val(base_fee);
			$('#net_base_fee').val(net_base_fee);
			$('#exemption').val(0);
			//setPaymentInfo();
		}
	});
}