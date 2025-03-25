async function fetchUsers() {
    const response = await fetch('/src/service/security/FetchUsers.php');
    const users = await response.json();

    const tbody = document.getElementById('usersTable').getElementsByTagName('tbody')[0];

    users.forEach(user => {
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
        deleteButton.classList.add("action-btn")

        deleteButton.addEventListener('click', async () => {
            await fetch('/src/service/security/DeleteUser.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({login: user.login})
            });
            tbody.removeChild(row);
        });

        const reservationsLink = document.createElement('a');
        reservationsLink.textContent = "RESERVATIONS";
        reservationsLink.classList.add("action-btn")

        const userId = user.id;
        reservationsLink.href = `/userReservations?userId=${userId}`;

        deleteCell.appendChild(reservationsLink);
        deleteCell.appendChild(deleteButton);

        row.appendChild(emailCell);
        row.appendChild(loginCell);
        row.appendChild(roleCell);
        row.appendChild(deleteCell);

        tbody.appendChild(row);
    });
}

fetchUsers();