(() => {

document.getElementById('submit').addEventListener('click', () => {
    const name = document.getElementById('nameInput').value;
    const phone = document.getElementById('phoneInput').value;
    const origin = document.getElementById('originInput').value;
    const date = (() => {
        const elValue = document.getElementById('dateInput').value;
        return new Date(elValue).getTime();
    })();
    const obs = document.getElementById('obsInput').value;
    const firebase = new Database();

    firebase.setSuccessFc(() => showFlag({
        successMessage: "Cliente cadastrado com sucesso!",
        successful: true,
        element: document.querySelector('#status-flag')
    }));
    firebase.setErrorFc(() => showFlag({
        failMessage: "Ocorreu um erro ao cadastrar",
        successful: false,
        element: document.querySelector('#status-flag')
    }));

    firebase.register(name, phone, origin, date, obs);
});

document.querySelector('#dateInput').valueAsDate = new Date();
})();