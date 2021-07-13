function openModal() {
    const modalWrapper = document.querySelector('.modal-wrapper')

    modalWrapper
        .classList
            .add('active')

}

function closeModal() {
    const modalWrapper = document.querySelector('.modal-wrapper')
    modalWrapper
        .classList
            .remove('active')
}