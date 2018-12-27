<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Facades\Redis as Cache; //Create a Interface to cache class to abstract Redis


class CacheInterface
{

  public function set($key, $value, $expiration) {

  }

  public function get($key) {

  }

  public function find($keyword) {

  }

}
