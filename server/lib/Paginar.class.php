<?php
class Paginar{
	
	private $page;
	private $start;
	private $limit;
	private $limitMax = '100';
	private $sort = 'id';
	private $order = 'asc';

	//$start = (($page - 1) * $rows);
	
	function __construct($post){
		$this->page = (int) $post['page'];
		$this->start = (int) $post['start'];
		$this->limit = (int) $this->maxLimit($post['limit']);
		
		if( isset($post['sort']) ){
			$sortJson = json_decode( $post['sort'] );
			$this->sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$this->order = $this->validateDirection($sortJson[0]->direction);
		}
	}

	private function maxLimit($valor){
		if($valor > $this->limitMax){
			return $this->limitMax;
		} else{ return $valor;}
	}
	
	private function validateDirection($direction){
		$defaultDirections = array('ASC','DESC');
		if( in_array($direction, $defaultDirections) ){
			return $direction;
		}
		else{
			return $defaultDirections[0];
		}
	}
	
	function getPage(){
		return $this->page;
	}
	
	function getStart(){
		return $this->start;
	}
	
	function getLimit(){
		return $this->limit;
	}
	
	function getSort(){
		return $this->sort;
	}
	
	function getOrder(){
		return $this->order;
	}
	
	function setLimitMax($valor){
		$this->limitMax = (int) $valor;
	}
}