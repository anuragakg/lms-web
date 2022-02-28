<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Resources\NotificationResource as ApiResource;
use App\Services\NotificationSendService;
use App\Http\Controllers\API\BaseController as BaseController;
class NotificationController extends BaseController
{
    protected $service;

    public function __construct(NotificationSendService $notificationSendService)
    {
        $this->service = $notificationSendService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->service->fetchNotifications();
        $items = ApiResource::collection($list);
        return $this->sendResponse( $items, 'Notifications');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $res = $this->service->markReadNotification($id);

            $res = [
                'message' => 'Notification Mark As Read'
            ];

            return $this->sendResponse([],'Notification Mark As Read');
        } catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $res = $this->service->deleteAllNotification();

            if ($res) {
                /** If item is deleted successfully */
                $res = [
                    'message' => 'Notifications Deleted'
                ];
                return $this->sendResponse( [], 'Notifications Deleted');
            }

            $res = [
                'message' => 'Notifications Not Deleted'
            ];
            /** If failed to delete item from db */
            return $this->sendError('Notifications Not Deleted');  
        } catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
        }
    }

    /**
     * Update Status of the resource
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    function updateStatus($id)
    {
        //
    }

    public function markAllRead()
    {
        try {
            $res = $this->service->markAllReadNotification();

            $res = [
                'message' => 'All Notification Is Mark As Read'
            ];

            return $this->sendResponse( [], 'All Notification Is Mark As Read');
        } catch (\Throwable $th) {
            return $this->sendError('Exception Error.', $th);  
        }
    }

    public function getNotificationCount(Request $request)
    {
        $user  = Auth::user();
        $list['count'] = $this->service->getNotificationCount();
        $list['role'] =  $user->role;
        $list['permissions'] =  $user->getPermissions;
        return $this->sendResponse( $list, 'Unread Notification');
    }
}
