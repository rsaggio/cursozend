<?php 

namespace Produto\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;
use Produto\Entity\Categoria;

/** @ORM\Entity(repositoryClass="Produto\Entity\Repository\ProdutoRepository")  */
class Produto implements InputFilterAwareInterface {

	/**
	*@ORM\Id
	*@ORM\GeneratedValue(strategy="AUTO")
	*@ORM\Column(type="integer")
	*/
	private $id;

	/** @ORM\Column(type="string") */
	private $nome;

	/** @ORM\Column(type="decimal",scale=2) */
	private $preco;

	/** @ORM\Column(type="string") */
	private $descricao;

	/**
    * @ORM\ManyToOne(targetEntity="Produto\Entity\Categoria")
    * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
    **/
	private $categoria;

	private $inputFilter;


	public function getId() {
		return $this->id;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getPreco() {
		return $this->preco;
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setPreco($preco) {
		$this->preco = $preco;
	}

	public function setDescricao($desc) {
		$this->descricao = $desc;
	}

	public function setCategoria(Categoria $categoria) {
		$this->categoria = $categoria;
	}

	public function setInputFilter(InputFilterInterface $InputFilter) {
		throw new \Exception('não implementado');
	}

	public function getInputFilter() {
		if(!$this->inputFilter) {

			$inputFilter = new InputFilter();

			$inputFilter->add([
				'name' => 'nome',
				'required' => true,
				'filters' => [
					['name' => 'StripTags']
				],
				'validators' => [
					[
						'name' => 'StringLength',
						'options' => [
							'min' => 3,
							'max' => 100,
							'messages' => [
								StringLength::TOO_SHORT => 'O nome deve conter pelo menos 3 letras'
							]
						]
					]
				]
			]);

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}

}

 ?>