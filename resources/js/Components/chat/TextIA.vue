<template>
    <div class="chat chat-end">
        <div class="chat-bubble chat-bubble-secondary max-w-80 break-words h-auto">
            <p>ChatIES: <span v-html="chat"></span></p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['chat']
}
</script>
