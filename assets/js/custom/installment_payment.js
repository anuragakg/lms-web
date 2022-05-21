const payment_id = TRIFED.getUrlParameters().id;
var gst=0;
$(function () {
	$('.date').datepicker();
	fetchPaymentInfo(payment_id);
	//add_installments();
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
					title: 'Programs List',
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
			
    		
			var url = conf.addPaymentInstallment.url;
			var method = conf.addPaymentInstallment.method;
			
			var form = $('#formID')[0];   
    		var data = new FormData(form);	
    		//if (edit_id != undefined && edit_id != '') 
			//{
				//data.append('form_id', edit_id );
				
			//}
			data.append('payment_id', payment_id );
			TRIFED.fileAjaxHit(url, method, data, function (response) {
				if (response.status == 1) {
					
					TRIFED.showMessage('success', 'Programs Added Successfully ');
					setTimeout(function() { window.location = 'payments-list.php'}, 3000);
				} else {
					TRIFED.showError('error', response.message);
				}
			});
	        return false;  //This doesn't prevent the form from submitting.
	    }
	});    
});


fetchPaymentInfo = (id = 0) => {
	var url = conf.getPaymentInfo.url(id);
	var method = conf.getPaymentInfo.method;
	var data = {};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#user_name').html(response.data.getLeadUser.name);
			$('#email_id').html(response.data.getLeadUser.email);
			$('#programme').html(response.data.getProgramInfo.title);
			gst=response.data.getProgramInfo.gst;
			$('#gross_payable').html(response.data.gross_payable);
			$('#exemption').html(response.data.exemption);
			$('#base_fee').html(response.data.base_fee);
			//$('#gst_applicable').html(response.data.gst_applicable);
			$('#net_base_fee').html(response.data.net_base_fee);
			$('#fund_receivable').html(response.data.net_base_fee);
			$('#fund_received').html(response.data.total_received);
			$('#balance_amount').html(response.data.balance_due);
			response.data.getInstallments.forEach((row)=>{
				add_installments(row,gst);
			});
		}
	});
}
function add_installments(row,gst){
	
	var random_id=Date.now();
	var data = { 
		random_id:random_id,
		data:row,
		gst
	};
	var template = $("#installment_template").html();
  var text = Mustache.render(template, data);

  $("#installment_dates_container").append(text);
  $('#mop_'+random_id).val(row.mop);
  $('#received_date_'+random_id).datepicker(
	  {
	  	dateFormat: 'dd-mm-yy',
	  	changeMonth: true,
        changeYear: true,
	  }
  	);
  //inc_installment();
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
	var gross_payable=$('#gross_payable').val();
	var exemption=$('#exemption').val();
	var base_fee=$('#base_fee').val();
	var net_base_fee=$('#net_base_fee').val();
	if(gross_payable!='' && exemption!='')
	{
		base_fee=parseFloat(gross_payable) - parseFloat(exemption);
		$('#base_fee').val(base_fee);
		$('#net_base_fee').val(base_fee);
	}
	
});
getProgramInfo=()=>{
	let program_id=$('#program_id').val();
	var url=conf.getProgramsById.url(program_id);
	var method=conf.getProgramsById.method;
	data={program_id};
	TRIFED.asyncAjaxHit(url, method, data, function (response, cb) {
		if (response) {
			$('#gross_payable').val(response.data.total_price)
		}
	});
}
function check_total_received(random_id){
	var w_fee=$('#w_fee_'+random_id).val();
	var gst=$('#gst_'+random_id).val();
	
	if(w_fee !='' && gst !='')
	{
		gst=parseFloat(gst);
		w_fee=parseFloat(w_fee);
		total_received=w_fee + ((gst * w_fee)/100);
		$('#total_received_'+random_id).val(total_received);
	}
}
$(document).on('keyup','.total_received',function(){
	var random_id=$(this).attr('data-id');
	var total_received=$(this).val();
	total_received=parseFloat(total_received);
	var gst_amount=(total_received * gst)/100;

	w_fee=total_received-gst_amount;
	$('#w_fee_'+random_id).val(w_fee);
	$('#gst_amount'+random_id).val(gst_amount);
});