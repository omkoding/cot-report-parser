<?php

namespace OmKoding\Cot;

use ReflectionClass;

class Symbol
{
	const BUTTER_CASH_SETTLED_ = 'BUTTER (CASH SETTLED)';
	const MILK_CLASS_III = 'MILK, Class III';
	const NON_FAT_DRY_MILK = 'NON FAT DRY MILK';
	const CME_MILK_IV = 'CME MILK IV';
	const LEAN_HOGS = 'LEAN HOGS';
	const LIVE_CATTLE = 'LIVE CATTLE';
	const RANDOM_LENGTH_LUMBER = 'RANDOM LENGTH LUMBER';
	const FEEDER_CATTLE = 'FEEDER CATTLE';
	const DRY_WHEY = 'DRY WHEY';
	const CHEESE_CASH_SETTLED_ = 'CHEESE (CASH-SETTLED)';
	const RUSSIAN_RUBLE = 'RUSSIAN RUBLE';
	const CANADIAN_DOLLAR = 'CANADIAN DOLLAR';
	const SWISS_FRANC = 'SWISS FRANC';
	const MEXICAN_PESO = 'MEXICAN PESO';
	const BRITISH_POUND_STERLING = 'BRITISH POUND STERLING';
	const JAPANESE_YEN = 'JAPANESE YEN';
	const EURO_FX = 'EURO FX';
	const EURO_FX_BRITISH_POUND_XRATE = 'EURO FX/BRITISH POUND XRATE';
	const EURO_FX_JAPANESE_YEN_XRATE = 'EURO FX/JAPANESE YEN XRATE';
	const BRAZILIAN_REAL = 'BRAZILIAN REAL';
	const NEW_ZEALAND_DOLLAR = 'NEW ZEALAND DOLLAR';
	const SOUTH_AFRICAN_RAND = 'SOUTH AFRICAN RAND';
	const III_MONTH_EURODOLLARS = '3-MONTH EURODOLLARS';
	const BITCOIN = 'BITCOIN';
	const III_MONTH_SOFR = '3-MONTH SOFR';
	const I_MONTH_SOFR = '1-MONTH SOFR';
	const S_P_500_CONSOLIDATED = 'S&P 500 Consolidated';
	const E_MINI_S_P_500_STOCK_INDEX = 'E-MINI S&P 500 STOCK INDEX';
	const E_MINI_S_P_FINANCIAL_INDEX = 'E-MINI S&P FINANCIAL INDEX';
	const E_MINI_S_P_UTILITIES_INDEX = 'E-MINI S&P UTILITIES INDEX';
	const E_MINI_S_P_400_STOCK_INDEX = 'E-MINI S&P 400 STOCK INDEX';
	const NASDAQ_100_CONSOLIDATED = 'NASDAQ-100 Consolidated';
	const NASDAQ_100_STOCK_INDEX_MINI_ = 'NASDAQ-100 STOCK INDEX (MINI)';
	const AUSTRALIAN_DOLLAR = 'AUSTRALIAN DOLLAR';
	const E_MINI_RUSSELL_2000_INDEX = 'E-MINI RUSSELL 2000 INDEX';
	const NIKKEI_STOCK_AVERAGE = 'NIKKEI STOCK AVERAGE';
	const NIKKEI_STOCK_AVERAGE_YEN_DENOM = 'NIKKEI STOCK AVERAGE YEN DENOM';
	const S_P_500_ANNUAL_DIVIDEND_INDEX = 'S&P 500 ANNUAL DIVIDEND INDEX';

    static public function all(): array
    {
        return (new ReflectionClass(self::class))->getConstants();
    }
}