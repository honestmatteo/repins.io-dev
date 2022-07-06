#!/bin/bash
docker info > /dev/null 2>&1

# Ensure that Docker is running...
if [ $? -ne 0 ]; then
    echo "Docker is not running."
    exit 1
fi

docker run --rm \
    -v "$(pwd)":/opt \
    -w /opt \
    laravelsail/php81-composer:latest \
    bash -c "laravel new example-app && mv example-app respins-laravel && cd respins-laravel && php ./artisan sail:install --with=mariadb,redis,minio,selenium"

cd respins-laravel

CYAN='\033[0;36m'
LIGHT_CYAN='\033[1;36m'
WHITE='\033[1;37m'
NC='\033[0m'

echo ""

if sudo -n true 2>/dev/null; then
    sudo chown -R $USER: .
    echo -e "${WHITE}Install of the base app seems to have been succesfull. Now executing ${NC} ./vendor/bin/sail up"
    bash -c "chmod 777 ${PWD}/vendor/bin/sail"
    bash -c "chmod -R 777 ${PWD}/storage"
    bash -c "chmod -R 777 ${PWD}/bootstrap/cache"
    bash -c "sudo ${PWD}/vendor/bin/sail up -d"
else
    echo -e "${WHITE}Please provide your password so we can make some final adjustments to your application's permissions.${NC}"
    echo ""
    sudo chown -R $USER: .
    echo ""
    echo -e "${WHITE}Thank you! We hope you build something incredible. Dive in with:${NC} cd example-app && ./vendor/bin/sail up"
fi
