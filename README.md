# Test case for Doctrine ORKM 2.17.x bug

Github issue: https://github.com/doctrine/orm/issues/11097

### Preparation

Execute migrations `php bin/console doctrine:migrations:migrate`

### Latest commit (ORM 2.16.3)

Execute tests `php bin/phpunit`. Everything ok.

### HEAD^ (ORM 2.17.1)

Execute tests `php bin/phpunit`. Test fails.





