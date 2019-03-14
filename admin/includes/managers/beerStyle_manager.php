<?php
require_once __DIR__.'/manager.php';
require_once __DIR__.'/../models/beerStyle.php';

class BeerStyleManager extends Manager{
	
	protected function getPrimaryKeys(){
		return ["id"];
	}
	protected function getColumns(){
		return ["name", "catNum", "category", "beerStyleList", "ogMin", "ogMax", "fgMin", "fgMax", "abvMin", "abvMax", "ibuMin", "ibuMax", "srmMin", "srmMax"];
	}
	protected function getTableName(){
		return "beerStyles";
	}
	protected function getDBObject(){
		return new BeerStyle();
	}	
	protected function getActiveColumnName(){
		return "active";
	}	
	function GetAllByList($list){
		$sql="SELECT * FROM beerStyles WHERE beerStyleList = '$list' ORDER BY name";
		return $this->executeQueryWithResults($sql);
	}
	
	function GetBeerStyleList(){
		global $mysqli;
		$sql="SELECT DISTINCT beerStyleList FROM beerStyles ORDER BY beerStyleList";
		return $this->executeNonObjectQueryWithSingleResults($sql);
	}
	
	function GetFirstByName($name){
	    $sql="SELECT * FROM beerStyles WHERE name = '$name' ORDER BY beerStyleList";
	    return $this->executeQueryWithSingleResult($sql);
	}
	function GetDistinctNamesFromPours(){
	    $sql="SELECT (@row_number:=@row_number + 1) AS id, beerStyle as name FROM (SELECT DISTINCT beerStyle FROM vwPours WHERE beerStyle IS NOT NULL) beerStyles,(SELECT @row_number:=0) AS t ORDER BY name";
	    return $this->executeQueryWithResults($sql);
	}
}