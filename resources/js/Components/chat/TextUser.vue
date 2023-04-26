<template>
    <div class="chat chat-start">
         <div class="chat-bubble chat-bubble-primary">Usted: {{chat}}</div>
    </div>
</template>

<script>
export default {
    props: ['chat']
}
</script>
