# Benchmarking Laravel test creating a API using REDIS
Create  a API to return realtime data statistics using Redis.

#### Installing Laravel
```sh
//Setup example
$ mv .env.sample .env

//Update Composer
$ composer update 

//Initialize Local using homestead (need a redis server)
$ php artisan serve

//Docker
$ docker-compose up -d
```


[http://127.0.0.1/] http://127.0.0.1/

----

**Add a sale**

  Add information to statistics cache.

* **URL**
  /payment

* **Method:**
  `POST`
  
   **Required:**
   `amount=[float]`
```javascript
//E.G.
{"amount":15.00}
```

| Parameter       | Type     | Description                                                  |
| --------------- | -------- | ------------------------------------------------------------ |
| amount     | **float**  | Price       |


* **Success Response:**
  * **Code:** 201 <br />
    **Content:** `{ success : true, paymentsStatistics:1545938034 : "10.00" }`
 
* **Sample Call:**
  ```sh
  //CURL
   curl --request POST \
  --url http://127.0.0.1:8000/payment \
  --header 'Content-Type: application/json' \
  --data '{"amount":100000}'
  
  //HTTPpie
  echo '{"amount":100000}' |  \
  http POST http://127.0.0.1:8000/payment \
  Content-Type:application/json
  ```
----
**Statistics**

 **URL**
  /statistics

* **Method:**
  `GET`
  
  * **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"total_amount":500,"avg_amount":100}`

* **Sample Call:**
  ```sh
  //CURL
   curl --request GET \
  --url http://127.0.0.1:8000/statistics \
  --header 'Content-Type: application/json' 
  
  //HTTPpie
  http GET http://127.0.0.1:8000/statistics \
  Content-Type:application/json
  ```
  
* **Sample Call:**
  ```sh
  //CURL
   curl --request POST \
  --url http://127.0.0.1:8000/payment \
  --header 'Content-Type: application/json' \
  --data '{"amount":100000}'
  
  //HTTPpie
  echo '{"amount":100000}' |  \
  http POST http://127.0.0.1:8000/payment \
  Content-Type:application/json
  ```
