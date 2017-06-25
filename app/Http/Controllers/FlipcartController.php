<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlipcartController extends Controller
{
    public function getFlipcartProducts()
    {
    	//echo "<pre>";
    	//print_r($_REQUEST);exit;
    	if(isset($_GET['count']) && isset($_GET['url'])){
			$queryString = $_GET['url'];
			$count = $_GET['count'];
			if( $queryString== null){
				$queryString = "Batman";
			}
			
			$flipkartUrl = "https://affiliate-api.flipkart.net/affiliate/search/json?query=" . $queryString . "&resultCount=" . $count;
			//echo $flipkartUrl;exit;
			$aHTTP['http']['method']  = 'GET';
			$aHTTP['http']['header']  = "Fk-Affiliate-Token:2f51a1d1fc6e4a34a7d046342afd2ff8\r\n";
			$aHTTP['http']['header'] .= "Fk-Affiliate-Id:prakashsh\r\n";
			
			$request= stream_context_create($aHTTP);
			$response= file_get_contents($flipkartUrl , false, $request);
			$array = json_decode($response,true);
			$x = 0;
			$productInfoList = $array['productInfoList'];
			//print_r($productInfoList);exit;
			return view('flipcart.flipcartList', compact('productInfoList'));

		}else{

			return view('flipcart.flipcartList');
		}
    	
    }
}
