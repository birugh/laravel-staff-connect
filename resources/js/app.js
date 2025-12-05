import './bootstrap';
import Swal from 'sweetalert2';
window.Swal = Swal;

const toggleBtn = document.getElementById('toggleBtn');

toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('sidebar-collapsed');
})