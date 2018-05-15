<?php
    //$link_id=mysql_connect('主机名','用户','密码');
    //mysql -u用户 -p密码 -h 主机
    $link_id=mysql_connect('172.16.1.51','root','asd123!@#') or mysql_error();
    if($link_id){
                 echo "mysql successful by noble !\n";
                }else{
                 echo mysql_error();
                }
?>
