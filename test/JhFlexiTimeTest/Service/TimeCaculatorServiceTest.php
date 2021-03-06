<?php

namespace JhFlexiTimeTest\Service;

use JhFlexiTime\Entity\RunningBalance;
use JhFlexiTime\Options\ModuleOptions;
use JhFlexiTime\Service\PeriodService;
use JhFlexiTime\Service\TimeCalculatorService;
use ZfcUser\Entity\User;
use JhFlexiTime\DateTime\DateTime;

/**
 * Class TimeCalculatorServiceTest
 * @package JhFlexiTimeTest\Service
 * @author Aydin Hassan <aydin@hotmail.co.uk>
 */
class TimeCalculatorServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \JhFlexiTime\Service\TimeCalculatorService
     */
    protected $timeCalculatorService;

    /**
     * @var float
     */
    protected $hoursInDay = 7.5;

    /**
     * @var int
     */
    protected $lunchDuration = 1;

    /**
     * @var \JhFlexiTime\Options\ModuleOptions
     */
    protected $options;

    /**
     * @var \DateTime $date
     */
    protected $date;

    /**
     * @var \JhFlexiTime\Repository\BookingRepositoryInterface
     */
    protected $bookingRepository;

    /**
     * @var \JhFlexiTime\Service\BalanceServiceInterface
     */
    protected $balanceService;

    protected $balanceRepository;

    /**
     * @var \JhFlexiTime\Service\PeriodService
     */
    protected $periodService;

    /**
     * Create Service
     */
    public function setUp()
    {
        $this->date                 = new DateTime;
        $this->bookingRepository    = $this->getMock('JhFlexiTime\Repository\BookingRepositoryInterface');
        $this->balanceRepository    = $this->getMock('JhFlexiTime\Repository\BalanceRepositoryInterface');

        $this->options = new ModuleOptions();
        $this->options->setHoursInDay($this->hoursInDay)
                      ->setLunchDuration($this->lunchDuration);

        $this->periodService = new PeriodService($this->options);

    }

    /**
     * @return TimeCalculatorService
     */
    public function getService(DateTime $today = null)
    {
        $timeCalculatorService = new TimeCalculatorService(
            $this->options,
            $this->bookingRepository,
            $this->balanceRepository,
            $this->periodService,
            $today ? $today : $this->date
        );

        return $timeCalculatorService;
    }

    /**
     * @param float $initialBalance
     * @param float $expectedBalance
     * @param float $monthToDateTotalHours
     * @param float $bookedToDate
     *
     * @dataProvider runningBalanceProvider
     */
//    public function testGetRunningBalance($initialBalance, $expectedBalance, $bookedToDate)
//    {
//
//        $mockUser       = $this->getMock('ZfcUser\Entity\UserInterface');
//        $runningBalance = new RunningBalance();
//        $runningBalance->setBalance($initialBalance);
//
//        $this->balanceRepository->expects($this->once())
//            ->method('findOneByUser')
//            ->with($mockUser)
//            ->will($this->returnValue($runningBalance));
//
//        $this->bookingRepository->expects($this->once())
//             ->method('getMonthBookedToDateTotalByUser')
//             ->with($mockUser, $this->date)
//             ->will($this->returnValue($bookedToDate));
//
//        $balance = $this->getService()->getRunningBalance($mockUser);
//        $this->assertEquals($expectedBalance, $balance);
//    }

    /**
     * @return array
     */
//    public function runningBalanceProvider()
//    {
//        /**
//         * Initial Balance | Expected Balance | Month Booked
//         */
//        return [
//            [0,     -5,          10],
//            [0,     0,           15],
//            [5,     0,           10],
//            [5,     5,           15],
//            [-5,    0,           15],
//            [-5,    -5,          15],
//            [-5,    -10,         10],
//            [-50,   -50,        150],
//            [-50,   -100,       100],
//            [50,    100,        200],
//            [0,     -1.75,      18.25],
//            [-10.5, 0,          30.5],
//
//        ];
//    }

//    public function testGetBalanceForwardReturnsZeroIfNoRowPresent()
//    {
//        $user = new User;
//
//        $this->balanceRepository
//             ->expects($this->once())
//             ->method('findOneByUser')
//             ->with($user)
//             ->will($this->returnValue(null));
//
//        $this->assertEquals(0, $this->getService()->getBalanceForward($user));
//    }

//    public function testGetBalanceForwardReturnsRunningBalance()
//    {
//        $balance    = 25;
//        $user       = new User;
//        $runningBalance = new RunningBalance();
//        $runningBalance->setBalance($balance);
//
//        $this->balanceRepository
//            ->expects($this->once())
//            ->method('findOneByUser')
//            ->with($user)
//            ->will($this->returnValue($runningBalance));
//
//        $this->assertEquals($balance, $this->getService()->getBalanceForward($user));
//    }

//    public function testGetMonthBalanceWithPreviousMonthReturnsFullMonthBalance()
//    {
//        $user       = new User;
//        $this->date = new DateTime("15 May 2014");
//        $date       = new DateTime("4 April 2014");
//        $startDate  = new DateTime('4 March 2014');
//
//        $this->bookingRepository
//             ->expects($this->once())
//             ->method('getMonthBookedTotalByUser')
//             ->with($user, $date)
//             ->will($this->returnValue(40));
//
//        $this->assertEquals(-125.0, $this->getService()->getMonthBalance($user, $startDate, $date));
//    }
//
//    public function testGetMonthBalanceWithSameMonthReturnsToDateBalance()
//    {
//        $user       = new User;
//        $this->date = new DateTime("15 May 2014");
//        $date       = new DateTime("4 May 2014");
//        $startDate  = new DateTime('4 April 2014');
//
//        $this->bookingRepository
//            ->expects($this->once())
//            ->method('getMonthBookedToDateTotalByUser')
//            ->with($user, $this->date)
//            ->will($this->returnValue(40));
//
//        $this->assertEquals(-42.5, $this->getService()->getMonthBalance($user, $startDate, $date));
//    }
//
//    public function testGetMonthBalanceWithFutureMonthDateReturnsZero()
//    {
//        $user       = new User;
//        $this->date = new DateTime("15 May 2014");
//        $date       = new DateTime("16 June 2014");
//        $startDate  = new DateTime('4 March 2014');
//
//        $this->assertEquals(0, $this->getService()->getMonthBalance($user, $startDate, $date));
//    }

//    public function testGetMonthTotalWorkedHoursForPreviousMonth()
//    {
//        $user       = new User;
//        $this->date = new DateTime("15 May 2014");
//        $date       = new DateTime("4 April 2014");
//        $startDate  = new DateTime('4 March 2014');
//
//        $this->bookingRepository
//            ->expects($this->once())
//            ->method('getMonthBookedTotalByUser')
//            ->with($user, $date)
//            ->will($this->returnValue(40));
//
//        $this->assertEquals(40, $this->getService()->getMonthTotalWorked($user, $startDate, $date));
//    }
//
//    public function testGetMonthTotalWorkedHoursForCurrentMonth()
//    {
//        $user       = new User;
//        $this->date = new DateTime("15 May 2014");
//        $date       = new DateTime("15 May 2014");
//        $startDate  = new DateTime('4 March 2014');
//
//        $this->bookingRepository
//            ->expects($this->once())
//            ->method('getMonthBookedToDateTotalByUser')
//            ->with($user, $date)
//            ->will($this->returnValue(40));
//
//        $this->assertEquals(40, $this->getService()->getMonthTotalWorked($user, $startDate, $date));
//    }

    public function testGetWeekTotals()
    {
        $user = new User;
        $date = new DateTime("15 May 2014");

        $week = ['firstDay' => new DateTime("12 May 2014"), 'lastDay' => new DateTime("18 May 2014")];

        $this->bookingRepository
             ->expects($this->once())
             ->method('getTotalBookedBetweenByUser')
             ->with($user, $week['firstDay'], $week['lastDay'])
             ->will($this->returnValue(10));

        $ret = $this->getService()->getWeekTotals($user, $date);

        $expected = [
            'weekTotalWorkedHours'  => 10,
            'weekTotalHours'        => 37.5,
            'balance'               => -27.5
        ];
        $this->assertEquals($expected, $ret);
    }

    public function testGetTotalsForCurrentMonthWhereStartDateWasInAPreviousMonth()
    {
        $user       = new User;
        $startDate  = new DateTime("1 January 2014");
        $today      = new DateTime("2 March 2014");
        $service    = $this->getService($today);

        $this->bookingRepository
            ->expects($this->exactly(1))
            ->method('getTotalBookedBetweenByUser')
            ->with(
                $user,
                $this->equalTo(new DateTime('1 March 2014 00:00:00')),
                $this->equalTo(new DateTime('2 March 2014 00:00:00'))
            )
            ->will($this->returnValue(75));


        $result     = $service->getTotals($user, $startDate, new DateTime("1 March 2014"));

        $expected = [
            'monthTotalWorkedHours' => 75,
            'monthTotalHours'       => 157.5,
            'monthBalance'          => 75.0,
            'runningBalance'        => 0.0,
            'monthRemainingHours'   => 157.5,
            'balanceForward'        => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetTotalsForCurrentMonthWhereStartDateWasInAPreviousMonthWithRunningBalance()
    {
        $user       = new User;
        $startDate  = new DateTime("1 January 2014");
        $today      = new DateTime("2 March 2014");
        $service    = $this->getService($today);

        $this->bookingRepository
            ->expects($this->exactly(1))
            ->method('getTotalBookedBetweenByUser')
            ->with(
                $user,
                $this->equalTo(new DateTime('1 March 2014 00:00:00')),
                $this->equalTo(new DateTime('2 March 2014 00:00:00'))
            )
            ->will($this->returnValue(75));

        $balance = new RunningBalance;
        $balance->setBalance(10);

        $this->balanceRepository
            ->expects($this->once())
            ->method('findOneByUser')
            ->with($user)
            ->will($this->returnValue($balance));

        $result = $service->getTotals($user, $startDate, new DateTime("1 March 2014"));

        $expected = [
            'monthTotalWorkedHours' => 75,
            'monthTotalHours'       => 157.5,
            'monthBalance'          => 75.0,
            'runningBalance'        => 10,
            'monthRemainingHours'   => 157.5,
            'balanceForward'        => 10,
        ];

        $this->assertEquals($expected, $result);
    }




    public function testGetTotalsForCurrentMonthWhereStartDateWasInThisMonth()
    {
        $user       = new User;
        $startDate  = new DateTime("3 February 2014");
        $today      = new DateTime("10 February 2014");
        $service    = $this->getService($today);

        $this->bookingRepository
            ->expects($this->exactly(1))
            ->method('getTotalBookedBetweenByUser')
            ->with(
                $user,
                $this->equalTo(new DateTime('3 February 2014 00:00:00')),
                $this->equalTo(new DateTime('10 February 2014 00:00:00'))
            )
            ->will($this->returnValue(30));


        $result     = $service->getTotals($user, $startDate, new DateTime("20 February 2014"));

        $expected = [
            'monthTotalWorkedHours' => 30,
            'monthTotalHours'       => 150.0,
            'monthBalance'          => -15.0,
            'runningBalance'        => -15.0,
            'monthRemainingHours'   => 112.5,
            'balanceForward'        => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetTotalsForAPreviousMonthWhereStartDateWasInAPreviousMonthToThat()
    {
        $user       = new User;
        $startDate  = new DateTime("1 January 2014");
        $today      = new DateTime("2 March 2014");
        $service    = $this->getService($today);

        $this->bookingRepository
            ->expects($this->exactly(1))
            ->method('getTotalBookedBetweenByUser')
            ->with(
                $user,
                $this->equalTo(new DateTime('1 February 2014 00:00:00')),
                $this->equalTo(new DateTime('28 February 2014 23:59:59'))
            )
            ->will($this->returnValue(75));


        $result     = $service->getTotals($user, $startDate, new DateTime("1 February 2014"));

        $expected = [
            'monthTotalWorkedHours' => 75,
            'monthTotalHours'       => 150.0,
            'monthBalance'          => -75.0,
            'runningBalance'        => 0.0,
            'monthRemainingHours'   => 0,
            'balanceForward'        => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetTotalsForAPreviousMonthWhereStartDateWasInThatMonth()
    {
        $user       = new User;
        $startDate  = new DateTime("4 March 2014");
        $today      = new DateTime("10 April 2014");
        $service    = $this->getService($today);

        $this->bookingRepository
            ->expects($this->exactly(1))
            ->method('getTotalBookedBetweenByUser')
            ->with(
                $user,
                $this->equalTo(new DateTime('4 March 2014 00:00:00')),
                $this->equalTo(new DateTime('31 March 2014 23:59:59'))
            )
            ->will($this->returnValue(75));


        $result     = $service->getTotals($user, $startDate, new DateTime("1 March 2014"));

        $expected = [
            'monthTotalWorkedHours' => 75,
            'monthTotalHours'       => 150.0,
            'monthBalance'          => -75.0,
            'runningBalance'        => -60.0,
            'monthRemainingHours'   => 0,
            'balanceForward'        => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetTotalsBalanceIsZeroIfInFutureMonth()
    {
        $user       = new User;
        $startDate  = new DateTime("4 March 2014");
        $today      = new DateTime("10 April 2014");
        $service    = $this->getService($today);

        $result  = $service->getTotals($user, $startDate, new DateTime("1 June 2014"));

        $expected = [
            'monthTotalWorkedHours' => 0,
            'monthTotalHours'       => 157.5,
            'monthBalance'          => 0,
            'runningBalance'        => -60.0, //because 8 days have not been booked in april
            'monthRemainingHours'   => 157.5,
            'balanceForward'        => 0,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetTotalsBalanceIsZeroIfInFutureMonthWithRunningBalanceAddedOn()
    {
        $user       = new User;
        $startDate  = new DateTime("4 March 2014");
        $today      = new DateTime("10 April 2014");
        $service    = $this->getService($today);

        $balance = new RunningBalance;
        $balance->setBalance(50);

        $this->balanceRepository
            ->expects($this->once())
            ->method('findOneByUser')
            ->with($user)
            ->will($this->returnValue($balance));

        $result  = $service->getTotals($user, $startDate, new DateTime("1 June 2014"));

        $expected = [
            'monthTotalWorkedHours' => 0,
            'monthTotalHours'       => 157.5,
            'monthBalance'          => 0,
            'runningBalance'        => -10, //because 8 days have not been booked in april
            'monthRemainingHours'   => 157.5,
            'balanceForward'        => 50,
        ];

        $this->assertEquals($expected, $result);
    }
}
