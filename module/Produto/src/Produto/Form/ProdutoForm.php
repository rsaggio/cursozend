<?php 
namespace Produto\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProdutoForm extends Form implements ObjectManagerAwareInterface{

	protected $objectManager;

	public function __construct(ObjectManager $om,$name = "") {

		parent::__construct($name);

		$this->setObjectManager($om);

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

		/*$this->add(array(
	     'type' => 'Zend\Form\Element\Csrf',
	     'name' => 'csrf',
	     'options' => array(
	             'csrf_options' => array(
	                     'timeout' => 100
	             )
	    )
 		));*/

		$this->add(array(
	        'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
	        'name'    => 'categoria',
	        'attributes' => ['class' => 'form-control'],
	        'options' => array(
	            'object_manager' => $this->getObjectManager(),
	            'target_class'   => 'Produto\Entity\Categoria',
	            'property'       => 'nome',
	            'empty_option'   => '--- escolha ---'
	        ),
    	));

	}

	public function setObjectManager(ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}

	public function getObjectManager() {
		return $this->objectManager;
	}
}

 ?>
