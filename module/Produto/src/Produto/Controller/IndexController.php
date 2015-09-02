<?php 

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

	public function indexAction() {
		$produtos = [];
		$produtos[] = array('nome' => 'Playstation 4', 'preco' => 2900.00, 'descricao' => 'Video game legal');
		$produtos[] = array('nome' => 'Chinelo Havaianas', 'preco' => 40.00, 'descricao' => 'chinelo da moda');
		$produtos[] = array('nome' => 'iphone 6', 'preco' => 3500.00,'descricao' => 'celular moderno');

		$view_params = array('produtos' => $produtos);

		return new ViewModel($view_params);
	}

 }

?>
