export default class Map {
	constructor (L, element) {
		this.L       = L
		this.map     = null
		this.markers = null
		this.element = element
	}

	createMap (lat, lng, zoom = 1, shops = []) {
		this.map = this.L.map(this.element).setView([lat, lng], zoom)

		this.L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(this.map)

		// Notre cluster
		this.markers = this.L.markerClusterGroup()

		shops.forEach((shop) => {
			this.addMarker(shop.latitude, shop.longitude, {
				title: shop.name
			})
		})
	}

	addMarker (lat, lng, options) {
		this.markers.addLayer(this.L.marker([lat, lng], options))
		// On affiche le cluster
		this.map.addLayer(this.markers)
	}
}
