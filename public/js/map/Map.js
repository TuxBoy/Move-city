export default class Map {

	/**
	 *
	 */
	constructor (map) {
	}

	createMap () {
		positions.forEach((pos) => {
			this.addMarker(pos.latitude, pos.longitude)
		})
	}

	addMarker (latitude, longitude) {
	}
}
