async function toggleBurgerMenu() {
    const toggle = document.getElementById('burgerMenu');
    const column = document.getElementById('rightColumn');

    toggle.addEventListener('click', function () {
        if (column.classList.contains('hidden')) {
            column.classList.remove('hidden');
        } else {
            column.classList.add('hidden');
        }
    });
};

toggleBurgerMenu()