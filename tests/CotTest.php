<?php

namespace OmKoding\Cot\Tests;

use OmKoding\Cot\Report;
use OmKoding\Cot\Symbol;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CotTest extends TestCase
{
	public function testReportByDate(): void
	{
		$report = (new Report)->byDate('09/11/2018', Symbol::EURO_FX);

		$this->assertSame($report, [
			"current" => [
				"non-commercial" => [
					"long" => 164639,
					"short" => 153469,
					"spreads" => 19095,
				],
				"commercial" => [
					"long" => 277060,
					"short" => 310471,
				],
			],
			"changes" => [
				"non-commercial" => [
					"long" => -8696,
					"short" => -11903,
					"spreads" => 5389,
				],
				"commercial" => [
					"long" => 23044,
					"short" => 26696,
				],
			],
			"open-interest" => [
				"current" => 550492,
				"non-commercial" => [
					"long" => 29.9,
					"short" => 27.9,
					"spreads" => 3.5,
				],
				"commercial" => [
					"long" => 50.3,
					"short" => 56.4,
				],
			],
		]);
	}

	public function testInvalidDate(): void
	{
		$this->expectException(InvalidArgumentException::class);

		$report = (new Report)->byDate('25/02/2018', Symbol::EURO_FX);
	}

	public function testReportLatest(): void
	{
		$report = (new Report)->latest(Symbol::EURO_FX);

		$this->assertNotNull($report['current']['non-commercial']['long']);
		$this->assertNotNull($report['changes']['commercial']['long']);
		$this->assertNotNull($report['open-interest']['current']);
	}
}