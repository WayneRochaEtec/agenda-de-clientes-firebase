function showFlag({successMessage="success", failMessage="fail", successful, element}){
    const flagType = (successful) ? "success" : "danger";
    const flagMessage = (successful) ? successMessage : failMessage;
    const alertElement = `
    <div class="container alert alert-${flagType} alert-dismissible fade show" role="alert">
        ${flagMessage}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;
    
    element.innerHTML = alertElement;
}