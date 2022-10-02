const deleteForm = document.querySelectorAll('.delete-form');

deleteForm.forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();

        const hasConfirmed = confirm("You really want to delete this element?");
        if(hasConfirmed) form.submit();
    })
})

