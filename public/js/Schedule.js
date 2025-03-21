document.addEventListener('DOMContentLoaded', function () {
    const calendarContainer = document.getElementById('calendar');

    const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const hours = [
        "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00",
        "19:00", "20:00", "21:00", "22:00", "23:00"
    ];
    const excluded = ["monday-23", "tuesday-23", "wednesday-23", "thursday-23", "friday-23", "saturday-10", "sunday-10", "saturday-11", "sunday-11"]

    const hourElement = document.createElement('div');
    hourElement.classList.add('hour');
    hourElement.textContent = "";
    calendarContainer.appendChild(hourElement);

    daysOfWeek.forEach(day => {
        const dayElement = document.createElement('div');
        dayElement.classList.add('day');
        dayElement.textContent = day;
        calendarContainer.appendChild(dayElement);
    });

    hours.forEach(hour => {
        const hourElement = document.createElement('div');
        hourElement.classList.add('hour');
        hourElement.textContent = hour;
        calendarContainer.appendChild(hourElement);

        daysOfWeek.forEach(day => {
            const hourElement = document.createElement('div');
            hourElement.classList.add('hourWindow');
            hourElement.textContent = "";
            hourElement.id = day.toLowerCase() + "-" + hour.split(":")[0];
            hourElement.onclick = function () {
                reserveSlot(day.toLowerCase(), hour.split(":")[0])
            };
            calendarContainer.appendChild(hourElement);
        });
    });

    excluded.forEach(excluded => {
        const hourExcluded = document.getElementById(excluded)
        hourExcluded.style.backgroundColor = "darkgray"
        hourExcluded.style.cursor = "not-allowed"
        hourExcluded.onclick = null
    })
    getReservations()

    function getReservations() {
        fetch('/getSchedule')
            .then(response => response.json())
            .then(data => {
                Object.entries(data).forEach(([key, value]) => {
                    const field = document.getElementById(key)

                    if (value[0] === value[1]) {
                        field.classList.add("reservedByYou")
                        field.textContent = "Reserved by you"
                        field.onclick = null
                    } else {
                        field.classList.add("reserved")
                        field.textContent = "Reserved"
                        field.onclick = null
                    }

                    field.classList.remove("hourWindow")
                });
            })
            .catch(error => {
                console.error('Error fetching schedule:', error);
            });
    }

    function reserveSlot(day, hour) {
        fetch('/reserveSlot', {
            method: 'POST',
            body: JSON.stringify({day, hour}),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    getReservations()
                    alert('Slot reserved successfully!');
                } else {
                    alert('Error reserving the slot.');
                }
            })
            .catch(error => {
                console.error('Error reserving slot:', error);
            });
    }
});