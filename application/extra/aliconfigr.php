<?php
//修改'vendor/riverslei/payment/src/Common/Ali/AliBaseStrategy.php' 文件的 80,81行注释换成下面一行内容，不严格验证
// 'CURLOPT_SSL_VERIFYPEER'    => false,'CURLOPT_SSL_VERIFYHOST'    => false,

return [
    // 正式模式
    'use_sandbox'               => false,
    //正式环境--数据
    'partner'                   => '2088801240869039',
    'app_id'                    => '2017071907807475',
    'sign_type'                 => 'RSA2',// RSA  RSA2
    // 可以填写文件路径，或者密钥字符串  当前字符串是 rsa2 的支付宝公钥(开放平台获取)
    //同里支付宝公钥
    'ali_public_key'            => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkI4fox8bpTBRp5czTOOjdcAn8Em6bdAVtCpI7PCEAT+/EaMrbLJWI/Nct190FDY/C5z7tJFrhalXbnTvK/pWxWrb7Fcp2xaU+s7wQScPcWkN+vNlQJEQ/HfP/w/HyH9J5dEyxGZ8ca1c49xJUEVDO2LBy5mdatwf6kI8f9z4FSXWsAxhlOIhPqnFLOG3n7MLSuB4YbSKZzSLs+ptNN7L5HGPatOgBd2OEmhPlZf+nwKgzV3sQdcIs3GwrBJ0OqF3HRF6F43o4B4Nxbe+79j35ubJeO7wPI2n/4JURYHJ2fiY8VBdXjeog8LAl82ga/ulweVm5m+szKqCY+ryS8JHGwIDAQAB',

    // 可以填写文件路径，或者密钥字符串  我的沙箱模式，rsa与rsa2的私钥相同，为了方便测试
    'rsa_private_key'           => 'MIIEogIBAAKCAQEA03z3137RQcx3PcnqO+mYxaXjRxY2Qp7LGnkCdZ9P3VSgBBGpByMWy3wLMLRGJXFD+HfA+maY3Tu8poD9z+rsQTMav4gEM5lOoffvDvVxBczp5WAcQAgQWjLQhfURBe/G4cZloZulCT4pfqf4PkD0Qfw+cpdITZOawPjoOox9I62gQG10FFn0YrHv93yBchGg73borAbP6PU0+8ShlNHE8/Y3wL8VA58Xo7+CAyEGoQBB3py7lXLpOO5/N5rbQN8hebLcjiFWPLdkrS31KtVTDw1UPaAK+O2KgZqe0DOqlynbAaA3/vMHYgmrtI/qf+dg2NpV+rTZT/OIoFnWbOZWbwIDAQABAoIBAHeTnhKDCtAYSoduJflQH+gI3pOv9GgAnrfOGdzlgeOT2JHUZmy5o0bUUQNtuoerHhJbq4oo/l+ASi8emeO4YXKP8Zy/zBhco0AjDlC35/qunMTrba2qoYxOVOaY5NIle57mbUpN1ad/NTj+wfZ5BWJVu/1Qmjn6rjJTygJossy7dIHbwQMtHXNpnfqyAirA51nXZljUZxl6LoE28JljZx5uqdep06OcnlJOtLTZNPjCx/1w8fjaQ+acmQEl9nPd/coOHruLG2C9l5hvpj6mXF7W7futfqWlCLaCMZihcm5ks0NQMNApb+NsvR5hSt9GFI+nTEyjmcE4w9keh5LixaECgYEA9HAVD7I3hdAj/0FVbeG2aEV054/+wAQPtie7e+hQPXYcdYYffxl2ieOtlNLS+BEWICCC23vX68d/5RvMGBcGm/iS1SUT3QeSrueDQCUbDgEwhKLAS76YvOitWPj8gz7iSc3DcuH2Joh9ybDPIAfdpsAlxRsudvDa4m/d0YjxAz8CgYEA3X3lSbrxvgn9n2+fUMTuQCCP3YAwGuhHnnzk1GXyqzCSbM0hZ2jXLVx+114Kb68meUKDQAq1cCJqFFhZL9LpQ3bcB1DjJQwnkycXRZc4NtsBgswdlYT18B+ARjqRhLWdUBThgGP1aOOSzTR6GY/mmsD5LtU7U3M0KnTO8hwhUNECgYAPAyc3/JEOZdcgISoXAorKYqGoax6ROm6gmFYaaQ0siSl8Sk1659xw4YvSnRQZ6iq6tGR1CGkdcPY44vko7ZkZUS3ra0iKBaILnepgsSa1OHt7WeeHf2AwEfY7hac0hFMvhzSexKPyf+WB0psV84W4bQqkzWOQKIC48XflG4z5zwKBgG7aM4dTKOoT1fuVwgaKiTNPGLGjFnBhEHchyuUCoRFMnfwWLkGzFv587H6dcluzLW5C+61xrp0QnEbScNCenmBFfJmswgIosyXSyrLpnBjYQ0lTHvtWMECdg3WimnHw82rBCJtZa9mzDCXnvbRNcPzC1/O4hJifb9xP2cMSkRoBAoGAdPajevGprbX9mfbucK7C6EPF0kTf33MhhfGhxTEbSNibDcaqAi5ycgm2HE0KmfWGM16LEVXcTkKBbvv75AxFqzKwOWcKGoBCCJXDg1DZqC6JL20TLSdOMbXNBdCQgb+b5nDlnhTW+Cqw1mztkr/WIrlwVOBCXfA8mrTAtQLFJQo=',

    'limit_pay'                 => [
        //'balance',// 余额
        //'moneyFund',// 余额宝
        //'debitCardExpress',// 	借记卡快捷
        //'creditCard',//信用卡
        //'creditCardExpress',// 信用卡快捷
        //'creditCardCartoon',//信用卡卡通
        //'credit_group',// 信用支付类型（包含信用卡卡通、信用卡快捷、花呗、花呗分期）
    ],// 用户不可用指定渠道支付当有多个渠道时用“,”分隔

    // 与业务相关参数
    'notify_url'            => 'http://buy.tongli.net/index/pay/notify',      //支付宝异步通知的服务器地址
    //'notify_url'            => 'http://lisgroup.55555.io/index/pay/notify',      //支付宝异步通知的服务器地址
    'return_url'            => 'http://buy.tongli.net/index/pay/pay_ok',      //支付报支付成功返回地址
    //'return_url'            => 'http://lisgroup.55555.io/index/pay/pay_ok',      //支付报支付成功返回地址

    'return_raw'                => false,// 在处理回调时，是否直接返回原始数据，默认为 true
];

