#!/usr/bin/env bash

set -e

DIRECTORY=$(cd "$(dirname "$0")" && pwd)
ICONS_ROOT="${DIRECTORY}/../dist"

if [ -z "${LATEST_VERSION}" ]; then
    echo 'Environment variable "LATEST_VERSION" has not been set'
    exit 1
fi

DOWNLOAD_URL="https://github.com/FortAwesome/Font-Awesome/releases/download/${LATEST_VERSION}/fontawesome-free-${LATEST_VERSION}-desktop.zip"

if [ ! -d "${ICONS_ROOT}" ]; then
    mkdir "${ICONS_ROOT}"
fi

echo "Downloading release to '${ICONS_ROOT}/latest.zip'"
curl -sLo "${ICONS_ROOT}/latest.zip" "${DOWNLOAD_URL}"

echo "Unzipping SVGs to '${ICONS_ROOT}'"
unzip -q "${ICONS_ROOT}/latest.zip" "fontawesome-free-${LATEST_VERSION}-desktop/svgs/*" -d "${ICONS_ROOT}/"

echo "Moving dist directories"
cp -R "${ICONS_ROOT}/fontawesome-free-${LATEST_VERSION}-desktop/svgs/"* "${ICONS_ROOT}/"

echo "Cleaning up downloaded files"
rm -rf "${ICONS_ROOT}/latest.zip" "${ICONS_ROOT}/fontawesome-free-${LATEST_VERSION}-desktop"

echo "Available styles: $(ls -m "${ICONS_ROOT}")"

echo "All done!"
