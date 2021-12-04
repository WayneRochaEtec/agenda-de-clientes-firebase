class Database {
    constructor(){
        this.db = firebase.firestore();
        this.successFc = () => {};
        this.errorFc = () => {};
    }

    setSuccessFc(callback){
        this.successFc = callback;
    }

    setErrorFc(callback){
        this.errorFc = callback;
    }
    
    getClient(docID){
        return new Promise((resolve, reject) => {
            this.db.collection('agendamentos').doc(docID)
                .get()
                .then((querySnapshot) => {
                    const client = querySnapshot.data();
                    console.log("Success to got Document!");
                    this.successFc();
                    resolve(client);
                })
                .catch((error) => {
                    this.errorFc();
                    console.error("Error geting document: ", error);
                });
        }); 
    }

    getClientsArray() {
        return new Promise((resolve, reject) => {
            const clients = [];
            this.db.collection("agendamentos").orderBy("name").limit(20)
                .get()
                .then((querySnapshot) => {
                    querySnapshot.forEach((doc) => {
                        const client = {id: doc.id, ...doc.data()};
                        clients.push(client);
                    });
                    resolve(clients);
                })
                .catch((error) => {
                    reject([]);
                });
        });
    }

    deleteClient(docID) {
        this.db.collection('agendamentos').doc(docID).delete()
            .then(() => {
                this.successFc();
            })
            .catch((error) => {
                this.errorFc();
            });
    }

    register(...userData) {
        const [ name, phone, origin, contact_date, note ] = userData;

        this.db.collection("agendamentos").add({
            'name': name,
            'phone': phone,
            'origin': origin,
            'contact_date': contact_date,
            'note': note
        })
        .then((docRef) => {
            console.log("Document written with ID: ", docRef.id);
            this.successFc();
        })
        .catch((error) => {
            console.error("Error adding document: ", error);
            this.errorFc();
        });
    }

    update(docID, ...userData){
        const [ name, phone, origin, contact_date, note ] = userData;

        this.db.collection("agendamentos").doc(docID).update({
            name: name,
            phone: phone,
            origin: origin,
            contact_date: contact_date,
            note: note
        })
        .then(() => {
            console.log("Document successfully updated!");
            this.successFc();
        })
        .catch((error) => {
            console.error("Error updating document: ", error);
            this.errorFc();
        });
    }
}
