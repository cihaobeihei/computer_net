
期中集群架构-第八章-期中架构nginx章节
======================================================================

__01. web服务软件种类介绍__<br>
- 常用来提供静态Web服务的软件有如下三种：<br>
	Apache：<br>
　　这是中小型Web服务的主流，Web服务器中的老大哥。<br>
	Nginx：<br>
　　大型网站Web服务的主流，曾经Web服务器中的初生牛犊，现已长大。<br>
　　Nginx的分支Tengine（http://tengine.taobao.org/)目前也在飞速发展。<br>
	Lighttpd：<br>
　　这是一个不温不火的优秀Web软件，社区不活跃，静态解析效率很高。<br>
　　在Nginx流行前，它是大并发静态业务的首选，国内百度贴吧、豆瓣等众多网站都有Lighttpd奋斗的身影。<br>

- 常用来提供动态服务的软件<br>
	PHP（FastCGI）：<br>
　　大中小型网站都会使用，动态网页语言PHP程序的解析容器。<br>
　　它可配合Apache解析动态程序，不过，这里的PHP不是FastCGI守护进程模式，而是mod_php5.so（module）。<br>
　　也可配合Nginx解析动态程序，此时的PHP常用FastCGI守护进程模式提供服务。<br>
	Tomcat：<br>
　　中小企业动态Web服务主流，互联网Java容器主流（如jsp、do）。<br>
	Resin：<br>
　　大型动态Web服务主流，互联网Java容器主流（如jsp、do）。<br>

__02. nginx软件服务介绍__<br>
    如果你听说或使用过Apache软件，那么很快就会熟悉Nginx软件，与Apache软件类似，
	Nginx（“engine x”）是一个开源的，支持高性能、高并发的WWW服务器和代理服务软件。
	它是由俄罗斯人lgor Sysoev开发的，最初被应用在俄罗斯的大型网站www.rambler.ru上。<br>
	后来作者将源代码以类BSD许可证的形式开源出来供全球使用。<br>
	Nginx可以运行在UNIX、Linux、BSD、Mac OS X、Solaris，以及Microsoft Windows等操作系统中<br>

__03. nginx软件特征介绍__<br>
- 支持高并发：能支持几万并发连接（特别是静态小文件业务环境）
- 资源消耗少：在3万并发连接下，开启10个Nginx线程消耗的内存不到200MB
- 支持异步网络I/O事件模型epoll（Linux 2.6+） apache（select）

__04. nginx软件功能介绍__<br>
- 1）作为Web服务软件（处理用户访问静态请求）
- 2）反向代理或负载均衡服务
- 3）前端业务数据缓存服务

__05. nginx软件模型特点说明__<br>
- apache与nginx软件对比说明？？？<br>
　　apache使用select模型<br>
　　nginx使用epoll模型<br>
　　举例说明：宿舍管理员<br>
　　select模型版管理员　会一个一个房间查询人员<br>
　　epoll模型版管理员　　会进行检索后，直接找到需要找的人<br>
　　举例说明：幼儿园阿姨<br>
　　select模型版阿姨　　会一个一个小朋友进行询问，确认哪个小朋友需要上厕所<br>
　　epoll模型版阿姨　　　会告知想上厕所小朋友自觉站到响应位置<br>　　

__06. nginx软件编译安装__<br>
- 第一个里程：软件依赖包安装<br>
　　pcre-devel：   perl语言正则表达式兼容软件包<br>
　　openssl-devel：使系统支持https方式访问<br>
　　``yum install -y pcre-devel openssl-devel``<br>

- 第二个里程：创建一个管理nginx进程的虚拟用户<br>
　　``useradd www -s /sbin/nologin/ -M``<br>

- 第三个里程：下载并解压nginx软件<br>
　　cd /server/tools<br>
　　wget http://nginx.org/download/nginx-1.12.2.tar.gz<br>
　　tar xf nginx-1.12.2.tar.gz <br>　　

- 第四个里程：进行软件编译安装<br>
　　软件编译安装三部曲：<br>
　　①. 编译配置<br>
     ```
     ./configure --prefix=/application/nginx-12.2 --user=www --group=www --with-http_ssl_module --with-http_stub_status_module
     --prefix=PATH     指定软件安装在什么目录下
     --user=USER       指定软件worker进程管理用户，利用www虚拟用户管理worker进程
     --group=USER
     --with-http_ssl_module           使nginx程序可以支持HTTPsF访问功能
     --with-http_stub_status_module	 用于监控用户访问nginx服务情况
     ```
　　②. 编译过程<br>
　　③. 编译安装<br>

- 第五个里程：为nginx程序软件创建链接目录<br>
    ``ln -s /application/nginx-12.2 /application/nginx``	<br>

- 第六个里程：启动nginx程序服务<br>
	``/application/nginx/sbin/nginx``<br>

__07. nginx软件程序目录结构__<br>
　　conf     --- nginx程序所有配置文件保存目录<br>
　　nginx.conf   nginx程序主配置文件<br>
　　精简nginx.conf配置文件内容：<br>
　　grep -Ev "#|^$" nginx.conf.default >nginx.conf<br>
```
	nginx配置文件组成：
	①. main       nginx主区块
	②. event      nginx事件区块
	③. http       nginx http功能区块
	④. server     nginx 网站主机区块
	⑤. location   nginx 匹配或者定位区块
```
```
    html	 --- nginx程序站点目录
	logs     --- nginx程序日志文件保存目录
	sbin     --- nginx程序命令所在目录
	nginx命令参数说明：
	-V       --- 查看nginx软件编译配置参数
	-t       --- 检查nginx配置文件语法格式是否正确
	-s       --- 用于管理nginx服务运行状态
	             stop   停止nginx服务
				 reload 平滑重启nginx服务器
				 重启nginx服务
				 nginx -s stop  先停止
				 nginx          再启动
```

__08. 编写nginx服务配置__<br>
- 三个语法格式说明：<br>
　　　①. 大括号要成对出现<br>
　　　②. 每一行指令后面要用分号结尾<br>
　　　③. 每一个指令要放置在指定的区块中<br>

- 实现编写一个网站页面<br>
    ```
	worker_processes  1;
    events {
        worker_connections  1024;
    }
    http {
        include       mime.types;
        default_type  application/octet-stream;
        sendfile        on;
        keepalive_timeout  65;
        server {
            listen       80;
            server_name  www.etiantian.org;
            location / {
                root   html/www;
                index  index.html index.htm;
            }
        }
    }
    ```

- 实现编写多个网站页面==编写多个虚拟主机（等于一个网站）
    - 第一个里程编写配置文件：
        ```
	    server {
        listen       80;
        server_name  www.etiantian.org;
        location / {
            root   html/www;
            index  index.html index.htm;
        }
        }
        server {
            listen       80;
            server_name  bbs.etiantian.org;
            location / {
                root   html/bbs;
                index  index.html index.htm;
            }
        }
        server {
            listen       80;
            server_name  blog.etiantian.org;
            location / {
                root   html/blog;
                index  index.html index.htm;
            }
        }
        ```
	- 第二个里程创建站点目录：<br>
	``mkdir -p /application/nginx/html/{www,bbs,blog}``<br>

	- 第三个里程创建站点目录下首页文件：
	    ```
	    for name in www bbs blog;do echo "10.0.0.7 $name.etiantian.org" >/application/nginx/html/$name/index.html;done
        for name in www bbs blog;do cat /application/nginx/html/$name/index.html;done
        10.0.0.7 www.etiantian.org
        10.0.0.7 bbs.etiantian.org
        10.0.0.7 blog.etiantian.org
        ```
	- 第四个里程：进行访问测试<br>
　　浏览器访问测试：<br>
　　注意：需要编写windows主机hosts文件，进行解析<br>
　　命令行访问测试：<br>
　　利用curl命令在linux系统中访问测试<br>
　　注意：需要编写linux主机hosts文件，进行解析<br>

	- 虚拟主机配置文件编写方法：<br>
　　①. 基于域名的虚拟主机配置方法（最常用）<br>
　　②. 基于端口的虚拟主机配置方法<br>
　　    说明：当你访问的网站域名在虚拟主机配置中不存在时，默认会将第一个虚拟主机的配置页面响应给用户<br>
　　③. 基于IP地址的虚拟主机配置方法<br>
　　    说明：nginx服务中只要涉及IP地址的修改，都需要重启nginx服务，而不能采用平滑重启<br>

__09 Nginx服务日志信息__<br>
　　错误日志 访问日志<br>
   - 01.错误日志<br>
        ```
        Syntax:	error_log file [level];
        Default:
        error_log logs/error.log error;
        Context:	main, http, mail, stream, server, location
        #error_log  logs/error.log;
        #error_log  logs/error.log  notice;
        #error_log  logs/error.log  info;

        vim nginx.conf
        error_log  /tmp/error.log error;
        ```

   补充说明：<br>
   ===========================================================================================<br>
   错误日志的，默认情况下不指定也没有关系，因为nginx很少有错误日志记录的。
   但有时出现问题时，是有必要记录一下错误日志的，方便我们排查问题。<br>
   error_log 级别分为 debug, info, notice, warn, error, crit  默认为crit
   该级别在日志名后边定义格式如下：<br>
   error_log  /your/path/error.log crit;<br>

   crit 记录的日志最少，而debug记录的日志最多。<br>
   如果nginx遇到一些问题，比如502比较频繁出现，但是看默认的error_log并没有看到有意义的信息，
   那么就可以调一下错误日志的级别，当你调成error级别时，错误日志记录的内容会更加丰富<br>
   ===========================================================================================<br>


   - 02.访问日志(重点关注)<br>
   ```
   log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '   --- 定义日志信息要记录的内容格式
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';
   access_log  logs/access.log  main;                    --- 调用定义格式信息，生成访问日志
   $remote_addr       10.0.0.1           --- 访问客户端的源地址信息
   $remote_user          -               --- 访问客户端认证用户信息   ？？？
   [$time_local]                         --- 显示访问时间
   $request        GET / HTTP/1.1        --- 请求行信息
   $status              304              --- 状态码信息（304状态码利用缓存显示页面信息）
   $body_bytes_sent                      --- 服务端响应客户端的数据大小信息
   $http_referer                         --- 记录链接到网站的域名信息  ？？？
   $http_user_agent                      --- 用户访问网站客户端软件标识信息
                                             用户利用客户端浏览器测试访问时，win10默认浏览器会有异常问
   $http_x_forwarded_for                 --- ？？？  反向代理
   官方链接：http://nginx.org/en/docs/http/ngx_http_log_module.html#access_log
   ```

   - 03.日志要进行切割
       - 01.利用shell脚本实现日志切割<br>
           ```
	       [root@web01 scripts]# vim cut_log.sh
           #!/bin/bash

           data_info=$(date +%F-%H:%M)

           mv /application/nginx/logs/www_access.log /application/nginx/logs/access.log.$data_info
           /application/nginx/sbin/nginx -s reload

           # cut nginx log cron
           * */6 * * * /bin/sh /server/scripts/cut_log.sh &>/dev/null
           ```




















































