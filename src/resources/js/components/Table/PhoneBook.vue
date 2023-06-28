<template>
    <v-card width="70%" class="phonebook-table">
        <v-card-title class="d-flex justify-space-between">
            <v-spacer/>
            <v-btn color="primary" @click="isShowUserModal = true" class="ml-8">
                {{ $t('buttons.add') }}
            </v-btn>
        </v-card-title>
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="items"
                :no-data-text="$t('table.no_data_text')"
                :loading-text="$t('table.loading_text')"
                :no-results-text="$t('table.no_results_text')"
                :footer-props="footerProps"
            >
                <template v-for="(col, i) in filters" v-slot:[`header.${i}`]="{ header }">
                    <span class="d-inline-block py-4">{{ header.text }}</span>
                    <div class="filter-icon">
                        <filter-menu
                            v-model="activeFilters[header.value]"
                            :items="filters[header.value]"
                        />
                    </div>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="showModal(item)">
                        mdi-pencil
                    </v-icon>
                    <v-icon small @click="showConfirmModal(item)">
                        mdi-delete
                    </v-icon>
                </template>
                <template #footer.page-text="props">
                    {{ props.pageStart }}-{{ props.pageStop }} {{ $t('table.footer.of') }} {{ props.itemsLength }}
                </template>
            </v-data-table>
            <user-modal
                v-model="isShowUserModal"
                :user="user"
                @input="reset"
            />
            <remove-user-confirmation
                v-model="isShowConfirmModal"
                :user="user"
                @input="reset"
            />
        </v-card-text>
    </v-card>
</template>

<script>
import FilterMenu from "@/components/Filter/FilterMenu.vue";
import UserModal from "@/components/Modals/UserModal.vue";
import RemoveUserConfirmation from "@/components/Modals/RemoveUserConfirmation.vue";
import {UserModel} from "@/components/Modals/UserModel.js";

export default {
    name: "PhoneBook",
    components: {
        FilterMenu,
        UserModal,
        RemoveUserConfirmation,
    },
    data() {
        return {
            users: [],
            headers: [
                {
                    text: this.$t('table.headers.fullName'),
                    align: 'left',
                    value: 'fullName',
                    width: '30%',
                    sortable: true,
                    filterable: true,
                },
                {
                    text: this.$t('table.headers.phone'),
                    align: 'center',
                    value: 'phone',
                    width: '20%',
                    sortable: false,
                    filterable: false,
                },
                {
                    text: this.$t('table.headers.address'),
                    align: 'center',
                    value: 'address',
                    width: '20%',
                    sortable: false,
                    filterable: true,
                },
                {
                    text: this.$t('table.headers.city'),
                    align: 'center',
                    value: 'city',
                    width: '20%',
                    sortable: true,
                    filterable: true,
                },
                {
                    text: this.$t('table.headers.actions'),
                    align: 'center',
                    value: 'actions',
                    width: '10%',
                    sortable: false,
                    filterable: false,
                },
            ],
            filters: {},
            activeFilters: {},
            footerProps: {
                itemsPerPageText: this.$t('table.footer.per_page_text'),
                itemsPerPageOptions: [10, 25, 50],
            },
            user: new UserModel(),
            isShowUserModal: false,
            isShowConfirmModal: false,
        };
    },
    computed: {
        items() {
            return this.users.filter((user) => {
                return Object.keys(this.activeFilters).every((key) => {
                    return !this.activeFilters[key].length || this.activeFilters[key].includes(user[key]);
                });
            });
        },
    },
    mounted() {
        this.rebuild();
    },
    methods: {
        async rebuild() {
            const result = await axios.get('/get');
            this.users = result.data.users;
            this.filters = result.data.filters;
        },
        showModal(item) {
            this.user = item;
            this.isShowUserModal = true;
        },
        showConfirmModal(item) {
            this.user = item;
            this.isShowConfirmModal = true;
        },
        reset() {
            this.user = new UserModel();
        },
    },
    created() {
        eventBus.$on('users.created', this.rebuild);
        eventBus.$on('users.updated', this.rebuild);
        eventBus.$on('users.deleted', this.rebuild);
    },
    beforeDestroy() {
        eventBus.$off('users.created', this.rebuild);
        eventBus.$off('users.updated', this.rebuild);
        eventBus.$off('users.deleted', this.rebuild);
    },
}
</script>

<style scoped>

</style>
