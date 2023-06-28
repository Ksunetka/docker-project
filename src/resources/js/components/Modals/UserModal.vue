<template>
    <v-dialog v-model="show" max-width="450px" persistent>
        <v-card class="modal-create-tag">
            <v-card-title v-text="title"/>
            <v-card-text>
                <form>
                    <v-text-field
                        v-model="form.lastName"
                        :label="$t('form.last_name')"
                        :rules="rules"
                        :error-messages="errors['lastName']"
                    />
                    <v-text-field
                        v-model="form.firstName"
                        :label="$t('form.first_name')"
                        :rules="rules"
                        :error-messages="errors['firstName']"
                    />
                    <v-text-field
                        v-model="form.surName"
                        :label="$t('form.sur_name')"
                        :rules="rules"
                        :error-messages="errors['surName']"
                    />
                    <v-text-field
                        v-model="form.phone"
                        :label="$t('form.phone')"
                        :rules="rules"
                        :error-messages="errors['phone']"
                    />
                    <v-text-field
                        v-model="form.address"
                        :label="$t('form.address')"
                        :rules="rules"
                        :error-messages="errors['address']"
                    />
                    <v-text-field
                        v-model="form.city"
                        :label="$t('form.city')"
                        :rules="rules"
                        :error-messages="errors['city']"
                    />
                </form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    @click="show = false"
                    :disabled="progressing"
                    depressed
                >
                    {{ $t('buttons.cancel') }}
                </v-btn>
                <v-btn
                    color="primary"
                    @click="createOrUpdate"
                    :loading="progressing"
                    :disabled="progressing"
                >
                    {{ $t('buttons.save') }}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {UserModel} from "@/components/Modals/UserModel.js";

export default {
    name: "UserModal",
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
            form: this.user,
            progressing: false,
            rules: [
                v => !!v || this.$t('validation.required'),
                v => v.length < 255 || this.$t('validation.max'),
            ],
            errors: {},
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
        title() {
            return this.user.uuid ? this.$t('user_modal.edit') : this.$t('user_modal.create');
        },
    },
    methods: {
        createOrUpdate() {
            if (this.user.uuid) {
                this.update();
            } else {
                this.create();
            }
        },
        create() {
            this.progressing = true;
            axios.post('/save', this.form)
                .then(() => this.show = false)
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
                .finally(() => this.progressing = false);
        },
        update() {
            this.progressing = true;
            axios.put('/update', this.form)
                .then(() => this.show = false)
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
                .finally(() => this.progressing = false);
        },
    },
    watch: {
        user() {
            this.form = this.user;
        },
    },
}
</script>

<style scoped>

</style>
