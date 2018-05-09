#!/bin/bash

# Database credentials
user="root"
password="123456 "
host="127.0.0.1"
backup_path="/home/ubuntu/sqldump"
# Set default file permissions
umask 177

# Dump database into SQL file
mysqldump --user=$user --password=$password client --single-transaction --flush-logs --master-data=2 > $backup_path/full_backup.sql

