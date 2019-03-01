
export default class CollectionDom
{

	constructor () {
		this.count = document.querySelectorAll('.times').length
	}

	addItem (add_collection_button) {
		add_collection_button.addEventListener('click', event => {
			event.preventDefault()
			const timesElement      = document.querySelector('.times')
			this.cloneContainer    =  timesElement.cloneNode(true);
			this.setNameAttribute('select', 'day')
			this.setNameAttribute('input',  'start_hours')
			this.setNameAttribute('input',  'end_hours')
			const container = document.querySelector('.collection')
			container.append(this.cloneContainer)
			this.count++
		})
	}

	setNameAttribute (elementName, property) {
		const selectDay = this.cloneContainer.querySelector('.times > ' + elementName)
		selectDay.setAttribute('name', 'times['+ this.count +']['+ property +']')
	}

}
