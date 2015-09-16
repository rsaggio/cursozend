<?php 

namespace Produto\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator;

/** @ORM\Entity */
class Categoria {

	/**
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/** @ORM\Column(type="string") */
	private $nome;


	function __construct($id = null,$nome = null) {
		$this->nome = $nome;
	}

	public function getNome() {
		return $this->nome;
	}

}

 ?>