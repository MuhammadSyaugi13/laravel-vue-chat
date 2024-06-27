<script setup>
    import { ref, onMounted, computed, watch } from 'vue'

    const dataOke = ref('')
    
    onMounted(()=>{
        Echo.channel('hello-channel-event.2').
        listen('HelloEvent', (e) => {
            dataOke.value = e.data
        })
    })
    </script>

<template>

<div class="w-full bg-slate-400">
    <div class="text-center">{{dataOke}}</div>
</div>

</template>