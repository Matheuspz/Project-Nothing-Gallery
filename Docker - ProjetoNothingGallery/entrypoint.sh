#!/bin/bash

echo "Aguardando MySQL iniciar..."
until mysqladmin ping -h"$DB_HOST" -u"$DB_USER" --password="$DB_PASS" --silent; do
  sleep 2
done

echo "MySQL está pronto. Executando migrations..."

php /var/www/html/database/database.php

exec apache2-foreground
