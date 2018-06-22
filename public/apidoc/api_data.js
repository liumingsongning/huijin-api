define({ "api": [
  {
    "type": "post",
    "url": "/address",
    "title": "address add",
    "name": "addAddress",
    "group": "Address",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "consignee",
            "description": "<p>收件人.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>邮件地址</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "country",
            "description": "<p>国家码.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province",
            "description": "<p>省码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city",
            "description": "<p>城市码.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "district",
            "description": "<p>地区码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>地址全文.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "zipcode",
            "description": "<p>邮政编码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tel",
            "description": "<p>座机</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sign_building",
            "description": "<p>标志建筑</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "best_time",
            "description": "<p>最佳送货时间</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token\": \"$token\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Access Denied\n{\n  \"message\": \"地址存储失败\",\n  \"status_code\": 403,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Address/AddressController.php",
    "groupTitle": "Address"
  },
  {
    "type": "delete",
    "url": "/address/:id",
    "title": "address delete",
    "name": "deleteAddress",
    "group": "Address",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"success\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Access Denied\n{\n  \"message\": \"删除失败\",\n  \"status_code\": 403,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Address/AddressController.php",
    "groupTitle": "Address"
  },
  {
    "type": "put",
    "url": "/address/:id",
    "title": "address update",
    "name": "updateAddress",
    "group": "Address",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "consignee",
            "description": "<p>收件人.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>邮件地址</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "country",
            "description": "<p>国家码.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province",
            "description": "<p>省码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city",
            "description": "<p>城市码.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "district",
            "description": "<p>地区码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>地址全文.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "zipcode",
            "description": "<p>邮政编码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tel",
            "description": "<p>座机</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sign_building",
            "description": "<p>标志建筑</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "best_time",
            "description": "<p>最佳送货时间</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token\": \"$token\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Access Denied\n{\n  \"message\": \"地址存储失败\",\n  \"status_code\": 403,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Address/AddressController.php",
    "groupTitle": "Address"
  },
  {
    "type": "post",
    "url": "/BuyNowCart/cart",
    "title": "add cart",
    "name": "BuyNowCart_add",
    "group": "Cart",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "good_id",
            "description": "<p>good id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"添加商品失败\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/BuyNowCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "get",
    "url": "/BuyNowCart/cart",
    "title": "BuyNowCart get",
    "name": "BuyNowCart_get",
    "group": "Cart",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"未查询到该购物车\",\n  \"status_code\": 404,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/BuyNowCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "post",
    "url": "/cart/add",
    "title": "add cart",
    "name": "addCart",
    "group": "Cart",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "good_id",
            "description": "<p>good id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"添加商品失败\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/ShoppingCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "post",
    "url": "/cart/clear",
    "title": "clear cart",
    "name": "clearCart",
    "group": "Cart",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"清空购物车失败\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/ShoppingCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "get",
    "url": "/cart/display",
    "title": "display cart",
    "name": "displayCart",
    "group": "Cart",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"未查询到该购物车\",\n  \"status_code\": 404,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/ShoppingCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "get",
    "url": "/cart/getAssign",
    "title": "getAssign cart",
    "name": "getAssign",
    "group": "Cart",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "arr",
            "optional": false,
            "field": "rowIds",
            "description": "<p>rowIds 商品id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"未查询到该购物车\",\n  \"status_code\": 404,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/ShoppingCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "post",
    "url": "/cart/minus",
    "title": "minus cart",
    "name": "minusCart",
    "group": "Cart",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "rowId",
            "description": "<p>row id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"减少商品失败\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/ShoppingCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "post",
    "url": "/cart/remove",
    "title": "remove cart",
    "name": "removeCart",
    "group": "Cart",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "rowId",
            "description": "<p>row id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"cart\": \"$cart\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"移除商品失败\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Cart/ShoppingCartController.php",
    "groupTitle": "Cart"
  },
  {
    "type": "get",
    "url": "/goods",
    "title": "Goods List",
    "group": "Goods",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"data\": \"$data\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Find\n{\n  \"error\": \"没有商品\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Goods/GoodsController.php",
    "groupTitle": "Goods",
    "name": "GetGoods"
  },
  {
    "type": "get",
    "url": "/goods/:id",
    "title": "Good show",
    "group": "Goods",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>Good id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"good\": \"$data\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Find\n{\n  \"message\": \"404 Not Found\",\n  \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Goods/GoodsController.php",
    "groupTitle": "Goods",
    "name": "GetGoodsId"
  },
  {
    "type": "post",
    "url": "/login",
    "title": "login",
    "name": "Login",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>User phone.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "code",
            "description": "<p>code</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token\": \"$token\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Access Denied\n{\n  \"message\": \"验证码不正确\",\n  \"status_code\": 403,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Login/LoginController.php",
    "groupTitle": "Login"
  },
  {
    "type": "post",
    "url": "/checkcaptcha",
    "title": "checkcaptcha",
    "name": "checkcaptcha",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>User phone.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "captcha",
            "description": "<p>luosimao captcha.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"success\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 400 Access Denied\n{\n  \"message\": \"人机验证失败\",\n  \"status_code\": 400,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Login/LoginController.php",
    "groupTitle": "Login"
  },
  {
    "type": "post",
    "url": "/phonebind",
    "title": "phonebind",
    "name": "phonebind",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>User phone.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "code",
            "description": "<p>code</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "type",
            "description": "<p>oauth type.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "oauth_id",
            "description": "<p>oauth oauth_id</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"token\": \"$token\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 403 Access Denied\n    {\n      \"message\": \"验证码不正确\",\n      \"status_code\": 403,\n    }\nor",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "    HTTP/1.1 500 Access Denied\n    {\n      \"message\": \"关联qq用户失败\",\n      \"status_code\": 500,\n    }\nor",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"未查到该qq用户\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Login/LoginController.php",
    "groupTitle": "Login"
  },
  {
    "type": "post",
    "url": "/sendcode",
    "title": "sendcode",
    "name": "sendcode",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "phone",
            "description": "<p>User phone.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "captcha",
            "description": "<p>luosimao captcha.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"success\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p> <pre><code>HTTP/1.1 403 Access Denied {   &quot;message&quot;: &quot;错误消息提示&quot;,   &quot;status_code&quot;: 403, }</code></pre>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Login/LoginController.php",
    "groupTitle": "Login"
  },
  {
    "type": "get",
    "url": "/order",
    "title": "order list",
    "group": "Order",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "page",
            "description": "<p>page.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"order\": \"$data\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Find\n{\n  \"message\": \"404 Not Found\",\n  \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Order/OrderController.php",
    "groupTitle": "Order",
    "name": "GetOrder"
  },
  {
    "type": "get",
    "url": "/order/:id",
    "title": "order show",
    "group": "Order",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>order id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"order\": \"$data\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Find\n{\n  \"message\": \"404 Not Found\",\n  \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Order/OrderController.php",
    "groupTitle": "Order",
    "name": "GetOrderId"
  },
  {
    "type": "post",
    "url": "/order/add",
    "title": "add order",
    "name": "add_order",
    "group": "Order",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "consignee",
            "description": "<p>收件人.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>邮件地址</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "country",
            "description": "<p>国家码.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province",
            "description": "<p>省码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city",
            "description": "<p>城市码.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "district",
            "description": "<p>地区码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>地址全文.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "zipcode",
            "description": "<p>邮政编码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tel",
            "description": "<p>座机</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>手机</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sign_building",
            "description": "<p>标志建筑</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "best_time",
            "description": "<p>最佳送货时间</p>"
          },
          {
            "group": "Parameter",
            "type": "arr",
            "optional": false,
            "field": "rowIds",
            "description": "<p>rowIds 商品id.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "pay_id",
            "description": "<p>pay_id 支付宝是1，微信扫码支付是6，线下支付是8.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "need_inv",
            "description": "<p>是否需要发票，1是需要，0是不需要</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "inv_type",
            "description": "<p>发票样式 '增值税专用发票(一般纳税人)' 或者 '普通发票'.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "inv_payee",
            "description": "<p>发票抬头</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "inv_content",
            "description": "<p>发票内容.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "referer",
            "description": "<p>'self_site'</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"order\": \"添加的订单详情\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": \"订单添加失败\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Order/OrderController.php",
    "groupTitle": "Order"
  },
  {
    "type": "delete",
    "url": "/order/:id",
    "title": "delete order",
    "name": "delete_order",
    "group": "Order",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>order id.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"success\": \"1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "AccessDenied",
            "description": "<p>The phone of the User was error.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 422 Access Denied\n{\n  \"message\": 删除订单失败\",\n  \"status_code\": 422,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Order/OrderController.php",
    "groupTitle": "Order"
  },
  {
    "type": "get",
    "url": "域名/alipay?order_sn=订单order_sn",
    "title": "支付宝支付接口",
    "group": "Payment",
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Find\n{\n  \"message\": \"404 Not Found\",\n  \"status_code\": 404\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/huihjin/git/huijin-api/app/Http/Controllers/Api/v1/Payment/PaymentController.php",
    "groupTitle": "Payment",
    "name": "GetAlipayOrder_snOrder_sn"
  }
] });
