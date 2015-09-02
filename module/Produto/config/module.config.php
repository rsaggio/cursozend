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
);