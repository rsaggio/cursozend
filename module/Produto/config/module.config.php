<?php
return array(
	'router' => array (
		'routes' => array (
			'application' => array (
				'type' => 'Segment',
				'options' => array (
					'route' => '/[:controller[/:action[/:id]]]',
					'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
					'defaults' => array (
						'__NAMESPACE__' => 'Produto\Controller',
						'controller' => 'Index',
						'action' => 'Index'
					),
				),
			),
			'produtos' => array (
				'type' => 'Segment',
				'options' => array (
					'route' => '/Produtos[/:page]',
					'constraints' => array(
                        'page' => '[0-9]*'
                    ),
					'defaults' => array (
						'__NAMESPACE__' => 'Produto\Controller',
						'controller' => 'Index',
						'action' => 'Index',
						'page' => 1
					),
				),
			),
		),
	),
	'controllers' => array(
        'invokables' => array(
            'Produto\Controller\Index' => 'Produto\Controller\IndexController',
            'Produto\Controller\Usuario' => 'Produto\Controller\UsuarioController'
        ),
    ),
    'view_manager' => array (
    	'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
	    'template_map' => array(
	        'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
    	),
    ),

    'doctrine' => array(
  		'driver' => array(
		    'application_entities' => array(
		      'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
		      'cache' => 'array',
		      'paths' => array(__DIR__ . '/../src/Produto/Entity')
			),

	    	'orm_default' => array(
		    	'drivers' => array(
		    	    'Produto\Entity' => 'application_entities'
		    	),
			),
		),
		'authentication' => array(
			'orm_default' => array (
				'object_manager' => 'Doctrine\ORM\EntityManager',
				'identity_class' => 'Produto\Entity\Usuario',
				'identity_property' => 'email',
				'credential_property' => 'senha',
				'credentialCallable' => function ($user, $senha) {
        			return ($user->getSenha() === md5($senha));
     			}
			),
		),
	),
	'view_helpers' => array(
        'invokables'=> array(
            'FlashHelper' => 'Produto\View\Helper\FlashHelper',
            'PaginationHelper' => 'Produto\View\Helper\PaginationHelper'
        )
    ),

	'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),


);