//Star - Ẩn hiện password
const ipnElementOld = document.querySelector('#old-password')
const ipnElemenNew = document.querySelector('#new-password')
const ipnElemenCf = document.querySelector('#cf-new-password')

const btnElementOld = document.querySelector('#btnPasswordOld')
const btnElementNew = document.querySelector('#btnPasswordNew')
const btnElementCf = document.querySelector('#btnPasswordCf')


btnElementOld.addEventListener('click', function() {

  const currentType = ipnElementOld.getAttribute('type')

  ipnElementOld.setAttribute(
    'type',
    currentType === 'password' ? 'text' : 'password'
  )
})

btnElementNew.addEventListener('click', function() {

  const currentType = ipnElemenNew.getAttribute('type')

  ipnElemenNew.setAttribute(
    'type',
    currentType === 'password' ? 'text' : 'password'
  )
})

btnElementCf.addEventListener('click', function() {

  const currentType = ipnElemenCf.getAttribute('type')

  ipnElemenCf.setAttribute(
    'type',
    currentType === 'password' ? 'text' : 'password'
  )
})
//End - Ẩn hiện password