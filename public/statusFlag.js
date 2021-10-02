function showFlag({succesMsg, failMsg, element}){
    const uri = new DocumentFragment().baseURI;
    const fragmentIndex = uri.search("#");

    if (fragmentIndex !== -1){
        const fragment = uri.slice(fragmentIndex + 1, uri.length);
        const flagType = (fragment == 'success') ? "success" : "danger";
        const flagMessage = (fragment == 'success') ? succesMsg : failMsg;
        const alertElement = `
        <div class="container alert alert-${flagType} alert-dismissible fade show" role="alert">
            ${flagMessage}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        
        element.outerHTML = alertElement;
    }
}