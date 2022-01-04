const ipnElemenNew = document.querySelector('#new_password')
const ipnElemenCf = document.querySelector('#cf_new_password')

const btnElementNew = document.querySelector('#btnPasswordNew')
const btnElementCf = document.querySelector('#btnPasswordCf')


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