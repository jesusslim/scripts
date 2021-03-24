#!/bin/bash

FEATURE=$1
PORT=$2
cp -r /home/deploy/apps/aizuoye-server /home/deploy/apps/$PORT
cp /etc/nginx/conf.d/homework.conf /etc/nginx/conf.d/$PORT.conf
sed -i "s/80/$PORT/g" /etc/nginx/conf.d/$PORT.conf
sed -i "s/aizuoye-server/$PORT/g" /etc/nginx/conf.d/$PORT.conf
nginx -s reload
cd /home/deploy/apps/$PORT/server/php
git checkout master
git pull
git checkout $FEATURE
rm -rf storage/log/*
php artisan migrate
