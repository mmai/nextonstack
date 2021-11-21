dev: checknix
	nix develop
checknix:
	bash ./nixfiles/checknix.sh
install: startdb
	cp .env .env.local
	symfony composer install
	symfony console doctrine:migrations:migrate
	yarn install
startdb:
	echo "todo : execute 'startServices'"
stopdb:
	echo "todo : execute 'stopServices'"
start: startdb
	symfony serve -d
sql:
	sql
stop: stopdb
	symfony server:stop
compile:
	yarn encore production
watch:
	yarn encore dev --watch
