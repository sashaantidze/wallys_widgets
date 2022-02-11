<template>
	<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

            <div class="mt-3">
            	<form @submit.prevent="addPack">
            		<div class="flex flex-row">
            			<div class="mb-6 mx-2 basis-1/2">
						    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Package name</label>
						    <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" placeholder="Name" required v-model='form.name'>
						    <p v-if="errors.name" class="text-sm mt-1 text-red-600">{{errors.name[0]}}</p>
					  	</div>

					  	<div class="mb-6 mx-2 basis-1/2">
						    <label for="size" class="block mb-2 text-sm font-medium text-gray-900">Package size</label>
						    <input type="number" id="size" min="10" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" placeholder="Size" required v-model="form.size">
						    <p v-if="errors.size" class="text-sm mt-1 text-red-600">{{errors.size[0]}}</p>
					  	</div>

            		</div>

            		<button class="cursor-pointer text-xl bg-blue-600 px-5 py-2 rounded-lg text-white" type="submit">Save</button>
            			
            	</form>
            </div>

        </div>
    </div>
</template>


<script>
import usePackages from '../api/usePackages'
import {ref, reactive} from 'vue'
import { useRouter } from 'vue-router'

export default {

	setup() {
		const {addPackage} = usePackages()
		const router = useRouter()
		const errors = ref({})
		const form = ref({
			name: '',
			size: 0
		})

		const addPack = async () => {
			try{
				await addPackage(form.value)
				router.push({name: 'packages'})
			}
			catch (e){
				if(e.response.status === 422){
					errors.value = e.response.data.errors
				}
			}
		}

		return {
			form,
			addPack,
			errors
		}
	}

}

</script>