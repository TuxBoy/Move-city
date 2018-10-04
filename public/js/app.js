import axios from 'axios'
import loadGoogleMapsApi from 'load-google-maps-api'
import Marker from "./map/Marker";


const map_params = {
	lat    : 46.3630104,
	lng    : 2.9846608,
	zoom : 6
}

loadGoogleMapsApi({v: '3.exp'}).then(googleMaps => {
	let map    = document.querySelector('#macarte');
	let center = new google.maps.LatLng(map_params.lat, map_params.lng)
	let gmap   = new google.maps.Map(map, {
		scrollwheel: false,
		draggable: true,
		controls: true,
		center: center,
		zoom: 6,
		mapTypeId: googleMaps.MapTypeId.ROADMAP
	})
	axios.get('/shop/api').then(response => {
		response.data.forEach(shop => {
			let marker = new Marker(googleMaps, gmap)
			marker.add(shop.title, shop)
			marker.addListener(shop.description)
		})
	}).catch(error => console.log(error))
}).catch(error => console.error(error) )
