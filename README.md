### Генерация ключей для oauth
```
cd api
openssl genrsa -out private.key 2048
openssl rsa -in private.key -pubout > public.key