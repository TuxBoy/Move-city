class Map {
	constructor (L) {
		this.L = L
		this.map = null
		this.markers = null
	}

	createMap (x, y, zoom = 1, positions = []) {
		this.map = this.L.map('macarte').setView([x, y], zoom)

		this.L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(this.map)

		// Notre cluster
		this.markers = this.L.markerClusterGroup()

		positions.forEach((pos) => {
			this.addMarker(pos.latitude, pos.longitude)
		})
	}

	addMarker (x, y) {
		this.markers.addLayer(this.L.marker([x, y]))
		// On affiche le cluster
		this.map.addLayer(this.markers)
	}
}
