<?php

namespace JhFlexiTimeTest\Service\Factory;

use JhFlexiTime\Service\Factory\TimeCalculatorServiceFactory;

/**
 * Class TimeCalculatorServiceFactoryTest
 * @package JhFlexiTimeTest\Service\Factory
 * @author Aydin Hassan <aydin@wearejh.com>
 */
class TimeCalculatorServiceFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactoryProcessesWithoutErrors()
    {
        $serviceLocator   = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $services         = [
            'FlexiOptions' =>
                $this->getMock('JhFlexiTime\Options\ModuleOptions'),
            'JhFlexiTime\Repository\BookingRepository'  =>
                $this->getMock('JhFlexiTime\Repository\BookingRepositoryInterface'),
            'JhFlexiTime\Repository\BalanceRepository' =>
                $this->getMock('JhFlexiTime\Repository\BalanceRepositoryInterface'),
            'JhFlexiTime\Service\PeriodService' =>
                $this->getMock('JhFlexiTime\Service\PeriodServiceInterface'),
        ];

        $serviceLocator
            ->expects($this->any())
            ->method('get')
            ->will(
                $this->returnCallback(
                    function ($serviceName) use ($services) {
                        return $services[$serviceName];
                    }
                )
            );

        $factory = new TimeCalculatorServiceFactory();
        $this->assertInstanceOf('JhFlexiTime\Service\TimeCalculatorService', $factory->createService($serviceLocator));
    }
}
