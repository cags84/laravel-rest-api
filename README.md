# Proyecto Laravel

Primero creamos el modelo Account(que representa a las cuentas), con su respectiva migración.

Modificamos las migraciones para agregar los campos y relaciones necesarias en las tablas, en este caso.

```sh
> $table->integer('balance');
```

```sh
> php artisan make:model Account -m
```

Modelamos las peticiones al API

```sh
/* Get balance for non-existing account */
// GET /balance?account_id=1234
// 404 0

/* Create account with initial balance */
// POST /event {"type": "deposit", "destination": "100", "amount": 10}
// 201 {"destination": {"id": "100", "balance": 10}}

/* Create into existing account */
// POST /event {"type": "deposit", "destination": "100", "amount": 10}
// 201 {"destination"_ {"id": "100", "balance": 20}}

/* Get balance for existing account */
// GET /balance?account_id=100
// 200 20

/* Withdraw from non-existing account */
// POST /event {"type": "withdraw}, "origin": "200", "amount": 10 }
// 404 0

/* Withdraw from existing account */
// POST /event {"type": "withdraw}, "origin": "200", "amount": 10 }
// 201 {"origin": {"id": "100", "balance": 15}}

/* Transfer from existing account */
// POST /event {"type": "transfer", "origin": "100", "amount": 15, "destination": "300"}
// 201 {"origin": {"id": "100", "balance"; 0}, "destination": {"id": "300", "balance": 15 }}

/* Transfer from non-existing account */
// POST /event {"type": "transfer", "origin": "100", "amount": 15, "destination": "300"}
```

Following we have a sequence of requests that will be used to test the API.

## Reset state before starting tests

```
POST /reset

200 OK
```


## Get balance for non-existing account

```
GET /balance?account_id=1234

404 0
```

## Create account with initial balance

```
POST /event {"type":"deposit", "destination":"100", "amount":10}

201 {"destination": {"id":"100", "balance":10}}
```

## Deposit into existing account

```
POST /event {"type":"deposit", "destination":"100", "amount":10}

201 {"destination": {"id":"100", "balance":20}}
```

## Get balance for existing account

```
GET /balance?account_id=100

200 20
```

## Withdraw from non-existing account

```
POST /event {"type":"withdraw", "origin":"200", "amount":10}

404 0
```

## Withdraw from existing account

```
POST /event {"type":"withdraw", "origin":"100", "amount":5}

201 {"origin": {"id":"100", "balance":15}}
```

## Transfer from existing account

```
POST /event {"type":"transfer", "origin":"100", "amount":15, "destination":"300"}

201 {"origin": {"id":"100", "balance":0}, "destination": {"id":"300", "balance":15}}
```

## Transfer from non-existing account

```
POST /event {"type":"transfer", "origin":"200", "amount":15, "destination":"300"}

404 0
```



Creamos los controladores

```sh
> php artisan make:controller ResetController
> php artisan make:controller EventController
> php artisan make:controller ResetController
```

Ejecutamos las migraciones

```sh
> php artisan migrate
```

Aprovechamos y creamos el repo de git y creamos el primer commit, antes no olvidar agragar las carpetas ocultas que crear nuestros IDE o editores con los que trabajamos por ejemplo: {.vscode, .idea}

Si por casualidad ya hemos ingresado el git, podemos sacar estos del repo con el siguiente comando.

```sh
> git rm -r --cached .idea/
```

```sh
> git init
> git add .
> git commit -m "Initial commit"
```


