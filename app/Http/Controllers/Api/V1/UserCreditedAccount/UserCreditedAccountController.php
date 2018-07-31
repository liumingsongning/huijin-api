<?php

namespace App\Http\Controllers\Api\V1\UserCreditedAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

class UserCreditedAccountController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create=$request->all();
        $create['uid']=$this->uid;
        $data=\App\Models\user_credited_account::create($create);
        if($data){
            return $this->response->array(['account'=>$data]);
        }else{
            throw $this->error('422', '创建失败');
        }
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

    public function ownerCreditedAccount(Request $request){
        $data=\App\Models\user_credited_account::where('uid',$this->uid)->get();
        if($data->isNotEmpty()){
            return $this->response->array(['account'=>$data]);
        }else{
            throw $this->error('422', '创建失败');
        }
    }
}
