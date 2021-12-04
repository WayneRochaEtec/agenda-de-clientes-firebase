const db = new Database();

(() => {
    const uri = new DocumentFragment().baseURI;
    const fragmentIndex = uri.search("#");

    db.setErrorFc(() => showFlag({
        failMessage: "Cliente não encontrado",
        successful: false,
        element: document.querySelector('#status-flag')
    }));
    if (fragmentIndex !== -1){
        const urlDocID = uri.slice(fragmentIndex + 1, uri.length);
        const client = db.getClient(urlDocID);
        
        client.then(data => {
            const nameInput = document.getElementById('nameInput');
            const phoneInput = document.getElementById('phoneInput');
            const originInput = document.getElementById('originInput');
            const contact_dateInput = document.getElementById('dateInput');
            const formattedDate = new Date(data.contact_date).toISOString().slice(0, 10);
            const noteInput = document.getElementById('obsInput');

            nameInput.value = data.name;
            phoneInput.value = data.phone;
            originInput.value = data.origin;
            contact_dateInput.value = formattedDate;
            noteInput.value = data.note;

            document.getElementById('confirm-edition-btn').addEventListener('click', () => {
                db.setSuccessFc(() => showFlag({
                    successMessage: "Informações foram alteradas!",
                    successful: true,
                    element: document.querySelector('#status-flag')
                }));
                db.setErrorFc(() => showFlag({
                    failMessage: "Ocorreu algum erro ao atualizar!",
                    successful: false,
                    element: document.querySelector('#status-flag')
                }));

                db.update(
                    urlDocID,
                    nameInput.value,
                    phoneInput.value,
                    originInput.value,
                    new Date(contact_dateInput.value).getTime(),
                    noteInput.value
                );
            });
        });
    }
})();