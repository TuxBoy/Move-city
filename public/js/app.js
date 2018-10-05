import axios from 'axios'
import Marker from "./map/Marker";
import Map from "./map/Map";


const map_params = {
	lat    : 46.3630104,
	lng    : 2.9846608,
	zoom : 6
}
axios.get('/shop/api').then(response => {
	let shops = response.data
	new Map(L, 'macarte').createMap(map_params.lat, map_params.lng, map_params.zoom, shops)
}).catch(error => console.log(error))
