<script setup>
    import { ref, onMounted, computed, watch } from 'vue'

    const dataOke = ref('')
    
    onMounted(()=>{
        Echo.channel('hello-channel-event.1').
        listen('HelloEvent', (e) => {
            dataOke.value = e.data
        })
    })
    </script>

<template>

<div class="w-full bg-slate-400">
    <div class="text-center">{{dataOke}}</div>
    <h2>Mantap</h2> 
</div>

</template>