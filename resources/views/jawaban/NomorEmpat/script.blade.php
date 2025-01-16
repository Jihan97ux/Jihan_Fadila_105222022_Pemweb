<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        fetch('/event/get-json', {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (Array.isArray(data)) {
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: data
                });

                calendar.render();
            } else {
                console.error("Invalid data format:", data);
                alert('Error: Invalid data format received.');
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert('Error fetching event data. Please check the console for details.');
        });
    });
</script>
