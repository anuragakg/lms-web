<?php
  
function changeDateFormate($date,$date_format=null){
	if($date_format==null){
		$date_format='d-M-Y';
	}
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
   
function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}

function form_type()
{
	$data=array(
		1=>'Mini Category',
		2=>'Lead'
	);
	return $data;
}
function get_form_type($id)
{
	$form_types=form_type();
	
	return $form_types[$id];
}
function status_text($status){
	switch ($status) {
		case '1':
			$text='Approved';
			break;
		case '2':
			$text='Reject';
			break;
		
		default:
			$text='Pending';
			break;
	}
	return $text;
}
function paginate_num(){
	return 10;
}