#!/bin/sh

# Get the path to PHPStorm
PHP_STORM_APP=$(mdfind kind:application PHPStorm.app)

BIN_SUB_PATH="/Contents/MacOS/phpstorm"

# Check to see if PHPStorm was installed
if [ -z "$PHP_STORM_APP" ]; then
    echo "PHPStorm could not be found!"
    exit 1
fi

PHP_STORM_BIN="$PHP_STORM_APP$BIN_SUB_PATH"

# Convert relative paths
if [ "$1" == "." ]; then 
    SOURCE_PATH="$(pwd)"
elif [ "$1" == ".." ]; then
    SOURCE_PATH="$(pwd)/.."
else
    SOURCE_PATH="$1"
fi

# Open PHPStorm passing parameters

$("$PHP_STORM_BIN" "$SOURCE_PATH")
