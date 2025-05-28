<!-- resources/views/components/full-calendar.blade.php -->
<div class="full-calendar-container">
    <div id="calendar"></div>

    @pushOnce('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: @json($events),
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    eventContent: function(info) {
                        const statusBadge = {
                            upcoming: '<span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">UPCOMING</span>',
                            ongoing: '<span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">ONGOING</span>',
                            completed: '<span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">COMPLETED</span>'
                        };

                        return {
                            html: `
                            <div class="fc-event-inner p-2">
                                <div class="flex items-center justify-between">
                                    <div class="font-medium truncate">${info.event.title}</div>
                                    ${statusBadge[info.event.extendedProps.status]}
                                </div>
                                <div class="mt-1 text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    ${info.event.extendedProps.location}
                                </div>
                            </div>
                        `
                        };
                    }
                });
                calendar.render();
            });
        </script>
    @endPushOnce
</div>
