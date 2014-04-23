<?php

namespace JhFlexiTime;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),

    //controllers
    'controllers' => array(
        'invokables' => array(
            'JhFlexiTime\Controller\Booking'     => 'JhFlexiTime\Controller\BookingController',
        ),
        'factories' => array(
            'JhFlexiTime\Controller\BookingRest' => 'JhFlexiTime\Controller\Factory\BookingRestControllerFactory',
            'JhFlexiTime\Controller\Settings'    => 'JhFlexiTime\Controller\Factory\SettingsControllerFactory',
        ),
    ),

    //routing
    'router' => array(
        'routes' => array(
            'time' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/booking[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'JhFlexiTime\Controller\Booking',
                        'action'     => 'list',
                    ),
                ),
            ),
            'booking-rest' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/booking-rest[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'JhFlexiTime\Controller\BookingRest',
                    )
                ),
            ),
            'settings' => array(
                'type'      => 'literal',
                'options'   => array(
                    'route' => '/settings',
                    'defaults' => array(
                        'controller' => 'JhFlexiTime\Controller\Settings',
                        'action'     => 'get',
                    ),
                )
            ),
        ),
    ),

    //forms & fieldsets
    'form_elements' => array(
        'factories' => array(
            'JhFlexiTime\Form\BookingForm' => 'JhFlexiTime\Form\Factory\BookingFormFactory'
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'JhFlexiTime\Repository\TimeRepository'          => 'JhFlexiTime\Repository\Factory\TimeRepositoryFactory',
            'JhFlexiTime\Repository\BalanceRepository'       => 'JhFlexiTime\Repository\Factory\BalanceRepositoryFactory',
            'JhFlexiTime\Service\BookingService'             => 'JhFlexiTime\Service\Factory\BookingServiceFactory',
            'JhFlexiTime\Service\TimeCalculatorService'      => 'JhFlexiTime\Service\Factory\TimeCalculatorServiceFactory',
            'JhFlexiTime\Service\PeriodService'              => 'JhFlexiTime\Service\Factory\PeriodServiceFactory',
            'JhFlexiTime\Service\BalanceService'             => 'JhFlexiTime\Service\Factory\BalanceServiceFactory',
            'JhFlexiTime\Listener\BookingSaveListener'       => 'JhFlexiTime\Listener\Factory\BookingSaveListenerFactory',
            'JhFlexiTime\Options\ModuleOptions'              => 'JhFlexiTime\Options\Factory\ModuleOptionsFactory',
            'JhFlexiTime\Options\BookingOptions'             => 'JhFlexiTime\Options\Factory\BookingOptionsFactory',
        ),
        'aliases' => array(
            'JhFlexiTime\ObjectManager'     => 'Doctrine\ORM\EntityManager',
            'FlexiOptions'                  => 'JhFlexiTime\Options\ModuleOptions',
            'BookingOptions'                => 'JhFlexiTime\Options\BookingOptions',
        ),
    ),
    
    //template
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'time/week' => __DIR__ . '/../view/partial/booking-week.phtml',
            'time/edit' => __DIR__ . '/../view/partial/booking-edit.phtml',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'input_filters' => array(
        'factories' => array(
            'JhFlexiTime\InputFilter\BookingInputFilter' => 'JhFlexiTime\InputFilter\Factory\BookingInputFilterFactory',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'bookingClasses' => 'JhFlexiTime\View\Helper\BookingClasses',
        ),
    ),
);
