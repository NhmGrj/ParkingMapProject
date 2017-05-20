install:
	composer install
	bower install
	php bin/console assetic:dump


install-db:
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create

load-db:
	php bin/console doctrine:fixtures:load
	
start:
	php bin/console server:start


restart:
	php bin/console server:stop
	php bin/console server:start
