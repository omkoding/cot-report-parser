<?php

namespace OmKoding\Cot;

use DateTime;
use ReflectionClass;
use GuzzleHttp\Client;
use InvalidArgumentException;

class Report
{
	protected $client;

	public function __construct()
	{
		$this->client = new Client;
	}

	public function latest($symbol)
	{
		$url = 'https://www.cftc.gov/dea/futures/deacmesf.htm';

		$response = $this->client->get($url);

		$parsed = $this->parse((string) $response->getBody());

		return $symbol ? $parsed[$symbol] : $parsed;
	}

    public function byDate($date, $symbol)
    {
        $d = DateTime::createFromFormat('m/d/Y', $date);

        if ($d->format('m/d/Y') != $date) {
            throw new InvalidArgumentException('Date format must be m/d/Y');            
        }

        list($month, $day, $year) = explode('/', $date);

        $url = sprintf(
            'https://www.cftc.gov/sites/default/files/files/dea/cotarchives/%s/futures/deacmesf%s%s%s.htm',
            $year,
            $month,
            $day,
            substr($year, -2)
        );

        $response = $this->client->get($url);

        $parsed = $this->parse((string) $response->getBody());

        return $symbol ? $parsed[$symbol] : $parsed;
    }

	protected function parse(string $html): array
	{
		$lines = explode(PHP_EOL, $html);

		$symbols = Symbol::all();

		$result = [];

		foreach ($symbols as $key => $symbol) {
			foreach ($lines as $index => $line) {
				if ($this->startsWith($line, $symbol . ' - ')) {
					$openInterest = preg_split('/\s+/', trim($lines[$index + 7]));

					$current = preg_split('/\s+/', trim($lines[$index + 9]));

					$changes = preg_split('/\s+/', trim($lines[$index + 12]));

					$percent = preg_split('/\s+/', trim($lines[$index + 15]));

					$result[$symbol] = [
						'current' => [
							'non-commercial' => [
								'long' => $current[0],
								'short' => $current[1],
								'spreads' => $current[2],
							],
							'commercial' => [
								'long' => $current[3],
								'short' => $current[4],
							],
						],
						'changes' => [
							'non-commercial' => [
								'long' => $changes[0],
								'short' => $changes[1],
								'spreads' => $changes[2],
							],
							'commercial' => [
								'long' => $changes[3],
								'short' => $changes[4],
							],
						],
						'open-interest' => [
							'current' => end($openInterest),
							'non-commercial' => [
								'long' => $percent[0],
								'short' => $percent[1],
								'spreads' => $percent[2],
							],
							'commercial' => [
								'long' => $percent[3],
								'short' => $percent[4],
							],
						],
					];
				}

				continue;
			}
		}

		return $result;
	}

	protected function startsWith($haystack, $needle)
	{
	     $length = strlen($needle);

	     return (substr($haystack, 0, $length) === $needle);
	}
}