@extends('layouts.app')

@section('content')
    <div class="container">
{{--        <button class="btn btn-primary change-view" data-view="dayGridMonth">Vista Mese</button>--}}
{{--        <button class="btn btn-secondary change-view" data-view="timeGridWeek">Vista Settimana</button>--}}
{{--        <button class="btn btn-secondary change-view" data-view="timeGridDay">Vista Giorno</button>--}}

        <div id="calendar"></div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script>
        $(document).ready(function () {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                initialView: 'dayGridMonth',
                events: '/interventi-calendar',
                displayEventTime: false,
                editable: true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                dateClick: function(info) {
                    alert('Data selezionata: ' + info.dateStr);
                },
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                eventClick: function (event) {
                    // Reindirizzamento alla pagina di dettaglio dell'intervento con dettaglio di dove parte la chiamata
                    window.location.href = "/interventi/" + event.id + "?from=calendar";
                }

            });
            $('.change-view').on('click', function () {
                var view = $(this).data('view');

                calendar.changeView(view);
            });
        });
    </script>
@endsection
