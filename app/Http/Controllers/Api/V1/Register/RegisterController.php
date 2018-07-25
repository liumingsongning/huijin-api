<?php

namespace App\Http\Controllers\Api\V1\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;

class RegisterController extends BaseController
{
        /**
     * @api {post} /updateCompanyPassword updateCompanyPassword
     * @apiName updateCompanyPassword
     * @apiGroup Register
     *
     * @apiParam {string} phone User phone.
     * @apiParam {string} code code
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "success": "1"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 403 Access Denied
     *     {
     *       "message": "注册失败",
     *       "status_code": 422,
     *     }
     */
    public function updateCompanyPassword(Request $request){
        $request->validate([
            'password' => 'required',
        ]);
        $password=$request->password;
       
        $user=$request->user();
        $user->password=Hash::make($password);
        $data=$user->save();
        if($data){
            return $this->response->array(['success' =>1]);
        }else{
            $this->error('422','注册失败');
        }
    }
        /**
     * @api {post} /bindCompany bindCompany
     * @apiName bindCompany
     * @apiGroup Register
     *
     * @apiParam {string} province code
     * @apiParam {string} city code
     * @apiParam {string} district code
     * @apiParam {string} street code
     * @apiParam {string} address 详细地址
     * @apiParam {string} bussiness_license 营业执照url
     * @apiParam {string} trademark 商标url
     * @apiParam {string} people_number 人数
     * @apiParam {string} company_industry 公司行业
     * @apiParam {string} company_nature 公司性质
     * @apiParam {string} business_volume 公司营业额
     * @apiParam {string} contact_name 联系人
     * @apiParam {string} section 部门
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "success": "1"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 403 Access Denied
     *     {
     *       "message": "注册失败",
     *       "status_code": 422,
     *     }
     */
    public function bindCompany(Request $request){

        $company=$request->all();
        $company['uid']=$this->uid;
        $company_user=\App\Models\company_user::where('uid',$this->uid)->first();
        if($company_user){
            $data=\App\Models\company_user::update($company);
        }else{
            $data=\App\Models\company_user::create($company);
        }
        
        if($data){
            return $this->response->array(['company' =>$data]);
        }else{
            $this->error('422','注册失败');
        }
    }
}
