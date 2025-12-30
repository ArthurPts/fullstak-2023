function getSavedTheme() {
    return localStorage.getItem('theme') || 'dark';
}

function applyTheme(theme) {
    $('html').attr('data-theme', theme);
    localStorage.setItem('theme', theme);
    
    // Update active button
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