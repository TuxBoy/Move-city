import axios from 'axios'
import Marker from "./map/Marker";
import CollectionDom from './CollectionDom'
import Map from "./map/Map";


const map_params = {
	lat    : 46.3630104,
	lng    : 2.9846608,
	zoom : 6
}
const map = document.querySelector('#macarte')
if (map) {
	axios.get('/shop/api').then(response => {
		let shops = response.data
		new Map(L, 'macarte').createMap(map_params.lat, map_params.lng, map_params.zoom, shops)
	}).catch(error => console.log(error))
}

const add_collection_button = document.querySelector('#add_collection')
if (add_collection_button) {
	const collection = new CollectionDom()
	collection.addItem(add_collection_button)
}
