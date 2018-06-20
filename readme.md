## 官网预定页面建设需求

> 待完成： 智游宝通知地址发送 **邮件** 重新申请

对接前须知：
通知地址由智游宝配置
将需要配置的通知地址，通知名称（退票、核销、完结注明）、配置企业码（注意：为分销商企业码）、配置单位名称发送到邮箱 taotao.xu@zhiyoubao.com
收到回复邮件后务必测试回调！

1、对接智游宝。游客在该网址下购买的门票，从预订到验证使用都能够在智游宝系统可以直接查询并在窗口验证换票；

2、游客预订的网络票如果最终未验证使用，可以随时申请退款；

3、支持多种票种购买。如成人票、学生票、演出票、门票+住宿、门票+餐饮等。且后台随时可以上架下架产品；

4、游客预订时有一个固定的预订系统模式，比如录入模块：游玩日期，人数，身份证、预订手机号等具体信息。购买多张票时只需要输入一个人的身份证和一个手机号；

5、有宣传的区域，在后期使用过程中针对不同时间点、不同的活动上传特定的宣传海报，如banner；
6、页面设计简单大方，购买流程方便不繁琐；

7、购买页面的详情，如购买流程，优惠政策都有所体现，同时配适量图片，单个产品页面篇幅不宜太长；

8、有手机页面，支持手机端支付。

9、能够支持支付宝、微信等多种支付方式。

#### 智游宝参数如下：
```
用户名：tlgz
企业码：TESTFX
密码：111111
地址：http://ds-zff.sendinfo.com.cn/Abutment/docked/login.htm
接口测试地址：http://ds-zff.sendinfo.com.cn/boss/service/code.htm
文档在登陆后可以下载
测试账号：admin 测试企业码：TESTFX  私钥：TESTFX
测试用票票型编码：PST20160918013085
```
一。接口开发流程：
2.开发步骤
需求在票务宝平台申请，分销售的企业，由票务宝提供你们私钥下载
boss.zhiyoubao.com/boss/service/code.htm
请求以POST提交
有两个参数
参数名	说明
xmlMsg	请求接口的内容，具体见下面内容
sign	MD5(“xmlMsg=”+ xmlMsg +私钥)后的值    -----加密后的内容要是小写的

私钥的值  具体我们提供
所有
2.1下订单 xmlMsg内容(xml)
```
<PWBRequest>
  <transactionName>SEND_CODE_REQ</transactionName>  固定值
  <header>
    <application>SendCode</application> 固定值
    <requestTime>2011-21-20</requestTime>
  </header>
  <identityInfo>
    <corpCode>BCFXS</corpCode>  我们提供
    <userName>ADMIN</userName> 我们提供的用户名
  </identityInfo>
  <orderRequest>
    <order>
      <certificateNo>330182198804273139</certificateNo>  身份证号
      <linkName>庄工</linkName>联系人 必填
      <linkMobile>13625814109</linkMobile> 必填
      <orderCode>t20141204002226</orderCode> 你们的订单编码（或别的），要求唯一，我回调你们通知检票完了的标识
      <orderPrice>200.00</orderPrice> 订单总价格
      <groupNo></groupNo>团号
      <payMethod></payMethod> 支付方式值spot现场支付vm备佣金 ，zyb智游宝支付
    <ticketOrders>
        <ticketOrder>
         <orderCode>t2014120400222601</orderCode>必填 你们的子订单编码                                <price>100.00</price>  票价，必填，线下要统计的
          <quantity>1</ quantity >   必填   票数量
          <totalPrice>1.00</totalPrice> 必填 子订单总价
          <occDate>2014-12-09</occDate>必填   日期
          <goodsCode>20140331011721</goodsCode> 必填 商品编码，同票型编码
          <goodsName>商品名称</goodsName>  -----商品名称
          <remark>商品名称</remark>  -----备注
        </ticketOrder>
      </ticketOrders>
    </order>
  </orderRequest>
</PWBRequest>
```
回传
```
<?xml version="1.0" encoding="UTF-8"?>
<PWBResponse>
  <transactionName>SEND_CODE_RES</transactionName>
  <code>0</code>
  <description>成功</description>
  <orderResponse>
    <order>
      <certificateNo>330182198804273139</certificateNo>
      <linkName>庄工</linkName>
      <linkMobile>13625814109</linkMobile>
      <orderCode>201308120000045137</orderCode><智游宝订单号>
      <orderPrice>1</orderPrice>
      <payMethod>vm</payMethod> 支付方式
      <assistCheckNo>00055359</assistCheckNo> 辅助码
      <payStatus>payed</payStatus> 支付状态
      <src>interface</src>
      <ticketOrders>
        <ticketOrder>
          <orderCode>t20141204002226</orderCode>
          <totalPrice>1</totalPrice>
          <price>1</price>
          <quantity>2</quantity>
          <occDate>2014-12-09 00:00:00</occDate>
          <goodsCode>20140331011721</goodsCode>
          <goodsName>商品名称</goodsName>
          <remark>helloworld</remark>
        </ticketOrder>
      </ticketOrders>
    </order>
  </orderResponse>
</PWBResponse>
```
2.5发短信
```xml
<PWBRequest>
  <transactionName> SEND_SM_REQ </transactionName>
  <header>
    <application>SendCode</application>
    <requestTime>2011-21-20</requestTime>
  </header>
  <identityInfo>
    <corpCode>BCFXS</corpCode> 分销商企业编码
    <userName>ADMIN</userName> 分销商用户名
  </identityInfo>
  <orderRequest>
    <order>
      <orderCode>21</orderCode> 你们的主订单编码
      <tplCode>20130914000000001</tplCode> 模板编号（不填默认模板）
    </order>
  </orderRequest>
</PWBRequest>
```
响应
```xml
<?xml version="1.0" encoding="UTF-8"?>
<PWBResponse>
  <transactionName> SEND_SM_RES </transactionName>
  <code>0</code>
  <description>成功</description>
</PWBResponse>
```