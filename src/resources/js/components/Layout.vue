<template>
    <v-app>
        <v-container fluid>
            <v-app-bar app>
                <v-toolbar-title>
                    <slot name="header"/>
                </v-toolbar-title>
            </v-app-bar>
            <v-main>
                <div class="d-flex justify-center">
                    <slot/>
                </div>
            </v-main>
        </v-container>
    </v-app>
</template>

<script>
export default {
    name: "AppLayout",
}
</script>

<style scoped>

</style>
