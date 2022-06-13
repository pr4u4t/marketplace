css:
ifneq ($(shell id -u),$(shell id -u market))
	@echo "You must be site owner to run this command"
else
	npm run production
endif

flush:
ifneq ($(shell id -u),$(shell id -u market))
	@echo "You must be site owner to run this command"
else
	php artisan route:clear
	php artisan view:clear
	php artisan config:clear
	php artisan cache:clear
endif

recache:
ifneq ($(shell id -u),$(shell id -u market))
	@echo "You must be site owner to run this command"
else
	php artisan view:cache
	php artisan route:cache
	php artisan config:cache
endif

php7.3:
	update-alternatives --set php /usr/bin/php7.3
	update-alternatives --set phar /usr/bin/phar7.3
	update-alternatives --set phar.phar /usr/bin/phar.phar7.3
	update-alternatives --set phpize /usr/bin/phpize7.3
	update-alternatives --set php-config /usr/bin/php-config7.3

jsupdate:
ifneq ($(shell id -u),$(shell id -u market))
	@echo "You must be site owner to run this command"
else
	npm update
endif

searchable:
ifneq ($(shell id -u),$(shell id -u market))
	@echo "You must be site owner to run this command"
else
	php artisan scout:import "App\Vendors"
endif

update:
ifneq ($(shell id -u),$(shell id -u market))
	@echo "You must be site owner to run this command"
else
	git pull
endif

redis-clear:
	redis-cli FLUSHALL
