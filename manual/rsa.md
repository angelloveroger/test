> #### 1.RSA非对称加密
> ***
> *一.`RSA加密`在实际应用中的流程（`描述`）*
>> *（1）A先对发送消息【`data`】执行哈希运算（$HASH$），得到消息摘要【`hashStr`】；*  
>>> 
>>>      $hashStr = MD5($data);
>> *（2）然后A用自己的私钥【`priA`】对消息摘要【`hashStr`】加密，生成数字签名【`sign`】；*  
>>> 
>>>     openssl_private_encrypt($hashStr, $sign, $priA);
>> *（3）把数字签名【`sign`】加在消息正文后面，一起发送给B。当然，为了防止消息被窃听，对消息内容【`data`】使用B的公钥【`pubB`】进行加密得到密文【`pubEncrypted`】，但这个不属于数字签名范畴；*   
>>> 
>>>     openssl_public_encrypt($data, $pubEncrypted, $pubB);
>> *（4）B收到消息后用A的公钥【`pubA`】对数字签名【`sign`】解密得到内容摘要【`hashStr`】，成功则代表消息确实来自A，失败说明有人冒充，此时数字签名起到了身份认证的作用；*  
>>> 
>>>     openssl_public_decrypt($sign, $hashStr, $pubA);
>> *（5）B对消息正文通过自己的私钥【`priB`】解密后执行哈希运算（$HASH$）得到新的内容摘要【`hashStrB`】；*  
>>> 
>>>     openssl_private_decrypt($pubEncrypted, $data, $priB);      
>>>     $hashStrB = MD5($data);
>> *（6）B会对比第4步得到的数字签名的【`hashStr`】值和自己运算得到的【`hashStrB`】值，一致则说明邮件未被篡改。此时数字签名用于数据完整性的验证。*           
>>>
>>>     $hashStr == $hashStrB ? true : false;
>>> ***
>

> ***
>> *二.`RSA加密`在实际应用中的流程（`流程图`[^footnote]）*
>>> ```mermaid
>>> graph TB
>>>     subgraph 接收消息者B
>>>         AA[接收报文 data=$pubEncrypted sign=$sign] ==> A2
>>>         AA ==> E2
>>>         E2($pubEncrypted 密文解密) ==> |B的私钥 $priB 解密| F2(消息明文 $data)
>>>         F2 ==> |HASH运算| G2(新的内容摘要 $hashStrB)
>>>         A2($sign 数字签名验证) ==> |A的公钥 $pubA 解密| B2{内容摘要 $hashStr}
>>>         B2 ==> |存在 $hashStr| C2(消息来自A)
>>>         B2 ==> |不存在 $hashStr| D2(消息来自冒充者)
>>>         G2 ==> H2{对比 $hashStr 和 $hashStrB}
>>>         C2 ==> H2
>>>         H2 ==> |相等| J2(数据未被篡改)
>>>         H2 ==> |不等| L2(数据被篡改)
>>>     end
>>> 
>>>     subgraph 发送消息者A
>>>         A1[消息明文 $data] ==>|B的公钥 $pubB 加密| B1(密文 $pubEncrypted)
>>>         A1 ==> |HASH运算| C1(内容摘要 $hashStr)
>>>         C1 ==>|A的私钥 $priA 加密| D1(数字签名 $sign)
>>>         B1 ==> E1(发送报文 data=$pubEncrypted sign=$sign)
>>>         D1 ==> E1
>>>     end
>>> ```

> ***
> ***三.另解***
>>  *发送方：*
>>>      1.首先生成一个对称密钥，用该对称密钥加密要发送的报文；
>>>      2.用服务端的公钥加密上述对称密钥；
>>>      3.将第一步和第二步的结果结合在一起传给服务端，称为数字信封；
>>  *接收方：*
>>>      1.使用自己的私钥解密被加密的对称密钥，
>>>      2.再用此对称密钥解密被客户端加密的密文，得到真正的原文。
>> *说明：*
>>>      * 数字签名和数字加密的过程虽然都使用公开密钥体系，但实现的过程正好相反，使用的密钥对也不同
>>>      * 数字签名使用的是发送方的密钥对，发送方用自己的私有密钥进行加密，接收方用发送方的公开密钥进
>>>      * 数字加密则使用的是接收方的密钥对，这是多对一的关系，任何知道接收方公开密钥的人都可以向接收
>>>      * 另外，数字签名只采用了非对称密钥加密算法，它能保证发送信息的完整性、身份认证和不可否认性
>>>      * 而数字加密采用了对称密钥加密算法和非对称密钥加密算法相结合的方法，它能保证发送信息保密性
> *** 












[^footnote]:流程图需要安装`Markdown Preview Enhanced`方可正常显示。 快捷键：<kbd>ctrl</kbd>+<kbd>,<kbd>；然后输入：**`markdown preview enhanced theme`**；用于设置插件的主题色
