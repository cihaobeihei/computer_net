# 期中架构
__rsync远程数据备份方式__<br>
- Access via remote shell:
    - Pull: rsync [OPTION...] [USER@]HOST:SRC... [DEST]
    - Push: rsync [OPTION...] SRC... [USER@]HOST:DEST
    - -v 显示传输的文件
    - -z 压缩 在公司局域网 带宽很大 一般可默认
    - -a 保持文件状态 传输后不变
    - -p 传输时显示百分比
    - -e 使用的信道协议
    - --exclude= 排除
    - --exclude-from= 加上一个文件 排除
    - --bwlimit=RATE 实现数据过程显示传输 单位是kbytes


__rsync守护进程__<br>
- 服务端部署
    - 1.确认软件是否安装
        - rpm -qa|grep rsync
    - 2.进行软件服务配置文件编写
        - vim /etc/rsyncd.conf

        ```
        #rsync_config
        #created by HQ at 2017
        ##rsyncd.conf start##
        uid = rsync
        gid = rsync
        use chroot = no
        max connections = 200
        timeout = 300
        pid file = /var/run/rsyncd.pid
        lock file = /var/run/rsync.lock
        log file = /var/log/rsyncd.log
        ignore errors
        read only = false
        list = false
        hosts allow = 172.16.1.0/24
        hosts deny = 0.0.0.0/32
        auth users = rsync_backup
        secrets file = /etc/rsync.password
        [backup]
        comment = "backup dir by oldboy"
        path = /backup
        ```

    - 3.创建备份目录管理用户
        - useradd rsync -M -s /sbin/nologin
    - 4.创建备份目录，并进行授权
        - mkdir /backup
        - chown -R rsync.rsync /backup/
    - 5.创建认证用户授权密码文件，并对密码文件进行授权
        - echo 'rsync_backup:asd123!@#' >>/etc/rsync.password
        - chomd 600 /etc/rsync.password
    - 6.启动程序服务
        - rsync --daemon
        - ps -ef|grep rsync
        - netstat -lntup |grep 873
- 客户端部署
    - 确认软件是否安装
        - rpm -qa|grep rsync
    - 创建认证密码文件
        - echo 'asd123!@#' >>/etc/rsync.password
        - chomd 600 /etc/rsync.password
    - 进行数据备份测试
        - rsync -avz /etc/hosts rsync_backup@172.16.1.41::backup --password-file=/etc/rsync.password
