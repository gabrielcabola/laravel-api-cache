<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Redis as Cache; //Create a Interface to cache class to abstract Redis


class PaymentRepository
{
      /**
       * The cache instance.
       */
      protected $cache;

      /**
       * Cache Key Prefix.
       */
      protected $prefix;

      /**
       * Minutes to Expire Cached Information.
       */
      protected $timeToExpire;

      /**
      * Create a new repository instance.
      *
      * @param  Cache  $cache
      * @return void
      */
      public function __construct(Cache $cache)
      {
          $this->cache = $cache;
          $this->prefix = 'paymentsStatistics';
          $this->timeToExpire = 60; //seconds
      }


      /**
      * Add payment to cache
      *
      * @param Request $payment
      * @return array
      *
      */
      public function add($payment)
      {
            //Generate a timestamp for a cache key
            $micro = microtime(true);
            $cacheKey = date('Y-m-d-H:i:s.').preg_replace("/^.*\./i","", $micro) . md5(rand(999, 9999) * $micro);

            //Set Cache info with expiration
            $this->cache::setEx( $this->prefix.':'.$cacheKey, $this->timeToExpire , $payment->amount );

            //More...
            //We can store this information in database via job dispatch in queue system to avoid block the requests.

            //response
            if($this->cache::exists($cacheKey)) {
              return ['success'=>true, 'key' => $cacheKey];
            } else {
              \Log::debug('The key '.$cacheKey.' is not setted correct');
              return ['success'=>false, 'key' => 'has a problem to set a key'];
            }


      }


      /**
      * Get Statitics from cache
      *
      * @param void
      * @return array
      *
      */
      public function statistics()
      {

          //search keys in caches
          $keys =  $this->cache::keys($this->prefix.'*');

          //total itens in cache
          $count = count($keys);

          //Prepare array from cache
          if($count > 0) {
              $sales = collect($keys)->map(function ($key) {
                  return $this->cache::get($key);
              })->toArray();
          } else $sales = [];

          //total amount
          $total = array_sum($sales);

          //average formula (can be a helper)
          $average =  $count === 0 ? 0 : array_sum($sales) / $count;

          //response
          return [
            'total_amount' => $total,
            'avg_amount' =>$average
          ];
      }


}
