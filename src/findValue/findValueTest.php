<?php

/**
 * @covers Dash\findValue
 */
class findValueTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($iterable, $predicate, $expected)
	{
		$actual = Dash\findValue($iterable, $predicate);
		$this->assertEquals($expected, $actual);
	}

	public function cases()
	{
		return array(
			'With an empty array' => array(
				[],
				function () { return false; },
				null
			),
			'With a non-matching search of an array' => array(
				[
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
					'd' => 'second',
					'e' => 'fifth',
				],
				function () { return false; },
				null
			),
			'With a matching value search of an array' => array(
				[
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
					'd' => 'second',
					'e' => 'fifth',
				],
				function ($value) {
					return $value == 'second';
				},
				'second'
			),
			'With a matching key search of an array' => array(
				[
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
					'd' => 'second',
					'e' => 'fifth',
				],
				function ($value, $key) {
					return $key == 'd';
				},
				'second'
			),
		);
	}
}
