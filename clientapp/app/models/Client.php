<?php

Class Client extends Eloquent{
	public $timestamps = false;

	public function user(){
		return $this->belongsTo('User');
	}
}