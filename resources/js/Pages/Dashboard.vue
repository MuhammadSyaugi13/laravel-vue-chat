<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <!-- <div class="grid grid-cols-4 gap-4">
        <div class="bg-lime-500">01</div>
        <div class="bg-lime-200">02</div>
        <div class="bg-lime-300">03</div>
        <div class="bg-lime-400">04</div>

        <div class="bg-lime-700">05</div>
        <div class="bg-blue-200">06</div>
        <div class="bg-blue-400 col-span-2 row-span-2">07</div>
        <div class="bg-blue-600">08</div>
        <div class="bg-blue-800">09</div>
    </div> -->

    <!-- <div class="grid grid-rows-22 h-screen">
        <div class="row-span-1 bg-red-500 flex items-center justify-center">Row 1</div>
        <div class="row-span-20 bg-green-500 flex items-center justify-center">Row 2</div>
        <div class="row-span-1 bg-blue-500 flex items-center justify-center">Row 3</div>
    </div> -->

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
                <div class="p-4 border-b border-gray-300 cursor-pointer hover:bg-gray-200">
                    <h2 class="text-lg font-semibold">John Doe</h2>
                    <p class="text-sm text-gray-600">Hey, how's it going?</p>
                </div>
                <!-- Add more conversation items here -->
            </div>
        </div>

        <!-- Chat window -->
        <div class="w-2/3 flex flex-col">
            <div class="p-4 border-b border-gray-300">
                <h2 class="text-xl font-bold">Chat with John Doe</h2>
            </div>
            <div class="flex-grow overflow-y-auto p-4">
                <!-- Example chat messages -->
                <div class="flex mb-4">
                    <div class="bg-blue-500 text-white p-3 rounded-lg max-w-xs ml-auto">Hey, how's it going?</div>
                </div>
                <div class="flex mb-4">
                    <div class="bg-gray-300 text-gray-800 p-3 rounded-lg max-w-xs">Good, thanks! How about you?</div>
                </div>
                <!-- Add more chat messages here -->
            </div>
            <div class="p-4 border-t border-gray-300">
                <div class="flex">
                    <input type="text" class="flex-grow p-2 border border-gray-300 rounded-l-lg" placeholder="Type a message...">
                    <button class="bg-blue-500 text-white p-2 rounded-r-lg">Send</button>
                </div>
            </div>
        </div>
    </div>
</template>
