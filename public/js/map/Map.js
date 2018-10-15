export default class Map {

	/**
	 * @see https://leafletjs.com/reference-1.3.4.html#marker
	 *
	 * @param L
	 * @param element
	 */
	constructor (L, element) {
		this.L       = L
		this.map     = null
		this.markers = null
		this.element = element
	}

	/**
	 *
	 * @param lat
	 * @param lng
	 * @param zoom
	 * @param shops
	 */
	createMap (lat, lng, zoom = 1, shops = []) {
		this.map = this.L.map(this.element).setView([lat, lng], zoom)
		this.L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(this.map)

		// Notre cluster
		this.markers = this.L.markerClusterGroup()

		shops.forEach((shop) => {
			this.addMarker(shop, {
				title: shop.name
			})
		})
	}

	/**
	 *
	 * @param data
	 * @param options
	 */
	addMarker (data, options) {
		let contentPopupText = data.name + ` <a href="/shop/show?id=${data.id}">En savoir plus</a>`
		const popupContent   = this.L.popup().setLatLng([data.latitude, data.longitude]).setContent(contentPopupText)
		this.markers.addLayer(this.L.marker([data.latitude, data.longitude], options).bindPopup(popupContent).openPopup())
		// On affiche le cluster

		this.map.addLayer(this.markers)
	}
}
