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

namespace Google\Service\Datastream;

class OracleTable extends \Google\Collection
{
  protected $collection_key = 'oracleColumns';
  protected $oracleColumnsType = OracleColumn::class;
  protected $oracleColumnsDataType = 'array';
  public $table;

  /**
   * @param OracleColumn[]
   */
  public function setOracleColumns($oracleColumns)
  {
    $this->oracleColumns = $oracleColumns;
  }
  /**
   * @return OracleColumn[]
   */
  public function getOracleColumns()
  {
    return $this->oracleColumns;
  }
  public function setTable($table)
  {
    $this->table = $table;
  }
  public function getTable()
  {
    return $this->table;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OracleTable::class, 'Google_Service_Datastream_OracleTable');
