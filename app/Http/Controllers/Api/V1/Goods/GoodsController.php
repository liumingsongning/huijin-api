<?php

namespace App\Http\Controllers\Api\V1\Goods;

use App\Http\Controllers\Api\BaseController;

class GoodsController extends BaseController
{
    /**
     * @api {get} /goods  Goods List

     * @apiGroup Goods
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "data": "$data"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Find
     *     {
     *       "error": "没有商品"
     *     }
     */
    public function index()
    {
        dd(1);
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
     * @api {get} /goods/:id   Good show
     * @apiGroup Goods
     * @apiParam {string} id Good id.
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *       "good": "$data"
     *     }
     *
     * @apiError AccessDenied The phone of the User was error.
     *
     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Find
     *     {
     *       "message": "404 Not Found",
     *       "status_code": 404
     *     }
     */
    public function show($id)
    {
        $data = \App\Models\good::find($id);
        if ($data) {
            return $this->response->array($data);
        } else {
            throw $this->error('404','未发现该商品');
        }

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
