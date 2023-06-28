<template>
    <layout>
        <template v-slot:header>
            {{ $t('project_name') }}
        </template>
        <template>
            <phone-book/>
        </template>
    </layout>
</template>

<script>
import Layout from "@/components/Layout.vue";
import PhoneBook from "@/components/Table/PhoneBook.vue";

export default {
    name: "App",
    components: {
        Layout,
        PhoneBook,
    },
}
</script>

<style scoped>

</style>
