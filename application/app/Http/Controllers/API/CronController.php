<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Lead;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\PaymentInstallment;
use App\Http\Controllers\API\BaseController;
use App\Notifications\SendInstallmentDueNotification;
use Illuminate\Support\Facades\Notification;
class CronController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->sendInstallmentNotifications();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    function sendInstallmentNotifications(){
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(1);
        $instalments = PaymentInstallment::whereBetween('installment_date', [$startDate, $endDate])->get();

        foreach ($instalments as $key => $instalment) {
            $lead_id=$instalment->lead_id;
            $payment_id=$instalment->payment_id;
            $payment=Payment::findOrFail($payment_id);
            $name=$payment->getLeadUser->name;
            $program=$payment->getProgramInfo->title;
            Notification::route('mail', [
                $payment->getLeadUser->email => $payment->getLeadUser->name,
            ])->notify(new SendInstallmentDueNotification($payment,$instalment));
        }
    }
}
