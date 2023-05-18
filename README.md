## Case Study Hakkında

A firması bir E-Ticaret yazılımı geliştirmiş ve müşterilerine bunu pazarlamak istemiştir. Müşteriler ürünü ancak Cimri, N11, Google ve Facebook ile entegre çalışması koşulu ile satın alabileceklerini iletmişlerdir. Yazılım firması bunu karşılayacak geliştirmeyi yapmak istemiş ancak her platformun farklı veri formatı ile çalıştıklarını görmüştür.

** Cimri verileri JSON ve XML formatlarında kabul etmektedir.

** N11 verileri JSON ve CSV formatlarında kabul etmektedir.

** Google verileri JSON formatında kabul etmektedir.

** Facebook verileri JSON, XML ve CSV formatlarında kabul etmektedir.

## Kurulum

Laravel API projesinin kurulması için MacOs / Linux işletim sistemlerinde aşağıda ki komutunu çalıştırın.

```sh
    make install 
```

Windows İşletim sistemlerinde aşağıda ki komutları sırasıyla çalıştırın.

```sh
    cp .env.example .env
	php artisan key:generate || true
    docker network create case_study_ecommerce || true
    docker-compose down --remove-orphans
    docker-compose up -d --build
    docker exec -it case_study_ecommerce_backend composer install
```

Kurulum tamamlandıktan sonra container içerisinde girip migrate komutu çalışıtırın. 
Bu aşama ile örnek product veri girişini yapılması sağlanır.

```sh
    make bash
    php artisan migrate:fresh --seed
```

## Dökümantasyon

Endpointleri listelemek ve test etmek için 

http://localhost:8000/request-docs/ adresini ziyaret edin.

Open API 3.0 Json -> http://localhost:8000/request-docs/api?openapi=true

Postman Collection : E-Commerce.postman_collection.json

SQL Dosyası : products.sql
