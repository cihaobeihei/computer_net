#!/bin/bash
####################
inotifywait -mrq --format "%w%f" -e create,delete,moved_to,close_write  /data|\
while read line
do
rsync -az --delete /data/ rsync_backup@172.16.1.41::backup --password-file=/etc/rsync.password
done
