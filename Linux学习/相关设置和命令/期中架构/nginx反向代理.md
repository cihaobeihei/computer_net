
# 期中集群架构-第十章-nginx反向代理负载均衡章节章节


###### 01. LNMP架构迁移数据库说明

###### 02. LNMP架构数据迁移到NFS存储说明

###### 03. nginx反向代理负载均衡功能



__01. LNMP架构迁移数据库说明__<br>
　　迁移数据库：利用数据库备份命令（mysql mysqladmin mysqldump）<br>
- 1） 备份数据库数据库信息<br>
   ``mysqldump -uroot -p'password' --all-databases >/tmp/bak.sql``<br>
   ``ll /tmp/bak.sql -h``<br>
   ``scp /tmp/bak.sql 172.16.1.51:/tmp/``<br>

- 2） 恢复数据库数据库信息<br>
   ```
   ##db01
   mysql -uroot -p'password' </tmp/bak.sql
   ###db01添加新的用户
   grant all on wordpress.* to wordpress@'172.16.1.0/255.255.255.0' identified by 'password';
   flush privileges;
   mysql -uwordpress -p'password' -h 172.16.1.51
   ```

- 3） 数据库迁移完毕，修改网站连接数据库的配置文件<br>
     ```
     mysql -uwordpress -p'password' -h 172.16.1.51       <-- 修改配置文件之前，先测试网站web服务器与迁移后的数据库连通性
     vim wp-config.php                                  <-- 修改wordpress上的数据库连接参数信息
     /** MySQL主机 */
     define('DB_HOST','172.16.1.51')                    <-- 修改连接的主机信息，将localhost修改为172.16.1.51
     说明：web服务器数据库此时可以关闭了
     ```

- 4）停止nginx服务器上MySQL服务<br>
　　``/etc/init.d/mysql stop``<br>

__02. LNMP架构数据迁移到NFS存储说明__<br>
- 01：先将原有目录中数据移出<br>
   ```
   cd /application/nginx/html/blog/wp-content/uploads
   mkdir /tmp/wordpress_backup -p
   mv ./* /tmp/wordpress_backup/
   ```
   ```
   数据存储到本地什么位置，获取方法
   ①. 通过网站页面右键点击，获取资源地址信息
   ②. find命令利用-mmin 5
   ③. 利用inotify服务监控目录数据变化
   ```

- 02：NFS服务器上配置创建共享目录<br>
    ```
    vim /etc/exports
    /data 172.16.1.0/24(rw,sync,all_squash)
    showmount -e 172.16.1.31
    mount -t nfs 172.16.1.31:/data /mnt/
    ```
    ```
    showmount -e 172.16.1.31
    mount -t nfs 172.16.1.31:/data/ ./uploads/
    mv /tmp/wordpress_backup/* ./
    ```

__03. nginx反向代理负载均衡功能__<br>
　　客户端====代理服务器===web服务器<br>
　　客户端看到的服务端==代理服务器<br>
　　代理服务器====web服务器<br>

　　反向代理功能架构<br>
　　3台web服务器，组建出web服务器集群<br>
　　>> web01　10.0.0.7　172.16.1.7<br>
　　>> web02　10.0.0.8　172.16.1.8<br>
　　>> web03　10.0.0.9　172.16.1.9<br>
　　1台负载均衡服务器<br>
　　lb01　10.0.0.5　172.16.1.5	<br>　

- ①. 部署web服务器<br>
    - 第一个里程：安装部署nginx软件<br>
        ```
        mkdir /server/tools -p
        cd /server/tools
        wget http://nginx.org/download/nginx-1.12.2.tar.gz
        tar xf nginx-1.12.2.tar.gz
        yum install -y pcre-devel openssl-devel
        useradd -M -s /sbin/nologin www
        cd nginx-1.12.2
        ./configure --prefix=/application/nginx-1.12.2 --user=www --group=www --with-http_ssl_module --with-http_stub_status_module
        make && make install
        ln -s /application/nginx-1.12.2 /application/nginx
        /application/nginx/sbin/nginx
        netstat -lntup|grep nginx
        ```

    - 第二个里程：编辑nginx配置文件<br>
        ```
        server {
            listen       80;
            server_name  www.etiantian.org;
            root   html/www;
            index  index.html index.htm;
        }
        server {
            listen       80;
            server_name  bbs.etiantian.org;
            root   html/bbs;
            index  index.html index.htm;
        }
        scp -rp /application/nginx/conf/nginx.conf 172.16.1.8:/application/nginx/conf/
        scp -rp /application/nginx/conf/nginx.conf 172.16.1.8:/application/nginx/conf/
        ```

    - 第三里程：创建模拟测试环境
        ```
        mkdir /application/nginx/html/{www,bbs} -p
        for name in www bbs;do echo "$(hostname) $name.etiantian.org" >/application/nginx/html/$name/oldboy.html;done
        for name in www bbs;do cat /application/nginx/html/$name/oldboy.html;done
        ```

    - 第四里程：在负载均衡服务器上，进行测试访问<br>
        ```
        curl -H host:www.etiantian.org 10.0.0.7/oldboy.html
        web01 www.etiantian.org
        curl -H host:bbs.etiantian.org 10.0.0.7/oldboy.html
        web01 bbs.etiantian.org
        curl -H host:www.etiantian.org 10.0.0.8/oldboy.html
        web02 www.etiantian.org
        curl -H host:bbs.etiantian.org 10.0.0.8/oldboy.html
        web02 bbs.etiantian.org
        curl -H host:www.etiantian.org 10.0.0.9/oldboy.html
        web03 www.etiantian.org
        curl -H host:bbs.etiantian.org 10.0.0.9/oldboy.html
        web03 bbs.etiantian.org
        ```


- ②. 部署负载均衡服务器<br>
    - 第一个里程：安装部署nginx软件
        ```
        mkdir /server/tools -p
        cd /server/tools
        wget http://nginx.org/download/nginx-1.12.2.tar.gz
        tar xf nginx-1.12.2.tar.gz
        yum install -y pcre-devel openssl-devel
        useradd -M -s /sbin/nologin www
        cd nginx-1.12.2
        ./configure --prefix=/application/nginx-1.12.2 --user=www --group=www --with-http_ssl_module --with-http_stub_status_module
        make && make install
        ln -s /application/nginx-1.12.2 /application/nginx
        /application/nginx/sbin/nginx
        netstat -lntup|grep nginx
        ```
    - 第二个里程：编写nginx反向代理配置文件<br>
	　``grep -Ev "#|^$" nginx.conf.default >nginx.conf``<br>

      官方链接:[http://nginx.org/en/docs/http/ngx_http_upstream_module.html#upstream](http://nginx.org/en/docs/http/ngx_http_upstream_module.html#upstream)<br>
     ```
     Syntax:	upstream name { ... }
     Default:	—
     Context:	http
     eg：
     upstream oldboy {
        server 10.0.0.7:80;
        server 10.0.0.8:80;
        server 10.0.0.9:80;
     }
     ```

	说明：upstream模块就类似定一个一个地址池或者说定一个web服务器组<br>

	官方链接：[http://nginx.org/en/docs/http/ngx_http_proxy_module.html#proxy_pass](http://nginx.org/en/docs/http/ngx_http_proxy_module.html#proxy_pass)<br>
    ```
    Syntax:	proxy_pass URL;
    Default:	—
    Context:	location, if in location, limit_except
    eg：
    location / {
       proxy_pass http://oldboy;
    }
    ```
    说明：proxy_pass主要用于进行抛送用户访问请求给upstream模块中的相应节点服务器<br>
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
         upstream oldboy {
             server 10.0.0.7:80;
             server 10.0.0.8:80;
             server 10.0.0.9:80;
         }
         server {
             listen       80;
             server_name  localhost;
             root   html;
             index  index.html index.htm;
           location / {
             proxy_pass http://oldboy;
            }
         }
     }

     /application/nginx/sbin/nginx -t
     /application/nginx/sbin/nginx -s reload
     ```

    - 第三个里程：进行访问负载均衡服务器测试
        - 1）利用浏览器进行测试<br>
		   进行hosts解析<br>
		   http://www.etiantian.org/oldboy.html  <--利用ctrl+F5刷新测试，检查是否进行负载调度<br>
        - 2）利用curl命令进行测试<br>
           ``[root@lb01 conf]# curl -H host:www.etiantian.org 10.0.0.5/oldboy.html``<br>
           web01 www.etiantian.org<br>
           ``[root@lb01 conf]# curl -H host:www.etiantian.org 10.0.0.5/oldboy.html``<br>
           web02 www.etiantian.org<br>
           ``[root@lb01 conf]# curl -H host:www.etiantian.org 10.0.0.5/oldboy.html``<br>
           web03 www.etiantian.org<br>
