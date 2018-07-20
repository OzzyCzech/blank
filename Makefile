.PHONY: clean.node_modules clean.vendor clean.dist clean build install

clean.node_modules:
	rm -rf ./node_modules

clean.vendor:
	rm -rf ./vendor

clean.dist:
	rm -rf ./dist

clean: clean.dist clean.vendor clean.node_modules

build: install
	yarn run build

install:
	cp -n .env.example .env
	yarn install
	composer install