## Case Study Hakkında

A firması bir E-Ticaret yazılımı geliştirmiş ve müşterilerine bunu pazarlamak istemiştir. Müşteriler ürünü ancak Cimri, N11, Google ve Facebook ile entegre çalışması koşulu ile satın alabileceklerini iletmişlerdir. Yazılım firması bunu karşılayacak geliştirmeyi yapmak istemiş ancak her platformun farklı veri formatı ile çalıştıklarını görmüştür.

### Cimri verileri JSON ve XML formatlarında kabul etmektedir.

### N11 verileri JSON ve CSV formatlarında kabul etmektedir.

### Google verileri JSON formatında kabul etmektedir.

### Facebook verileri JSON, XML ve CSV formatlarında kabul etmektedir.

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


## Dökümantasyon

Endpointleri listelemek için 

http://localhost:8000/request-docs/ adresini ziyaret edin.


## License

Bu Case Study SSTTek adına açık kaynaklı olarak hazırlanmıştır ve [MIT license](https://opensource.org/licenses/MIT). haklarına sahiptir.