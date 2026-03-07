import 'preline/preline';
import Swal from 'sweetalert2'

window.Swal = Swal

document.addEventListener('livewire:navigated', () => { 
    setTimeout(() => {
        if (window.HSStaticMethods) {
            window.HSStaticMethods.autoInit();
        }
    }, 50);
});