    (function(){
    const root = document.documentElement;
    const THEME_KEY = 'next_theme';

    /* Tema toggle (opsiyonel) */
    const savedTheme = localStorage.getItem(THEME_KEY) || 'light';
    root.setAttribute('data-bs-theme', savedTheme);
    document.getElementById('themeToggle')?.addEventListener('click', () => {
    const next = root.getAttribute('data-bs-theme') === 'light' ? 'dark' : 'light';
    root.setAttribute('data-bs-theme', next);
    localStorage.setItem(THEME_KEY, next);
});

    /* Dropdown clipping & davranış iyileştirme */
    // 1) Navbar içindeki tüm dropdownlara 'display: static' ver (Popper konum hesaplamasında daha stabil)
    document.querySelectorAll('.topbar .dropdown-toggle').forEach(el=>{
    el.setAttribute('data-bs-display','static');
    el.setAttribute('data-bs-auto-close','outside'); // form/checkbox vs. için rahat kullanım
});

    // 2) Desktop’ta hover ile aç/kapa (mobilde tıklama davranışı korunur)
    const isTouch = () => window.matchMedia('(hover: none)').matches || 'ontouchstart' in window;
    function enableHoverDropdowns(){
    if (window.innerWidth < 992 || isTouch()) return; // sadece lg+ ve non-touch
    document.querySelectorAll('.navbar .dropdown').forEach(drop=>{
    const toggle = drop.querySelector('[data-bs-toggle="dropdown"]');
    if(!toggle) return;
    const instance = bootstrap.Dropdown.getOrCreateInstance(toggle, {autoClose: 'outside', display: 'static'});

    let enterTimer, leaveTimer;
    drop.addEventListener('mouseenter', () => {
    clearTimeout(leaveTimer);
    enterTimer = setTimeout(()=> instance.show(), 80);
});
    drop.addEventListener('mouseleave', () => {
    clearTimeout(enterTimer);
    leaveTimer = setTimeout(()=> instance.hide(), 120);
});
    // Klavye erişilebilirliği
    toggle.addEventListener('keydown', (e)=>{
    if(e.key === 'ArrowDown'){e.preventDefault(); instance.show();}
});
});
}
    enableHoverDropdowns();
    window.addEventListener('resize', () => enableHoverDropdowns());

    /* Aktif link demo (gerçekte route bazlı yap) */
    document.querySelectorAll('.navbar .nav-link').forEach(a=>{
    a.addEventListener('click', () => {
    document.querySelectorAll('.navbar .nav-link.active').forEach(x=>x.classList.remove('active'));
    a.classList.add('active');
});
});
})();
