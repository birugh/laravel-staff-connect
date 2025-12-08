import './bootstrap';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';

window.Chart = Chart;
window.Swal = Swal;

// TODO: Toggle sidebar

const toggleBtn = document.getElementById('toggleBtn');
const sidebar = document.querySelector('.sidebar');

if (sidebar) {
    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('sidebar-collapsed');
        })
    }

    sidebar.addEventListener('mouseenter', () => {
        setTimeout(() => {
            document.body.classList.remove('sidebar-collapsed');
        }, 100);
    })
    sidebar.addEventListener('mouseleave', () => {
        setTimeout(() => {
            document.body.classList.add('sidebar-collapsed');
            document.querySelectorAll(".sidebar-group").forEach(group => {
                const collapse = group.querySelector(".sidebar-collapse");
                const arrow = group.querySelector(".arrow-icon");

                if (!collapse.classList.contains('hidden')) {
                    collapse.classList.toggle("hidden");
                    arrow.classList.toggle("rotate-180");
                } else {
                    return;
                }
            });
        }, 100);
    })
}






// TODO: Toggle password

function attachTogglePassword(inputId, showId, hideId, type = 'field') {
    const field = document.getElementById(inputId);
    const show = document.getElementById(showId);
    const hide = document.getElementById(hideId);

    if (!field || !show || !hide) {
        return;
    }

    if (type === 'field') {
        function toggle() {
            const type = field.type === 'password' ? 'text' : 'password';
            field.type = type;
            show.classList.toggle('hidden');
            hide.classList.toggle('hidden');
        }

        show.addEventListener('click', toggle);
        hide.addEventListener('click', toggle);
    }
    else if (type === 'label') {
        const originalValue = field.textContent.trim();
        const maskedValue = "*".repeat(originalValue.length);
        field.textContent = maskedValue;

        function toggle() {
            const isMasked = field.textContent === maskedValue;
            field.textContent = isMasked ? originalValue : maskedValue;
            show.classList.toggle('hidden');
            hide.classList.toggle('hidden');
        }

        show.addEventListener('click', toggle);
    }
}

attachTogglePassword('passwordField', 'passwordShow', 'passwordHidden');
attachTogglePassword('passwordConfirmField', 'passwordConfirmShow', 'passwordConfirmHidden');
attachTogglePassword('nikField', 'nikField', 'nikField', 'label');

const el = document.getElementById("messagesChart");

if (el) {
    const chartData = JSON.parse(el.dataset.chart);
    console.log(chartData.data);
    console.log(el.dataset.chart);

    new Chart(el.getContext('2d'), {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Jumlah Pesan per Bulan',
                data: chartData.data,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: '#2563eb',
                borderWidth: 1,
            }]
        },
    });
}

document.querySelectorAll(".sidebar-group").forEach(group => {
    const toggle = group.querySelector(".sidebar-toggle");
    const collapse = group.querySelector(".sidebar-collapse");
    const arrow = group.querySelector(".arrow-icon");

    toggle.addEventListener("click", () => {
        collapse.classList.toggle("hidden");
        arrow.classList.toggle("rotate-180");
    });
});
