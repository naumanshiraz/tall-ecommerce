import 'preline/preline';

document.addEventListener('livewire:navigated', () => { 
    setTimeout(() => {
        if (window.HSStaticMethods) {
            window.HSStaticMethods.autoInit();
        }
    }, 50);
});