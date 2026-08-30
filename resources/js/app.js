import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// ─── Dark Mode ────────────────────────────────────────────────
const initDarkMode = () => {
    const root = document.documentElement;
    const stored = localStorage.getItem('theme');
    if (stored === 'dark' || (!stored && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
};

window.toggleDarkMode = () => {
    const root = document.documentElement;
    if (root.classList.contains('dark')) {
        root.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        root.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
};

initDarkMode();

// ─── Alpine Components ────────────────────────────────────────
document.addEventListener('alpine:init', () => {

    // Mobile sidebar
    Alpine.data('mobileMenu', () => ({
        open: false,
        toggle() { this.open = !this.open; },
        close() { this.open = false; },
    }));

    // Search with debounce
    Alpine.data('searchBar', () => ({
        query: '',
        focused: false,
        get hasQuery() { return this.query.trim().length > 0; },
        clear() { this.query = ''; },
    }));

    // Inspection checklist
    Alpine.data('inspectionList', (storageKey = 'cessna172_inspection') => ({
        checked: {},
        init() {
            try {
                const saved = localStorage.getItem(storageKey);
                this.checked = saved ? JSON.parse(saved) : {};
            } catch(e) {
                this.checked = {};
            }
        },
        toggle(id) {
            this.checked[id] = !this.checked[id];
            localStorage.setItem(storageKey, JSON.stringify(this.checked));
        },
        isChecked(id) { return !!this.checked[id]; },
        reset() {
            this.checked = {};
            localStorage.removeItem(storageKey);
        },
        get checkedCount() {
            return Object.values(this.checked).filter(Boolean).length;
        },
    }));

    // Bookmarks
    Alpine.data('bookmarks', () => ({
        items: [],
        init() {
            try {
                this.items = JSON.parse(localStorage.getItem('cessna172_bookmarks') || '[]');
            } catch(e) {
                this.items = [];
            }
        },
        add(title, url, note = '') {
            const bm = { id: Date.now(), title, url, note, date: new Date().toISOString() };
            this.items.unshift(bm);
            this.save();
        },
        remove(id) {
            this.items = this.items.filter(b => b.id !== id);
            this.save();
        },
        save() {
            localStorage.setItem('cessna172_bookmarks', JSON.stringify(this.items));
        },
        has(url) {
            return this.items.some(b => b.url === url);
        },
    }));

    // Figure viewer
    Alpine.data('figureViewer', (imagePath) => ({
        scale: 1,
        fullscreen: false,
        dragging: false,
        startX: 0,
        startY: 0,
        translateX: 0,
        translateY: 0,
        zoomIn()  { this.scale = Math.min(this.scale + 0.25, 4); },
        zoomOut() { this.scale = Math.max(this.scale - 0.25, 0.5); },
        reset()   { this.scale = 1; this.translateX = 0; this.translateY = 0; },
        toggleFullscreen() { this.fullscreen = !this.fullscreen; },
    }));

    // Tab component
    Alpine.data('tabs', (defaultTab = 0) => ({
        active: defaultTab,
        setTab(i) { this.active = i; },
        isActive(i) { return this.active === i; },
    }));

    // Serial number lookup
    Alpine.data('serialLookup', () => ({
        serial: '',
        loading: false,
        result: null,
        error: null,
        async lookup() {
            if (!this.serial.trim()) return;
            this.loading = true;
            this.result = null;
            this.error = null;
            try {
                const res = await fetch(`/models/lookup?serial=${encodeURIComponent(this.serial.trim())}`);
                const data = await res.json();
                if (data.found) {
                    this.result = data.model;
                } else {
                    this.error = 'No matching aircraft found in the available manual data.';
                }
            } catch(e) {
                this.error = 'Lookup failed. Please try again.';
            } finally {
                this.loading = false;
            }
        },
    }));

    // Modal
    Alpine.data('modal', () => ({
        open: false,
        show() { this.open = true; },
        hide() { this.open = false; },
    }));

    // Global Language Switcher (Google Translate Integration - Manual Only)
    Alpine.data('languageSwitcher', () => ({
        currentLang: localStorage.getItem('site_lang') || 'en',
        init() {
            // Do NOT auto translate unless explicitly chosen and cookie matches
            if (this.currentLang === 'en') {
                this.clearGoogleTranslateCookie();
            }
        },
        toggleLanguage() {
            this.currentLang = this.currentLang === 'en' ? 'id' : 'en';
            localStorage.setItem('site_lang', this.currentLang);
            
            if (this.currentLang === 'id') {
                this.applyGoogleLang('id');
            } else {
                this.clearGoogleTranslateCookie();
                // Reload page or reset to English cleanly
                const select = document.querySelector('.goog-te-combo');
                if (select) {
                    select.value = 'en';
                    select.dispatchEvent(new Event('change'));
                }
                window.location.reload();
            }
        },
        clearGoogleTranslateCookie() {
            const host = window.location.hostname;
            const domainParts = host.split('.');
            document.cookie = 'googtrans=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            document.cookie = `googtrans=; Path=/; Domain=${host}; Expires=Thu, 01 Jan 1970 00:00:01 GMT;`;
            if (domainParts.length > 1) {
                document.cookie = `googtrans=; Path=/; Domain=.${host}; Expires=Thu, 01 Jan 1970 00:00:01 GMT;`;
            }
        },
        applyGoogleLang(lang) {
            const host = window.location.hostname;
            document.cookie = `googtrans=/en/${lang}; path=/;`;
            document.cookie = `googtrans=/en/${lang}; path=/; domain=${host}`;
            
            const select = document.querySelector('.goog-te-combo');
            if (select) {
                select.value = lang;
                select.dispatchEvent(new Event('change'));
            } else {
                setTimeout(() => {
                    const s = document.querySelector('.goog-te-combo');
                    if (s) {
                        s.value = lang;
                        s.dispatchEvent(new Event('change'));
                    }
                }, 500);
            }
        }
    }));

    // Inline Paragraph Translator
    Alpine.data('paragraphTranslator', (originalContent = '', originalTitle = '') => ({
        originalContent,
        originalTitle,
        showTranslated: false,
        translatedContent: '',
        translatedTitle: '',
        loading: false,
        error: false,
        get translatedHtml() {
            if (!this.translatedContent) return '';
            return this.translatedContent.replace(/\n/g, '<br>');
        },
        async toggle() {
            if (this.showTranslated) {
                this.showTranslated = false;
                return;
            }

            if (this.translatedContent) {
                this.showTranslated = true;
                return;
            }

            this.loading = true;
            this.error = false;

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                // Translate title if exists
                if (this.originalTitle) {
                    const titleRes = await fetch('/api/translate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ text: this.originalTitle, target: 'id', source: 'en' })
                    });
                    const titleData = await titleRes.json();
                    if (titleData.success) {
                        this.translatedTitle = titleData.translated;
                    }
                }

                // Translate content
                const contentRes = await fetch('/api/translate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ text: this.originalContent, target: 'id', source: 'en' })
                });

                const data = await contentRes.json();
                if (data.success) {
                    this.translatedContent = data.translated;
                    this.showTranslated = true;
                } else {
                    this.error = true;
                }
            } catch (e) {
                console.error('Translation error:', e);
                this.error = true;
            } finally {
                this.loading = false;
            }
        }
    }));
});

// ─── Keyboard shortcuts for manual reader ─────────────────────
document.addEventListener('keydown', (e) => {
    if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
    const prev = document.querySelector('[data-nav="prev"]');
    const next = document.querySelector('[data-nav="next"]');
    if (e.key === 'ArrowLeft' && prev) { e.preventDefault(); prev.click(); }
    if (e.key === 'ArrowRight' && next) { e.preventDefault(); next.click(); }
});

// ─── Debounced search ─────────────────────────────────────────
let searchTimer;
window.debounceSearch = (form, delay = 400) => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => form.submit(), delay);
};

Alpine.start();
