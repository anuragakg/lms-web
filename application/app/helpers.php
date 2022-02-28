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

function getLTypeUser($role)
{
	switch ($role) {
		case '2':
			$user_type=1;
			break;
		case '3':
			$user_type=2;
			break;
		case '4':
			$user_type=3;
			break;
		default:
			$user_type=null;
			break;
	}
	return $user_type;
}

function hashPassword($password){
	return bcrypt(hash('sha256',$password));
}
function sendVerticalNotification($product)
{
	$job = (new \App\Jobs\SendVerticalJob($product))->delay(now()->addSeconds(2)); 
	dispatch($job);  
}
function sendNewCategoryNotification($product)
{
	$job = (new \App\Jobs\CategoryCreatedJob($product))->delay(now()->addSeconds(2)); 
	dispatch($job);  
}
function sendNewFormNotification($product)
{
	$job = (new \App\Jobs\NewFormCreatedJob($product))->delay(now()->addSeconds(2)); 
	dispatch($job);  
}
function sendSubCategoryNotification($product)
{
	$job = (new \App\Jobs\NewSubCategoryJob($product))->delay(now()->addSeconds(2)); 
	dispatch($job);  
}
function sendMiniCategoryNotification($product)
{
	$job = (new \App\Jobs\NewMiniCategoryJob($product))->delay(now()->addSeconds(2)); 
	dispatch($job);  
}
function sendLeadCategoryNotification($product)
{
	$job = (new \App\Jobs\NewLeadCategoryJob($product))->delay(now()->addSeconds(2)); 
	dispatch($job);  
}
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

