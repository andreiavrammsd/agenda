<?php

namespace Array51\AgendaBundle\Service;

use Array51\DataBundle\Repository\EventRepository;
use Array51\AgendaBundle\Exception\InvalidDateException;

class CalendarService extends AbstractBaseService
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * @param EventRepository $eventRepository
     */
    public function setEventRepository(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param string $month Format YYYY-mm
     * @return array
     * @throws InvalidDateException
     */
    public function getMonth($month)
    {
        $date = \DateTime::createFromFormat('Y-m', $month);
        if (false === $date) {
            throw new InvalidDateException(
                'Invalid format for month, required format is YYYY-mm (2015-03)'
            );
        }

        $year = $date->format('Y');
        $month = $date->format('m');

        return $this->eventRepository->getEventsCountByMonthDays($year, $month);
    }
}
