#!/usr/bin/env bash

set -e

DIRECTORY=$(cd "$(dirname "$0")" && pwd)
ICONS_ROOT="${DIRECTORY}/../dist"

if [ -z "${INPUT_VERSION}" ]; then
    echo 'Environment variable "INPUT_VERSION" has not been set'
    exit 1
fi

DOWNLOAD_URL="https://github.com/FortAwesome/Font-Awesome/releases/download/${INPUT_VERSION}/fontawesome-free-${INPUT_VERSION}-desktop.zip"

echo "Downloading release to '${ICONS_ROOT}/latest.zip'"
curl -qSLo "${ICONS_ROOT}/latest.zip" "${DOWNLOAD_URL}"

echo "Unzipping SVGs to '${ICONS_ROOT}'"
unzip -q "${ICONS_ROOT}/latest.zip" "fontawesome-free-${INPUT_VERSION}-desktop/svgs/*" -d "${ICONS_ROOT}/"

echo "Moving dist directories"
cp -R "${ICONS_ROOT}/fontawesome-free-${INPUT_VERSION}-desktop/svgs" "${ICONS_ROOT}/"

echo "Cleaning up downloaded files"
rm -rf "${ICONS_ROOT}/latest.zip" "${ICONS_ROOT}/fontawesome-free-${INPUT_VERSION}-desktop"

echo "All done!"
