<?php
   
namespace App\Services;
   
use Illuminate\Http\Request;
use Validator;
use App\Models\Payment;
use App\Models\Lead;
use App\Models\PaymentInstallment;

use App\Models\User;
use Auth;
use DB;
use App\Notifications\SendUserInstallments;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerticalCreated;
class PaymentsService 
{
    public function getList($request){
        $limit = $request['length']??10;
        $search = isset($request['search']['value'])?$request['search']['value']:'';
        
        $Payment=Payment::orderBy('id','desc');
        if(!empty($search)){
            //$Payment=$Payment->where(DB::raw("CONCAT(`title`)"), 'LIKE', "%".$search."%");    
        }
        
        return $Payment->paginate($limit);
            
    }
    public function addPayment($request){
        $user_id = Auth::user()->id??1;
        
        
        try{
            DB::beginTransaction();
            $Payment=Payment::where(['lead_id'=>$request->lead_id,'program_id'=>$request->program_id])->first();
            if(empty($Payment)){
                $Payment=new Payment();    
            }
            
            $lead=Lead::findOrFail($request->lead_id);
            $lead->is_payment_setup=1;
            $lead->save();
            if($request->installment_total > $request->net_base_fee)
            {
                throw new \Error('installment total should not be greater than net base fee');
            }


            $Payment->lead_id=$request->lead_id;
            $Payment->program_id=$request->program_id;
            $Payment->installment_total=$request->installment_total;
            $Payment->gross_payable=$request->gross_payable;
            $Payment->exemption=$request->exemption;
            $Payment->base_fee=$request->base_fee;
            //$Payment->gst_applicable=$request->gst_applicable;
            $Payment->net_base_fee=$request->net_base_fee;
            $Payment->balance_due=$request->net_base_fee;
            $Payment->added_by=$user_id;
            $Payment->save();

            foreach ($request['instalment']['installment_num'] as $key => $installment) {
                $paymentInstallment=new PaymentInstallment();
                $date= $request['instalment']['installment_date'][$key];
                $date=date('Y-m-d',strtotime($date));
                $paymentInstallment->payment_id=$Payment->id;
                $paymentInstallment->lead_id=$request->lead_id;
                $paymentInstallment->installment_num=$installment;
                $paymentInstallment->installment_date=$date;
                $paymentInstallment->installment_amount=isset($request['instalment']['installment_amount'][$key])?$request['instalment']['installment_amount'][$key]:'';
                $paymentInstallment->save();
            }  


            

            $job = (new \App\Jobs\SetupUserInstallment($Payment))->delay(now()->addSeconds(2)); 
            dispatch($job);  
            DB::commit();
            return $Payment;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }


    public function updatePayment($request,$form_id){
        $user_id = Auth::user()->id??1;
        
        
        try{
            DB::beginTransaction();
            $Payment=Payment::where(['id'=>$form_id])->first();
            
            if($request->installment_total > $request->net_base_fee)
            {
                throw new \Error('installment total should not be greater than net base fee');
            }

            $Payment->lead_id=$request->lead_id;
            $Payment->program_id=$request->program_id;
            $Payment->installment_total=$request->installment_total;
            $Payment->gross_payable=$request->gross_payable;
            $Payment->exemption=$request->exemption;
            $Payment->base_fee=$request->base_fee;
            //$Payment->gst_applicable=$request->gst_applicable;
            $Payment->net_base_fee=$request->net_base_fee;
            $Payment->balance_due=$request->net_base_fee;
            $Payment->added_by=$user_id;
            $Payment->save();

            foreach ($request['instalment']['installment_id'] as $key => $installment_id) {
                $paymentInstallment=PaymentInstallment::where('id',$installment_id)->first();
                if(empty($paymentInstallment)){
                    $paymentInstallment=new PaymentInstallment();    
                }
                $date= $request['instalment']['installment_date'][$key];
                $date=date('Y-m-d',strtotime($date));
                $paymentInstallment->payment_id=$Payment->id;
                $paymentInstallment->lead_id=$request->lead_id;
                $paymentInstallment->installment_num=isset($request['instalment']['installment_num'][$key])?$request['instalment']['installment_num'][$key]:'';
                $paymentInstallment->installment_date=$date;
                $paymentInstallment->installment_amount=isset($request['instalment']['installment_amount'][$key])?$request['instalment']['installment_amount'][$key]:'';
                $paymentInstallment->save();
            }  


            

            $job = (new \App\Jobs\SetupUserInstallment($Payment))->delay(now()->addSeconds(2)); 
            dispatch($job);  
            DB::commit();
            return $Payment;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
    
    public function checkValidation($input){
        return Validator::make($input, [
            'program_id' => 'required',
            'installment_total' => 'required',
            'gross_payable' => 'required',
            'exemption' => 'required',
            'base_fee' => 'required',
            //'gst_applicable' => 'required',
            'net_base_fee' => 'required',
            'instalment.installment_num.*' => 'required',
            'instalment.installment_date.*' => 'required',
            'instalment.installment_amount.*' => 'required',
        ]);
    }
    public function checkInstallmentValidation($input){
        return Validator::make($input, [
            'payment_id' => 'required',
            
        ]);   
    }
    public function getPayment($id){
        return Payment::find($id);
    }
    public function addInstallment($request){
        $user_id = Auth::user()->id;
        
        
        try{
            DB::beginTransaction();
            $Payment=Payment::findOrFail($request->payment_id);
            
            

            foreach ($request['w_fee'] as $key => $installment) {
                $paymentInstallment=PaymentInstallment::findOrFail($key);
                if($installment !=''){
                    $paymentInstallment->w_fee=$installment;
                    $gst=$request['gst'][$key]!='' ? $request['gst'][$key] : 0;
                    $gst_amount=$request['gst_amount'][$key]!='' ? $request['gst_amount'][$key] : 0;
                    $paymentInstallment->gst=$gst;
                    $paymentInstallment->gst_amount=$gst_amount;
                    //$total_received=$installment + (($gst * $installment)/100);
                    $total_received=$request['total_received'][$key]!='' ? $request['total_received'][$key] : 0;
                    $paymentInstallment->total_received=$total_received;
                    $paymentInstallment->mop=$request['mop'][$key];
                    $paymentInstallment->received_by=$request['received_by'][$key];
                    $paymentInstallment->received_date=date('Y-m-d',strtotime($request['received_date'][$key]));
                    $paymentInstallment->save();
                }
                
            }  
            $total_received=PaymentInstallment::where('payment_id',$request->payment_id)->sum('total_received');
            $balance_due=$Payment->net_base_fee-$total_received;
            $Payment->total_received=$total_received;
            $Payment->balance_due=$balance_due;
            $Payment->save();
            DB::commit();
            return $Payment;
        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;  
            
        }
        
    }
}