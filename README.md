## 简介

O2O配送系统

## 安全性

在系统层面提供了众多的安全特性，确保网站和产品安全无忧。这些特性包括：

*  XSS安全防护
*  表单自动验证
*  强制数据类型转换
*  输入数据过滤
*  表单令牌验证
*  防SQL注入
*  图像上传检测

## 商业友好的开源协议

遵循Apache2开源协议发布。Apache Licence是著名的非盈利开源组织Apache采用的协议。该协议和BSD类似，鼓励代码共享和尊重原作者的著作权，同样允许代码修改，再作为开源或商业软件发布。

## 安装
 * 安装php基础运行环境
```
sudo su
apt-get install -y php5=5.5\*
apt-get install -y apache2=2.4\*
apt-get install -y php5-mysql
apt-get install -y mysql-server-5.6
apt-get install -y php5-gd
apt-get install -y php5-curl
apt-get install -y git

a2enmod rewrite
a2enmod rewrite
a2enmod proxy
a2enmod proxy_http
```
 * 安装git环境
 * 克隆代码 git clone https://github.com/{username}/guozhi.git
 * 导入数据库文件 guozhi.sql
 * 修改相应的配置文件 /App/Common/Conf/Config.php
 * 修改运行时目录的写入权限 /App/Runtime
 * OK!
