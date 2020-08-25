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

    php -r "require __DIR__.'/src/Actions/CompileSvgsAction.php'; (new \OwenVoke\BladeFontAwesome\Actions\CompileSvgsAction('${ICONS_DIR}', '${RESOURCES_DIR}'))->execute();"
done

echo "All done!"
