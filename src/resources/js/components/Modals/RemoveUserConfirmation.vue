<template>
    <v-dialog v-model="show" max-width="580px" persistent>
        <v-card>
            <v-card-title class="mb-4">
                {{ $t('delete_modal.title') }}
            </v-card-title>
            <v-card-text v-html="$t('delete_modal.description')"/>
            <v-card-actions class="justify-center">
                <v-btn
                    @click="show=false"
                    :disabled="progressing"
                    color="blue darken-1"
                    text>
                    {{ $t('buttons.cancel') }}
                </v-btn>
                <v-btn
                    @click="remove"
                    :loading="progressing"
                    color="blue darken-1"
                    text
                >
                    {{ $t('buttons.confirm') }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {UserModel} from "@/components/Modals/UserModel.js";

export default {
    name: "RemoveUserConfirmation",
    props: {
        value: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
            default: new UserModel(),
        },
    },
    data() {
        return {
            progressing: false,
        };
    },
    computed: {
        show: {
            get() {
                return this.value;
            },
            set(value) {
                this.$emit('input', value);
            },
        },
    },
    methods: {
        remove() {
            this.progressing = true;
            axios.delete('/delete', {
                params: {
                    uuid: this.user.uuid
                },
            })
                .then(() => this.show = false)
                .finally(() => this.progressing = false);
        },
    },
}
</script>

<style scoped>

</style>
