<!-- resources/views/components/full-calendar.blade.php -->
<div class="full-calendar-container">
    <div id="calendar"></div>

    @pushOnce('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar');

                // Debug: Check events data
                // console.log('Calendar Events:', @json($events));

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: @json($events),
                    height: 'auto',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    dayMaxEvents: 3, // Limit events shown per day
                    eventContent: function(info) {
                        const event = info.event;
                        const props = event.extendedProps || {};

                        // console.log('Rendering event:', event.title, props);

                        // Handle Holiday Events
                        if (props.type === 'holiday') {
                            return {
                                html: `
                                <div class="fc-event-inner p-1 bg-red-500 text-white rounded">
                                    <div class="font-bold text-xs text-center">
                                        ${event.title}
                                    </div>
                                </div>
                                `
                            };
                        }

                        // Handle HMIF Events
                        const statusBadge = {
                            upcoming: '<span class="bg-blue-100 text-blue-800 text-xs px-1 py-0.5 rounded">UP</span>',
                            ongoing: '<span class="bg-green-100 text-green-800 text-xs px-1 py-0.5 rounded">ON</span>',
                            completed: '<span class="bg-gray-100 text-gray-800 text-xs px-1 py-0.5 rounded">DONE</span>'
                        };

                        const badge = statusBadge[props.status] ||
                            '<span class="bg-purple-100 text-purple-800 text-xs px-1 py-0.5 rounded">EVENT</span>';
                        const location = props.location || '';

                        return {
                            html: `
                            <div class="fc-event-inner p-1">
                                <div class="flex items-start justify-between mb-1">
                                    <div class="font-medium text-xs truncate flex-1 pr-1">${event.title}</div>
                                    ${badge}
                                </div>
                                ${location ? `
                                                        <div class="text-xs opacity-75 truncate">
                                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                                            ${location}
                                                        </div>
                                                        ` : ''}
                            </div>
                            `
                        };
                    },
                    eventClick: function(info) {
                        const event = info.event;
                        const props = event.extendedProps || {};

                        console.log('Event clicked:', event.title, props);

                        // Handle holiday click
                        if (props.type === 'holiday') {
                            alert(`🎉 ${event.title}\n\n${props.description || 'Hari Libur Nasional'}`);
                            info.jsEvent.preventDefault();
                            return;
                        }

                        // Handle HMIF event click
                        if (event.url) {
                            // If has URL, open in new tab
                            window.open(event.url, '_blank');
                            info.jsEvent.preventDefault();
                        } else {
                            // Show event details
                            let details = `📅 ${event.title}\n\n`;
                            if (props.location) details += `📍 Location: ${props.location}\n`;
                            if (props.status) details += `🏷️ Status: ${props.status.toUpperCase()}\n`;
                            if (event.start) details += `📅 Date: ${event.start.toLocaleDateString()}\n`;

                            alert(details);
                        }

                        info.jsEvent.preventDefault();
                    },
                    eventDidMount: function(info) {
                        const props = info.event.extendedProps || {};

                        // Set custom colors based on event type
                        if (props.type === 'holiday') {
                            info.el.style.backgroundColor = '#dc2626';
                            info.el.style.borderColor = '#dc2626';
                            info.el.style.color = '#ffffff';
                        } else {
                            // Set color based on event color property
                            if (info.event.color) {
                                info.el.style.backgroundColor = info.event.color;
                                info.el.style.borderColor = info.event.color;
                            }
                            if (info.event.textColor) {
                                info.el.style.color = info.event.textColor;
                            }
                        }

                        // Add tooltip
                        const title = props.type === 'holiday' ?
                            `${info.event.title}\n${props.description || 'Hari Libur'}` :
                            `${info.event.title}\n${props.location || ''}\nStatus: ${props.status || 'Event'}`;

                        info.el.setAttribute('title', title);
                    },
                    // Custom event colors
                    eventClassNames: function(info) {
                        const props = info.event.extendedProps || {};

                        if (props.type === 'holiday') {
                            return ['holiday-event'];
                        }

                        // Add class based on status
                        if (props.status) {
                            return [`status-${props.status}`];
                        }

                        return ['hmif-event'];
                    },
                    // Event ordering (holidays first, then by time)
                    eventOrder: function(a, b) {
                        const aProps = a.extendedProps || {};
                        const bProps = b.extendedProps || {};

                        // Holidays first
                        if (aProps.type === 'holiday' && bProps.type !== 'holiday') return -1;
                        if (bProps.type === 'holiday' && aProps.type !== 'holiday') return 1;

                        // Then by title alphabetically
                        return a.title.localeCompare(b.title);
                    }
                });

                calendar.render();

                console.log('FullCalendar rendered successfully');
            });
        </script>

        <style>
            /* Custom CSS for calendar events */
            .fc-event.holiday-event {
                background-color: #dc2626 !important;
                border-color: #dc2626 !important;
                color: white !important;
            }

            .fc-event.status-upcoming {
                background-color: #3b82f6 !important;
                border-color: #2563eb !important;
            }

            .fc-event.status-ongoing {
                background-color: #10b981 !important;
                border-color: #059669 !important;
            }

            .fc-event.status-completed {
                background-color: #6b7280 !important;
                border-color: #4b5563 !important;
            }

            .fc-event.hmif-event {
                color: white !important;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                .fc-event-inner {
                    padding: 1px !important;
                }

                .fc-event-title {
                    font-size: 10px !important;
                }
            }

            /* Calendar container */
            .full-calendar-container {
                background: white;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            /* Header styling */
            .fc-toolbar-title {
                font-size: 1.5rem !important;
                font-weight: 600 !important;
                color: #1f2937 !important;
            }

            .fc-button-primary {
                background-color: #3b82f6 !important;
                border-color: #3b82f6 !important;
            }

            .fc-button-primary:hover {
                background-color: #2563eb !important;
                border-color: #2563eb !important;
            }

            .fc-button-primary:disabled {
                background-color: #9ca3af !important;
                border-color: #9ca3af !important;
            }
        </style>
    @endPushOnce
</div>
