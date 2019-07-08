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
					"long" => "164,639",
					"short" => "153,469",
					"spreads" => "19,095",
				],
				"commercial" => [
					"long" => "277,060",
					"short" => "310,471",
				],
			],
			"changes" => [
				"non-commercial" => [
					"long" => "-8,696",
					"short" => "-11,903",
					"spreads" => "5,389",
				],
				"commercial" => [
					"long" => "23,044",
					"short" => "26,696",
				],
			],
			"open-interest" => [
				"current" => "550,492",
				"non-commercial" => [
					"long" => "29.9",
					"short" => "27.9",
					"spreads" => "3.5",
				],
				"commercial" => [
					"long" => "50.3",
					"short" => "56.4",
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