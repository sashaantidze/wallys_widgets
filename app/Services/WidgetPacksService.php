<?php

namespace App\Services;

class WidgetPacksService
{

	public static function calculatePacksAmount(array $packs, int $widgetsAmount)
	{

		$packCounter = [];
		$output = [];

		foreach($packs as $index => $pack){

			if($widgetsAmount >= $pack){

				$packCounter[$index] = intval($widgetsAmount / $pack);

				$widgetsAmount = $widgetsAmount - $packCounter[$index] * $pack;

			}

			if(($pack - $widgetsAmount) < min($packs)){

				$packCounter[$index] = 1;

				break;
			}
		}


		foreach($packCounter as $i => $count){

		    $output[$packs[$i]] = $count;

	  	}

	  	return $output;

	}




}