document.addEventListener('DOMContentLoaded', function () {
    const chooseButtons = document.querySelectorAll('.choose-table-btn');
    const tableAreaSelect = document.querySelector('#tableAreaSelect');

    chooseButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const selectedTable = button.dataset.table;

            if (tableAreaSelect) {
                tableAreaSelect.value = selectedTable;
                document.querySelector('#booking')?.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const confirmed = confirm('Delete this reservation data?');

            if (!confirmed) {
                event.preventDefault();
            }
        });
    });
});
