Symfony date & time 
\

https://stackoverflow.com/questions/58544940/how-to-display-a-datepicker-on-symfony


https://symfony.com/doc/current/reference/forms/types/date.html


  {{ dump(app.session.get('basket')) }}
  
  
----

Visit the Tattali CalendarBundle:
https://github.com/tattali/CalendarBundle

but use the more detailed docs page here:
https://github.com/tattali/CalendarBundle/blob/master/src/Resources/doc/doctrine-crud.md




0. Create new project (and 'cd' into that folder)

symfony new --webapp testingLectureDemo2

1. (remove encode entry points lines from inside /templates/base.html.twig)

2. Install the package via Composer

composer require tattali/calendar-bundle

(and say 'yes' to running community recipe)

3. Create entity : Booking

- beginAt: datetime / not nullable - default
- endAt: datetime / nullable = true
- title: string

4. Create db / make migration / run migration

5. Make CRUD (taking default controller name)

symfony console ma:crud Booking

6. Create folder /src/EventSubscriber

7. Create class CalendarSubscriber.php
NOTE: Ensure routre URL is: app_booking_show:
      $bookingEvent->addOption('url', $this->router->generate('app_booking_show', .....
				
								

namespace App\EventSubscriber;

use App\Repository\BookingRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $bookingRepository;
    private $router;

    public function __construct(
        BookingRepository $bookingRepository,
        UrlGeneratorInterface $router
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        $bookings = $this->bookingRepository
            ->createQueryBuilder('booking')
            ->where('booking.beginAt BETWEEN :start and :end OR booking.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($bookings as $booking) {
            // this create the events with your data (here booking data) to fill calendar
            $bookingEvent = new Event(
                $booking->getTitle(),
                $booking->getBeginAt(),
                $booking->getEndAt() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $bookingEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            $bookingEvent->addOption(
                'url',
                $this->router->generate('app_booking_show', [
                    'id' => $booking->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($bookingEvent);
        }
    }
}

8. Create new template: templates/booking/calendar.html.twig
NOTE: Ensure routre URL is: app_booking_new:


{# templates/booking/calendar.html.twig #}
{% extends 'base.html.twig' %}

{% block body %}
    <a href="{{ path('app_booking_new') }}">Create new booking</a>

    <div id="calendar-holder"></div>
{% endblock %}

{% block stylesheets %}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.1.0/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.1.0/main.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.1.0/main.min.css">
{% endblock %}

{% block javascripts %}
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.1.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.1.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.1.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@4.1.0/main.min.js"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            var calendarEl = document.getElementById('calendar-holder');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                defaultView: 'dayGridMonth',
                editable: true,
                eventSources: [
                    {
                        url: "{{ path('fc_load_events') }}",
                        method: "POST",
                        extraParams: {
                            filters: JSON.stringify({})
                        },
                        failure: () => {
                            // alert("There was an error while fetching FullCalendar!");
                        },
                    },
                ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                },
                plugins: [ 'interaction', 'dayGrid', 'timeGrid' ], // https://fullcalendar.io/docs/plugin-index
                timeZone: 'UTC',
            });
            calendar.render();
        });
    </script>
{% endblock %}


9. Add new /booking/calendar/ route method to controller BookingController


   #[Route('/calendar', name: 'booking_calendar', methods: ['GET'])]
    public function calendar(): Response
    {
        return $this->render('booking/calendar.html.twig');
    }
	
	
