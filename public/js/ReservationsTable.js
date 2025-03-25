async function showReservations() {
    const urlParams = new URLSearchParams(window.location.search);

    const userId = urlParams.get('userId');
    const url = `/src/service/reservation/FetchReservations.php?userId=${userId}`;

    let reservations = []
    fetch(url, {
        method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (data.length === 0) {
                console.log("Brak danych.");
            } else {
                const tbody = document.getElementById('usersTable').getElementsByTagName('tbody')[0];

                data.forEach(reservation => {
                    const row = tbody.insertRow(); 

                    const reservationId = row.insertCell(0);
                    const day = row.insertCell(1);
                    const hour = row.insertCell(2);

                    reservationId.textContent = reservation.user_id;
                    day.textContent = reservation.day;
                    hour.textContent = reservation.hour;
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });


    const tbody = document.getElementById('usersTable').getElementsByTagName('tbody')[0];

    reservations.forEach(user => {
        console.log(user)
        const row = document.createElement('tr');

        const emailCell = document.createElement('td');
        emailCell.textContent = user.email;

        const loginCell = document.createElement('td');
        loginCell.textContent = user.login;

        const roleCell = document.createElement('td');
        roleCell.textContent = user.role;

        const deleteCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.textContent = "DELETE";

        deleteButton.addEventListener('click', async () => {
            await fetch('/src/service/security/DeleteUser.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ login: user.login })
            });
            tbody.removeChild(row);
        });

        const reservationsButton = document.createElement('button');
        reservationsButton.textContent = "RESERVASTIONS";

        reservationsButton.addEventListener('click', async () => {
            const userId = user.id;
            window.location.href = `/userReservations?userId=${userId}`;
        });

        deleteCell.appendChild(reservationsButton);

        deleteCell.appendChild(deleteButton);

        row.appendChild(emailCell);
        row.appendChild(loginCell);
        row.appendChild(roleCell);
        row.appendChild(deleteCell);

        tbody.appendChild(row);
    });
}

showReservations();