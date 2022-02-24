<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\RolesModel;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use DB;
class RolesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try{
            $items= RolesModel::paginate(100);
            $json_data = array(
            "recordsTotal"    => $items->total(),  
            "recordsFiltered" => $items->total(), 
            "data"            => $items,
            'current_page' => $items->currentPage(),
            'next' => $items->nextPageUrl(),
            'previous' => $items->previousPageUrl(),
            'per_page' => $items->perPage(),   
            );
            return $this->sendResponse( $json_data, 'Roles Listed successfully.');
        }catch (\Throwable $th) {
           return $this->sendError('Exception Error.', $th);  
       }
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
        $role=RolesModel::where('id',$id)->first();
        return $this->sendResponse( $role, 'Roles Listed successfully.');
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

    public function getPermissionsList()
    {
        $permissions=PermissionModel::get();
        $data=array();
        foreach ($permissions as $key => $permission) {
            $data[$permission->group][]=array(
                'id'=>$permission->id,
                'alias'=>$permission->alias,
                'name'=>$permission->name,
                'description'=>$permission->description,
            );
        }
        return $this->sendResponse( $data, 'Roles Listed successfully.');
        
    }
    public function savePermissions(Request $request)
    {
        $input=$request->all();
        $role_id=$input['role_id'];
        DB::beginTransaction();
        RolePermissionModel::where('role_id',$role_id)->delete();
        foreach ($input['permission_id'] as $key => $permission) {
            $role_permission=new RolePermissionModel();
            $role_permission->role_id=$role_id;
            $role_permission->permission=$permission;
            $role_permission->save();
        }
        DB::commit();
        return $this->sendResponse( [], 'Roles Permission added successfully.');
        
    }
    public function getRolePermission($role_id)
    {
        $permissions=RolePermissionModel::where('role_id',$role_id)->get();
        return $this->sendResponse( $permissions, 'Roles Permission added successfully.');
    }
    public function getRoleList()
    {
        $roles= RolesModel::get();
        return $this->sendResponse( $roles, 'Roles list');
    }
}
