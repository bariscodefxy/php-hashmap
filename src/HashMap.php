<?php

namespace bariscodefx\PHPHashMap;

/**
 * HashMap
 */
class HashMap {

    /**
     * @var array
     */
    private array $buckets;

    /**
     * constructor
     */
    public function __construct() {
        $this->buckets = array_fill(0, 100, null); // Fixed size array
    }

    /**
     * @param $key
     * @return int
     */
    private function _hash($key): int {
        $hash = 0;
        $length = strlen($key);
        for ($i = 0; $i < $length; $i++) {
            $hash += ord($key[$i]);
        }
        return $hash % count($this->buckets);
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value) {
        $index = $this->_hash($key);
        if (!$this->buckets[$index]) {
            $this->buckets[$index] = array();
        }
        $this->buckets[$index][] = array("key" => $key, "value" => $value);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key): mixed {
        $index = $this->_hash($key);
        if ($this->buckets[$index]) {
            foreach ($this->buckets[$index] as $item) {
                if ($item["key"] === $key) {
                    return $item["value"];
                }
            }
        }
        return null;
    }

    /**
     * @param string $varname
     * @return mixed
     */
    public function __get(string $varname): mixed {
        return $this->{$varname};
    }
}