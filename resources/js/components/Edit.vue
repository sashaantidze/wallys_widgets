<template>
	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
        	<div class="m-3">
	            <router-link class="text-sm py-1 px-2 bg-gray-200 rounded-lg" :to="{name: 'packages'}">Go back</router-link>
	        </div>
            <div class="mt-3">
            	<form @submit.prevent="editPack">
            		<div class="flex flex-row">
            			<div class="mb-6 mx-2 basis-1/2">
						    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Package name</label>
						    <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" placeholder="Name"  v-model='form.name'>
						    <p v-if="errors.name" class="text-sm mt-1 text-red-600">{{errors.name[0]}}</p>
					  	</div>

					  	<div class="mb-6 mx-2 basis-1/2">
						    <label for="size" class="block mb-2 text-sm font-medium text-gray-900">Package size</label>
						    <input type="text" id="size"  class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" placeholder="Size"  v-model="form.size">
						    <p v-if="errors.size" class="text-sm mt-1 text-red-600">{{errors.size[0]}}</p>
					  	</div>

            		</div>

            		<button class="cursor-pointer text-xl bg-orange-600 px-5 py-2 rounded-lg text-white" type="submit">Update</button>
            			
            	</form>
            </div>

        </div>
    </div>
</template>


<script>
import usePackages from '../api/usePackages'
import { onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'

export default {

	setup() {
		const route = useRoute()
		const router = useRouter()
		const ID = route.params.id
		const {fetchPackage, putPackage, pack} = usePackages()
		const errors = ref({})
		const form = ref({
			name: '',
			size: 0
		})

		onMounted(async () => {
			await fetchPackage(ID)

			form.value.size = pack.value.size
			form.value.name = pack.value.name
		})


		const editPack = async () => {
			try {
				await putPackage(ID, form.value)
				router.push({name: 'packages'})
			}
			catch (e) {
				if(e.response.status === 422){
					errors.value = e.response.data.errors
				}
			}
		}

		return {
			fetchPackage,
			pack,
			form,
			errors,
			editPack
		}
	}

}


</script>