function getCsrf() {
    var m = document.querySelector('meta[name="csrf-token"]');
    return m ? m.getAttribute('content') : '';
}

/* ── ADMIN: cari jenis motor ─────────────────────────────── */
function cariJenisMotorAdmin(q, merk) {
    var p = new URLSearchParams();
    if (q) p.append('q', q);
    if (merk) p.append('merk', merk);
    fetch('/admin/jenis-motor/cari?' + p, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', Accept: 'application/json' }
    })
        .then(r => r.json())
        .then(data => renderJenisAdmin(data))
        .catch(e => console.error(e));
}

function renderJenisAdmin(list) {
    var tbody = document.getElementById('jenisTableBody');
    if (!tbody) return;
    if (!list.length) {
        tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:32px;color:#aaa;">Tidak ada data.</td></tr>';
        return;
    }
    tbody.innerHTML = list.map(j => {
        var foto = j.foto_url
            ? `<img src="${j.foto_url}" alt="${j.nama_jenis}" style="width:46px;height:38px;object-fit:cover;border-radius:7px;">`
            : '<span style="font-size:50px;color:var(--secondary)">M</span>';
        var bc = j.tersedia > 0 ? 'badge-tersedia' : 'badge-disewa';
        return `<tr>
            <td>${foto}</td>
            <td style="font-weight:600;">${j.nama_jenis}</td>
            <td>${j.merk}</td>
            <td>${j.tipe}</td>
            <td style="color:var(--primary);font-weight:600;">${j.harga_format}</td>
            <td>${j.total_unit} unit</td>
            <td><span class="badge ${bc}">${j.tersedia} tersedia</span></td>
            <td><div class="aksi-btn">
                <a href="${j.unit_url}" class="btn btn-sm btn-success">Unit</a>
                <a href="${j.edit_url}" class="btn btn-sm btn-warning">Edit</a>
                <button onclick="hapusJenis(${j.id},'${j.delete_url}')" class="btn btn-sm btn-danger">Hapus</button>
            </div></td>
        </tr>`;
    }).join('');
}

/* ── CUSTOMER: cari jenis motor ──────────────────────────── */
function cariMotorCustomer(q, merk, status) {
    var p = new URLSearchParams();
    if (q) p.append('q', q);
    if (merk) p.append('merk', merk);
    if (status) p.append('status', status);

    var loading = document.getElementById('loadingMotor');
    var grid = document.getElementById('motorGrid');
    if (loading) loading.style.display = 'block';
    if (grid) grid.style.opacity = '0.5';

    fetch('/customer/rental/cari?' + p, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', Accept: 'application/json' }
    })
        .then(r => r.json())
        .then(data => {
            if (loading) loading.style.display = 'none';
            if (grid) grid.style.opacity = '1';
            renderGridCustomer(data);
        })
        .catch(e => {
            if (loading) loading.style.display = 'none';
            if (grid) grid.style.opacity = '1';
            console.error(e);
        });
}

function renderGridCustomer(list) {
    var grid = document.getElementById('motorGrid');
    if (!grid) return;
    if (!list.length) {
        grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:48px;color:#aaa;">Tidak ada motor ditemukan.</div>';
        return;
    }
    grid.innerHTML = list.map(j => {
        var foto = j.foto_url
            ? `<img src="${j.foto_url}" alt="${j.nama_jenis}">`
            : '<span style="font-size:50px;color:var(--secondary)">M</span>';
        var ada = j.tersedia > 0;
        var bc = ada ? 'badge-tersedia' : 'badge-disewa';
        var bl = ada ? 'Tersedia' : 'Habis';

        var btnSewa = ada
            ? `<a href="${j.sewa_url}" class="btn-card-sw">Sewa</a>`
            : `<button disabled class="btn-card-off">Habis</button>`;

        return `<div class="motor-card">
            <div class="motor-foto">${foto}</div>
            <div class="motor-body">
                <div class="motor-tersedia">
                    <h3 class="motor-nama">${j.nama_jenis}</h3>
                    <span class="badge ${bc}">${bl}</span>
                </div>
                <p class="motor-merk">${j.merk} &bull; ${j.tipe}</p>
                <p class="motor-harga">${j.harga_format}/hari</p>
                <div class="motor-aksi">
                    <a href="${j.detail_url}" class="btn-card-det">Detail</a>
                    ${btnSewa}
                </div>
            </div>
        </div>`;
    }).join('');
}

/* ── TOAST ───────────────────────────────────────────────── */
function toast(pesan, tipe) {
    var old = document.getElementById('toast-app');
    if (old) old.remove();

    var el = document.createElement('div');
    el.id = 'toast-app';
    el.className = 'toast-notif ' + (tipe === 'ok' ? 'toast-success' : 'toast-error');
    el.textContent = pesan;

    document.body.appendChild(el);

    setTimeout(() => {
        el.style.opacity = '0';
        setTimeout(() => el.parentNode && el.parentNode.removeChild(el), 300);
    }, 3000);
}

/* ── DARK MODE ───────────────────────────────────────────── */
(function () {
    if (localStorage.getItem('darkMode') === 'dark') {
        document.body.classList.add('dark');
    }
})();

function toggleDarkMode() {
    var isDark = document.body.classList.toggle('dark');
    localStorage.setItem('darkMode', isDark ? 'dark' : 'light');
    updateDarkIcons(isDark);
}

function updateDarkIcons(isDark) {
    document.querySelectorAll('.dm-icon').forEach(function (el) {
        el.textContent = isDark ? '\u2600' : '\u263D';
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var isDark = document.body.classList.contains('dark');
    updateDarkIcons(isDark);
});

/* ── KALKULASI SEWA OTOMATIS ───────────────────────── */
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('formSewa');
    if (!form) return;

    const harga = parseInt(form.dataset.harga || 0);

    const tglSewa = document.getElementById('tanggalSewa');
    const tglKembali = document.getElementById('tanggalKembali');

    const kalkHari = document.getElementById('kalkHari');
    const kalkTotal = document.getElementById('kalkTotal');

    function hitungTotal() {

        if (!tglSewa.value || !tglKembali.value) {
            kalkHari.textContent = '-';
            kalkTotal.textContent = 'Rp 0';
            return;
        }

        const sewa = new Date(tglSewa.value);
        const kembali = new Date(tglKembali.value);

        const selisih = kembali - sewa;
        const hari = selisih / (1000 * 60 * 60 * 24);

        if (hari <= 0 || isNaN(hari)) {
            kalkHari.textContent = '-';
            kalkTotal.textContent = 'Rp 0';
            return;
        }

        const total = hari * harga;

        kalkHari.textContent = hari + ' Hari';
        kalkTotal.textContent =
            'Rp ' + total.toLocaleString('id-ID');
    }

    tglSewa.addEventListener('change', hitungTotal);
    tglKembali.addEventListener('change', hitungTotal);

    hitungTotal();
});

/* ── METODE PEMBAYARAN SEWA ───────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {

    const metode = document.querySelectorAll('[name="metode_bayar"]');

    if (!metode.length) return;

    function updateMetodePembayaran(value) {

        const rekMandiri = document.getElementById('rekMandiri');
        const rekBRI = document.getElementById('rekBRI');
        const buktiWrap = document.getElementById('buktiWrap');
        const infoTunai = document.getElementById('infoTunai');

        if (!rekMandiri || !rekBRI || !buktiWrap || !infoTunai) return;

        // reset semua
        rekMandiri.classList.remove('show');
        rekBRI.classList.remove('show');
        infoTunai.classList.remove('show');

        rekMandiri.style.display = 'none';
        rekBRI.style.display = 'none';
        buktiWrap.style.display = 'none';
        infoTunai.style.display = 'none';

        // transfer mandiri
        if (value === 'transfer_mandiri') {
            rekMandiri.style.display = 'block';
            buktiWrap.style.display = 'block';
            rekMandiri.classList.add('show');
        }

        // transfer bri
        if (value === 'transfer_bri') {
            rekBRI.style.display = 'block';
            buktiWrap.style.display = 'block';
            rekBRI.classList.add('show');
        }

        // tunai
        if (value === 'tunai') {
            infoTunai.style.display = 'block';
            infoTunai.classList.add('show');
        }
    }

    metode.forEach(function (radio) {
        radio.addEventListener('change', function () {
            updateMetodePembayaran(this.value);
        });
    });

    // state awal
    const checked = document.querySelector('[name="metode_bayar"]:checked');
    if (checked) {
        updateMetodePembayaran(checked.value);
    }

});

/* ── HAMBURGER MENU ──────────────────────────────── */
(function () {
    'use strict';

    function injectHamburgerLines(btn) {
        if (!btn || btn.querySelector('.hb-line')) return;
        var label = btn.textContent.trim() || 'Menu';
        btn.setAttribute('aria-label', label);
        btn.setAttribute('aria-expanded', 'false');
        btn.innerHTML =
            '<span class="hb-line"></span>' +
            '<span class="hb-line"></span>' +
            '<span class="hb-line"></span>';
    }

    /* Toggle buka / tutup menu */
    function toggleMenu(btn, menu) {
        var isOpen = menu.classList.contains('open');
        if (isOpen) {
            menu.classList.remove('open');
            btn.classList.remove('active');
            btn.setAttribute('aria-expanded', 'false');
        } else {
            menu.classList.add('open');
            btn.classList.add('active');
            btn.setAttribute('aria-expanded', 'true');
        }
    }

    /* Tutup menu saat klik di luar container navbar */
    function closeOnOutsideClick(btn, menu, container) {
        document.addEventListener('click', function (e) {
            if (!container.contains(e.target)) {
                menu.classList.remove('open');
                btn.classList.remove('active');
                btn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* Tutup menu saat resize ke ≥ 768px */
    function closeOnResize(btn, menu) {
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                menu.classList.remove('open');
                btn.classList.remove('active');
                btn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {

        /* ── CUSTOMER NAVBAR ───────────────────────────────── */
        var customerNav = document.querySelector('.navbar');
        if (customerNav) {
            var custHam = customerNav.querySelector('.btn-hamburger');
            var navMobile = document.querySelector('.nav-mobile');

            if (custHam && navMobile) {
                injectHamburgerLines(custHam);
                custHam.addEventListener('click', function (e) {
                    e.stopPropagation();
                    toggleMenu(custHam, navMobile);
                });
                closeOnOutsideClick(custHam, navMobile, customerNav);
                closeOnResize(custHam, navMobile);
            }
        }

        /* ── LANDING NAVBAR ────────────────────────────────── */
        var landNav = document.querySelector('.land-navbar');
        if (landNav) {
            var landHam = landNav.querySelector('.btn-hamburger');
            var landMenu = document.querySelector('.land-mobile-menu');

            if (landHam && landMenu) {
                injectHamburgerLines(landHam);
                landHam.addEventListener('click', function (e) {
                    e.stopPropagation();
                    toggleMenu(landHam, landMenu);
                });
                closeOnOutsideClick(landHam, landMenu, landNav);
                closeOnResize(landHam, landMenu);
            }
        }

        /* ── ADMIN SIDEBAR HAMBURGER ──────────────────────── */
        var topbar = document.querySelector('.topbar');

        if (topbar) {
            var adminHam = topbar.querySelector('.btn-hamburger');
            var sidebar = document.querySelector('.sidebar');
            var overlay = document.querySelector('.sidebar-overlay');

            if (adminHam && sidebar) {

                injectHamburgerLines(adminHam);

                adminHam.addEventListener('click', function (e) {
                    e.stopPropagation();

                    sidebar.classList.toggle('open');

                    if (overlay) {
                        overlay.classList.toggle('open');
                    }

                    adminHam.classList.toggle('active');

                    var isOpen = sidebar.classList.contains('open');
                    adminHam.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });

                if (overlay) {
                    overlay.addEventListener('click', function () {
                        sidebar.classList.remove('open');
                        overlay.classList.remove('open');
                        adminHam.classList.remove('active');
                        adminHam.setAttribute('aria-expanded', 'false');
                    });
                }

                window.addEventListener('resize', function () {
                    if (window.innerWidth >= 768) {
                        sidebar.classList.remove('open');

                        if (overlay) {
                            overlay.classList.remove('open');
                        }

                        adminHam.classList.remove('active');
                        adminHam.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        }

        /* ── TUTUP MENU ───────*/
        var mobileLinks = document.querySelectorAll('.nav-mobile a, .land-mobile-menu a');
        mobileLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                var parent = link.closest('.nav-mobile') || link.closest('.land-mobile-menu');
                if (!parent) return;
                var navbar = parent.closest('.navbar') || parent.closest('.land-navbar');
                var ham = navbar ? navbar.querySelector('.btn-hamburger') : null;
                parent.classList.remove('open');
                if (ham) {
                    ham.classList.remove('active');
                    ham.setAttribute('aria-expanded', 'false');
                }
            });
        });

    });

})();

// ===== USER DROPDOWN NAVBAR =====
(function () {
    const trigger = document.getElementById('userDropdownTrigger');
    const card = document.getElementById('userDropdownCard');
    if (!trigger || !card) return;

    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = card.classList.contains('open');
        card.classList.toggle('open', !isOpen);
        trigger.classList.toggle('open', !isOpen);
    });

    // Tutup saat klik di luar
    document.addEventListener('click', function (e) {
        if (!trigger.contains(e.target) && !card.contains(e.target)) {
            card.classList.remove('open');
            trigger.classList.remove('open');
        }
    });

    // Tutup saat tekan Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            card.classList.remove('open');
            trigger.classList.remove('open');
        }
    });
})();


/* ===== USER DROPDOWN ===== */
(function () {
    const wrap = document.getElementById('userDropdownWrap');
    const trigger = document.getElementById('userTrigger');
    if (!wrap || !trigger) return;

    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        wrap.classList.toggle('open');
    });

    // Tutup saat klik di luar
    document.addEventListener('click', function (e) {
        if (!wrap.contains(e.target)) {
            wrap.classList.remove('open');
        }
    });

    // Tutup saat tekan Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') wrap.classList.remove('open');
    });
})();
