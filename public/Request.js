class Request {
    post(url, data, callback = false) {
        const xhttp = new XMLHttpRequest()
        xhttp.onload = function() {
            if (callback !== false) {
                let response_object = JSON.parse(this.responseText)
                if (response_object.status == true) {
                    callback(response_object)
                }
            }
        }
        xhttp.open("POST", url)
        xhttp.send(data)
    }

    get(url, callback = false) {
        const xhttp = new XMLHttpRequest()
        xhttp.onload = function() {
            if (callback !== false) {
                let response_object = JSON.parse(this.responseText)
                if (response_object.status == true) {
                    callback(response_object)
                }
            }
        }
        xhttp.open("GET", url)
        xhttp.send()
    }
}