## H5开发模板

目前的工作很大一部分上是来做外包.开发一些俗称的**H5**小应用.这些小应用一般都比较简单.只包含了2-3个页面.用PHP来写一些逻辑也很快速.用PHP来解决:一是微信的授权(获取用户的信息),二是有一些活动需要提交一些数据保存到数据库里面,三是处理微信用户的分享操作.暂时就这么多.主要用到php和mysql来实现业务逻辑.平常开发用到的机会很多,故写成规范化的东西方便自己和其他同学使用.

### 项目用到的包
1. [微信 SDK](https://easywechat.org/)
2. [数据库](https://github.com/illuminate/database)

### 使用方法
1. 前置条件 php version >= 5.5.9
2. git clone git@github.com:ruooooooli/h5-template.git
3. cd h5-template && composer install
3. app/config.php 是项目的配置文件,开始之前需要先配置
