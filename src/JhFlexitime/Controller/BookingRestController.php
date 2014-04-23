<?php

namespace JhFlexiTime\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Validator\Date as DateValidator;
use Zend\View\Model\JsonModel;
use JhFlexiTime\Service\TimeCalculatorService;
use JhFlexiTime\Service\BookingService;

/**
 * Class BookingRestController
 * @package JhFlexiTime\Controller
 * @author Aydin Hassan <aydin@wearejh.com>
 */
class BookingRestController extends AbstractRestfulController
{

    /**
     * @var \JhFlexiTime\Service\BookingService
     */
    protected $bookingService;

    /**
     * @var \JhFlexiTime\Service\TimeCalculatorService
     */
    protected $timeCalculatorService;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @param BookingService $bookingService
     * @param TimeCalculatorService $timeCalculatorService
     */
    public function __construct(
        BookingService $bookingService,
        TimeCalculatorService $timeCalculatorService
    ) {
        $this->bookingService           = $bookingService;
        $this->timeCalculatorService    = $timeCalculatorService;
    }

    /**
     * @param string $month
     * @param string $year
     * @return \DateTime
     */
    public function getDate($month = null, $year = null) {

        if(!$this->date) {
            $validator  = new DateValidator(array('format' => 'M Y'));
            if ($validator->isValid(sprintf("%s %s", $month, $year))) {
                $period = new \DateTime(sprintf('last day of %s %s 23:59:59', $month, $year));
            } else {
                $period = new \DateTime;
            }
            $this->date = $period;
        }

        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return JsonModel
     */
    public function getList()
    {
        $month  = (string) $this->params()->fromQuery('m');
        $year   = (string) $this->params()->fromQuery('y');
        $period = $this->getDate($month, $year);

        $user           = $this->zfcUserAuthentication()->getIdentity();
        $records        = $this->bookingService->getUserBookingsForMonth($user, $period);
        $pagination     = $this->bookingService->getPagination($period);
        $totals         = $this->timeCalculatorService->getTotals($user, $period);

        return new JsonModel(array(
            'bookings' => array(
                'records'   => $records,
                'totals'    => $totals,
                'user'      => $user,
            ),
            'pagination' => $pagination,
            'date'       => $period,
        ));
    }

    /**
     * @param int $id
     * @return JsonModel
     */
    public function get($id)
    {
        $user = $this->zfcUserAuthentication()->getIdentity();
        return new JsonModel(array(
            'booking' => $this->bookingService->getBookingByUserAndId($user, $id),
        ));
    }

    /**
     * @param array $data
     * @return JsonModel
     */
    public function create($data)
    {
        $user           = $this->zfcUserAuthentication()->getIdentity();
        $return         = $this->bookingService->create($data, $user);

        if (is_array($return)) {
            $return['success'] = false;
            return new JsonModel($return);
        }

        return new JsonModel(array(
            'success' => true,
            'booking' => $return,
            'totals'  => $this->timeCalculatorService->getTotals($user, $return->getDate()),
        ));
    }

    /**
     * @param int $id
     * @param array $data
     * @return JsonModel
     */
    public function update($id, $data)
    {
        $user   = $this->zfcUserAuthentication()->getIdentity();
        $return = $this->bookingService->update($id, $data, $user);

        if (is_array($return)) {
            $return['success'] = false;
            return new JsonModel($return);
        }

        return new JsonModel(array(
            'booking' => $return,
            'success' => true,
            'totals'  => $this->timeCalculatorService->getTotals($user, $return->getDate()),
        ));
    }

    /**
     * @param int $id
     * @return JsonModel
     */
    public function delete($id)
    {
        $user = $this->zfcUserAuthentication()->getIdentity();
        try {
            $booking = $this->bookingService->getBookingByUserAndId($user, $id);
        } catch (\Exception $e) {
            return new JsonModel(array(
                'success'   => false,
                'message'   => 'Invalid ID',
            ));
        }

        $this->bookingService->delete($booking);

        return new JsonModel(array(
            'success' => true,
            'totals'  => $this->timeCalculatorService->getTotals($user, $booking->getDate()),
        ));
    }


}
