<?php
namespace App\Helpers;

class Helpers
{
	public static function years() {
		$current_year = date('Y');
		$min_years = $current_year - 30;
		$years = [];
		for ($i = $min_years; $i <= $current_year; $i++) {
			$years[] = $i;
		}
		return $years;
	}
}

