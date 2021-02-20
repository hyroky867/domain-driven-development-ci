#!/bin/bash

cd ../docker-codeigniter4 && docker-compose exec app /workspace/bin/phpunit-test.sh ${@}