<?php
/* 订单状态 */

define('OS_UNCONFIRMED',            0); // 未确认

define('OS_CONFIRMED',              1); // 已确认

define('OS_CANCELED',               2); // 已取消

define('OS_INVALID',                3); // 无效

define('OS_RETURNED',               4); // 退货

define('OS_SPLITED',                5); // 已分单

define('OS_SPLITING_PART',          6); // 部分分单



/* 支付类型 */

define('PAY_ORDER',                 0); // 订单支付

define('PAY_SURPLUS',               1); // 会员预付款

define('PAY_UNIQUE',               1); // 收藏商品付款



/* 配送状态 */

define('SS_UNSHIPPED',              0); // 未发货

define('SS_SHIPPED',                1); // 已发货

define('SS_RECEIVED',               2); // 已收货

define('SS_PREPARING',              3); // 备货中

define('SS_SHIPPED_PART',           4); // 已发货(部分商品)

define('SS_SHIPPED_ING',            5); // 发货中(处理分单)

define('OS_SHIPPED_PART',           6); // 已发货(部分商品)



/* 支付状态 */

define('PS_UNPAYED',                0); // 未付款

define('PS_PAYING',                 1); // 付款中

define('PS_PAYED',                  2); // 已付款



/* 综合状态 */

define('CS_AWAIT_PAY',              100); // 待付款：货到付款且已发货且未付款，非货到付款且未付款

define('CS_AWAIT_SHIP',             101); // 待发货：货到付款且未发货，非货到付款且已付款且未发货

define('CS_FINISHED',               102); // 已完成：已确认、已付款、已发货


/* 帐户明细类型 */
define('SURPLUS_SAVE',              0); // 为帐户冲值
define('SURPLUS_RETURN',            1); // 从帐户提款

/* 帐号变动类型 */
define('ACT_SAVING',                0);     // 帐户冲值
define('ACT_DRAWING',               1);     // 帐户提款
define('ACT_ADJUSTING',             2);     // 调节帐户
define('ACT_OTHER',                99);     // 其他类型

/* 二手物品交易类型 */

define('UNI_PUBLISH',                0);     // 收藏商品发布
define('UNI_AWAIT_PAY',              1);    // 收藏商品被拍下未付款
define('UNI_PAYED',                  2);    // 收藏商品已付款
define('UNI_SOLDOUT',                3);    // 收藏商品下架