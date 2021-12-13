const drawerBtn = document.querySelector('.js-drawer')
const drawerdetails = document.querySelector('.dra-details')
const header = document.querySelector('#container')

function showDrawer(){
    drawerdetails.classList.add('open')
}

function hiddenDrawer(){
    drawerdetails.classList.remove('open')
}

drawerBtn.addEventListener('click',showDrawer)
header.addEventListener('click',hiddenDrawer)