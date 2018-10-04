export default class Marker {

	constructor (googleMaps, map) {
		this.map        = map
		this.googleMaps = googleMaps
	}

	add (title, data) {
		this.marker = new this.googleMaps.Marker({
			position : new this.googleMaps.LatLng(data.latitude, data.longitude),
			title    : title,
			map      : this.map
		})
	}

	addListener (content, type = 'click') {
		this.googleMaps.event.addListener(this.marker, type, () => {
			let infowindow = new this.googleMaps.InfoWindow({
				content: content,
				size   : new this.googleMaps.Size(100, 100)
			});
			infowindow.open(this.map, this.marker)
		})
	}

}
