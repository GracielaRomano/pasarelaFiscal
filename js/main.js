$(document).ready(function() {
    // Tabs functionality
    $('.code-tab-btn').click(function() {
        const tabId = $(this).data('tab');
        
        // Remove active class from all buttons and tabs
        $('.code-tab-btn').removeClass('active');
        $('.code-tab').removeClass('active').hide();
        
        // Add active class to clicked button and show corresponding tab
        $(this).addClass('active');
        $(`#${tabId}-code`).addClass('active').show();
    });

    // Activar la primera pestaña por defecto
    $('.code-tab-btn[data-tab="php"]').click();

    // Smooth scroll
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $($(this).attr('href'));
        
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 500);
        }
    });

    // Scroll animations
    $(window).scroll(function() {
        $('.feature-card, .pricing-card').each(function() {
            const elementTop = $(this).offset().top;
            const viewportTop = $(window).scrollTop();
            const windowHeight = $(window).height();

            if (elementTop < (viewportTop + windowHeight - 100)) {
                $(this).addClass('fade-in');
            }
        });
    });

    // Active nav link
    $(window).scroll(function() {
        const scrollPosition = $(window).scrollTop();
        const navHeight = $('.border-b').outerHeight();
        
        if (scrollPosition > navHeight) {
            $('.nav-link').addClass('text-blue-300');
        } else {
            $('.nav-link').removeClass('text-blue-300');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Manejar los clicks en las pestañas de código
    const codeTabs = document.querySelectorAll('.code-tab-btn');
    
    codeTabs.forEach(tab => {
        tab.addEventListener('click', async function() {
            // Remover clase active de todas las pestañas
            codeTabs.forEach(t => t.classList.remove('active'));
            
            // Agregar clase active a la pestaña actual
            this.classList.add('active');
            
            // Obtener el lenguaje seleccionado
            const language = this.getAttribute('data-tab');
            
            try {
                // Realizar la llamada AJAX
                const response = await fetch(`api/code_examples.php?language=${language}`);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                
                // Ocultar todos los tabs de código
                document.querySelectorAll('.code-tab').forEach(tab => {
                    tab.classList.add('hidden');
                });
                
                // Mostrar el tab correspondiente
                const codeTab = document.getElementById(`${language}-code`);
                if (codeTab) {
                    codeTab.classList.remove('hidden');
                    
                    // Actualizar el contenido del código
                    const codeContent = `<pre class="vscode-code font-mono text-sm whitespace-pre-wrap bg-[#1e1e1e] p-4 rounded-lg overflow-x-auto">${data.code}</pre>`;
                    codeTab.innerHTML = codeContent;
                }
            } catch (error) {
                console.error('Error al cargar el código:', error);
            }
        });
    });
    
    // Cargar el código PHP por defecto al iniciar
    document.querySelector('.code-tab-btn[data-tab="php"]').click();
}); 