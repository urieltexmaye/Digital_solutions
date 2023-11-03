document.querySelectorAll('.lbl-menu label').forEach(function(label) {
    label.addEventListener('click', function() {
        document.querySelectorAll('.lbl-menu label').forEach(function(label) {
            label.classList.remove('active');
        });
        label.classList.add('active');
    });
});

// O usando jQuery
// $('.lbl-menu label').on('click', function() {
//     $('.lbl-menu label').removeClass('active');
//     $(this).addClass('active');
// });