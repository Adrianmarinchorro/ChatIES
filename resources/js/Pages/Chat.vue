<template>
    <Head title="Chat"/>
    <PruebaLayout>

        <div class="flex h-full">

            <div class="w-1/6 bg-blue-400 min-h-full">

            </div>

            <div class="w-5/6 min-h-full bg-orange-600">

                <div class="">
                    <p>
                        p
                    </p>
                </div>

                <InputChat class="absolute bottom-0">

                </InputChat>

            </div>

        </div>
    </PruebaLayout>
</template>

<script>
import PruebaLayout from '@/Layouts/PruebaLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputChat from '@/Components/chat/InputChat.vue'

export default {
    components: {
        InputChat , Head, PruebaLayout
    }
}
</script>

