#!/usr/bin/env bash
# ------------------------------------------------------------------
# Open PHPStorm from the CLI.
# ------------------------------------------------------------------

# Configuration
SCRIPT_NAME=$(basename $0)
SCRIPT_VERSION="0.3.0"

#
# Load Modules
source ./modules/*.module

__parse_arguments $*
if [[ $? != 0 ]]; then
    exit $?
fi

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
if [[ "$PROJECT_PATH" == "." || -z "$PROJECT_PATH" ]]; then 
    PROJECT_PATH="$(pwd)"
elif [[ "$PROJECT_PATH" == ".." ]]; then
    PROJECT_PATH="$(pwd)/.."
else
    PROJECT_PATH="$PROJECT_PATH"
fi

# Open PHPStorm passing parameters

# Run Command
if [[ -z "$LINE_NUMBER" || -z "$FILE_NAME" ]]; then
    $(nohup "$PHP_STORM_BIN" "$PROJECT_PATH"  > /dev/null 2>&1 &)
else
    $(nohup "$PHP_STORM_BIN" "$PROJECT_PATH" "--line" "$LINE_NUMBER" "$PROJECT_PATH/$FILE_NAME"  > /dev/null 2>&1 &)
fi
exit 0