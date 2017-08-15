<?php

namespace Blog\Model;

class Blog 
{
	public function exchangeArray($data)
	{
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
} 