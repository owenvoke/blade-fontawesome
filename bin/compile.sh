#!/usr/bin/env bash

set -e

DIRECTORY=$(cd "$(dirname "$0")" && pwd)
ICONS_ROOT="${DIRECTORY}/../dist"
RESOURCES_ROOT="${DIRECTORY}/../resources/svg"
STYLES=(brands regular solid)

echo "Compiling Font Awesome..."

for STYLE in "${STYLES[@]}"; do
    ICONS_DIR="${ICONS_ROOT}/${STYLE}"
    RESOURCES_DIR="${RESOURCES_ROOT}/${STYLE}"

    if [ ! -d "${RESOURCES_DIR}" ]; then
        mkdir "${RESOURCES_DIR}"
    fi

    for FILE in "${ICONS_DIR}"/*; do
      FILENAME=${FILE##*/}

      if [ "$FILENAME" == ".gitignore" ]
      then
        break
      fi

      # Compile icons...
      cp "${FILE}" "${RESOURCES_DIR}/${FILENAME}"

      CLASS='<svg fill="currentColor"'
      sed -i '' "s/<svg/${CLASS}/" "${RESOURCES_DIR}/${FILENAME}"
    done
done

echo "All done!"
