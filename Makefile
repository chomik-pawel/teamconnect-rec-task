.PHONY : help
help : Makefile
	@echo 'TeamConnect'
	@echo '========================================================'
	@echo 'make start'
	@echo 'make tests'

.PHONY: start
start:
	docker compose up -d

.PHONY: tests
tests:
	docker exec -it team-connect-php vendor/bin/codecept run
