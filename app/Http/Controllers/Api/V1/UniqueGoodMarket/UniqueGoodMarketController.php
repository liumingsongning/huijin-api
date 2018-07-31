<?php

namespace App\Http\Controllers\Api\V1\UniqueGoodMarket;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Jobs\SoldoutUnique;
use DB;
class UniqueGoodMarketController extends BaseController
{
    public function index(Request $request){
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        $model =\App\Models\unique_good_market::with('unique_good');

        if($request->q&&$request->q!=''){
            $q='%' . $request->q . '%';
            $model=$model->whereHas('unique_good',function($query)use($q){
                $query->where('goods_name', 'like', $q);
            });
        }

        $data = $model->Paginate($perPage = $perPage, $columns = ['*'], $pageName = 'page', $page = $page);
        if (!empty($data)) {
            return $this->response->array(['markets' => $data]);
        } else {
            $this->error('404', '还没有数据');
        }
    }
    public function show($id)
    {
        $data = \App\Models\unique_good_mardet::find($id);

        if ($data) {
            return $this->response->array($data);
        } else {
            throw $this->error('404', '未发现该商品');
        }

    }
    public function publish(Request $request)
    {

        $uid = $this->uid;
        $unique_good_id=$request->unique_good_id;
        if(!$this->checkUser($uid,$request->order_good_id,$request->unique_good_id)){
            $this->error('422','您的订单里没有该收藏商品');
        }else{
            $create['sell_uid']=$uid;
            $create['unique_good_id']=$unique_good_id;
            $create['introduction']=$request->introduction;
            $create['price']=$request->price;
            $create['status']=UNI_PUBLISH;
            $create['sale_user_phone']=$request->sale_user_phone;
            $create['user_credited_account']=$request->user_credited_account;
            $data=\App\Models\unique_good_market::create($create);
            if ($data) {
                // $this->dispatch(new SoldoutUnique($data, config('app.SoldoutUnique_ttl')));
                return $this->response->array(['data'=>$data]);
            } else {
                throw $this->error('422', '发布商品失败');
            }
        }
    }
    public function checkUser($uid,$order_good_id,$unique_good_id)
    {
        $data=DB::table('order_infos')
                ->leftJoin('order_goods', 'order_infos.order_sn', '=', 'order_goods.order_sn')
                ->leftJoin('order_join_uniques', 'order_goods.id', '=', 'order_join_uniques.order_good_id')
                ->where('order_infos.user_id',$uid)
                ->where('order_infos.pay_status',2)
                ->where('order_goods.id',$order_good_id)
                ->where('order_join_uniques.id',$unique_good_id)
                ->first();
        return $data;
    }
    public function ownerPublishSecondHand(Request $request){
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        $model = new \App\Models\unique_good_mardet;

        $data = $model::where('sell_uid',$this->uid)->Paginate($perPage = $perPage, $columns = ['*'], $pageName = 'page', $page = $page);
        if (!empty($data)) {
            return $this->response->array(['orders' => $data]);
        } else {
            $this->error('404', '还没有数据');
        }
    }
    public function ownerBoughtSecondHand(Request $request){

        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        $model = new \App\Models\unique_good_mardet;

        $data = $model::where('buy_uid',$this->uid)->Paginate($perPage = $perPage, $columns = ['*'], $pageName = 'page', $page = $page);

        if (!empty($data)) {
            return $this->response->array(['orders' => $data]);
        } else {
            $this->error('404', '还没有数据');
        }
    }
}
