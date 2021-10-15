dev: checknix
	nix develop
checknix:
	bash ./nixfiles/checknix.sh
start:
	symfony serve -d
	echo "todo : execute 'startServices'"
