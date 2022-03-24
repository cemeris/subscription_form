const req = new Request()

const urlParams = new URLSearchParams(window.location.search)
const id = urlParams.get('id');

if (id > 0) {
    req.get('api.php?name=getSingleSubscriber&id=' + id, function (response) {
        const input = document.getElementById('subscription_name')
        input.value = response.entity.name

        document.getElementById('subscription_email').value = response.entity.email
        document.getElementById('subscription_id').value = response.entity.id
    })
}

document.querySelector('form').onsubmit = function(event) {
    event.preventDefault()
    if(document.getElementById('subscription_check').checked) {
        const url = this.getAttribute('action')
        let form = this;
        req.post(url, new FormData(this), function (response) {
            console.log(response)
            document.getElementById('message').textContent = ''
        })
    }
    else {
        document.getElementById('message').textContent = "please check the checkbox!"
    }
}
/**
 UZDEVUMU RISINĀŠANAS ALGORITMS
 1. Jāsaprot uzdevums. Precizējam.
Jāpeņem vērtība no response un jāievieto iekš input value.



 2. QA. Kur? Kas? Idejas.
 3. Saskaldīt uzdevumu
  Name
    ✅ - atrodam vērtību no response objekta
    
    ✅ - atrodam pareizo input elementu
    ✅ - ievietojam iekš input value
  Email
 */
