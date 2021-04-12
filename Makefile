sail-up:
	./vendor/bin/sail up -d

sail-down:
	./vendor/bin/sail down

sail-build:
	./vendor/bin/sail build --no-cache

sail-shell:
	./vendor/bin/sail shell

sail-migrate:
	./vendor/bin/sail artisan migrate

sail-seed:
	./vendor/bin/sail artisan db:seed

sail-fresh:
	./vendor/bin/sail artisan migrate:fresh --seed

sail-test:
	./vendor/bin/sail artisan test
