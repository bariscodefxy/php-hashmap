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
     * @param int $bucketCount
     */
    public function __construct(int $bucketCount = 100) {
        $this->buckets = array_fill(0, $bucketCount, null); // Fixed size array
    }

    /**
     * @param string $key
     * @return int
     */
    private function _hash(string $key): int {
        $hash = 0;
        $length = strlen($key);
        for ($i = 0; $i < $length; $i++) {
            $hash += ord($key[$i]);
        }
        return $hash % count($this->buckets);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, mixed $value) {
        $index = $this->_hash($key);
        if (!$this->buckets[$index]) {
            $this->buckets[$index] = array();
        }
        $this->buckets[$index][] = array("key" => $key, "value" => $value);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed {
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
     * @return int
     */
    public function count(): int {
        $count = 0;
        foreach($this->buckets as $bucket) {
            $count += count($bucket ?? []);
        }
        return $count;
    }

    /**
     * @param string $varname
     * @return mixed
     */
    public function __get(string $varname): mixed {
        return $this->{$varname};
    }
}
