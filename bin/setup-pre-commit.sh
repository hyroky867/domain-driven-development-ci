#!/bin/bash

#cd `dirname $0`/../..
APP_DIR=`pwd`

cp -f $APP_DIR/bin/pre-commit $APP_DIR/.git/hooks/ \
&& chmod +x $APP_DIR/.git/hooks/pre-commit
