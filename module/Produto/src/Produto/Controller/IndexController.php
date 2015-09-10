<?php 

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Produto\Entity\Produto;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\SmtpOptions;

class IndexController extends AbstractActionController {

	public function indexAction() {

		$page = $this->params()->fromRoute('page',1);
		$limit = 1;
		$offset = ($page == 1) ? 0: ($page - 1) * $limit;
		$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
		$repositorio = $em->getRepository("Produto\Entity\Produto");

		$lista = $repositorio->getProdutosPaginados($offset,$limit);

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

	public function editarAction() {
		
		$id = $this->params()->fromRoute('id');
		if(is_null($id)) {
			$id = $this->params()->fromPost('id');
		}



		$em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
		$repositorio = $em->getRepository("Produto\Entity\Produto");
		$produto = $repositorio->find($id);

		if($this->request->isPost()) {
			
			$produto->setNome($this->request->getPost('nome'));
			$produto->setPreco($this->request->getPost('preco'));
			$produto->setDescricao($this->request->getPost('descricao'));

			$em->persist($produto);
			$em->flush();

			$this->flashMessenger()->addMessage('Produto alterar com sucesso!');
			return $this->redirect()->toUrl('/Index/Index');

		}

		$view_params = ['produto' => $produto];
		return new ViewModel($view_params);

	}

	public function contatoAction() {

		if($this->request->isPost()) {

			$nome = $this->request->getPost('nome');
			$email = $this->request->getPost('email');
			$mensagem = $this->request->getPost('msg');

			$message = new Message();
			$message->addTo('renan.saggio@gmail.com')
			->addFrom('renan.saggio@gmail.com')
			->setSubject('Envio de email com zf2');

			$body = $this->getHtmlBody("
				<b>Nome:</b> {$nome}<br />
				<b>Email:</b> {$email}<br />
				<b>Mensagem:</b> {$mensagem}
			");
			
			$transport = $this->getEmailTransport();

			$message->setBody($body);

			$transport->send($message);

			$this->flashMessenger()->addMessage("Email enviado com sucesso.");

		}

		return new ViewModel();
	}

	private function getEmailTransport() {
		$transport = new SmtpTransport();
		$options   = new SmtpOptions(array(
			'host'              => 'smtp.gmail.com',
			'connection_class'  => 'login',
			'connection_config' => array(
				'ssl'       => 'tls',
				'username' => 'renan.saggio@gmail.com',
				'password' => ''
				),
			'port' => 587,
			));

		$transport->setOptions($options);

		return $transport;
	}

	private function getHtmlBody($html) {
		$html = new MimePart($html);
		$html->type = "text/html";

		$body = new MimeMessage();
		$body->addPart($html);

		return $body;
	}


}

?>
