<template>
    <Head title="Chat" />
    <AuthenticatedLayout>

        <div class="flex">
            <div class="w-1/6 bg-blue-400 h-96 min-h-full">

            </div>
            <div class="w-5/6">
                <div class="h-96 min-h-full bg-orange-600">
                    <p></p>
                </div>
                <InputChat class=""></InputChat>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputChat from '@/Components/chat/InputChat.vue'

export default {
    components: {
        InputChat , Head, AuthenticatedLayout
    }
}
</script>

