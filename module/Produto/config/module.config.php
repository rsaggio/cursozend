<?php
return array(
	'router' => array (
		'routes' => array (
			'application' => array (
				'type' => 'Literal',
				'options' => array (
					'route' => '/app',
					'defaults' => array (
						'__NAMESPACE__' => 'Produto\Controller',
						'controller' => 'Index',
						'action' => 'Index'
					),
				),
			),
		),
	),
	'controllers' => array(
        'invokables' => array(
            'Produto\Controller\Index' => 'Produto\Controller\IndexController'
        ),
    ),
    'view_manager' => array (
    	'template_path_stack' => array(
            __DIR__ . '/../view',
        )
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
	),
);