<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class LargeDataTest extends TestCase
{
    public function testLargeData(): void
    {
        $hashmap = new \bariscodefx\PHPHashMap\HashMap();

        $time = microtime(true);
        for($i = 0; $i < 1000000; $i++)
        {
            $hashmap->set('key.' . $i, 'data_' . $i);
        }
        fwrite(STDOUT,  __FUNCTION__ . "(): Writing it finished in " . microtime(true) - $time . ".\n");

        $time = microtime(true);
        $hashmap->get('key.1000000');
        fwrite(STDOUT,  __FUNCTION__ . "(): Reading it finished in " . microtime(true) - $time . ".\n");

        $this->assertTrue(true);
    }
}
