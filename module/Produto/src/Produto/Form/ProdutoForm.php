<?php 
namespace Produto\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class ProdutoForm extends Form {

	public function __construct($name = "") {

		parent::__construct($name);

		$this->setAttribute(array(
			'method' => 'POST',
		));

		/* Criando um input do tipo text */
		$this->add(array(
			'type' => 'Text',
			'name' => 'nome',
			'attributes' => array('class' => 'form-control')
		));

		/* Criando um input do tipo text */
		$this->add(array(
			'type' => 'Number',
			'name' => 'preco',
			'attributes' => array('class' => 'form-control')
		));

		/* Criando um input do tipo text */

		$textarea = new Element\Textarea('descricao');
		$textarea->setAttributes([
			'class' => 'form-control'
		]);
		$this->add($textarea);

	}
}

 ?>
