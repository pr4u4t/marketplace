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

update:
ifneq ($(shell id -u),$(shell id -u market))
        @echo "You must be site owner to run this command"
else
	git pull
endif

redis-clear:
	redis-cli FLUSHALL
