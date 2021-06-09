<?php declare(strict_types=1);

/* Copyright (c) 1998-2021 ILIAS open source, Extended GPL, see docs/LICENSE */

use ILIAS\ContentPage\PageMetrics\ValueObject\PageReadingTime;
use PHPUnit\Framework\TestCase;

/**
 * Class PageReadingTimeTest
 * @author Michael Jansen <mjansen@databay.de>
 */
class PageReadingTimeTest extends TestCase
{
    public function mixedReadingTypesProvider() : array
    {
        return [
            'Float Type' => [4.0],
            'String Type' => ['4'],
            'Array Type' => [[4]],
            'Object Type' => [new stdClass()],
            'Boolean Type' => [false],
            'Null Type' => [null]
        ];
    }

    /**
     * @param $mixedType
     * @dataProvider mixedReadingTypesProvider
     */
    public function testPageReadingTimeValueThrowsExceptionWhenConstructedWithInvalidTypes($mixedType) : void
    {
        $this->expectException(TypeError::class);

        $readingTime = new PageReadingTime($mixedType);
    }

    public function testRawReadingTimeCanBeRetrievedFromValueObject() : void
    {
        $readingTime = new PageReadingTime(5);
        $this->assertEquals(5, $readingTime->minutes());
    }
}
