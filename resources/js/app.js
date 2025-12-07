import './bootstrap';
import Swal from 'sweetalert2';
window.Swal = Swal;

// TODO: Toggle sidebar

const toggleBtn = document.getElementById('toggleBtn');

toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('sidebar-collapsed');
})

// TODO: Toggle password

function attachTogglePassword(inputId, showId, hideId) {
    const field = document.getElementById(inputId);
    const show = document.getElementById(showId);
    const hide = document.getElementById(hideId);

    function toggle() {
        const type = field.type === 'password' ? 'text' : 'password';
        field.type = type;
        show.classList.toggle('hidden');
        hide.classList.toggle('hidden');
    }

    show.addEventListener('click', toggle);
    hide.addEventListener('click', toggle);
}

attachTogglePassword('passwordField', 'passwordShow', 'passwordHidden');
attachTogglePassword('passwordConfirmField', 'passwordConfirmShow', 'passwordConfirmHidden');
