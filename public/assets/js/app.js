(function () {
    const menuToggle = document.querySelector(".menu-toggle")
    menuToggle.onclick = function (e) {
        const body = document.body
        body.classList.toggle('hide-sidebar')
    }
})()