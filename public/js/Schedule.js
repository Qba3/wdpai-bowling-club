document.addEventListener('DOMContentLoaded', function () {
    const calendarContainer = document.getElementById('calendar');

    const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    const hours = [
        "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00",
        "19:00", "20:00", "21:00", "22:00", "23:00"
    ];

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
            hourElement.id = hour.split(":")[0] + "-" + day.toLowerCase();
            calendarContainer.appendChild(hourElement);
        });

    });


    // Pobieranie dostępnych bloków godzinowych z backendu
    fetch('/getSchedule') // Zmienna URL do API backendu
        .then(response => response.json())
        .then(data => {
            console.log(data)
            // Załóżmy, że data zawiera tablicę obiektów { day: 'Mon', hour: '10:00', status: 'available' }
            data.forEach(entry => {
                const dayIndex = daysOfWeek.indexOf(entry.day);
                const hourIndex = hours.indexOf(entry.hour);
                const cellIndex = (hourIndex + 1) * 7 + dayIndex + 7; // Obliczamy index w kalendarzu

                const cell = calendarContainer.children[cellIndex];

                // Jeśli blok jest dostępny, dodajemy klasę 'available', w przeciwnym razie 'reserved'
                if (entry.status === 'available') {
                    cell.classList.add('available');
                    cell.addEventListener('click', () => reserveSlot(entry.day, entry.hour));
                } else {
                    cell.classList.add('reserved');
                }
            });
        })
        .catch(error => {
            console.error('Error fetching schedule:', error);
        });

    // Funkcja do rezerwowania slotu
    function reserveSlot(day, hour) {
        // Możesz dodać tutaj wywołanie AJAX do backendu, aby zarezerwować dany blok
        fetch('/path-to-api/reserve-slot', {
            method: 'POST',
            body: JSON.stringify({ day, hour }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
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
