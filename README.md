# Laravel SPA

https://www.grafikart.fr/tutoriels/laravel-passport-oauth-978

## 1. Set up web auth

https://laravel.com/docs/7.x/authentication

-   Create a user to use it with the API

## 2. Set up Laravel passeport

https://laravel.com/docs/7.x/passport#frontend-quickstart

## 3. Use Laravel Passeport : Password grant

```
$ php artisan passport:client --password
```

### Get token

Use Postman:

```
curl --location --request POST 'http://localhost:8000/oauth/token' \
--header 'Content-Type: multipart/form-data; boundary=--------------------------141827371592682820766257' \
--form 'grant_type=password' \
--form 'client_id=4' \
--form 'client_secret=j3bJwMGXisgiHgvKqctPq16dhFYyL7Ep8b16cYUa' \
--form 'username=clement@webstart.com' \
--form 'password=azertyuiop'
```

## 4. Use Laravel Passeport : Authorization code grand

### 1. Dans le navigateur :

-   http://localhost:8000/oauth/authorize?client_id=3&redirect=http%3A%2F%2Flocalhost:8000%2Fauth%2Fcallback&response_type=code

On récupérer le code dans l'url de la réponse en 404.

### 2. Dans Postman :

-   POST
-   http://localhost:8000/oauth/token

```
{
	"grant_type": "authorization_code",
	"client_id": 3,
	"client_secret": "WoFieFkgcKkj7aSkU2dCtnr002M5CJCsPKsQrWiT",
	"redirect_uri": "http://localhost:8000/auth/callback",
	"code": "def502002792c3d0906429ecbc12a0b0622581fa0b3784f2ec358fd6933319906720032b654867dec99ffc14bac88c24a910028500e3cf945cb9cb5307626d32ed46fa68dc7a494fb861029ef7545f79859a66530072bc3cb32e75560de6be0e6669c1182680b39246a3c5d697a61e3891d81bb516f9bb6d8b4e11df39e8491709b64bd7531721ce8e653ec527f9026a9a4f4ee53bf3ba282f6d67a92e4eaf0838be096aa9b2e2a0f85f51de7b7b2a0d11fd3925d7bce50451efd2493970fccea27062ef5d5c92fa1ecbd6b3ab463588a2cbaf68b2b62ef4b9418b729faab9463bc8eb567a0b2be1ab36c7dea7920c26eaab85ca16813c7deef475eac0b54adc50856f0b42166b044d8728eef04f6d587b237f5d2dc38518ccd8980daac9cf19d068e08f2e35f0b603d15d6294b9ed504de43fcc75e5f7605599755d66ecac354e4e9b292e85bacbac35c11a30399a21db1c72e8eea41b12050027941de7f65f025b5a9a"
}
```

### 3. Test de l'API dans Postman:

-   GET
-   http://localhost:8000/api/user
    -   Renvoi le formulaire de login
    -   Si on ajout un header : `Accept: application/json`
        -   Renvoi `{"message":"Unauthenticated."}`
    -   Si on ajoute aussi l'access token qui est un Bearer Token dans Authorization de Postman : on récupère les informations utilisateurs

## 5. Scopes

-   Créer les scopes dans `AuthServiceProvider.php`
-   Créer les routes avec les middlewares scope
-   Ajouter les scopes au `Kernel.php` (http);

-   GET
-   http://localhost:8000/oauth/authorize?client_id=3&redirect=http%3A%2F%2Flocalhost:8000%2Fauth%2Fcallback&response_type=code&scope=admin
-   Obtenir un nouveau code et refaire la requête http://localhost:8000/oauth/token pour obtenir de nouveaux tokens
