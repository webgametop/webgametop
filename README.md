# webgametop

```bash
docker compose run --rm -w /var/www/www-data/webgametop php-cli chown www-data:www-data -R bootstrap/cache storage
```

```bash
docker compose run --rm -w /var/www/www-data/webgametop node sh -c "npm install && npm run build"
```
