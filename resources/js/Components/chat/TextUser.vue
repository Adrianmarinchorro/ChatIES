<template>
    <div class="chat chat-start">
         <div class="chat-bubble chat-bubble-primary max-w-80 break-words h-auto">Usted: {{chat}}</div>
    </div>
</template>

<script>
export default {
    props: ['chat']
}
</script>
