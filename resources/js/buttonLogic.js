document.addEventListener('DOMContentLoaded', function () {
    const updateNewsBtn = document.getElementById('updateButton');

    if (updateNewsBtn) {
        updateNewsBtn.addEventListener('click', function () {
            updateNewsBtn.disabled = true;
            updateNewsBtn.classList.add('loading');
            const updateForm = document.getElementById('updateForm');
            if (updateForm) {
                updateForm.submit();
            }
        });


    }
});
