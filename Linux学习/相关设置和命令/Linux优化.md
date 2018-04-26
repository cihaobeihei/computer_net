# Linux优化

__1.规划服务器的地址__<br>
/etc/hosts文件<br>

```
127.0.0.1   localhost localhost.localdomain localhost4 localhost4.localdomain4
::1         localhost localhost.localdomain localhost6 localhost6.localdomain6
172.16.1.5      lb01
172.16.1.6      lb02
172.16.1.7      web01
172.16.1.8      web02
172.16.1.9      web03
172.16.1.51     db01
172.16.1.31     nfs01
172.16.1.41     backup
172.16.1.61     m01

```

__2.更改yum愿__<>
- wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.aliyun.com/repo/Centos-6.repo
- wget -O /etc/yum.repos.d/epel.repo http://mirrors.aliyun.com/repo/epel-6.repo

__3.关闭SELinux__<br>
```
sed -i.bak 's/SELINUX=enforcing/SELINUX=disabled/' /etc/selinux/config
grep SELINUX=disabled /etc/selinux/config
setenforce 0
getenforce
```

__4.关闭iptables__<br>
```
/etc/init.d/iptables stop
/etc/init.d/iptables stop
chkconfig iptables off
```

__5.精简开机自启服务__<br>
```
export LANG=en
chkconfig|egrep -v "crond|sshd|network|rsyslog|sysstat"|awk '{print "chkconfig",$1,"off"}'|bash
chkconfig --list|grep 3:on
```

__6.提权oldboy可以sudo__<br>
```
useradd oldboy
echo 123456|passwd --stdin oldboy
\cp /etc/sudoers /etc/sudoers.ori
echo "oldboy  ALL=(ALL) NOPASSWD: ALL " >>/etc/sudoers
tail -1 /etc/sudoers
visudo -c
```

__7.英文字符集__<br>
```
cp /etc/sysconfig/i18n /etc/sysconfig/i18n.ori
echo 'LANG="en_US.UTF-8"'  >/etc/sysconfig/i18n
source /etc/sysconfig/i18n
echo $LANG
```

__8.时间同步__<br>
```
echo '#time sync by lidao at 2017-03-08' >>/var/spool/cron/root
echo '*/5 * * * * /usr/sbin/ntpdate pool.ntp.org >/dev/null 2>&1' >>/var/spool/cron/root
crontab -l
```

__9.加大文件描述__<br>
```
echo '*               -       nofile          65535 ' >>/etc/security/limits.conf
tail -1 /etc/security/limits.conf
```

__10.内核优化__<br>
```
cat >>/etc/sysctl.conf<<EOF
net.ipv4.tcp_fin_timeout = 2
net.ipv4.tcp_tw_reuse = 1
net.ipv4.tcp_tw_recycle = 1
net.ipv4.tcp_syncookies = 1
net.ipv4.tcp_keepalive_time = 600
net.ipv4.ip_local_port_range = 4000    65000
net.ipv4.tcp_max_syn_backlog = 16384
net.ipv4.tcp_max_tw_buckets = 36000
net.ipv4.route.gc_timeout = 100
net.ipv4.tcp_syn_retries = 1
net.ipv4.tcp_synack_retries = 1
net.core.somaxconn = 16384
net.core.netdev_max_backlog = 16384
net.ipv4.tcp_max_orphans = 16384
#以下参数是对iptables防火墙的优化，防火墙不开会提示，可以忽略不理。
net.nf_conntrack_max = 25000000
net.netfilter.nf_conntrack_max = 25000000
net.netfilter.nf_conntrack_tcp_timeout_established = 180
net.netfilter.nf_conntrack_tcp_timeout_time_wait = 120
net.netfilter.nf_conntrack_tcp_timeout_close_wait = 60
net.netfilter.nf_conntrack_tcp_timeout_fin_wait = 120
EOF
sysctl -p
```

__11.安装其他小软件__<br>
```
yum install lrzsz nmap tree dos2unix nc telnet sl -y
```

__12.ssh连接速度慢优化__<br>
```
sed -i.bak 's@#UseDNS yes@UseDNS no@g;s@^GSSAPIAuthentication yes@GSSAPIAuthentication no@g'  /etc/ssh/sshd_config
/etc/init.d/sshd reload
```

# 虚拟主机克隆操作
__第一步：调整虚拟主机网络配置信息__<br>
-  一清空 两删除
    - 两删除：删除网卡（eth0 eth1）中，UUID（硬件标识信息）和HWADDR（网络mac地址）进行删除
        - sed -ri '/UUID|HWADDR/d'  /etc/sysconfig/network-scripts/ifcfg-eth[01]
    - 一清空：清空网络规则配置文件
        - echo '>/etc/udev/rules.d/70-persistent-net.rules' >>/etc/rc.local
- 克隆机重新启动