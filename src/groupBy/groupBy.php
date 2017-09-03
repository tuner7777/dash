<?php

namespace Dash;

/**
 * Groups elements by the common values generated by an iteratee.
 *
 * @category Iterable
 * @param iterable $iterable
 * @param callable $iteratee (optional) Invoked with ($element) for each element of $iterable
 * @param string $defaultGroup (optional) Elements with null $iteratee return values will be in this group
 * @return array map of key => grouped elements
 *
 * @example
	groupBy([1, 2, 3, 4, 5], 'Dash\isOdd');
	// === [true => [1, 3, 5], false => [2, 4]]
 *
 * @example
	groupBy([2.1, 2.5, 3.5, 3.9, 4], 'Dash\isOdd');
	// === [2 => [2.1, 2.5], 3 => [3.5, 3.9], 4 => [4]]
 */
function groupBy($iterable, $iteratee = 'Dash\identity', $defaultGroup = null)
{
	assertType($iterable, 'iterable', __FUNCTION__);

	return reduce($iterable, function ($grouped, $value) use ($iteratee, $defaultGroup) {
		$key = get($value, $iteratee);
		$key = is_null($key) ? $defaultGroup : $key;
		$grouped[$key][] = $value;
		return $grouped;
	});
}
