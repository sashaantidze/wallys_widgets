<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="m-3">
            <router-link class="text-sm py-1 px-2 bg-gray-200 rounded-lg" :to="{name: 'packages'}">Go to packages</router-link>
        </div>

        <div class="p-6 bg-white border-b border-gray-200">
            
            <div class="mt-3">
                <form @submit.prevent="calcPacks">
                    <div class="flex flex-row">
                        <div class="mb-6 mx-2 basis-1/2">
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Widgets amount</label>
                            <input type="text" id="amount" class="bg-gray-50 border border-gray-300 text-sm rounded-lg block w-full p-2.5" placeholder="Enter widgets amount" required v-model="amount">
                            <p v-if="errors.amount" class="text-sm mt-1 text-red-600">{{errors.amount[0]}}</p>

                            <button class="cursor-pointer bg-blue-600 p-2.5 mt-3 rounded-lg text-white text-sm" type="submit">Calculate</button>
                        </div>

                        <div class="mb-6 mx-2 basis-1/2">
                            <div v-if="getPacks.packs" class="text-center">
                                <p v-for="(count, pack) in getPacks.packs">{{pack}} Widgets --- {{count}} pack(s)</p>
                            </div>
                        </div>

                    </div>
                        
                </form>
            </div>

        </div>
    </div>
</template>


<script>
import usePackages from '../api/usePackages'
import { ref } from 'vue'

export default {


    setup() {
        const amount = ref()
        const errors = ref({})
        const {getPacks, calculatePacks} = usePackages()


        const calcPacks = async () => {
            try {
                await calculatePacks({amount: amount.value})
            }
            catch (e) {
                console.log(e.response)
                if(e.response.status === 422){
                    errors.value = e.response.data.errors
                }
            }
        }



        return {
            amount,
            calculatePacks,
            calcPacks,
            errors,
            getPacks
        }
    }


}


</script>
