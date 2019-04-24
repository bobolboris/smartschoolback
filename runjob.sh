#!/usr/bin/env bash
echo "#Run"
./artisan queue:work --queue=high,default
