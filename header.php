<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    function getSavedTheme() {
        return localStorage.getItem('theme') || 'dark';
    }

    function applyTheme(theme) {
        $('html').attr('data-theme', theme);
        localStorage.setItem('theme', theme);

        $('.theme-btn').removeClass('active');
        $(`.theme-btn[data-theme="${theme}"]`).addClass('active');
    }

    $(document).ready(function() {
        const savedTheme = getSavedTheme();

        if ($('.theme-switcher').length === 0) {
            const themeSwitcher = `
            <div class="theme-switcher">
                <button class="theme-btn" data-theme="dark" title="Dark Theme"></button>
                <button class="theme-btn" data-theme="light" title="Light Theme"></button>
            </div>
        `;
            $('body').append(themeSwitcher);
        }

        applyTheme(savedTheme);

        $(document).on('click', '.theme-btn', function() {
            const theme = $(this).data('theme');
            applyTheme(theme);
        });
    });
</script>

<style>
    .navbar {
        background: var(--bg-secondary);
        backdrop-filter: blur(8px);
        padding: 20px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 0 10px var(--shadow-color);
        animation: navGlow 2s infinite alternate;
        transition: background 0.3s ease;
    }

    @keyframes navGlow {
        0% {
            box-shadow: 0 0 6px var(--shadow-color);
        }

        50% {
            box-shadow: 0 0 12px var(--glow-color);
        }

        100% {
            box-shadow: 0 0 6px var(--shadow-color);
        }
    }

    .navbar a {
        color: var(--text-primary);
        text-decoration: none;
        margin: 0 25px;
        font-family: 'Segoe UI', sans-serif;
        font-size: 18px;
        letter-spacing: 1px;
        transition: color 0.3s, transform 0.2s;
    }

    .navbar a:hover {
        color: var(--glow-color);
        transform: scale(1.1);
    }

    .navbar h1 {
        color: var(--text-primary);
        margin: 0;
        font-size: 22px;
        letter-spacing: 1px;
    }

    .nav-links {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<?php
if ($_SESSION['admin'] == 1) { ?>
    <div class="navbar">
        <div class="nav-links">
            <a href="index.php">🏠 Home</a>
            <a href="tampilandosen.php">👨‍🏫 Dosen</a>
            <a href="tampilanmahasiswa.php">🎓 Mahasiswa</a>
            <?php if (isset($_SESSION['login'])): ?>
                <a href="logout.php">🚪 Logout</a>
            <?php endif; ?>
        </div>
    </div>

<?php } else { ?>

    <div class="navbar">
        <div class="nav-links">
            <a href="index.php">🏠 Home</a>
            <a href="tampilangrup.php?search=5"> 🔍 Cari Grup</a>
            <a href="tampilangrup.php?list=5"> 👨‍🏫 Grupmu</a>
            <?php if (isset($_SESSION['login'])): ?>
                <a href="logout.php">🚪 Logout</a>
            <?php endif; ?>
        </div>
    </div>

<?php } ?>