import Swal from 'sweetalert2/dist/sweetalert2.js';
window.Swal = Swal;
window.toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});