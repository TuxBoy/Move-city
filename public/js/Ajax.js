const XMLHttpRequest = window.XMLHttpRequest

class Ajax {
	static get (url) {
		return new Promise((resolve, reject) => {
			if (typeof url !== 'string' || url.trim() === '') {
				reject(new Error('You provide an invalid url from Ajax.get() request.'))
			}

			const xhr = new XMLHttpRequest()

			xhr.onreadystatechange = function (event) {
				if (this.readyState === XMLHttpRequest.DONE) {
					if (this.status === 200) {
						resolve(JSON.parse(this.responseText) || this.responseText)
					} else {
						reject(this)
					}
				}
			}

			xhr.open('GET', url)
			xhr.send(null)
		})
	}

	static post (url, data) {
		if (typeof url !== 'string' || url.trim() === '') {
			reject(new Error('You provide an invalid url from Ajax.post() request.'))
		}

		if (typeof data !== 'object') {
			reject(new Error('You provide an invalid data object from Ajax.post() request.'))
		}

		const xhr = new XMLHttpRequest()

		xhr.onreadystatechange = function (event) {
			if (this.readyState === XMLHttpRequest.DONE) {
				if (this.status === 200) {
					resolve(JSON.parse(this.responseText) || this.responseText)
				} else {
					reject(this)
				}
			}
		}

		xhr.open('POST', url, true)
		xhr.send(data)
	}
}
