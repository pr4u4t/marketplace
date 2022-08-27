# ~~marketplace~~
# opensource e-commerce social platform
Where individuals can exchange their goods and services for digital payments including paypal and cryptocurrencies. Site is based on Laravel 8 framework and PHP. 

# Requirements
- PHP 7.1.3
- Composer
- Database (MySQL/MariaDB/PostgreSQL)

## PHP Extensions
-  sodium (Message encryption)
-  gmp (Precision calculation)
-  xmlrpc (Bitmessage communication protocol)

## Additional services 
- One of supported coins for processing transactions
- Elasticsearch (Searching acceleration trough goods/services/users records)

## Optional (still good to have)
- Memcached (caching)
- Redis (caching)

## Supported coins
- Bitcoin (BTC)
- Bitcoin Multisig (BTCM)
- Monero (XMR)
- BitcoinCash (BCH)
- PivxCoin (PIVX)
- Litecoin (LTC)
- Dash (DASH)
- VergeCoin (XVG)

## Installation

```console
$ cd /srv/http
$ git clone https://github.com/pr4u4t/marketplace.git
$ cp .env.example .env 
#setup mysql database
$ mysql -u root -h localhost
MariaDB [(none)]> CREATE USER 'SiteOwner'@'localhost' IDENTIFIED BY 'StrongPassword';
MariaDB [(none)]> CREATE DATABASE SiteDatabase;
MariaDB [(none)]> GRANT ALL PRIVILEGES ON SiteDatabase.* TO 'SiteOwner'@'localhost';
MariaDB [(none)]> FLUSH PRIVILEGES;
MariaDB [(none)]> exit
#generate app key
$ cat /dev/urandom | tr -dc '[:alpha:]' | fold -w ${1:-32} | head -n 1
#edit .env file setting database credentials and app key
$ vim .env
$ php7 /usr/bin/composer install
```

## TODO:
- [ ] Add PayPal support
- [ ] WebSocket MQTT chat
- [ ] Migration to bootstrap 5
- [ ] Auction and inverted auction (for services)
- [ ] Add blog with user blog support
- [ ] Integrate site and forum UI
- [ ] Update to Laravel 9

## Screenshots
![admin panel screenshot](https://github.com/pr4u4t/marketplace/blob/main/doc/admin.webp?raw=true "admin panel")

![user profile screenshot](https://github.com/pr4u4t/marketplace/blob/main/doc/user_profile.webp?raw=true "user profile")

## Donations
BTC: 3MWctnaTBC8emKs2FJpDaj7ZuyW1QHGgAv

PayPal: pawel.ciejka@gmail.com

Skrill: pawel.ciejka@gmail.com


