<?php
namespace Magere\Fields;

return [
    'view_helpers' => [
        'aliases' => [
            'field' => View\Helper\Fields::class,
        ],
        'factories' => [
            View\Helper\Fields::class => View\Helper\Factory\FieldFactory::class,
        ],
    ],

    'service_manager' => [
        'aliases' => [
            'FieldsService' => 'Magere\Fields\Service\FieldsService',
            'PagesService' => 'Magere\Fields\Service\PagesService',
            'FieldsPagesService' => 'Magere\Fields\Service\FieldsPagesService',
        ],
        'factories' => [
            'Magere\Fields\Service\FieldsService' => function ($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $service = \Magere\Agere\Service\Factory\Helper::create('fields/fields', $em);

                return $service;
            },
            'Magere\Fields\Service\PagesService' => function ($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $service = \Magere\Agere\Service\Factory\Helper::create('fields/pages', $em);

                return $service;
            },
            'Magere\Fields\Service\FieldsPagesService' => function ($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $service = \Magere\Agere\Service\Factory\Helper::create('fields/fieldsPages', $em);

                return $service;
            },
        ],
    ],
    // Doctrine config
    'doctrine' => [
        'driver' => [
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Model' => __NAMESPACE__ . '_driver',
                ],
            ],
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'extension' => '.dcm.yml',
                'paths' => [__DIR__ . '/yaml'],
            ],
        ],
    ],
];
