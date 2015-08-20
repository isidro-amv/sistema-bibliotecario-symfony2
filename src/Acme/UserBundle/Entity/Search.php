<?php
// src/Acme/userBundle/Entity/Task.php
	namespace Acme\UserBundle\Entity;

	class Search
	{

		protected $palabras;

    	public function getPalabras()
    	{
    	    return $this->palabras;
    	}

    	public function setPalabras($palabras)
    	{
    	    $this->palabras = $palabras;
    	}
	}

?>