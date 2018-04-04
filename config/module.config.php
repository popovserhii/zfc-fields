<?php
namespace Popov\ZfcFields;

return [
    'view_helpers' => [
        'aliases' => [
            'field' => View\Helper\Fields::class,
        ],
        'factories' => [
            View\Helper\Fields::class => View\Helper\Factory\FieldFactory::class,
        ],
    ],

    'dependencies' => [
        'aliases' => [
            'FieldsService' => Service\FieldsService::class,
            'PagesService' => Service\PagesService::class,
            'FieldsPagesService' => Service\FieldsPagesService::class,
        ],
        /*'factories' => [
            'Popov\ZfcFields\Service\FieldsService' => function ($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $service = \Magere\Agere\Service\Factory\Helper::create('fields/fields', $em);

                return $service;
            },
            'Popov\ZfcFields\Service\PagesService' => function ($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $service = \Magere\Agere\Service\Factory\Helper::create('fields/pages', $em);

                return $service;
            },
            'Popov\ZfcFields\Service\FieldsPagesService' => function ($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $service = \Magere\Agere\Service\Factory\Helper::create('fields/fieldsPages', $em);

                return $service;
            },
        ],*/
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
