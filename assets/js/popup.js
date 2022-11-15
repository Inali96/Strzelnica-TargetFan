
const popup = document.getElementById('popup1');
const btnClose  = document.getElementById('btnClose');

const show = () => {
        popup.className = "popup show";
};

const hide = () => {
    popup.className = "popup-close hide";
}

btnClose.addEventListener('click', function () {

    popup.className = "popup-close hide";
});
