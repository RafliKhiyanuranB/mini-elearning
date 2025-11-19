document.addEventListener('DOMContentLoaded', () => {
    const notesForm = document.querySelector('.notes-form');
    if (!notesForm) {
        return;
    }

    notesForm.addEventListener('submit', () => {
        const textarea = notesForm.querySelector('textarea');
        const message = textarea && textarea.value.trim()
            ? 'Catatan tersimpan (dummy). Integrasikan dengan backend untuk persistensi.'
            : 'Isi ringkasan sebelum menyimpan.';

        alert(message);
    });
});

