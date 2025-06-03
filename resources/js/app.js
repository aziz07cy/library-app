import Swal from 'sweetalert2/dist/sweetalert2.js';
window.Swal = Swal;
window.toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    showClass: {
        popup: `
          animate__animated
          animate__bounceInRight
          animate__faster
        `
    },
    hideClass: {
        popup: `
          animate__animated
          animate__bounceOutRight
          animate__faster
        `
    },
    timerProgressBar: true,
});