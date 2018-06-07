<?php

namespace App\Http\Controllers\Api\V1\Address;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
class AddressController extends BaseController
{
    protected $model;
    function __construct(Request $request) {
        parent::__construct($request);
        $this->model=\App\Models\user_address::where('user_id',$this->uid);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=$this->model->get();
        if($data){
            return $this->response->array(['address'=>$data]);
        }else{
            $this->error('404', '还没有数据');
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
     * @api {post} /address address add
     * @apiName addAddress
     * @apiGroup Address
     *
     * @apiParam {string} consignee 收件人.
     * @apiParam {string} email 邮件地址
     * @apiParam {string} country 国家码.
     * @apiParam {string} code code
     * @apiParam {string} phone User phone.
     * @apiParam {string} code code
     * @apiParam {string} phone User phone.
     * @apiParam {string} code code
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "token": "$token"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 403 Access Denied
     *     {
     *       "message": "验证码不正确",
     *       "status_code": 403,
     *     }
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->
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
}
