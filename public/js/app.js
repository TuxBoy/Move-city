import axios from 'axios'
import Map from "./map/Map";
import loadGoogleMapsApi from 'load-google-maps-api'


const map_params = {
	lat    : 46.3630104,
	lng    : 2.9846608,
	zoom : 6
}

let map
loadGoogleMapsApi().then(googleMaps => {
	map = new googleMaps.Map(document.querySelector('#macarte'), {
		center: {
			lat: map_params.lat,
			lng: map_params.lng
		},
		zoom: map_params.zoom
	})


	axios.get('/shop/api').then(response => {

		response.data.forEach(shop => {
			new googleMaps.Marker({
				position : new googleMaps.LatLng(shop.latitude, shop.longitude),
				title: shop.name,
				map: map
			})
		})
	}).catch(error => console.log(error))
}).catch(error => console.error(error) )
