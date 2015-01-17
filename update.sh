#!/bin/bash -l

REPOS_URL="https://raw.githubusercontent.com/aozora0000/dockerbuilder"
APP_NAME="dockerbuilder"
PHAR_FILE="${APP_NAME}.phar"

DONWLOAD_DIR=`pwd`
DOWNLOAD_URL="${REPOS_URL}/${PHAR_FILE}"
CURL_OPT="-sSL --progress-bar --retry=3 --retry-delay=5"

curl $CURL_OPT -o $DONWLOAD_DIR/$PHAR_FILE $DOWNLOAD_URL
