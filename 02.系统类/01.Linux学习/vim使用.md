# vim使用
首先需要了解一些VIM的基本设置：<br>
[https://benmccormick.org/](https://benmccormick.org/2014/07/14/learning-vim-in-2014-configuring-vim/)<br>

## 基本设置选项
[https://www.shortcutfoo.com/](https://www.shortcutfoo.com/blog/top-50-vim-configuration-options/)<br>
## 搭建插件管理工具Vundle
详细步骤见：[https://github.com/VundleVim/Vundle.vim#quick-start](https://github.com/VundleVim/Vundle.vim#quick-start)<br>
__注意：__ 需要git和curl。<br>
Vundle的一般使用命令在配置文件中存在。<br>

## Ctags安装和使用
ctags是一款代码阅读工具，主要支持跨文件查询函数定义。<br>
这是个独立的软件，不被vudle管理。<br>
使用apt-get或yum直接安装。<br>
``apt-get install exuberant-ctags``<br>
``yum install -y exuberant-ctags``<br>
__常用命令__<br>
```
Ctrl -R *   //递归管理当前项目
Ctrl + ]    //跳转到函数定义
Ctrl + t    //从函数定义返回

Ctrl + o    //在左侧打开文件列表
F4          //在右侧打开函数列表

Ctrl + n    //补齐函数，向下翻
```

## 分屏操作
- ``:sp``上下分屏
- ``:vsp``左右分屏 后面加文件名可以打开另外的文件6
- ``Ctrl+ww``切屏
- ``:wq``推出当前屏
