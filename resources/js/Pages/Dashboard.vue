<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex h-screen overflow-hidden">
        <!-- sidebar -->
        <div class="w-1/4 bg-red-400">
            <div class="py-4 bg-green-900">Your Profile</div>
            <div class="bg-yellow-900 h-full overflow-scroll">
                <div class="bg-lime-200 h-[290px]">test1</div>
                <div class="bg-lime-300 h-[290px]">test2</div>
                <div class="bg-lime-400 h-[290px]">test3</div>
                <div class="bg-lime-500 h-[290px]">test4</div>
                <div class="bg-lime-600 h-[290px]">test5</div>
                <div class="tes">test</div>
            </div>
        </div>
        <!-- ./ sidebar -->

        <!-- content -->
         <div class="w-3/4 bg-blue-200">
            <div class="bg-violet-300 mx-4">sda</div>
            <div class="h-full bg-red-300 justify-center overflow-y-scroll">
                <div class="bg-lime-200 h-[290px]">test1</div>
                <div class="bg-lime-300 h-[290px]">test2</div>
                <div class="bg-lime-400 h-[290px]">test3</div>
                <div class="bg-lime-500 h-[290px]">test4</div>
                <div class="bg-lime-600 h-[290px]">test5</div>
            </div>
            <div class="">tetetet</div>
         </div>
        <!-- ./ content -->
        
    </div>
</template>
