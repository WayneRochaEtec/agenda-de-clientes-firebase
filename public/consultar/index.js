const db = new Database();
let rowNumber = 0;

function insertRow(data) {
    rowNumber++;
    const table = document.querySelector('tbody');
    const row = `
        <tr>
            <td>${rowNumber}</td>
            <td>${data.name.toLowerCase()}</td>
            <td>${data.phone}</td>
            <td>${data.origin}</td>
             <td>${new Date(data.contact_date).toLocaleDateString('pt-BR', {timeZone: 'UTC'})}</td>
            <td>${data.note}</td>
            <td>
                <button data-firebase-doc="${data.id}" type="button" class="btn btn-outline-primary edit_client_btn">editar</button>
                <button data-firebase-doc="${data.id}" type="button" class="btn btn-outline-danger delete_client_btn">excluir</button>
            </td>
        </tr>`;

    table.innerHTML += row;
}

function addEventListeners(){
    document.querySelectorAll('.delete_client_btn').forEach((btn) => {
        btn.addEventListener('click', ({target}) => {
            const docID = target.getAttribute('data-firebase-doc');
            db.deleteClient(docID);
            document.querySelector('tbody').innerHTML = '';
            rowNumber = 0;
            fillTable();
        });
    });
    document.querySelectorAll('.edit_client_btn').forEach((btn) => {
        btn.addEventListener('click', ({target}) => {
            const docID = target.getAttribute('data-firebase-doc');
            window.open('../editar/index.html#'+docID);
        });
    });
}

function fillTable(){
    const clients = db.getClientsArray();
    clients.then(clients => {
        clients.forEach(client => insertRow(client));
        addEventListeners();
    });
}

fillTable();
db.setSuccessFc(() => showFlag({
    successMessage: "Cliente deletado com sucesso!",
    successful: true,
    element: document.querySelector('#status-flag')
}));
db.setErrorFc(() => showFlag({
    failMessage: "Ocorreu um erro ao deleter o cliente",
    successful: false,
    element: document.querySelector('#status-flag')
}));