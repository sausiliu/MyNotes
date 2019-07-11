# QA

## 遇到的问题

```t
org.jinterop.dcom.common.JIException: Access is denied, please check whether the [domain-username-password] are correct. Also, if not already done please check the GETTING STARTED and FAQ sections in readme.htm. They provide information on how to correctly configure the Windows machine for DCOM access, so as to avoid such exceptions.  [0x00000005]
```

* 解决方法

修改注册表

1. 找到注册表

   > HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Policies\System

2. 创建 LocalAccountTokenFilterPolicy

    > create or modify 32-bit DWORD: LocalAccountTokenFilterPolicy  
    > set the value to: 1

### 参考内容

一下内容转自  

[链接](http://foeris.com/display/blog/opc.kepware)
[java – Utgard – 拒绝访问](https://codeday.me/bug/20190520/1141862.html)
[stackoverflow - Utgard - Access denied](https://stackoverflow.com/questions/18076924/utgard-access-denied)

Note:

```text
转至元数据结尾
由 y创建, 最后修改于2018-04-17 转至元数据起始
使用相关
win10使用的条件关闭uac
不能使用家庭版
win10没问题
win7没问题
server2012没问题
并发plc读取
如果存在离线的会对其他的造成影响

access is denied
首先请先检查用户密码时候有问题

以下是win10的特定处理方案

解决方法：

Access is denied error
When you get an

"Access is denied. [0x00000005]"
error, apply the following patch to the registry:

 

HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Policies\System
create or modify 32-bit DWORD: LocalAccountTokenFilterPolicy
set the value to: 1
Credit to Arturas Sirvinskas (comments below)



参考资料：

http://ygrdqt.iteye.com/blog/2200156

0x8001FFFF

一般处理方式是防火墙问题（可能有用的参考资料：https://blog.csdn.net/stwstw0123/article/details/48091729）


某网址提供的一些问题
Openscada远程链接时常见的问题及解决方法
（1）org.jinterop.dcom.common.JIException: Message not found for errorCode:0xC0000034

原因：未启动RemoteRegistry和Windows Management Instrumentation服务。

解决方法：打开控制面板，点击【管理工具】—>>【服务】，启动RemoteRegistry和Windows ManagementInstrumentation服务。


（2）org.jinterop.dcom.common.JIException:Access is denied, please check whether the [domain-username-password] arecorrect. Also, if not already done please check the GETTING STARTED and FAQsections in readme.htm. They provide information on how to correctly configurethe Windows machine for DCOM access, so as to avoid such exceptions.  [0x00000005]

原因：首先检查错误提示的配置信息是否有误，如果都正确，则原因可能是你访问的当前用户没有该访问权限。

解决方法：

1、打开注册列表，

选择HKEY_CLASSES_ROOT\CLSID\{76A64158-CB41-11D1-8B02-00600806D9B6}

2、右键点击[权限]>>【高级】>>[所有者]>>添加opc用户到权限项目中，点击应用，确定。


https://blog.csdn.net/u013120247/article/details/50163147
```
