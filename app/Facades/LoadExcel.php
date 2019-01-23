<?php 

namespace App\Facades;
use Illuminate\Support\Facades\Facade;
	/**
	 * 
	 */
	class LoadExcel extends Facade
	{
		
		public static function index($request){
			return $request;
		} 
	}
