<?php
return [
    //智游宝测试账号
    /*'url'       =>  'http://ds-zff.sendinfo.com.cn/boss/service/code.htm', //post发送数据url地址
    'userName'  =>  'admin',        //账号
    'corpCode'  =>  'TESTFX',       //企业码
    'goodsCode' =>  'PST20160918013085',//用票票型编码
    'sign'      =>  'TESTFX',       //密钥
    'tpCode'    =>  '20130914000000001',//智游宝短信模板编号，不填使用默认模板*/
    //----- 正式环境 ------------
    'url'       =>  'http://boss.zhiyoubao.com/boss/service/code.htm', //post发送数据url地址
    'userName'  =>  'sztlfx2',              //账号
    'corpCode'  =>  'sdzfxsztlfx2',         //企业码
    'goodsCode' =>  '20140610014545',       //商品编码
    'sign'      =>  'CF4E8E851E2509774668AD4324A0A95B',       //密钥
    'tpCode'    =>  '',                   //智游宝短信模板编号，不填使用默认模板
];