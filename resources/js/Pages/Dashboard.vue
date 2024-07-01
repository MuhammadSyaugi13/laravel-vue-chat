<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, watch, computed } from 'vue'

const roomId = ref(false)
const friendId = ref(false)
const messages = ref([])

const daftarRoom = ref(false)
const daftarMessage = ref(false)

const openRoom = (friend_id) => {

    friendId.value = friend_id

    axios.post(route('room.create'), {
        friend_id,
    }).then(res => {
        const data = res.data
        daftarRoom.value = data.dataRoom
        daftarMessage.value = data.dataMessage

        messageEvent(daftarRoom.value?.id)

    }).catch(err => {
        Toast.fire({
            icon: 'error',
            title: `Data:\n${err.message}`
        })
        disabledFilter.value = false
    })
}

const dataListen = ref('')

const messageEvent = (roomId) => {
    Echo.join(`chat.${roomId}`)
    .here((users) => {
        console.log("join room success");
    })
    .listen('SendMessage', (e)=>{
        console.log(e);
        dataListen.value = e
        if(e.userId == friendId.value){

            messages.value.push({
                message: e.message,
                position: "left"
            })
        } 
    })
    .joining((user) => {
        console.log(user.name);
    })
    .leaving((user) => {
        console.log(user.name);
    })
    .error((error) => {
        console.error('error');
        console.error(error);
    });
}

const message = ref('')
const saveMessage = () => {

    if (message.value == "") return;

    messages.value.push({
        message: message.value,
        position: "right"
    })

    const messageParam = message.value
    message.value = messageParam

    axios.post(route('chat.save'), {
        roomId: daftarRoom.value?.id,
        message: messageParam
    }).then(res => {
        message.value = ""

    }).catch(err => {
        Toast.fire({
            icon: 'error',
            title: `gagal kirim chat:\n${err.message}`
        })
    })
}

const friends = ref(false)
const isDaftarFriendsLoading = ref(false)
const getFriends = () => {
    isDaftarFriendsLoading.value = true
    axios.get(route("chat.index")).then(res => {
        const data = res.data
        friends.value = data
        isDaftarFriendsLoading.value = false
    }).catch(err => {
        Toast.fire({
            icon: 'error',
            title: `error getFriends:\n${err.message}`
        })
        isDaftarFriendsLoading.value = false
    })
}

onMounted(() => {
    getFriends()
})

</script>

<template>

    <div class="bg-gray-500 h-screen flex">

        <!-- Sidebar for conversations list -->
        <div class="w-1/3 bg-white border-r border-gray-300 flex flex-col">
            <div class="p-4 border-b border-gray-300">
                <h1 class="text-xl font-bold">Conversations</h1>
                <hr class="my-4">
                <input class="w-full rounded-full border-2" placeholder="pencarian..." type="text">
            </div>
            <div class="flex-grow overflow-y-auto">

                <!-- Example conversation item -->
                <div v-if="friends && !isDaftarFriendsLoading" v-for="(d, i) in friends" @click="openRoom(d.id)" class="p-4 border-b border-gray-300 cursor-pointer hover:bg-gray-200">
                    <h2 class="text-lg font-semibold">{{ d.name }}</h2>
                    <p class="text-sm text-gray-600">Hey, how's it going?</p>
                </div>
                <div v-else-if="isDaftarFriendsLoading" class="p-4">
                    <h2 class="text-lg font-semibold text-center">Sedang mengunduh percakapan...</h2>
                </div>
                <div v-else class="p-4">
                    <h2 class="text-lg font-semibold text-center">Mulai Percakapan</h2>
                </div>


                <!-- Add more conversation items here -->
            </div>
        </div>

        <!-- Chat window -->
        <div class="w-2/3 flex flex-col">
            <div class="p-4 border-b border-gray-300">
                <h2 class="text-xl font-bold">Chat with John Doe</h2>
            </div>

            <div v-if="messages.length != 0" class="flex-grow overflow-y-auto p-4">
                <!-- Example chat messages -->
                 <!--Pesan kanan  -->
                <div v-for="(d, i) in messages" class="flex mb-4">
                    <div v-if="d.position == 'right'" class="bg-blue-500 text-white p-3 rounded-lg max-w-xs ml-auto">{{d.message}}</div>
                    <div v-else class="bg-gray-300 text-gray-800 p-3 rounded-lg max-w-xs">{{d.message}}</div>
                </div>

                <!--Pesan kiri  -->
                <!-- <div v-else class="flex mb-4">
                    <div class="bg-gray-300 text-gray-800 p-3 rounded-lg max-w-xs">{{d.message}}</div>
                </div> -->
                <!-- Add more chat messages here -->
            </div>
            <div v-else class="flex-grow overflow-y-auto p-4">
                <div class="flex mb-4">
                    <div class="text-center font-bold text-slate-100 p-3 rounded-lg w-full">Mulai percakapan</div>
                </div>
            </div>

            <div class="p-4 border-t border-gray-300">
                <div class="flex">
                    <input v-model="message" @keyup.enter="saveMessage()" type="text" class="flex-grow p-2 border border-gray-300 rounded-l-lg" placeholder="Type a message...">
                    <button class="bg-blue-500 text-white p-2 rounded-r-lg">Send</button>
                </div>
            </div>
        </div>
        <!-- ./ Chat window -->
    </div>
</template>
