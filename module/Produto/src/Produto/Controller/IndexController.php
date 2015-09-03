<?php 

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Produto\Entity\Produto;

class IndexController extends AbstractActionController {

	public function indexAction() {
		$produtos = [];
		$produtos[] = array('nome' => 'Playstation 4', 'preco' => 2900.00, 'descricao' => 'Video game legal');
		$produtos[] = array('nome' => 'Chinelo Havaianas', 'preco' => 40.00, 'descricao' => 'chinelo da moda');
		$produtos[] = array('nome' => 'iphone 6', 'preco' => 3500.00,'descricao' => 'celular moderno');

		

		$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
		$repositorio = $em->getRepository("Produto\Entity\Produto");
		$lista = $repositorio->findAll();

		$view_params = array('produtos' => $lista);

		return new ViewModel($view_params);
	}

	public function cadastrarAction() {
		
		if($this->request->isPost()) {

			$user = new Produto();
			$user->setNome($this->request->getPost('nome'));
			$user->setPreco($this->request->getPost('preco'));
			$user->setDescricao($this->request->getPost('descricao'));

			$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
			$em->persist($user);
			$em->flush();

			return $this->redirect()->toUrl('/Index/Index');

		}


		return new ViewModel();

	}

	public function deletarAction() {

		$id = $this->params()->fromRoute('id');
		if(is_null($id)) {
			$id = $this->params()->fromPost('id');
		}

		$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
		$repositorio = $em->getRepository("Produto\Entity\Produto");
		$produto = $repositorio->find($id);

		if($this->request->isPost()) {
				
			$em->remove($produto);
			$em->flush();

			return $this->redirect()->toUrl('/Index/Index');

		}

		$view_params = ['produto' => $produto];
		return new ViewModel($view_params);
	}


}

?>
