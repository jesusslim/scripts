#!/bin/bash

rm -rf homework_*
sudo kill -9 $(ps -ef | grep python)
rm -rf *.log
rm -rf scripts
rm -rf apps/*
sudo yum install git -y
