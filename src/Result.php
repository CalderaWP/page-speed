<?php

namespace calderawp\speed;

use calderawp\object\almostStdImmutable;

class Result extends almostStdImmutable
{

	/** @var  int */
	protected $id;

	/** @var  int */
	protected $site;

	/** @var  string */
	protected $url;

	/** @var  int */
	protected $status;

	/** @var  int */
	protected $score;

	/** @var  object */
	protected $result;


	public function __construct( \stdClass $obj = null )
	{
		$this->status = $obj->responseCode;
		$this->result = $obj->pageStats;
		$this->score = $obj->ruleGroups->SPEED->score;
	}
	
	public function set_url( string $url )
	{
		$this->url = $url;
	}

}