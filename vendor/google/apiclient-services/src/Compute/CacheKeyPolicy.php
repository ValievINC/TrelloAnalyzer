<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Compute;

class CacheKeyPolicy extends \Google\Collection
{
  protected $collection_key = 'queryStringWhitelist';
  public $includeHost;
  public $includeHttpHeaders;
  public $includeNamedCookies;
  public $includeProtocol;
  public $includeQueryString;
  public $queryStringBlacklist;
  public $queryStringWhitelist;

  public function setIncludeHost($includeHost)
  {
    $this->includeHost = $includeHost;
  }
  public function getIncludeHost()
  {
    return $this->includeHost;
  }
  public function setIncludeHttpHeaders($includeHttpHeaders)
  {
    $this->includeHttpHeaders = $includeHttpHeaders;
  }
  public function getIncludeHttpHeaders()
  {
    return $this->includeHttpHeaders;
  }
  public function setIncludeNamedCookies($includeNamedCookies)
  {
    $this->includeNamedCookies = $includeNamedCookies;
  }
  public function getIncludeNamedCookies()
  {
    return $this->includeNamedCookies;
  }
  public function setIncludeProtocol($includeProtocol)
  {
    $this->includeProtocol = $includeProtocol;
  }
  public function getIncludeProtocol()
  {
    return $this->includeProtocol;
  }
  public function setIncludeQueryString($includeQueryString)
  {
    $this->includeQueryString = $includeQueryString;
  }
  public function getIncludeQueryString()
  {
    return $this->includeQueryString;
  }
  public function setQueryStringBlacklist($queryStringBlacklist)
  {
    $this->queryStringBlacklist = $queryStringBlacklist;
  }
  public function getQueryStringBlacklist()
  {
    return $this->queryStringBlacklist;
  }
  public function setQueryStringWhitelist($queryStringWhitelist)
  {
    $this->queryStringWhitelist = $queryStringWhitelist;
  }
  public function getQueryStringWhitelist()
  {
    return $this->queryStringWhitelist;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CacheKeyPolicy::class, 'Google_Service_Compute_CacheKeyPolicy');
