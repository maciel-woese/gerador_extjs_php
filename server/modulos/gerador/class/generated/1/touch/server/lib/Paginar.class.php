<?php
class Paginar{
	
	private $page;
	private $start;
	private $limit;
	private $sort = 'id';
	private $order = 'asc';

	static function maxLimit($valor, $max=25){
		if($valor > $max){ return $max; } else{ return $valor; }
	}
	
	function __construct($post){
		$this->page = (int) $post['page'];
		$this->start = (int) $post['start'];
		$this->limit = (int) self::maxLimit($post['limit']);
		
		if( isset($post['sort']) ){
			$sortJson = json_decode( $post['sort'] );
			$this->sort = trim(rtrim(addslashes($sortJson[0]->property )));
			$this->order = trim(rtrim(addslashes( $sortJson[0]->direction )));
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
}