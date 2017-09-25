#!/bin/bash
# Create docker-compose.yml

BASE_DIR=`dirname $0`

parse_yaml() {
   local prefix=$2
   local s='[[:space:]]*' w='[a-zA-Z0-9_]*' fs=$(echo @|tr @ '\034')
   sed -ne "s|^\($s\)\($w\)$s:$s\"\(.*\)\"$s\$|\1$fs\2$fs\3|p" \
        -e "s|^\($s\)\($w\)$s:$s\(.*\)$s\$|\1$fs\2$fs\3|p"  $1 |
   awk -F$fs '{
      indent = length($1)/2;
      vname[indent] = $2;
      for (i in vname) {if (i > indent) {delete vname[i]}}
      if (length($3) > 0) {
         vn=""; for (i=0; i<indent; i++) {vn=(vn)(vname[i])("_")}
         printf("%s%s%s=\"%s\"\n", "'$prefix'",vn, $2, $3);
      }
   }'
}

eval $(parse_yaml $BASE_DIR/docker-compose.yml)

# 1. Enter repository name
while :; do
    echo -n "Enter repository name [$REPOSITORY_NAME]: "
    read REPO_NAME

    if [ "$REPO_NAME" == "" ]; then
        [ "$REPOSITORY_NAME" == "" ]&& continue
    else
        REPOSITORY_NAME=$REPO_NAME
    fi

    if [ -d "$BASE_DIR/../$REPOSITORY_NAME" ]; then
        echo -n "That repository already exists. Edit $REPOSITORY_NAME ? (Y/n): "
        read REPO_EXIST

        [ "$REPO_EXIST" != "Y" ]&& continue
    else
        cp -apR $BASE_DIR $BASE_DIR/../$REPOSITORY_NAME
        rm -rf $REPO_DIR/.git
    fi

    cd $BASE_DIR/../$REPOSITORY_NAME
    REPO_DIR=`pwd`
    break
done

# 2. Read docker-compose.yml
YML_FILE="$REPO_DIR/docker-compose.yml~"
cp -p $REPO_DIR/docker-compose.yml $YML_FILE
eval $(parse_yaml $YML_FILE)

# 3. Database initialization
echo
echo '#### Database initialization ####'

## 3.1. Enter mysql root password
while :; do
    echo -n "Enter mysql root password [$services_db_environment_MYSQL_ROOT_PASSWORD]: "
    read MYSQL_ROOT_PASSWORD

    [ "$MYSQL_ROOT_PASSWORD" == "" ]&& break

    sed -i -e "s/\(MYSQL_ROOT_PASSWORD: \).*/\1$MYSQL_ROOT_PASSWORD/g" $YML_FILE
    [ $? -eq 0 ]&& break

    eval $(parse_yaml $REPO_DIR/docker-compose.yml)
done

## 3.2. Enter database name
while :; do
    echo -n "Enter mysql database name [$services_db_environment_MYSQL_DATABASE]: "
    read MYSQL_DATABASE

    [ "$MYSQL_DATABASE" == "" ]&& break

    sed -i -e "s/\(MYSQL_DATABASE: \).*/\1$MYSQL_DATABASE/g" $YML_FILE
    [ $? -eq 0 ]&& break

    eval $(parse_yaml $REPO_DIR/docker-compose.yml)
done

## 3.3. Enter mysql user
while :; do
    echo -n "Enter mysql user name [$services_db_environment_MYSQL_USER]: "
    read MYSQL_USER

    [ "$MYSQL_USER" == "" ]&& break

    sed -i -e "s/\(MYSQL_USER: \).*/\1$MYSQL_USER/g" $YML_FILE
    [ $? -eq 0 ]&& break

    eval $(parse_yaml $REPO_DIR/docker-compose.yml)
done

## 3.4. Enter mysql password
while :; do
    echo -n "Enter $MYSQL_USER password [$services_db_environment_MYSQL_PASSWORD]: "
    read MYSQL_PASSWORD

    [ "$MYSQL_PASSWORD" == "" ]&& break

    sed -i -e "s/\(MYSQL_PASSWORD: \).*/\1$MYSQL_PASSWORD/g" $YML_FILE
    [ $? -eq 0 ]&& break

    eval $(parse_yaml $REPO_DIR/docker-compose.yml)
done

# 4. wordpress initialize
echo
echo '#### Wordpress initialization ####'

## 4.1. Input PHP version
while :; do
    PHP_VERSION=`echo $services_web_image | sed -e 's/^.*_\(.*\):.*$/\1/'`
    echo -n "Enter PHP version (php71|php70|php56|php54)[$PHP_VERSION]: "
    read PHP_VERSION

    case "$PHP_VERSION" in
        php7[10] | php5[64])
            sed -i -e "s/\(image: kunitaya\/apache24_\).*\(:latest\)/\1$PHP_VERSION\2/g" $YML_FILE
            break;;
        "") break;;
    esac

    eval $(parse_yaml $REPO_DIR/docker-compose.yml)
done

## 4.2. wordpress locale
while :; do
    echo -n "Enter wordpress locale [$services_web_environment_WP_LOCALE]: "
    read WP_LOCALE

    [ "$WP_LOCALE" == "" ]&& break

    sed -i -e "s/\(WP_LOCALE: \).*/\1$WP_LOCALE/g" $YML_FILE
    [ $? -eq 0 ]&& break

    eval $(parse_yaml $REPO_DIR/docker-compose.yml)
done


# 5. Write yml
while :; do
    echo -n "You want to overwrite the settings? (Y/n): "
    read OVERWRITE

    [ "$OVERWRITE" == "" ]&& continue

    case "$OVERWRITE" in
        "Y")
            mv -f $YML_FILE $REPO_DIR/docker-compose.yml
            break;;
        "n")
            echo -n "All changes will be discarded. Is it OK? (Y/n): "
            read OK

            if [ "$OK" == "Y" ]; then
                rm -f $YML_FILE
                echo "Discarded. Bye."
                exit 1
            fi
            ;;
        *)  continue;;
    esac
done

echo "Completed!"
echo "Run: cd $REPOSITORY_NAME && docker-compose up -d"

exit 0
