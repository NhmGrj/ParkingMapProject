
reset-db: uninstall-db install-db load-db

server-restart: server-stop server-restart

reset: server-restart reset-db

set-up: install install-db load-db server-start


install:
	composer install
	bower install
	php bin/console assets:install
	php bin/console assetic:dump


install-db:
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create


update-schema:
	php bin/console doctrine:schema:update --force

uninstall-db:
	php bin/console doctrine:database:drop --force

load-db:
	php bin/console doctrine:fixtures:load --no-interaction

server-start:
	php bin/console server:start

server-stop:
	php bin/console server:stop
