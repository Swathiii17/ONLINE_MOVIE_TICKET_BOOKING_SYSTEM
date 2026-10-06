document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('bookingForm');
    if (!form) return;

    const checks = [...form.querySelectorAll('input[name="seats[]"]:not(:disabled)')];
    const selected = document.getElementById('selectedSeats');
    const total = document.getElementById('totalPrice');

    function update() {
        const seats = checks.filter(c => c.checked).map(c => c.value);
        selected.textContent = seats.length ? seats.join(', ') : 'None';
        total.textContent = (seats.length * Number(window.ticketPrice || 0)).toFixed(2);
    }

    checks.forEach(c => c.addEventListener('change', update));

    form.addEventListener('submit', (e) => {
        if (!checks.some(c => c.checked)) {
            e.preventDefault();
            alert('Please select at least one available seat.');
        }
    });
});