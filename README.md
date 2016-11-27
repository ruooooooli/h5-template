## H5开发模板

        目前的工作很大一部分上是来做外包。开发一些俗称的 **H5** 小应用。
        这些小应用一般都比较简单。只包含1-3个页面，所以用PHP来写一些逻辑也很快速。
        解决的问题:一是微信的授权(获取用户的信息)，二是有一些活动需要提交一些数据保存到数据库里面，三是处理微信用户的分享操作。
        主要用到PHP和MYSQL来实现业务逻辑。平常开发用到的机会很多，故写成规范化的东西方便自己和其他同学使用。

### 项目当中用到的包
1. [微信 SDK(easywechat)](https://easywechat.org/)
2. [数据库(Laravel database)](https://github.com/illuminate/database)

### 使用方法
1. PHP 版本要求 **version >= 5.5.9**
2. 下载 `git clone git@github.com:ruooooooli/h5-template.git`
3. 切换目录 `cd h5-template`
4. 使用 **composer** 安装依赖 `composer install`
5. 目录 **storage** 需要可写权限
6. app/config.php 是项目的配置文件，开始之前可以复制一个进行配置


### 微信授权相关
1. 先在 config.php 配置 AppID 和 AppSecret
2. 在微信后台 **接口权限>网页授权** 里面确保填写的授权地址和现在开发的地址一致,才可以完成网页授权
