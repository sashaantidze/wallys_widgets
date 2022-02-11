<template>
	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="ml-8 mb-5">
            	<router-link :to="{name: 'add'}" class="text-sm py-1 px-2 bg-gray-200 rounded-lg">Add</router-link>
            </div>

        	<div v-if="packages.length">
        		<div v-for="pack in packages" :key="pack.id" class="mx-auto sm:px-6 lg:px-8 py-2">
	                <div class="bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg flex justify-between">
	                    <div class="p-4">
	                        {{pack.name}} (<span class="font-bold">{{pack.size}}</span> Widgets)
	                    </div>

	                    <div class="flex items-center p-4 space-x-2">
	                        <router-link :to="{name: 'edit', params: {'id': pack.id}}" class="cursor-pointer text-sm bg-blue-500 px-2 py-1 rounded-lg text-white">Edit</router-link>
	                        <div @click="deletePack(pack.id)" class="cursor-pointer text-sm bg-red-500 px-2 py-1 rounded-lg text-white">Delete</div>
	                    </div>
	                </div>
	            </div>
        	</div>
        	<div v-else>
        		<p class="text-center">There are no packages available.</p>
        	</div>


        </div>
    </div>
</template>


<script>

import usePackages from '../api/usePackages'
import { onMounted } from 'vue'

export default {

	setup() {
		const {packages, fetchPackages, deletePackage} = usePackages()


		const deletePack = async (id) => {
			if(!window.confirm('You sure?')) return

			deletePackage(id).then((response) => {
				packages.value = packages.value.filter((pack) => pack.id !== id)
			})
		}

		

		onMounted(fetchPackages)

		return {
			packages,
			fetchPackages,
			deletePack
		}
	}

}

</script>