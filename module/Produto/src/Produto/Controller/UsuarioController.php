<?php 

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController {

	public function indexAction() {
		return new ViewModel();
	}

	public function logarAction() {
		 $data = $this->getRequest()->getPost();

	    // If you used another name for the authentication service, change it here
	  	$authService = $this->getAuthService();
	  	$adapter = $this->getAuthAdapter();

	    $adapter->setIdentityValue($data['email']);
	    $adapter->setCredentialValue($data['senha']);
	    $authResult = $authService->authenticate();

	    if ($authResult->isValid()) {
	        return $this->redirect()->toUrl('/Index/Index');
	    }

	    $this->flashMessenger()->addErrorMessage('Login ou senha inválidos');
	    return $this->redirect()->toUrl('/Usuario/Index');

	}

	public function logoutAction() {
		$authService = $this->getAuthService();

		$authService->clearIdentity();

		$this->redirect()->toUrl('/Usuario');
	}

	private function getAuthService() {
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		return $authService;
	}
	private function getAuthAdapter() {
	    $authService = $this->getAuthService();

		$adapter = $authService->getAdapter();

		return $adapter;

	}

}

?>
