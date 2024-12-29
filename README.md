Learn Laravel by build project management system

  Setup project in your local machine, make sure you have installed docker in your local machine, then start by following below commands in the root project directory,

1. Simply run

```bash
   docker-compose build
   docker-compose up 
```

2. Open up the bash terminal of php container, by running

```bash
    docker exec it php bash
```
and run composer install and npm install

```bash
   composer install
   npm install
```
Once done, start your local server by running
```bash
   php artisan serve
```




