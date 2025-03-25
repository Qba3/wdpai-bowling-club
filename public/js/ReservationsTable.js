async function showReservations() {
    const urlParams = new URLSearchParams(window.location.search);

    const userId = urlParams.get('userId');
    const url = `/src/service/reservation/FetchReservations.php?userId=${userId}`;

    fetch(url, {
        method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (data.length === 0) {
                console.log("No data");
            } else {
                const tbody = document.getElementById('usersTable').getElementsByTagName('tbody')[0];

                data.forEach(reservation => {
                    const row = tbody.insertRow();

                    const reservationId = row.insertCell(0);
                    const day = row.insertCell(1);
                    const hour = row.insertCell(2);
                    const deleteCell = row.insertCell(3);

                    reservationId.textContent = reservation.id;
                    day.textContent = reservation.day;
                    hour.textContent = reservation.hour;

                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = "DELETE";
                    deleteButton.classList.add("action-btn")

                    deleteButton.addEventListener('click', async () => {
                        await fetch('/src/service/reservation/DeleteReservation.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({id: reservation.id})
                        });
                        tbody.removeChild(row);
                    });

                    deleteCell.appendChild(deleteButton);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

showReservations();