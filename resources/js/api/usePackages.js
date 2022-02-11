import axios from 'axios'
import {ref} from 'vue'

export default function usePackages()
{


	const packages = ref([])
	const pack = ref({})
	const getPacks = ref([])

	const fetchPackages = async () => {
		let response = await axios.get('/api/package')
		packages.value = response.data.data
	}


	const fetchPackage = async (id) => {
		let response = await axios.get(`/api/package/${id}`)
		pack.value = response.data.data
	}


	const addPackage = async (payload) => {
		return await axios.post('/api/package', payload)
	}


	const deletePackage = async (id) => {
		return await axios.delete(`/api/package/${id}`)
	}


	const putPackage = async (id, payload) => {
		return await axios.put(`/api/package/${id}`, payload)
	}


	const calculatePacks = async (payload) => {
		let response = await axios.post('/api/getpacks', payload)
		getPacks.value = response.data.data
	}


	return {
		packages,
		fetchPackages,
		deletePackage,
		addPackage,
		fetchPackage,
		pack,
		putPackage,
		calculatePacks,
		getPacks
	}

}