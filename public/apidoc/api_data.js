define({ "api": [
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
    "filename": "D:/laravel/dingoJwt/dingo/app/Http/Controllers/Api/v1/Goods/GoodsController.php",
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
    "filename": "D:/laravel/dingoJwt/dingo/app/Http/Controllers/Api/v1/Goods/GoodsController.php",
    "groupTitle": "Goods",
    "name": "GetGoodsId"
  },
  {
    "type": "post",
    "url": "/sendcode",
    "title": "sendcode",
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
          "content": "HTTP/1.1 400 Access Denied\n{\n  \"message\": \"人机验证失败\",\n  \"status_code\": 400,\n}\nor\nHTTP/1.1 403 Access Denied\n{\n  \"message\": \"错误消息提示\",\n  \"status_code\": 403,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "D:/laravel/dingoJwt/dingo/app/Http/Controllers/Api/v1/Login/LoginController.php",
    "groupTitle": "Login"
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
    "filename": "D:/laravel/dingoJwt/dingo/app/Http/Controllers/Api/v1/Login/LoginController.php",
    "groupTitle": "Login"
  }
] });
