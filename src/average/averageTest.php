<?php

/**
 * @covers Dash\average
 * @covers Dash\_average
 * @covers Dash\mean
 * @covers Dash\_mean
 */
class averageTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $expected)
	{
		$this->assertEquals($expected, Dash\average($iterable));
		$this->assertEquals($expected, Dash\mean($iterable));
	}

	/**
	 * @dataProvider cases
	 */
	public function testCurried($iterable, $expected)
	{
		$average = Dash\_average();
		$this->assertEquals($expected, $average($iterable));

		$mean = Dash\_mean();
		$this->assertEquals($expected, $mean($iterable));
	}

	public function cases()
	{
		return [

			'With an empty array' => [
				'iterable' => [],
				'expected' => 0,
			],

			/*
				With indexed array
			 */

			'With an indexed array with one element' => [
				'iterable' => [3],
				'expected' => 3,
			],
			'With an indexed array' => [
				'iterable' => [2, 3, 5, 8],
				'expected' => 4.5,
			],

			/*
				With associative array
			 */

			'With an associative array with one element' => [
				'iterable' => ['a' => 3],
				'expected' => 3,
			],
			'With an associative array' => [
				'iterable' => ['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8],
				'expected' => 4.5,
			],

			/*
				With stdClass
			 */

			'With an empty stdClass' => [
				'iterable' => (object) [],
				'expected' => 0,
			],
			'With an stdClass with one element' => [
				'iterable' => (object) ['a' => 3],
				'expected' => 3,
			],
			'With an stdClass' => [
				'iterable' => (object) ['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8],
				'expected' => 4.5,
			],

			/*
				With ArrayObject
			 */

			'With an empty ArrayObject' => [
				'iterable' => new ArrayObject([]),
				'expected' => 0,
			],
			'With an ArrayObject with one element' => [
				'iterable' => new ArrayObject(['a' => 3]),
				'expected' => 3,
			],
			'With an ArrayObject' => [
				'iterable' => new ArrayObject(['a' => 2, 'b' => 3, 'c' => 5, 'd' => 8]),
				'expected' => 4.5,
			],
		];
	}

	/**
	 * @dataProvider casesTypeAssertions
	 * @expectedException InvalidArgumentException
	 */
	public function testTypeAssertions($iterable, $type)
	{
		try {
			Dash\average($iterable);
		}
		catch (Exception $e) {
			$this->assertEquals("Dash\average expects iterable but was given $type", $e->getMessage());
			throw $e;
		}

		try {
			Dash\mean($iterable);
		}
		catch (Exception $e) {
			$this->assertEquals("Dash\average expects iterable but was given $type", $e->getMessage());
			throw $e;
		}
	}

	public function casesTypeAssertions()
	{
		return [
			'With null' => [
				'iterable' => null,
				'type' => 'NULL',
			],
			'With an empty string' => [
				'iterable' => '',
				'type' => 'string',
			],
			'With a string' => [
				'iterable' => 'hello',
				'type' => 'string',
			],
			'With a zero number' => [
				'iterable' => 0,
				'type' => 'integer',
			],
			'With a number' => [
				'iterable' => 3.14,
				'type' => 'double',
			],
			'With a DateTime' => [
				'iterable' => new DateTime(),
				'type' => 'DateTime',
			],
		];
	}
}
