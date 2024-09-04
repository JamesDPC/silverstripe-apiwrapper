<?php

namespace Symbiote\ApiWrapper\Tests;

use SilverStripe\ORM\DataObject;
use SilverStripe\Dev\TestOnly;

/**
 * Test object for ServiceWrapTest
 */
class ServiceWrapperTestObject extends DataObject implements TestOnly
{
    private static string $table_name = 'ServiceWrapTestObject';

    private static array $db = [
        'Title' => 'Varchar(128)',
    ];

    public function canView($member = null)
    {
        return true;
    }
}
