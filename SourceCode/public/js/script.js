document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('.ri-menu-line').parentElement;
    const nav = document.querySelector('nav');

    menuButton.addEventListener('click', function() {
        nav.classList.toggle('hidden');
        nav.classList.toggle('flex');
        nav.classList.toggle('flex-col');
        nav.classList.toggle('absolute');
        nav.classList.toggle('top-16');
        nav.classList.toggle('right-4');
        nav.classList.toggle('bg-white');
        nav.classList.toggle('shadow-lg');
        nav.classList.toggle('p-4');
        nav.classList.toggle('rounded-lg');
        nav.classList.toggle('z-50');
    });
});
